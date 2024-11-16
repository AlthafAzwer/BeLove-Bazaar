<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle the admin login process.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the user has the 'admin' role
            if ($user->roles->contains('name', 'admin')) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout(); // Log out if not an admin
            return redirect()->route('admin.login')->withErrors(['error' => 'Access denied.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Log the admin out and redirect to the admin login.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
