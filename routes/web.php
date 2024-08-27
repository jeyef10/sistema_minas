<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SolicitanteController;
use App\Http\Controllers\RecaudosController;
use App\Http\Controllers\ComisionadosController;
use App\Http\Controllers\MineralController;
use App\Http\Controllers\RegaliaController;
use App\Http\Controllers\PlazosController;
// use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\PlanificacionController;
use App\Http\Controllers\InspeccionesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ManualController;




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
    return view('auth.login');
})->name('login');

// Route::get('/reset-password', function () {
//     return view('reset-password');
// })->name('password.email');

Route::get('/reset-password/{token}/{email}', function ($token, $email) {
    return view('reset-password-confirm', ['token' => $token, 'email' => $email]);
})->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'sendEmail'])->name('password.email');

Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.update');

// /* Ruta Importar Nómina */
// Route::get('nomina', [NominaController::class, 'index']);
// Route::post('nomina/importar', [NominaController::class, 'Importar']);

// /* Ruta Validar la Cedúla */
// Route::get('validacion', [ValidarcedulaController::class, 'index']);
// Route::get('/validar', [ValidarcedulaController::class, 'create']);

/* Ruta Registro del Usuario */
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

/*creamos un grupo de rutas protegidas para los controlador de roles */

Route::resource('roles', RolController::class)->middleware('auth');
Route::resource('usuarios', UsuarioController::class)->middleware('auth');

/* Ruta Login o Inicio de Sesión */
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

/* Ruta Home o Vista Principal(Inicio) */
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

/* Ruta Logout o Cierre de Sesión */
Route::get('/logout', [logoutController::class, 'logout']);

/* Ruta Perfil Usuario */
Route::get('/Perfil',  [UserSettingsController::class,'Perfil'])->name('Perfil')->middleware('auth');
Route::post('/change/password',  [UserSettingsController::class,'changePassword'])->name('changePassword');

/* Ruta Solicitante */
Route::get('/solicitante',  [SolicitanteController::class,'index'])->name('solicitante')->middleware('auth');
Route::get('/solicitante/create', [SolicitanteController::class, 'create'])->name('create')->middleware('auth');
Route::get('/solicitante/pdf',  [SolicitanteController::class,'pdf'])->name('solicitante')->middleware('auth');
Route::resource('solicitante', SolicitanteController::class)->middleware('auth');

/* Ruta Recaudo */
Route::get('/recaudo',  [RecaudosController::class,'index'])->name('recaudo')->middleware('auth');
Route::get('/recaudo/create', [RecaudosController::class, 'create'])->name('create')->middleware('auth');
Route::get('/recaudo/pdf',  [RecaudosController::class,'pdf'])->name('recaudo')->middleware('auth');
Route::resource('recaudo', RecaudosController::class)->middleware('auth');

/* Ruta Comisionado*/
Route::get('/comisionado',  [ComisionadosController::class,'index'])->name('comisionado')->middleware('auth');
Route::get('/comisionado/create', [ComisionadosController::class, 'create'])->name('create')->middleware('auth');
Route::get('/comisionado/pdf',  [ComisionadosController::class,'pdf'])->name('comisionado')->middleware('auth');
Route::resource('comisionado', ComisionadosController::class)->middleware('auth');
Route::get('/municipios', [ComisionadosController::class, 'getMunicipios']);

/* Ruta Mineral */
Route::get('/mineral',  [MineralController::class,'index'])->name('mineral')->middleware('auth');
Route::get('/mineral/create', [MineralController::class, 'create'])->name('create')->middleware('auth');
Route::get('/mineral/pdf',  [MineralController::class,'pdf'])->name('mineral')->middleware('auth');
Route::resource('mineral', MineralController::class)->middleware('auth');

/* Ruta Regalia */
Route::get('/regalia',  [RegaliaController::class,'index'])->name('regalia')->middleware('auth');
Route::get('/regalia/create', [RegaliaController::class, 'create'])->name('create')->middleware('auth');
Route::get('/regalia/pdf',  [RegaliaController::class,'pdf'])->name('regalia')->middleware('auth');
Route::resource('regalia', RegaliaController::class)->middleware('auth');

/* Ruta Plazo*/
Route::get('/plazo',  [PlazosController::class,'index'])->name('plazo')->middleware('auth');
Route::get('/plazo/create', [PlazosController::class, 'create'])->name('create')->middleware('auth');
Route::get('/plazo/pdf',  [PlazosController::class,'pdf'])->name('plazo')->middleware('auth');
Route::resource('plazo', PlazosController::class)->middleware('auth');

/* Ruta Categoria*/
// Route::get('/categoria',  [CategoriaController::class,'index'])->name('categoria')->middleware('auth');
// Route::get('/categoria/create', [CategoriaController::class, 'create'])->name('create')->middleware('auth');
// Route::get('/categoria/pdf',  [CategoriaController::class,'pdf'])->name('categoria')->middleware('auth');
// Route::resource('categoria', CategoriaController::class)->middleware('auth');

/* Ruta Recepcion de Recaudos */
Route::get('/recepcion/create', [RecepcionController::class, 'create'])->name('create')->middleware('auth');
Route::resource('recepcion', RecepcionController::class)->middleware('auth');
Route::get('/recepcion/create/fetch-solicitantes/{tipoSolicitante}', [RecepcionController::class, 'fetchSolicitantesByTipo']);
Route::get('/recepcion/create/fetch-minerales', [RecepcionController::class, 'fetchMinerales']);
Route::get('/recepcion/create/fetch-recaudos', [RecepcionController::class, 'fetchRecaudos']);

/* Ruta Planificación */
Route::get('/planificacion', [PlanificacionController::class,'index'])->name('planificacion')->middleware('auth');
Route::get('/planificacion/create', [PlanificacionController::class, 'create'])->name('create')->middleware('auth');
Route::get('/planificacion/create/{id}', [PlanificacionController::class,'create'])->name('planificacion.create')->middleware('auth');
Route::resource('planificacion', PlanificacionController::class)->middleware('auth');
Route::get('/planificacion/create/fetchComisionados/{municipioId}', [PlanificacionController::class, 'fetchComisionados']);
Route::get('/planificacion/detalles/{id}', [PlanificacionController::class, 'getRecepcionDetalles']);

Route::get('/planificacion/create/getRecepcionDatos/{recepcionId}', [PlanificacionController::class, 'getRecepcionDatos'])->name('recepcionId');
Route::get('/notifications/fetch', [NotificationController::class, 'fetch']) ->name('notifications.fetch');
Route::get('/notifications/user', [NotificationController::class, 'sendInspectionNotifications']) ->name('notifications.user');

/* Ruta Inspección */
Route::get('/inspeccion', [InspeccionesController::class,'index'])->name('inspeccion')->middleware('auth');
Route::get('/inspeccion/create', [InspeccionesController::class, 'create'])->name('create')->middleware('auth');
Route::get('/inspeccion/create/{id}', [InspeccionesController::class, 'create'])->name('inspeccion.create')->middleware('auth');
Route::resource('inspeccion', InspeccionesController::class)->middleware('auth');
Route::get('/inspeccion/create/fetchComisionados/{municipioId}', [InspeccionesController::class, 'fetchComisionados']);

/* Ruta Licencia */
Route::get('/licencia', [LicenciaController::class,'index'])->name('licencia')->middleware('auth');
Route::get('/licencia/create', [LicenciaController::class, 'create'])->name('create')->middleware('auth');
Route::get('/licencia/create/{id}', [LicenciaController::class, 'create'])->name('licencia.create')->middleware('auth');
Route::resource('licencia', LicenciaController::class)->middleware('auth');
Route::get('/licencia/detalles/{id}', [LicenciaController::class, 'getInspeccionDetalles']);

/* Ruta Bitacora*/
Route::get('bitacora', [ReporteController::class, 'bitacora'])->name('bitacora')->middleware('auth');

/* Ruta Manual */
Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth');
