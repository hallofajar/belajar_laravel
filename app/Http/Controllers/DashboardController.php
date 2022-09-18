<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	protected $data;

	public function __construct()
	{
		$this->data = [
			'title' => 'Dashboard',
			'active' => 'Dashboard',
		];
	}

}
