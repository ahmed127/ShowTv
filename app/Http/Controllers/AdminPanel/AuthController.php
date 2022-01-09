<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
    	return view('adminPanel.auth.login');
    }

    public function postLogin(Request $request)
    {
    	$credentials = $request->validate([
    		'email' => 'required|email:rfc,dns',
    		'password' => 'required',
    	]);

        Admin::where('email', $request->email)->first();
        
    	if (Auth::guard('admin')->attempt($credentials)) {
    		return redirect(route('adminPanel.dashboard'));
    	}
        
        return back()->with(['errorMessage' => 'These credentials do not match our records.']);
	}

    public function logout()
    {
    	Auth::guard('admin')->logout();

    	return redirect(route('adminPanel.login'));
    }
}
