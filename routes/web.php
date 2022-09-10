<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Umum\landing;
use App\Http\Controllers\Auth\Registrasi;
use App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [landing::class, 'index']);

// Auth Route

Route::controller(Login::class)->group(function () {
	Route::get('/login', 'index');
	Route::post('/login',  'login');
});


Route::controller(Registrasi::class)->group(function () {
	Route::get('/register', 'index');
	Route::post('/register', 'store');
});

// dashboard
Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth'])->name('dashboard');
