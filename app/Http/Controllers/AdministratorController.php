<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrator;
use App\Models\User;

class AdministratorController extends Controller
{
    public function index()
    {
        $search = request('search');
        $query  = Administrator::with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $administrators = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('administrators.index', compact('administrators'));
    }

    public function create()
    {
        return view('administrators.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'phone'    => 'required|max:20',
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
            'role'     => 'admin',
        ]);

        // 2. Create the Administrator profile
        Administrator::create([
            'name'    => $validatedData['name'],
            'email'   => $validatedData['email'],
            'phone'   => $validatedData['phone'],
            'role'    => 'admin',
            'image'   => $validatedData['image'],
            'user_id' => $user->id,
        ]);

        return redirect('/administrators')->with('success', 'Administrator created. Login: ' . $validatedData['email']);
    }

    public function show(Administrator $administrator)
    {
        return view('administrators.show', compact('administrator'));
    }

    public function edit($id)
    {
        $administrator = Administrator::findOrFail($id);
        return view('administrators.edit', compact('administrator'));
    }

    public function update(Request $request, $id)
    {
        $administrator = Administrator::findOrFail($id);

        $validatedData = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . ($administrator->user->id ?? 'NULL'),
            'phone'    => 'required|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Handle image upload with old image cleanup
        if ($image = $request->file('image')) {
            if ($administrator->image && $administrator->image !== 'default.jpg') {
                $oldPath = public_path('image/' . $administrator->image);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $profileImage);
            $validatedData['image'] = $profileImage;
        }

        // Update administrator profile
        $administrator->update([
            'name'  => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role'  => 'admin',
            'image' => $validatedData['image'] ?? $administrator->image,
        ]);

        // Sync linked user account
        if ($administrator->user) {
            $userUpdate = [
                'name'  => $validatedData['name'],
                'email' => $validatedData['email'],
            ];
            if (!empty($validatedData['password'])) {
                $userUpdate['password'] = Hash::make($validatedData['password']);
            }
            $administrator->user->update($userUpdate);
        }

        return redirect('/administrators')->with('success', 'Administrator updated successfully');
    }

    public function destroy($id)
    {
        $administrator = Administrator::findOrFail($id);

        // Delete image file
        if ($administrator->image && $administrator->image !== 'default.jpg') {
            $oldPath = public_path('image/' . $administrator->image);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        // Delete linked user account
        if ($administrator->user) {
            $administrator->user->delete();
        }

        $administrator->delete();
        return redirect('/administrators')->with('success', 'Administrator deleted successfully');
    }

    // Live search JSON endpoint
    public function search(Request $request)
    {
        $q = $request->get('q', '');
        if (strlen($q) < 2) return response()->json([]);

        $results = Administrator::where(function ($query) use ($q) {
                        $query->where('name', 'like', "%{$q}%")
                              ->orWhere('email', 'like', "%{$q}%");
                    })
                    ->select('id', 'name', 'email', 'role', 'image')
                    ->orderBy('name')->limit(8)->get();

        return response()->json($results);
    }
}
