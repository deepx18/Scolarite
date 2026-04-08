<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginStudentsController extends Controller
{
    public function showLoginForm()
    {
        return view('loginStudents.index');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'apogee' => 'nullable|string',
            'dob' => 'nullable|date',
        ], [
            'apogee.required' => 'Apogee number or CNE is required',
            'dob.required' => 'The date of birth is required',
            'dob.date' => 'The date of birth must be a valid date',
        ]);

        // Check if both fields are provided
        if (empty($validated['apogee']) || empty($validated['dob'])) {
            return back()
                ->withErrors(['general' => 'Please enter both your Apogee number/CNE and date of birth'])
                ->withInput();
        }

        $student = Student::where(function ($query) use ($validated) {
            $query->where('apogee_number', trim($validated['apogee']))
                  ->orWhere('cne', trim($validated['apogee']));
        })
        ->where('date_of_birth', trim($validated['dob']))
        ->first();

        if ($student) {
            Auth::guard('student')->login($student);
            return redirect()->route('requests.index');
        }

        return back()
            ->withErrors(['general' => 'Invalid credentials. Please check your Apogee number/CNE and date of birth.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.student.show');
    }
}
