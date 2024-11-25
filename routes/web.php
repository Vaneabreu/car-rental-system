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

/* ==============================
  RUTAS DE AUTENTICACIÓN
 ============================== */

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/password/email', [LoginController::class, 'sendPasswordResetLink'])->name('password.email');

/* ==============================
  RUTAS PÚBLICAS
 ============================== */

Route::get('/welcome', function () {
    return view('welcome');
});


/* ==============================
  RUTAS QUE REQUIEREN AUTENTICACIÓN
 ============================== */

Route::middleware(['auth'])->group(function () {

    /* ==============================
      PÁGINAS GENERALES
     ============================== */
    // Página de inicio
    Route::get('/', [VehiculoController::class, 'ver']);
    Route::get('/home', [VehiculoController::class, 'ver'])->name('vehiculos.ver');

    // Página fuera de línea (PWA)
    Route::get('/offline', function(){
        return view('vendor.laravelpwa.offline');
    });

    // Página Web
    Route::get('/web', [VehiculoController::class, 'paginaWeb'])->name('pagina.web');

    // Calendario de reservas
    Route::get('/calendar', [ReservaController::class, 'calendar'])->name('calendar');

    /* ==============================
      RUTAS DE VEHÍCULOS
     ============================== */
    Route::prefix('vehiculos')->name('vehiculos.')->group(function () {
        Route::get('/crear', [VehiculoController::class, 'crear'])->name('crear');
        Route::post('/registrar', [VehiculoController::class, 'store'])->name('store');
        Route::get('/ver', [VehiculoController::class, 'ver'])->name('ver');
        Route::get('/{id}/editar', [VehiculoController::class, 'editar'])->name('editar');
        Route::delete('/{id}', [VehiculoController::class, 'eliminar'])->name('eliminar');
        Route::put('/{id}', [VehiculoController::class, 'actualizar'])->name('actualizar');
        Route::get('/reservar', [ReservaController::class, 'create'])->name('reservar');
        Route::post('/reservar', [ReservaController::class, 'store'])->name('guardarReserva');
        Route::get('/estado-cuenta', [VehiculoController::class, 'estadoCuenta'])->name('estado-cuenta');
    });

    /* ==============================
      RUTAS DE RESERVAS
     ============================== */
    Route::prefix('reservas')->name('reservas.')->group(function () {
        Route::get('/por-mes', [ReservaController::class, 'reservasPorMes'])->name('por-mes');
        Route::delete('/{id}/eliminar', [ReservaController::class, 'eliminar'])->name('eliminar');
        Route::get('/{id}/editar', [ReservaController::class, 'editar'])->name('editar');
        Route::put('/{id}', [ReservaController::class, 'actualizar'])->name('actualizar');
        Route::get('/por-fecha/{fecha}', [ReservaController::class, 'reservasPorFecha'])->name('por_fecha');
    });

    /* ==============================
      RUTAS DE VENTAS
     ============================== */
    Route::prefix('ventas')->name('ventas.')->group(function () {
        Route::get('/crear', [VehiculoController::class, 'CrearVenta'])->name('crear');
        Route::post('/store', [VehiculoController::class, 'storeVenta'])->name('store');
        Route::get('/ver', [VehiculoController::class, 'viewVentas'])->name('view');
        Route::get('/{id}/edit', [VehiculoController::class, 'editVenta'])->name('edit');
        Route::delete('/{id}', [VehiculoController::class, 'destroyVenta'])->name('destroy');
        Route::put('/{id}', [VehiculoController::class, 'updateVenta'])->name('update');
    });

    /* ==============================
      ESTADO DE CUENTA Y PDF
     ============================== */
    Route::prefix('estado-cuenta')->name('vehiculos.estado-cuenta.')->group(function () {
        Route::get('/generar-pdf', [ReservaController::class, 'generarFacturaPDF'])->name('pdf');
        Route::post('/pdf', [VehiculoController::class, 'estadoCuentaPDF'])->name('pdf');
        Route::get('/print', [VehiculoController::class, 'printEstadoCuenta'])->name('print');
    });

    /* ==============================
      RUTAS DE CLIENTES
     ============================== */
    Route::prefix('clientes')->name('clientes.')->group(function () {
        Route::get('/ver', [ClienteController::class, 'index'])->name('ver');
        Route::get('/', [ClienteController::class, 'create'])->name('create');
        Route::post('/', [ClienteController::class, 'store'])->name('store');
        Route::get('/get', [ClienteController::class, 'getClients'])->name('get');
        Route::get('/{cliente}/edit', [ClienteController::class, 'edit'])->name('edit');
        Route::put('/{cliente}', [ClienteController::class, 'update'])->name('update');
        Route::get('/detalle/{cliente}', [ClienteController::class, 'show'])->name('show');
        Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('destroy');
        Route::get('/buscar', [ClienteController::class, 'buscarClientes'])->name('buscar');
    });

    /* ==============================
      RUTAS DE GASTOS
     ============================== */
    Route::prefix('gastos')->name('gastos.')->group(function () {
        Route::get('/', [GastoController::class, 'index'])->name('index');
        Route::get('/crear', [GastoController::class, 'create'])->name('create');
        Route::post('/', [GastoController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [GastoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GastoController::class, 'update'])->name('update');
        Route::delete('/{id}', [GastoController::class, 'destroy'])->name('destroy');
    });

    /* ==============================
      RUTAS DE COTIZACIÓN
     ============================== */
    Route::prefix('cotizacion')->name('cotizacion.')->group(function () {
        Route::get('/crear', [CotizacionController::class, 'crear'])->name('crear');
        Route::post('/generar', [CotizacionController::class, 'generar'])->name('generar');
        Route::get('/{id}', [CotizacionController::class, 'ver'])->name('ver');
        Route::get('/{cotizacion}/editar', [CotizacionController::class, 'edit'])->name('editar');
        Route::put('/{cotizacion}', [CotizacionController::class, 'actualizar'])->name('actualizar');
        Route::get('/{cotizacion}/descargar', [CotizacionController::class, 'descargar'])->name('descargar');
        Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('index');
        Route::delete('/{id}', [CotizacionController::class, 'destroy'])->name('destroy');
    });

});
