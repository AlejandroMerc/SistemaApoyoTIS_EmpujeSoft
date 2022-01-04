<?php

use App\Http\Controllers\EntregaController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CalendarioGEController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/template/{id}', [TemplateController::class, 'getTemplate'])->name('getTemplate');
Route::get('/template/delete/{id}', [TemplateController::class, 'deleteTemplate'])->name('deleteTemplate');

Route::get('/adjunto/entrega/{activity_id}/{grupoempresa_id}', [EntregaController::class, 'getFiles'])->name('getAdjuntoFiles');
Route::get('/calendarioGE/{grupoempresa_id}', [CalendarioGEController::class, 'showCalendarGE']);
