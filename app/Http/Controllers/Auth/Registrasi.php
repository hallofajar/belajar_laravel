<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Registrasi extends Controller
{
	//
	public function index()
	{
		return view('auth.registrasi');
	}

	public function store(Request $request)
	{
		// return $request->all();
		// Validate the request...
		$request->validate([
			'fullname' => 'required|max:255',
			'username' => 'required|unique:users|max:255',
			'email' => 'email|required|unique:users|max:255',
			'password' => 'required|min:5',
		]);


		dd('registrasi berhasil');
		// Store the user...
	}
}
