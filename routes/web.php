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


Route::get('/site/visita/busca', [VisitaController::class, 'busca'])->name('site.visita.busca');
Route::get('/site/visita/buscar',[RegisterController::class, 'buscarUsuarioVisita'])->name('site.visita.buscar.registro');

Route::post('/site/visita/salvar', [VisitaController::class, 'salvarUsuarioVisita'])->name('site.visita.salvar');
Route::get('/site/visita/verificar/{id}/{hash}', [VerificationController::class, 'verificarVisita'])->name('site.verificar.visita');


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


    Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.create');

	Route::get('/auth/visitas', [VisitaController::class, 'index'])->name('auth.visitas');
	Route::get('/auth/visita/ver/{registro:slug}', [VisitaController::class, 'ver'])->name('auth.visita.ver');
	Route::put('/auth/visitas/atualizar/{id}', [VisitaController::class, 'atualizar'])->name('auth.visita.atualizar');
	Route::get('/auth/visitas/deletar/{id}', [VisitaController::class, 'deletar'])->name('auth.visita.deletar');

	Route::get('/auth/contatos', [ContatoController::class, 'index'])->name('auth.contatos');
	Route::get('/auth/contato/adicionar', [ContatoController::class, 'adicionar'])->name('auth.contato.adicionar');
	Route::post('/auth/contato/salvar', [ContatoController::class, 'salvar'])->name('auth.contato.salvar');
	Route::get('/auth/contato/editar/{registro:slug}', [ContatoController::class, 'editar'])->name('auth.contato.editar');
	Route::put('/auth/contato/atualizar/{id}', [ContatoController::class, 'atualizar'])->name('auth.contato.atualizar');
	Route::get('/auth/contato/deletar/{registro:slug}', [ContatoController::class, 'deletar'])->name('auth.contato.deletar');

});

require __DIR__.'/auth.php';
