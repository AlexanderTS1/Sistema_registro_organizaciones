<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publico\RegistroOrganizacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/registro-organizacion');
});



/*
|--------------------------------------------------------------------------
| PANEL PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get(
    '/registro-organizacion',
    [RegistroOrganizacionController::class, 'create']
)->name('registro.create');

Route::post(
    '/registro-organizacion',
    [RegistroOrganizacionController::class, 'store']
)->name('registro.store');

Route::get(
    '/registro-exitoso/{id}',
    [RegistroOrganizacionController::class, 'success']
)->name('registro.success');



/*
|--------------------------------------------------------------------------
| CONSULTA EXPEDIENTE
|--------------------------------------------------------------------------
*/

Route::get(
    '/consulta-expediente',
    [RegistroOrganizacionController::class, 'consulta']
)->name('consulta.expediente');

Route::post(
    '/consulta-expediente',
    [RegistroOrganizacionController::class, 'buscar']
)->name('consulta.buscar');



/*
|--------------------------------------------------------------------------
| DASHBOARD USUARIO
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



/*
|--------------------------------------------------------------------------
| PERFIL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



require __DIR__.'/auth.php';