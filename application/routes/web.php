<?php

use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PropriedadeController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth:sanctum', 'verified'])->group(function()
{
    Route::get('/dashboard', function ()
    {
        return Inertia::render('Dashboard');

    })->name('dashboard');

    Route::get('/propriedades',        [PropriedadeController::class, 'index'])->name('propriedades.index');
    Route::get('/propriedades/search', [PropriedadeController::class, 'search'])->name('propriedades.search');
    Route::get('/propriedades/create', [PropriedadeController::class, 'create'])->name('propriedades.create');
    Route::post('/propriedades/store', [PropriedadeController::class, 'store'])->name('propriedades.store');
    Route::put('/propriedades/update', [PropriedadeController::class, 'update'])->name('propriedades.update');
    Route::delete('/propriedades/delete/{propriedade}', [PropriedadeController::class, 'delete'])->name('propriedades.delete');

    Route::get('/contratos',        [ContratoController::class, 'index'])->name('contratos.index');
    Route::get('/contratos/create', [ContratoController::class, 'create'])->name('contratos.create');
    Route::post('/contratos/store', [ContratoController::class, 'store'])->name('contratos.store');
    Route::put('/contratos/update', [ContratoController::class, 'update'])->name('contratos.update');
    Route::delete('/contratos/delete/{contrato}', [ContratoController::class, 'delete'])->name('contratos.delete');


    Route::get('/relatorio',    [RelatorioController::class, 'index'])->name('relatorio.index');
    Route::post('/relatorio/create',    [RelatorioController::class, 'create'])->name('relatorio.create');
    Route::get('/relatorio/download/{relatorio}',    [RelatorioController::class, 'download'])->name('relatorio.download');

});




