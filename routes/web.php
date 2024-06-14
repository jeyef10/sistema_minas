<?php

use App\Http\Controllers\AsignarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\UserSettingsController;
use App\Models\Asignar;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ManualController;
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
// Route::get('/comisionados/create/{municipioId}', [ComisionadosController::class, 'getParroquias']);

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
// Route::get('/recepcion/detalles/{id}', [RecepcionController::class, 'getRecepcionDetalles']);

/* Ruta Planificación */
Route::get('/planificacion', [PlanificacionController::class,'index'])->name('planificacion')->middleware('auth');
Route::get('/planificacion/create', [PlanificacionController::class, 'create'])->name('create')->middleware('auth');
Route::resource('planificacion', PlanificacionController::class)->middleware('auth');
Route::get('/planificacion/create/fetchComisionados/{municipioId}', [PlanificacionController::class, 'fetchComisionados']);
Route::get('/planificacion/detalles/{id}', [PlanificacionController::class, 'getRecepcionDetalles']);
// Route::get('/planificacion/create/{recepcion}', 'PlanificacionController@create')->name('planificacion.create');
// Route::get('/planificacion/{recepcionId}', [PlanificacionController::class, 'getRecepcionDatos']);

Route::get('/planificacion/create/getRecepcionDatos/{recepcionId}', [PlanificacionController::class, 'getRecepcionDatos'])->name('recepcionId');


/* Ruta Inspección */
Route::get('/inspeccion', [InspeccionesController::class,'index'])->name('inspeccion')->middleware('auth');
Route::get('/inspeccion/create', [InspeccionesController::class, 'create'])->name('create')->middleware('auth');
// Route::resource('planificacion', PlanificacionController::class)->middleware('auth');
// Route::get('/planificacion/create/fetchComisionados/{municipioId}', [PlanificacionController::class, 'fetchComisionados']);
// Route::get('/planificacion/detalles/{id}', [PlanificacionController::class, 'getRecepcionDetalles']);

/* Ruta Bitacora*/
Route::get('bitacora', [ReporteController::class, 'bitacora'])->name('bitacora')->middleware('auth');

/* Ruta Manual */
Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth');

// Route::get('/municipios', [SolicitudesController::class, 'getMunicipios']);
// Route::get('/solicitudes/create/{municipioId}', [SolicitudesController::class, 'getParroquias']);
// Route::get('/solicitudes/create/fetch-comisionados/{municipioId}/{parroquiaId}', [SolicitudesController::class, 'fetchComisionados']);
// Route::get('/solicitudes/create/mostrarComisionados/{municipioId}/{parroquiaId}', [SolicitudesController::class, 'mostrarComisionados']);



/* Ruta Cargo 
Route::get('/cargo',  [CargoController::class,'index'])->name('cargo')->middleware('auth');

Route::get('/cargo/create',[CargoController::class,'create'])->name('create')->middleware('auth');

Route::get('/cargo/pdf',  [CargoController::class,'pdf'])->name('cargo')->middleware('auth');

Route::resource('cargo', CargoController::class)->middleware('auth');*/

/* Ruta Division 

Route::get('/division',  [DivisionController::class,'index'])->name('division')->middleware('auth');

Route::get('/division/create',[DivisionController::class,'create'])->name('create')->middleware('auth');*/

/* Ruta de PDF Division 
Route::get('/division/archivo',  [DivisionController::class,'archivo'])->name('division.archivo')->middleware('auth');

Route::resource('division', DivisionController::class)->middleware('auth');*/

/* Ruta Marca 
Route::get('/marca',  [MarcaController::class,'index'])->name('marca')->middleware('auth');

Route::get('/marca/create',[MarcaController::class,'create'])->name('create')->middleware('auth');

Route::get('/marca/pdf',  [MarcaController::class,'pdf'])->name('marca')->middleware('auth');


Route::post('/marca/saveModal', [MarcaController::class, 'saveModal'])->name('marca.saveModal')->middleware('auth');//ruta para procesar la solicitud AJAX

Route::resource('marca', MarcaController::class)->middleware('auth');*/

/* Ruta Modelo
Route::get('/modelo',  [ModeloController::class,'index'])->name('modelo')->middleware('auth');

Route::get('/modelo/create',[ModeloController::class,'create'])->name('create')->middleware('auth');

Route::get('/modelo/pdf',  [ModeloController::class,'pdf'])->name('modelo')->middleware('auth');

Route::post('/modelo/saveModal', [ModeloController::class, 'saveModal'])->name('modelo.saveModal')->middleware('auth');//ruta para procesar la solicitud AJAX

Route::resource('modelo', ModeloController::class)->middleware('auth');*/


/* Ruta Tipo de Periféricos
Route::get('/tipoperiferico',  [TipoPerifericoController::class,'index'])->name('tipoperiferico')->middleware('auth');

Route::get('/tipoperif/create',[TipoPerifericoController::class,'create'])->name('create')->middleware('auth');

Route::get('/tipoperiferico/pdf',[TipoPerifericoController::class,'pdf'])->name('tipoperiferico')->middleware('auth');

Route::resource('tipoperif', TipoPerifericoController::class)->middleware('auth');*/


/* Ruta Periferico
Route::get('/periferico',  [PerifericosController::class,'index'])->name('periferico')->middleware('auth');

Route::get('/periferico/create',[PerifericosController::class,'create'])->name('create')->middleware('auth');

Route::get('/periferico/pdf',  [PerifericosController::class,'pdf'])->name('periferico')->middleware('auth');

Route::resource('periferico', PerifericosController::class)->middleware('auth');*/

/* Ruta Persona
Route::get('/persona',  [PersonaController::class,'index'])->name('persona')->middleware('auth');

Route::get('persona/by-sede/{sede}', [PersonaController::class, 'getBySede'])->name('divisiones.by.sede');

Route::get('/persona/create',[PersonaController::class,'create']);

Route::get('/persona/pdf',  [PersonaController::class,'pdf'])->name('persona')->middleware('auth');

Route::resource('persona', PersonaController::class);*/

/* Ruta Sistema
Route::get('/sistema',  [SistemaController::class,'index'])->name('sistema')->middleware('auth');

Route::get('/sistema/create',[SistemaController::class,'create'])->name('create')->middleware('auth');

Route::get('/sistema/pdf',  [SistemaController::class,'pdf'])->name('sistema')->middleware('auth');

Route::resource('sistema', SistemaController::class)->middleware('auth');*/

/* Ruta Equipo
Route::get('/equipo',  [EquiposController::class,'index'])->name('equipo')->middleware('auth');

Route::get('/equipo/create',[EquiposController::class,'create'])->name('create')->middleware('auth');

Route::get('/equipo/pdf',  [EquiposController::class,'pdf'])->name('equipo')->middleware('auth');

Route::resource('equipo', EquiposController::class)->middleware('auth');

Route::post('/equipo/marca', [EquiposController::class,'modal'])->middleware('auth');*/

/* Ruta Asignar 
Route::get('/asignar', [AsignarController::class, 'index'])->name('asignar')->middleware('auth');
Route::get('/asignar/pdf', [AsignarController::class, 'pdf'])->name('asignar')->middleware('auth');
Route::get('/asignar/create', [AsignarController::class, 'create'])->name('asignar.create')->middleware('auth');
Route::put('/asignar/persona/{id}', [AsignarController::class, 'updateByPerson'])->name('asignar.updateByPerson')->middleware('auth');
Route::put('/asignar/reincorp/{id}', [AsignarController::class, 'updatereincorp'])->name('asignar.updatereincorp')->middleware('auth');
Route::get('/asignar/{asignar}/reincorporar', [AsignarController::class, 'reincorporar'])->name('asignar.reincorporar')->middleware('auth');
Route::get('/asignar/{asignar}/desincorporar', [AsignarController::class, 'desincorporar'])->name('asignar.desincorporar')->middleware('auth');

Route::resource('asignar', AsignarController::class)->middleware('auth');

Route::get('/desincorporar', [AsignarController::class, 'desincorp'])->name('desincorporar')->middleware('auth');

Route::get('/reincorporar', [AsignarController::class, 'reincorp'])->name('reincorporar')->middleware('auth');*/

/* Ruta Estadistica 

Route::get('estadistica', [EstadisticaController::class, 'index'])->name('estadistica')->middleware('auth');*/

/* Ruta reportes 
Route::get('reportes', [ReporteController::class, 'index'])->name('reportes')->middleware('auth');
Route::get('/reportes/pdf',  [ReporteController::class,'reportesPdf'])->name('reportes.pdf')->middleware('auth');
Route::get('reportes/indexperif', [ReporteController::class, 'indexperif'])->name('reportes')->middleware('auth');
Route::get('/reportes/perifpdf',  [ReporteController::class,'reportesperifPdf'])->name('reportes.perifpdf')->middleware('auth');


/* Ruta Inventario
Route::get('/inventario',  [EquiposController::class,'indexinvent'])->name('equipo')->middleware('auth');
Route::get('/inventario/estatus',  [AsignarController::class,'estatus'])->name('estatus')->middleware('auth');*/

/* Ruta Manual 
Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth'); */