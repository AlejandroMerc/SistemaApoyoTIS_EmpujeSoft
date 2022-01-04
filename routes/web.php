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
use App\Http\Controllers\CreateSemesterController;
use App\Http\Controllers\CreateActivityController;
use App\Http\Controllers\TurnInActivityController;
use App\Http\Controllers\ActivityResponseController;
use App\Http\Controllers\ActivitySendCorrectionController;

use App\Http\Controllers\ControllerEvent;
use App\Http\Controllers\ControllerCalendar;
use App\Http\Controllers\CalendarioEventoController;
use App\Http\Controllers\CalendarioGEController;
use App\Http\Controllers\VerRespuestasDosController;
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
Route::post('plantillas', [TemplateListController::class, 'uploadFile'])->name('template');

Route::get('plantillas/editor/{id}', [TemplateEditorController::class, 'index'])->name('template-editor-id');
Route::post('plantillas/editor/{id}', [TemplateEditorController::class, 'save'])->name('template-editor-id');

Route::post('registroge', [App\Http\Controllers\RegisterGEController::class, 'registrarGE'])->name('register-ge-data');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registerGE', [App\Http\Controllers\RegisterGEController::class, 'registerGE'])->name('registerGE');
Route::get('listarGrupoEmpresa', [ListGEController::class, 'showListGE'])->name('listGE');

Route::get('/postPublication', [PostPublicationController::class, 'showPostPublication'])->name('postPublication');
Route::post('/postPublication',[PostPublicationController::class,'registerPublicationData'])->name('register-publication');

Route::get('/createSemester', [App\Http\Controllers\CreateSemesterController::class, 'createSemester'])->name('createSemester');
Route::post('/createSemester',[App\Http\Controllers\CreateSemesterController::class, 'store'])->name('store-data');

Route::get('/verRespuestasDos/{publicacion_id}', [App\Http\Controllers\VerRespuestasDosController::class, 'verRespuestasDos'])->name('verRespuestasDos');
Route::get('/responderActividad/{publicacion_id}',[TurnInActivityController::class, 'showTurnIn'])->name('responderActividad');
Route::post('/responderActividad', [TurnInActivityController::class,'sendActivity'])->name('sendActivity');
Route::post('/validateFiles', [TurnInActivityController::class,'validateFiles'])->name('validateFiles');

/*Route::get('/calendarioTis',function(){
    return view('eventos.index');
});*/
Route::get('/calendarioTis',[CalendarioEventoController::class, 'index'])->name('calendarioTis');;

Route::group(['middleware'=> ['auth']],function(){

Route::get('/evento', [CalendarioEventoController::class, 'index']);
Route::post('/evento/mostrar', [CalendarioEventoController::class, 'show']);
Route::post('/evento/agregar/{calendario_id}', [CalendarioEventoController::class, 'store']);
Route::post('/evento/editar/{id}', [CalendarioEventoController::class, 'edit']);
Route::post('/evento/actualizar/{evento}', [CalendarioEventoController::class, 'update']);
Route::post('/evento/borrar/{id}', [CalendarioEventoController::class, 'destroy']);
});

Route::get('/calendarioGE', [CalendarioGEController::class, 'index'])->name('calendarioGE');
//Route::post('/calendarioGE/mostrar', [CalendarioGEController::class, 'show']);
Route::post('/calendarioGE/mostrar/{ge_id}', [CalendarioGEController::class, 'showCalendarGE'])->name('mostrarGE');

Route::get('/crearEventoTIS', [App\Http\Controllers\CalendarioTISController::class, 'showCreateEventTIS'])->name('crearEventoTIS');
Route::post('/crearEventoTIS', [App\Http\Controllers\CalendarioTISController::class, 'createEventTIS'])->name('crearEvento-data-tis');

Route::get('/planificacionAsesor', [App\Http\Controllers\PlanificacionAsesorController::class, 'showPlanificacion'])->name('planificacionAsesor');

// Auth::routes();
Route::get('password/reset', '\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('createActivity', [CreateActivityController::class, 'showCreateActivity'])->name('createActivity');

Route::get('/crearGrupo', [crearGrupoController::class, 'index'])->name('crearGrupo');
Route::post('/crearGrupo', [crearGrupoController::class, 'validar'])->name('crearGrupo');
Route::post('createActivity', [CreateActivityController::class, 'registerActivityData'])->name('registir-activity-data');

Route::get('verRespuestasDos/revision/{id_grupoempresa}/{id_activity}', [ActivityResponseController::class, 'indexResponse'])->name('verRespuesta.revision');
Route::post('verRespuestasDos/revision/{id_grupoempresa}/{id_activity}', [ActivityResponseController::class, 'response'])->name('verRespuesta.revision');
Route::get('verRespuestasDos/correccion/{id_grupoempresa}/{id_activity}', [ActivitySendCorrectionController::class, 'index'])->name('verRespuesta.correccion');
Route::post('verRespuestasDos/correccion/{id_grupoempresa}/{id_activity}', [ActivitySendCorrectionController::class, 'sendActivity'])->name('verRespuesta.correccion');
Route::post('aceptarEntrega', [VerRespuestasDosController::class, 'aceptar'])->name('aceptarEntrega');

Route::get('/link', function () {
    Artisan::call('storage:link');
    });
