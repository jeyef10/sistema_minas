<?php

use App\Http\Controllers\AsignarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\ValidarcedulaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PerifericosController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\TipoPerifericoController;
use App\Http\Controllers\EstadisticaController;
use App\Models\Asignar;
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
Route::get('/logout', [LogoutController::class, 'logout']);

/* Ruta Perfil Usuario */
Route::get('/Perfil',  [UserSettingsController::class,'Perfil'])->name('Perfil')->middleware('auth');
Route::post('/change/password',  [UserSettingsController::class,'changePassword'])->name('changePassword');

/* Ruta Sede */
Route::get('/sede',  [SedeController::class,'index'])->name('sede')->middleware('auth');
Route::get('/sede/create', [SedeController::class, 'create'])->name('create')->middleware('auth');
Route::get('/sede/pdf',  [SedeController::class,'pdf'])->name('sede')->middleware('auth');
Route::resource('sede', SedeController::class)->middleware('auth');

/* Ruta Cargo */
Route::get('/cargo',  [CargoController::class,'index'])->name('cargo')->middleware('auth');

Route::get('/cargo/create',[CargoController::class,'create'])->name('create')->middleware('auth');

Route::get('/cargo/pdf',  [CargoController::class,'pdf'])->name('cargo')->middleware('auth');

Route::resource('cargo', CargoController::class)->middleware('auth');

/* Ruta Division */

Route::get('/division',  [DivisionController::class,'index'])->name('division')->middleware('auth');

Route::get('/division/create',[DivisionController::class,'create'])->name('create')->middleware('auth');

/* Ruta de PDF Division */
Route::get('/division/archivo',  [DivisionController::class,'archivo'])->name('division.archivo')->middleware('auth');

Route::resource('division', DivisionController::class)->middleware('auth');

/* Ruta Marca */
Route::get('/marca',  [MarcaController::class,'index'])->name('marca')->middleware('auth');

Route::get('/marca/create',[MarcaController::class,'create'])->name('create')->middleware('auth');

Route::get('/marca/pdf',  [MarcaController::class,'pdf'])->name('marca')->middleware('auth');


Route::post('/marca/saveModal', [MarcaController::class, 'saveModal'])->name('marca.saveModal')->middleware('auth');//ruta para procesar la solicitud AJAX

Route::resource('marca', MarcaController::class)->middleware('auth');

/* Ruta Modelo*/
Route::get('/modelo',  [ModeloController::class,'index'])->name('modelo')->middleware('auth');

Route::get('/modelo/create',[ModeloController::class,'create'])->name('create')->middleware('auth');

Route::get('/modelo/pdf',  [ModeloController::class,'pdf'])->name('modelo')->middleware('auth');

Route::post('/modelo/saveModal', [ModeloController::class, 'saveModal'])->name('modelo.saveModal')->middleware('auth');//ruta para procesar la solicitud AJAX

Route::resource('modelo', ModeloController::class)->middleware('auth');


/* Ruta Tipo de Periféricos*/
Route::get('/tipoperiferico',  [TipoPerifericoController::class,'index'])->name('tipoperiferico')->middleware('auth');

Route::get('/tipoperif/create',[TipoPerifericoController::class,'create'])->name('create')->middleware('auth');

Route::get('/tipoperiferico/pdf',[TipoPerifericoController::class,'pdf'])->name('tipoperiferico')->middleware('auth');

Route::resource('tipoperif', TipoPerifericoController::class)->middleware('auth');


/* Ruta Periferico*/
Route::get('/periferico',  [PerifericosController::class,'index'])->name('periferico')->middleware('auth');

Route::get('/periferico/create',[PerifericosController::class,'create'])->name('create')->middleware('auth');

Route::get('/periferico/pdf',  [PerifericosController::class,'pdf'])->name('periferico')->middleware('auth');

Route::resource('periferico', PerifericosController::class)->middleware('auth');

/* Ruta Persona*/
Route::get('/persona',  [PersonaController::class,'index'])->name('persona')->middleware('auth');

Route::get('persona/by-sede/{sede}', [PersonaController::class, 'getBySede'])->name('divisiones.by.sede');

Route::get('/persona/create',[PersonaController::class,'create']);

Route::get('/persona/pdf',  [PersonaController::class,'pdf'])->name('persona')->middleware('auth');

Route::resource('persona', PersonaController::class);

/* Ruta Sistema*/
Route::get('/sistema',  [SistemaController::class,'index'])->name('sistema')->middleware('auth');

Route::get('/sistema/create',[SistemaController::class,'create'])->name('create')->middleware('auth');

Route::get('/sistema/pdf',  [SistemaController::class,'pdf'])->name('sistema')->middleware('auth');

Route::resource('sistema', SistemaController::class)->middleware('auth');

/* Ruta Equipo*/
Route::get('/equipo',  [EquiposController::class,'index'])->name('equipo')->middleware('auth');

Route::get('/equipo/create',[EquiposController::class,'create'])->name('create')->middleware('auth');

Route::get('/equipo/pdf',  [EquiposController::class,'pdf'])->name('equipo')->middleware('auth');

Route::resource('equipo', EquiposController::class)->middleware('auth');

Route::post('/equipo/marca', [EquiposController::class,'modal'])->middleware('auth');

/* Ruta Asignar */
Route::get('/asignar', [AsignarController::class, 'index'])->name('asignar')->middleware('auth');
Route::get('/asignar/pdf', [AsignarController::class, 'pdf'])->name('asignar')->middleware('auth');
Route::get('/asignar/create', [AsignarController::class, 'create'])->name('asignar.create')->middleware('auth');
Route::put('/asignar/persona/{id}', [AsignarController::class, 'updateByPerson'])->name('asignar.updateByPerson')->middleware('auth');
Route::put('/asignar/reincorp/{id}', [AsignarController::class, 'updatereincorp'])->name('asignar.updatereincorp')->middleware('auth');
Route::get('/asignar/{asignar}/reincorporar', [AsignarController::class, 'reincorporar'])->name('asignar.reincorporar')->middleware('auth');
Route::get('/asignar/{asignar}/desincorporar', [AsignarController::class, 'desincorporar'])->name('asignar.desincorporar')->middleware('auth');

Route::resource('asignar', AsignarController::class)->middleware('auth');

Route::get('/desincorporar', [AsignarController::class, 'desincorp'])->name('desincorporar')->middleware('auth');

Route::get('/reincorporar', [AsignarController::class, 'reincorp'])->name('reincorporar')->middleware('auth');

/* Ruta Estadistica */

Route::get('estadistica', [EstadisticaController::class, 'index'])->name('estadistica')->middleware('auth');

/* Ruta reportes */
Route::get('reportes', [ReporteController::class, 'index'])->name('reportes')->middleware('auth');
Route::get('/reportes/pdf',  [ReporteController::class,'reportesPdf'])->name('reportes.pdf')->middleware('auth');
Route::get('reportes/indexperif', [ReporteController::class, 'indexperif'])->name('reportes')->middleware('auth');
Route::get('/reportes/perifpdf',  [ReporteController::class,'reportesperifPdf'])->name('reportes.perifpdf')->middleware('auth');
Route::get('bitacora', [ReporteController::class, 'bitacora'])->name('bitacora')->middleware('auth');

/* Ruta Inventario*/
Route::get('/inventario',  [EquiposController::class,'indexinvent'])->name('equipo')->middleware('auth');
Route::get('/inventario/estatus',  [AsignarController::class,'estatus'])->name('estatus')->middleware('auth');

/* Ruta Manual */
Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth');