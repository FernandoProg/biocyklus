<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\OrganizacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\Auth\EmpleadoAuthController;
use App\Http\Controllers\Auth\OrganizacionAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth:empleados')->group(function () {
    Route::get('/empleados/dashboard', [EmpleadoAuthController::class, 'dashboard'])->name('empleados.dashboard');
});

Route::resource('restaurantes', RestauranteController::class);
Route::resource('organizacion', OrganizacionController::class);
Route::resource('empleados', EmpleadoController::class);
Route::get('/empleado/login', [EmpleadoAuthController::class, 'showLoginForm'])->name('empleados.login');
Route::post('/empleado/login', [EmpleadoAuthController::class, 'login']);
Route::post('/empleado/logout', [EmpleadoAuthController::class, 'logout'])->name('empleados.logout');

Route::get('/organizaciones/login', [OrganizacionAuthController::class, 'showLoginForm'])->name('organizaciones.login');
Route::post('/organizaciones/login', [OrganizacionAuthController::class, 'login']);
Route::post('/organizaciones/logout', [OrganizacionAuthController::class, 'logout'])->name('organizaciones.logout');

Route::post('/payment', [PaymentController::class, 'createdTransaction'])->name('payment.create');
Route::any('/payment/confirm', [PaymentController::class, 'commitTransaction'])->name('payment.commit');



Route::get('/nosotros', function () {
    return view('inicio/nosotros');
})->name('nosotros');

Route::get('/contacto', function () {
    return view('inicio/contacto');
});

Route::get('/terminos', function () {
    return view('inicio/terminos');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('administrador');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
