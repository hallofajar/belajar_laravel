<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
		// Validate the request...
		$request->validate([
			'nama' => 'required|max:255',
			'email' => 'email|required|unique:users|max:255',
			'nomerhp' => 'required',
			'password' => 'required|min:5',
		]);


		// Store the user...
		User::create([
			'nama' => $request->nama,
			'email' => $request->email,
			'nomerhp' => $request->nomerhp,
			'password' => bcrypt($request->password),
		]);

		return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
	}
}
