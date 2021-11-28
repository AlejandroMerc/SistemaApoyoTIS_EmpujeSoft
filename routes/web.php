<?php

use App\Http\Controllers\ListGEController;
use App\Http\Controllers\RegisterAdviserController;
use App\Http\Controllers\RegisterStudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\PostPublicationController;
use App\Http\Controllers\TemplateListController;
use App\Http\Controllers\TemplateEditorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crearGrupoController;

use App\Http\Controllers\CreateActivityController;

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

Route::get('/',[HomeController::class, 'index']);

Route::get('login', [CustomLoginController::class, 'index'])->name('login');
Route::post('login', [CustomLoginController::class, 'login'])->name('login');

Route::get('registroasesor', [RegisterAdviserController::class, 'index'])->name('register-adviser-view');
Route::post('registroasesor', [RegisterAdviserController::class, 'registerData'])->name('register-adviser-data');

Route::get('registroestudiante', [RegisterStudentController::class, 'index'])->name('register-student-view');
Route::post('registroestudiante', [RegisterStudentController::class, 'registerData'])->name('register-student-data');

Route::get('plantillas', [TemplateListController::class, 'index'])->name('template');
Route::post('plantillas', [TemplateListController::class, 'uploadFile'])->name('template-upload');

Route::get('plantillas/subir', [TemplateListController::class, 'upload'])->name('template-file');

Route::get('plantillas/editor', [TemplateEditorController::class, 'index'])->name('template-editor');

Route::post('registroge', [App\Http\Controllers\RegisterGEController::class, 'registrarGE'])->name('register-ge-data');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registerGE', [App\Http\Controllers\RegisterGEController::class, 'registerGE'])->name('registerGE');
Route::get('listarGrupoEmpresa', [ListGEController::class, 'showListGE'])->name('listGE');

Route::get('/postPublication', [PostPublicationController::class, 'showPostPublication'])->name('postPublication');

// Auth::routes();
Route::get('password/reset', '\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('createActivity', [CreateActivityController::class, 'showCreateActivity'])->name('createActivity');

Route::get('/crearGrupo', [crearGrupoController::class, 'index'])->name('crearGrupo');
Route::post('/crearGrupo', [crearGrupoController::class, 'validar'])->name('crearGrupo');
