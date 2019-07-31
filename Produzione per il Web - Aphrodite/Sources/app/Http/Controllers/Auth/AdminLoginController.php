<?php

namespace ASD_Aphrodite\Http\Controllers\auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use ASD_Aphrodite\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct() {

        $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAdmin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect()->intended(route('area_riservata.home'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('auth.login');
    }
}
