<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\OrganizacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('restaurantes', RestauranteController::class);

Route::get('/organizacion', [OrganizacionController::class, 'create'])->name('organizacion.create');

Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');


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
