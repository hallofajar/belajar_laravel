<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

class DataPenduduk extends DashboardController
{
	public function index()
	{
		return view('dashboard.penduduk_index');
		// dd($this->data);
	}
}
