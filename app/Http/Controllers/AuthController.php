<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login($value='')
    {
		// dd(Auth::id());
		return view('auth.login');
    }

    public function doLogin(Request $request)
    {
    	$credentials = $request->only('email', 'password');
        
    	if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->can('manage users')) {
                //
            }
    		return redirect()->intended('/');
    	}
    	
        return redirect()->intended('/auth/login');
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->intended('auth/login');
    }
}
