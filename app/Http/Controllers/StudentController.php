<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

// Quick explanation of each method:

//Méthode	Rôle
//index()	Récupère tous les étudiants → envoie à index.blade.php
//create()	Affiche le formulaire → create.blade.php
//store()	Valide + sauvegarde en DB + upload image
//show()	Affiche un seul étudiant → show.blade.php
//edit()	Affiche le formulaire pré-rempli → edit.blade.php
//update()	Met à jour en DB
//destroy()	Supprime de la DB

class StudentController extends Controller
{
    public function index()
    {
        $search  = request('search');
        $section = request('section');

        $query = Student::with('teacher');

        $user = auth()->user();
        if ($user->isTeacher()) {
            $teacher = $user->teacher;
            $query   = $teacher
                ? $query->where('section', $teacher->subject)
                : $query->whereRaw('0=1');
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($section) {
            $query->where('section', $section);
        }

        $students = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('students.index', compact('students'));
    }

    // 2. Show the form to create a new student
    public function create()
    {
        $teachers = \App\Models\Teacher::all();
        return view('students.create', compact('teachers'));
    }

    // 3. Save new student to database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|max:255',
            'email'      => 'required|email|max:255|unique:students,email',
            'phone'      => 'required|max:20',
            'section'    => 'required|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
            'image'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $profileImage);
            $validatedData['image'] = $profileImage;
        }

        Student::create($validatedData);
        return redirect('/students')->with('success', 'Student created successfully');
    }

    // 4. Show one student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // 5. Show the edit form
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $teachers = \App\Models\Teacher::all();
        return view('students.edit', compact('student', 'teachers'));
    }

    // 6. Update student in database
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'name'       => 'required|max:255',
            'email'      => 'required|email|max:255|unique:students,email,' . $id,
            'phone'      => 'required|max:20',
            'section'    => 'required|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        if ($image = $request->file('image')) {
            // Delete old image
            if ($student->image && $student->image !== 'default.jpg') {
                $oldPath = public_path('image/' . $student->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $profileImage);
            $validatedData['image'] = $profileImage;
        }

        $student->update($validatedData);
        return redirect('/students')->with('success', 'Student updated successfully');
    }

    // Live search JSON endpoint
    public function search(Request $request)
    {
        $q = $request->get('q', '');
        if (strlen($q) < 2) return response()->json([]);

        $user  = auth()->user();
        $query = Student::query();
        if ($user->isTeacher() && $user->teacher) {
            $query->where('section', $user->teacher->subject);
        }

        $results = $query->where(function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%")
                           ->orWhere('email', 'like', "%{$q}%");
                    })
                    ->select('id', 'name', 'email', 'section', 'image')
                    ->orderBy('name')->limit(8)->get();

        return response()->json($results);
    }

    // 7. Delete student from database
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        // Delete image file
        if ($student->image && $student->image !== 'default.jpg') {
            $oldPath = public_path('image/' . $student->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $student->delete();
        return redirect('/students')->with('success', 'Student deleted successfully');
    }
}



