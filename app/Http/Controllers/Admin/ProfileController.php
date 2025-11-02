<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Profile routes are already protected by auth:admin and role:admin middleware in routes
        // Admins should be able to view/edit profiles without additional permissions
    }
    
    
    public function index($admin)
    {
        $admin = User::findOrFail($admin);
        // Return the profile view for the admin
        return view('admin.profile', compact('admin'));
    }

    public function edit($admin)
    {
        $admin = User::findOrFail($admin);
        // Return the edit profile view for the admin
        return view('profile.EditProfile', compact('admin'));
    }   

    public function update(Request $request, $admin)
    {
        $admin = User::findOrFail($admin);
        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = uniqid('profile_', true) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProfileImg'), $imageName);
            $data['profile_image'] = 'ProfileImg/' . $imageName;
        }

        $admin->update($data);
        return redirect()->route('admin.profile', $admin->id)->with('success', 'Profile updated successfully.');
    }

    public function destroy($admin)
    {
        $admin = User::findOrFail($admin);
        $admin->delete();
        return redirect()->route('admin.login')->with('success', 'Admin profile deleted successfully.');
    }
}
