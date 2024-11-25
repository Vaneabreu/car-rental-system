<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

//Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/carros', [VehiculoController::class, 'cars']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/test2', function() {
    /* dd("Hola"); */
 return view('test2');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');



 Route::middleware(['auth'])->group(function () {

//Rutas que requieren autenticación

//HOME
Route::get('/', [VehiculoController::class, 'ver']);
Route::get('/homes', [App\Http\Controllers\VehiculoController::class, 'ver'])->name('vehiculos.ver');

Route::get('/offline', function(){
    return view('vendor.laravelpwa.offline');
});

//PAGINA WEB
Route::get('/web', [VehiculoController::class, 'paginaWeb'])->name('pagina.web');

//CALENDARIO
Route::get('/calendar', [ReservaController::class, 'calendar'])->name('calendar');

//VEHICULOS
Route::get('/vehiculos/crear', [VehiculoController::class, 'crear'])->name('vehiculos.crear');
Route::post('/vehiculos/registrar', [VehiculoController::class, 'store'])->name('vehiculos.store');
Route::get('/vehiculos/ver', [VehiculoController::class, 'ver'])->name('vehiculos.ver');
Route::get('/vehiculos/{id}/editar', [VehiculoController::class, 'editar'])->name('vehiculos.editar');
Route::delete('/vehiculos/{id}', [VehiculoController::class, 'eliminar'])->name('vehiculos.eliminar');
Route::put('/vehiculos/{id}', [VehiculoController::class, 'actualizar'])->name('vehiculos.actualizar');
Route::get('/vehiculos/reservar', [ReservaController::class, 'create'])->name('vehiculos.reservar');
Route::post('/vehiculos/reservar', [ReservaController::class, 'store'])->name('vehiculos.guardarReserva');
Route::get('/vehiculos/reservas/por-mes', [ReservaController::class, 'reservasPorMes'])->name('reservas.por-mes');
Route::get('/vehiculos/estado-cuenta', [VehiculoController::class, 'estadoCuenta'])->name('vehiculos.estado-cuenta');
Route::get('/vehiculos/reservas/por-fecha/{fecha}', [ReservaController::class, 'reservasPorFecha'])->name('vehiculos.reservas.por_fecha');


//VENTAS
Route::get('/vehiculos/venta', [VehiculoController::class, 'CrearVenta'])->name('vehiculos.venta');
Route::post('/vehiculos/store/venta', [VehiculoController::class, 'storeVenta'])->name('vehiculos.guardarVenta');
Route::get('/vehiculos/ventas/view', [VehiculoController::class, 'viewVentas'])->name('vehiculos.viewVentas');
Route::get('/venta/{id}/edit', [VehiculoController::class, 'editVenta'])->name('venta.edit');
Route::delete('/venta/{id}', [VehiculoController::class, 'destroyVenta'])->name('ventas.destroy');
Route::put('/ventas/{id}', [VehiculoController::class, 'updateVenta'])->name('ventas.update');

//RESERVAS
Route::delete('/reservas/{id}/eliminar', [ReservaController::class, 'eliminar'])->name('reservas.eliminar');
Route::get('/reservas/{id}/editar', [ReservaController::class, 'editar'])->name('reservas.editar');
Route::put('/reservas/{id}', [ReservaController::class, 'actualizar'])->name('reservas.actualizar');

//ESTADO DE CUENTA Y PDF
Route::get('/generar-factura-pdf', [ReservaController::class, 'generarFacturaPDF'])->name('generar.factura.pdf');
Route::post('vehiculos/estado-cuenta/pdf', [VehiculoController::class, 'estadoCuentaPDF'])->name('vehiculos.estado-cuenta.pdf');
Route::get('/vehiculos/estado-cuenta/print', [VehiculoController::class, 'printEstadoCuenta'])->name('vehiculos.estado-cuenta.print');

//CLIENTES
Route::get('/clientes/ver', [ClienteController::class, 'index'])->name('ver.clientes');
Route::get('/clientes', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/get', 'ClienteController@getClients')->name('clientes.get');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::get('/clientes/detalle/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/buscar-clientes', [ClienteController::class, 'buscarClientes'])->name('buscar.clientes');


//GASTOS
Route::get('/gastos', [GastoController::class, 'index'])->name('gastos.index');
Route::get('/gastos/create', [GastoController::class, 'create'])->name('gastos.create');
Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store');
Route::get('/gastos/crear', [GastoController::class, 'crear'])->name('gastos.crear');
Route::get('/gastos/{id}/edit', [GastoController::class, 'edit'])->name('gastos.edit');
Route::put('/gastos/{id}', [GastoController::class, 'update'])->name('gastos.update');
Route::delete('/gastos/{id}', [GastoController::class, 'destroy'])->name('gastos.destroy');

//COTIZACION
Route::delete('/cotizacion/{id}', [CotizacionController::class, 'destroy'])->name('cotizacion.destroy');
Route::get('/cotizacion/crear', [CotizacionController::class, 'crear'])->name('cotizacion.crear');
Route::post('/cotizacion/generar', [CotizacionController::class, 'generar'])->name('cotizacion.generar');
Route::get('/cotizacion/{id}', [CotizacionController::class, 'ver'])->name('cotizacion.ver');
Route::get('/cotizaciones/{cotizacion}/editar', [CotizacionController::class, 'edit'])->name('cotizaciones.editar');
Route::put('/cotizaciones/{cotizacion}', [CotizacionController::class, 'actualizar'])->name('cotizaciones.actualizar');
Route::get('/cotizacion/{cotizacion}/descargar', [CotizacionController::class, 'descargar'])->name('cotizacion.descargar');
Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizacion.index');

});

Route::post('/password/email', [LoginController::class, 'sendPasswordResetLink'])->name('password.email');

Route::get('test', function(){
    return view('test');
})->name('test');

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */

Route::get('/home', [App\Http\Controllers\VehiculoController::class, 'ver'])->name('vehiculos.ver');

/* Route::get('/homes', [App\Http\Controllers\VehiculoController::class, 'ver'])->name('vehiculos.ver');
 */

Auth::routes();

Route::get('/home', [VehiculoController::class, 'ver'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
