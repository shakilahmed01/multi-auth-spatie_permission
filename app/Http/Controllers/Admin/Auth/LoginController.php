<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect admins after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return '/admin/dashboard'; // Redirect to admin dashboard
    }

    /**
     * Override the guard to use 'admin' guard for authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin'); // Use the admin guard
    }

    /**
     * Show the admin login form.
     */
    public function showAdminLoginForm()
    {
        return view('auth.admin-login'); // Ensure this view exists
    }

    /**
     * Handle an admin login request.
     */
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/admin/dashboard'); // Redirect after successful login
        }

        return back()->withErrors(['email' => 'Invalid login credentials.']);
    }

    /**
     * Logout from the admin guard.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logout from admin guard
        return redirect('/admin/login'); // Redirect to admin login page
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}
