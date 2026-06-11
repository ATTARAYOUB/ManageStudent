<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $search = request('search');
        $query  = Teacher::withCount('students');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $teachers = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'phone'    => 'required',
            'subject'  => 'required|max:255',
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|min:6|confirmed',
        ]);

        // Handle image upload
        if ($image = $request->file('image')) {
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $profileImage);
            $validatedData['image'] = $profileImage;
        }

        // 1. Create the User login account
        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role'     => 'teacher',
        ]);

        // 2. Create the Teacher profile linked to that user
        Teacher::create([
            'name'    => $validatedData['name'],
            'email'   => $validatedData['email'],
            'phone'   => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'image'   => $validatedData['image'],
            'user_id' => $user->id,
        ]);

        return redirect('/teachers')->with('success', 'Teacher created successfully. Login: ' . $validatedData['email']);
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validatedData = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . ($teacher->user->id ?? 'NULL'),
            'phone'    => 'required',
            'subject'  => 'required|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Handle image upload
        if ($image = $request->file('image')) {
            // Delete old image
            if ($teacher->image && $teacher->image !== 'default.jpg') {
                $oldPath = public_path('image/' . $teacher->image);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $profileImage);
            $validatedData['image'] = $profileImage;
        }

        // Update teacher profile
        $teacher->update([
            'name'    => $validatedData['name'],
            'email'   => $validatedData['email'],
            'phone'   => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'image'   => $validatedData['image'] ?? $teacher->image,
        ]);

        // Sync the linked user account if it exists
        if ($teacher->user) {
            $userUpdate = [
                'name'  => $validatedData['name'],
                'email' => $validatedData['email'],
            ];
            // Only update password if a new one was provided
            if (!empty($validatedData['password'])) {
                $userUpdate['password'] = Hash::make($validatedData['password']);
            }
            $teacher->user->update($userUpdate);
        }

        return redirect('/teachers')->with('success', 'Teacher updated successfully');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        // Delete image file
        if ($teacher->image && $teacher->image !== 'default.jpg') {
            $oldPath = public_path('image/' . $teacher->image);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        // Delete the linked user account too
        if ($teacher->user) {
            $teacher->user->delete();
        }

        $teacher->delete();
        return redirect('/teachers')->with('success', 'Teacher deleted successfully');
    }

    // Live search JSON endpoint
    public function search(Request $request)
    {
        $q = $request->get('q', '');
        if (strlen($q) < 2) return response()->json([]);

        $results = Teacher::where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                              ->orWhere('subject', 'like', "%{$q}%")
                              ->orWhere('email', 'like', "%{$q}%");
                    })
                    ->select('id', 'name', 'email', 'subject', 'image')
                    ->orderBy('name')->limit(8)->get();

        return response()->json($results);
    }
}
