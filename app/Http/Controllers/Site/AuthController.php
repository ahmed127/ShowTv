<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Models\Gift;
use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
    	return view('site.auth.register');
    }

    public function postRegister(Request $request)
    {
    	$inputs = $request->validate([
    		'name' => 'required|max:191',
    		'image' => 'required',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:6|max:191|confirmed',
    	]);

        $user = User::create($inputs);

    	if (Auth::guard('web')->attempt(['email' => $user->email, 'password'=> $request->password])) {
            dispatch(new SendEmailJob($user->email));
            Gift::create(['user_id'=>$user->id, 'amount'=>'20','expired_at'=> now()->addDays(5)]);

    		return redirect(route('site.home'));
    	}

        return back()->with(['errorMessage' => 'These credentials do not match our records.']);
	}

    public function login()
    {
    	return view('site.auth.login');
    }

    public function postLogin(Request $request)
    {
    	$credentials = $request->validate([
    		'email' => 'required|email',
    		'password' => 'required',
    	]);

        User::where('email', $request->email)->first();

    	if (Auth::guard('web')->attempt($credentials)) {
    		return redirect(route('site.home'));
    	}

        return back()->with(['errorMessage' => 'These credentials do not match our records.']);
	}
    public function logout()
    {
    	Auth::logout();

    	return redirect(route('site.login'));
    }
}
