<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class landing extends Controller
{
	public function index()
	{

		return view('landing.landingHome', ['title' => 'LandingPage']);
	}
}
