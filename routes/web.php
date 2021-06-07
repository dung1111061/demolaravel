<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth'])->group(function () {
	Route::get('/', function () {
	    return view('dashboard');
	})->name('dashboard');

	Route::resource('user', UserController::class);
	Route::get('/user/search', [UserController::class,'search'])->name('search');

});
require __DIR__.'/auth.php';
