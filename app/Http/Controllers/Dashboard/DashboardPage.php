<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

class DashboardPage extends DashboardController
{
	public function index()
	{
		return view('dashboard.index',$this->data);
	}
}
