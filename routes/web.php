<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtlasController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Modelo3DController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('auth.home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/modelos-3d', [Modelo3DController::class, 'index'])->name('modelos-3d.index');
Route::get('/modelos-3d/animais/{animal:slug}', [Modelo3DController::class, 'porAnimal'])->name('modelos-3d.por-animal');
Route::get('/modelos-3d/{modelo}', [Modelo3DController::class, 'show'])->name('modelos-3d.show');
Route::get('/site/contato/index', [RegisterController::class, 'siteIndex'])->name('site.contato.index');
Route::get('/site/contato/visualizar/{registro:slug}', [RegisterController::class, 'siteRegistervisualizar'])->name('site.contato.visualizar');




Route::prefix('atlas')->name('atlas.')->group(function () {
    Route::get('/index', [AtlasController::class, 'index'])->name('index');
    Route::get('/show/{conteudo:slug}', [AtlasController::class, 'show'])->name('show');


    Route::get('/sistemas', [AtlasController::class, 'indexSistemas'])->name('sistemas.index');
    Route::get('/sistemas/{sistema:slug}', [AtlasController::class, 'showSistema'])->name('sistemas.show');
    Route::get('/animais', [AtlasController::class, 'indexAnimais'])->name('animais.index');
    Route::get('/animais/{animal:slug}', [AtlasController::class, 'showAnimal'])->name('animais.show');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');

    Route::get('/contatos/edit', [ContatoController::class, 'edit'])->name('contatos.edit');
    Route::put('/contatos', [ContatoController::class, 'update'])->name('contatos.update');
});

require __DIR__.'/auth.php';
