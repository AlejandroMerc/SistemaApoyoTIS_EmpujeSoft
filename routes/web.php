<?php

use App\Http\Controllers\ListGEController;
use App\Http\Controllers\RegisterAdviserController;
use App\Http\Controllers\RegisterStudentController;
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

Route::get('registroestudiante', [RegisterStudentController::class, 'index'])->name('register-student-view');

Route::post('registroestudiante', [RegisterStudentController::class, 'registerData'])->name('register-student-data');



// Route::get('/registerGE', function () {
//     return view('registerGE');
// });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registerGE', [App\Http\Controllers\RegisterGEController::class, 'registerGE'])->name('registerGE');
Route::get('listarGrupoEmpresa', [ListGEController::class, 'showListGE'])->name('listGE');
Auth::routes();


