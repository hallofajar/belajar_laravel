<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

class DataPenduduk extends DashboardController
{
	public function index()
	{

		$this->data['active'] = 'Data Penduduk';
		return view('dashboard.penduduk_index',$this->data);
	}
}
