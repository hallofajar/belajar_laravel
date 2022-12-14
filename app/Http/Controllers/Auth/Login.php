<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
	public function index()
	{
		return view('auth.login');
	}
	public function login(Request $request)
	{

		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return redirect()->intended('dashboard');
		}

		return back()->with('pesan', 'The provided credentials do not match our records.');
	}

	public function logout(Request $request)
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}
}
