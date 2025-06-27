<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Attempt to log the user in
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Redirect based on role
        $user = Auth::user();
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('owner.dashboard');
        }
    } else {
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}

public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|in:student,owner',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
    ]);

    Auth::login($user);

    if ($user->role === 'student') {
        return redirect()->route('student.dashboard');
    } else {
        return redirect()->route('owner.dashboard');
    }
}


    public function showLogin()
    {
    return view('auth.login'); 
    }
    public function showRegister()
    {
    return view('auth.register'); 
    }
}
