<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Enrollment;

class CourseController extends Controller
{
    public function index()
    {
        $search = request('search');
        $user   = auth()->user();

        $query = Course::with(['teacher'])->withCount('students');

        // Teachers only see their own courses
        if ($user->isTeacher() && $user->teacher) {
            $query->where('teacher_id', $user->teacher->id);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('room', 'like', "%{$search}%")
                  ->orWhere('schedule', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|max:500',
            'schedule'    => 'required|max:255',
            'room'        => 'required|max:255',
            'teacher_id'  => 'nullable|exists:teachers,id',
        ]);

        Course::create($validated);
        return redirect('/courses')->with('success', 'Course created successfully');
    }

    public function show($id)
    {
        $course      = Course::with(['teacher', 'students'])->findOrFail($id);
        $allStudents = Student::orderBy('name')->get();
        return view('courses.show', compact('course', 'allStudents'));
    }

    public function edit($id)
    {
        $course   = Course::findOrFail($id);
        $teachers = Teacher::orderBy('name')->get();
        return view('courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $course    = Course::findOrFail($id);
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|max:500',
            'schedule'    => 'required|max:255',
            'room'        => 'required|max:255',
            'teacher_id'  => 'nullable|exists:teachers,id',
        ]);

        $course->update($validated);
        return redirect('/courses')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect('/courses')->with('success', 'Course deleted successfully');
    }

    // Live search JSON endpoint
    public function search(Request $request)
    {
        $q    = $request->get('q', '');
        $user = auth()->user();
        if (strlen($q) < 2) return response()->json([]);

        $query = Course::with('teacher');
        if ($user->isTeacher() && $user->teacher) {
            $query->where('teacher_id', $user->teacher->id);
        }

        $results = $query->where(function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%")
                           ->orWhere('room', 'like', "%{$q}%")
                           ->orWhere('schedule', 'like', "%{$q}%");
                    })
                    ->select('id', 'name', 'schedule', 'room', 'teacher_id')
                    ->orderBy('name')->limit(8)->get()
                    ->map(fn($c) => [
                        'id'       => $c->id,
                        'name'     => $c->name,
                        'schedule' => $c->schedule,
                        'room'     => $c->room,
                        'teacher'  => $c->teacher ? $c->teacher->name : null,
                    ]);

        return response()->json($results);
    }

    // Enroll a student in a course
    public function enroll(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $course = Course::findOrFail($id);

        // Prevent duplicate enrollment
        $exists = Enrollment::where('course_id', $id)
                             ->where('student_id', $request->student_id)
                             ->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Student is already enrolled in this course.');
        }

        $course->students()->syncWithoutDetaching([$request->student_id]);
        return redirect()->back()->with('success', 'Student enrolled successfully');
    }

    // Remove student from course
    public function unenroll($courseId, $studentId)
    {
        $course = Course::findOrFail($courseId);
        $course->students()->detach($studentId);
        return redirect()->back()->with('success', 'Student removed from course');
    }

    // Update grade for a student in a course
    public function updateGrade(Request $request, $courseId, $studentId)
    {
        $request->validate([
            'grade'   => 'nullable|numeric|min:0|max:20',
            'remarks' => 'nullable|max:255',
        ]);

        $grade       = $request->grade;
        $gradeLetter = null;

        if ($grade !== null) {
            $gradeLetter = match(true) {
                $grade >= 18 => 'A+',
                $grade >= 16 => 'A',
                $grade >= 14 => 'B',
                $grade >= 12 => 'C',
                $grade >= 10 => 'D',
                default      => 'F',
            };
        }

        Enrollment::where('course_id', $courseId)
                  ->where('student_id', $studentId)
                  ->update([
                      'grade'        => $grade,
                      'grade_letter' => $gradeLetter,
                      'remarks'      => $request->remarks,
                  ]);

        return redirect()->back()->with('success', 'Grade updated successfully');
    }
}
