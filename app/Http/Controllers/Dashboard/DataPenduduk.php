<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\pendudukRumahModels;

class DataPenduduk extends DashboardController
{
	public function index()
	{
		$this->data['dataPenduduk'] = pendudukRumahModels::all();
		$this->data['active'] = 'Data Penduduk';
		// dd($this->data['dataPenduduk']);
		return view('dashboard.penduduk_index',$this->data);
	}
}
