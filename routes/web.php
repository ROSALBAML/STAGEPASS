<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('subcategorias', SubcategoriaController::class);
Route::resource('categorias', SubcategoriaController::class);
Route::resource('users', SubcategoriaController::class);
Route::resource('boletos', BoletoController::class);
Route::resource('tarjetas_credito', BoletoController::class);
Route::resource('eventos', EventoController::class);

Route::get('/', [EventoController::class, 'home'])->name('home');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/evento/index', function () {
    return view('/evento.index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

