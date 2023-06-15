<?php

use App\Http\Controllers\DarkModeController;
use App\Http\Livewire\MostrarOpciones;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/menu', function () {
    return view('reserve.menu');
})->name('menu');

Route::get('/actualizar-perfil', function () {
    return view('reserve.actualizar-perfil');
})->name('actualizar-perfil');

Route::get('/reservas', function () {
    return view('reserve.mis-reservas');
})->name('reservas');

Route::get('/recomendaciones', function () {
    return view('reserve.recomendaciones');
})->name('recomendaciones');

Route::get('/filtrados', function () {
    return view('reserve.filtrados');
})->name('filtrados');

Route::get('/mesa/{mesaId}', function ($mesaId) {
    return view('reserve.tableData')->with('mesaId', $mesaId);
})->name('mesa');

