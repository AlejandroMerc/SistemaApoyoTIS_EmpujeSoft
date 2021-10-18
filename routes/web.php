<?php

use App\Http\Controllers\RegisterAdviserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('registroasesor', [RegisterAdviserController::class, 'index'])->name('register-adviser-view');

Route::post('registroasesor', [RegisterAdviserController::class, 'registerData'])->name('register-adviser-data');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
