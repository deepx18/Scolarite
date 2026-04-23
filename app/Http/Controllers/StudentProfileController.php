<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Show the student profile page
     */
    public function show()
    {
        $student = auth()->user();
        // dd($student->first_name);

        return view('fo_students.profile', [
            'student' => $student,
        ]);
    }

    /**
     * Update student profile information
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
        ]);

        auth()->user()->update($validated);

        return redirect()->route('profile.show')
            ->with('success', __('admin.profile_updated'));
    }

    /**
     * Show change password form
     */
    public function changePasswordForm()
    {
        return view('fo_students.change-password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('profile.show')
            ->with('success', __('admin.password_changed'));
    }
}
