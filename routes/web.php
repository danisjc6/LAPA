<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AtlaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\VisitaController;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [PostagemController::class, 'siteHome'])->name('site.home');
Route::get('/site/atlas/index', [AtlaController::class, 'siteIndex'])->name('site.atlas.index');
Route::get('/site/atlas/categoria/{categoria:slug}', [AtlaController::class, 'atlasPorCategoria'])->name('site.atlas.categoria');
Route::get('/site/atlas/disciplina/{disciplina:slug}', [AtlaController::class, 'atlasPorDisciplina'])->name('site.atlas.disciplina');


Route::get('/site/eventos/index', [PostagemController::class, 'siteIndexEvento'] )->name('site.postagens.indexEvento');
Route::get('/site/noticias/index', [PostagemController::class, 'siteIndexNoticia'])->name( 'site.postagens.indexNoticia');
Route::get('/site/editais/index', [PostagemController::class, 'siteIndexEdital'])->name( 'site.postagens.indexEdital');


Route::get('/site/eventos/visualizar/{registro:slug}', [PostagemController::class, 'siteVisualizarPostagem'])->name('site.eventos.visualizar');

Route::get('/site/editais/visualizar/{registro:slug}', [PostagemController::class, 'siteVisualizarPostagem'])->name('site.editais.visualizar');

Route::get('/site/noticias/visualizar/{registro:slug}', [PostagemController::class, 'siteVisualizarPostagem'])->name('site.noticias.visualizar');


Route::get('/site/postagem/visualizar/{registro:slug}', [PostagemController::class, 'siteVisualizarPostagem'])->name('site.postagem.visualizar');

Route::get('/site/contato/index', [RegisterController::class, 'siteIndex'])->name('site.contato.index');
Route::get('/site/contato/visualizar/{registro:slug}', [RegisterController::class, 'siteRegistervisualizar'])->name('site.contato.visualizar');

Route::get('/site/materiais/index', [MaterialController::class, 'siteIndex'])->name('site.materiais.index');
Route::get('/site/materiais/disciplina/{disciplina:slug}', [MaterialController::class, 'materiaisPorDisciplina'])->name('site.materiais.disciplina');

Route::get('/site/visita/busca', [VisitaController::class, 'busca'])->name('site.visita.busca');
Route::get('/site/visita/buscar',[RegisterController::class, 'buscarUsuarioVisita'])->name('site.visita.buscar.registro');

Route::post('/site/visita/salvar', [VisitaController::class, 'salvarUsuarioVisita'])->name('site.visita.salvar');
Route::get('/site/visita/verificar/{id}/{hash}', [VerificationController::class, 'verificarVisita'])->name('site.verificar.visita');

Route::get('/termos&privacidade', [RegisterController::class, 'visualizarTermosPrivacidade'])->name('termo.privacidade');
Route::get('/confirmacao/email', [VerificationController::class, 'confirmacaoEmail'])->name('confirmacao.email');

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
  Route::get('/gerenciar', [HomeController::class, 'gerenciar'])->name('auth.gerenciar');
});

Route::middleware(['auth','check.cpf'])->group(function () {


	Route::get('/auth/registros',[RegisterController::class, 'index'])->name('auth.registros');
  	Route::get('/auth/registros/editar',[RegisterController::class, 'editar'])->name('auth.registros.editar');
   	Route::any('/auth/registros/atualizar',[RegisterController::class, 'atualizar'])->name('auth.registros.atualizar');
	Route::get('/auth/registros/deletar/{id}',[RegisterController::class, 'deletar'])->name('auth.registros.deletar');

	Route::get('/auth/disciplinas', [DisciplinaController::class, 'index'])->name('auth.disciplinas');
	Route::get('/auth/disciplina/adicionar', [DisciplinaController::class, 'adicionar'])->name('auth.disciplina.adicionar');
    Route::post('/auth/disciplina/salvar', [DisciplinaController::class, 'salvar'])->name('auth.disciplina.salvar');
	Route::put('/auth/disciplina/atualizar/{id}', [DisciplinaController::class, 'atualizar'])->name('auth.disciplina.atualizar');

	Route::get('/auth/disciplina/editar/{registro:slug}', [DisciplinaController::class, 'editar'])->name('auth.disciplina.editar');
	Route::get('/auth/disciplina/deletar/{registro:slug}', [DisciplinaController::class, 'deletar'])->name('auth.disciplina.deletar');

	Route::get('/auth/postagens', [PostagemController::class, 'index'])->name('auth.postagens');

	Route::get('/auth/postagem/adicionar', [PostagemController::class, 'adicionar'])->name('auth.postagem.adicionar');
	Route::post('/auth/postagem/salvar', [PostagemController::class, 'salvar'])->name('auth.postagem.salvar');

	Route::get('/auth/postagem/editar/{registro:slug}', [PostagemController::class, 'editar'])->name('auth.postagem.editar');

	Route::put('/auth/postagem/atualizar/{id}', [PostagemController::class, 'atualizar'])->name('auth.postagem.atualizar');

	Route::get('/auth/postagem/deletar/{registro:slug}', [PostagemController::class, 'deletar'])->name('auth.postagem.deletar');

	Route::get('/auth/postagem/publicar/{registro:slug}', [PostagemController::class, 'publicar_postagem'])->name('auth.postagem.publicar');

	Route::get('/auth/postagem/ver/{registro:slug}', [PostagemController::class, 'visualizarRascunho'])->name('auth.postagem.ver');

	Route::get('/auth/categorias', [CategoriaController::class, 'index'])->name('auth.categorias');
	Route::get('/auth/categoria/adicionar', [CategoriaController::class, 'adicionar'])->name('auth.categoria.adicionar');
	Route::post('/auth/categoria/salvar', [CategoriaController::class, 'salvar'])->name('auth.categoria.salvar');
	Route::get('/auth/categoria/editar/{registro:slug}', [CategoriaController::class, 'editar'])->name('auth.categoria.editar');
	Route::put('/auth/categoria/atualizar/{id}', [CategoriaController::class, 'atualizar'])->name('auth.categoria.atualizar');
	Route::get('/auth/categoria/deletar/{registro:slug}', [CategoriaController::class, 'deletar'])->name('auth.categoria.deletar');

	Route::get('/auth/atlas', [AtlaController::class, 'index'])->name('auth.atlas');
	Route::get('/auth/atla/adicionar', [AtlaController::class, 'adicionar'])->name('auth.atla.adicionar');
	Route::post('/auth/atla/salvar', [AtlaController::class, 'salvar'])->name('auth.atla.salvar');
	Route::get('/auth/atla/editar/{registro:slug}', [AtlaController::class, 'editar'])->name('auth.atla.editar');
	Route::put('/auth/atla/atualizar/{id}', [AtlaController::class, 'atualizar'])->name('auth.atla.atualizar');
	Route::get('/auth/atla/deletar/{registro:slug}', [AtlaController::class, 'deletar'])->name('auth.atla.deletar');
	Route::get('/auth/atla/visualizar/{registro:slug}', [AtlaController::class, 'ver'])->name('auth.atla.visualizar');
	Route::get('/auth/atla/publicar/{registro:slug}', [AtlaController::class, 'publicar'])->name('auth.atla.publicar');
	Route::get('/auth/anexos/deletar/{registro:id}', [AtlaController::class, 'deletarAnexo'])->name('auth.anexo.deletar');

	Route::get('/auth/materiais', [MaterialController::class, 'index'])->name('auth.materiais');
	Route::get('/auth/materiais/adicionar', [MaterialController::class, 'adicionar'])->name('auth.material.adicionar') ;
	Route::post('/auth/materiais/salvar',  [MaterialController::class, 'salvar'])->name('auth.material.salvar');
	Route::get('/auth/materiais/editar/{registro:slug}', [MaterialController::class, 'editar' ])->name('auth.material.editar');
	Route::put('/auth/materiais/atualizar/{id}', [MaterialController::class, 'atualizar'])->name(' auth.material.atualizar');
	Route::get('/auth/materiais/deletar/{registro:slug}', [MaterialController::class, ' deletar'])->name('auth.material.deletar');
	Route::get('ajax/materiais/disciplina/{registro:slug}', [MaterialController::class, 'ajaxMateriaisDisciplina'])->name('auth.ajax.materiais.disciplina');
    Route::get('/auth/material/visualizar/{registro:slug}', [MaterialController::class, 'ver'] )->name('auth.material.visualizar');
	Route::get('/auth/material/publicar/{registro:slug}', [MaterialController::class, 'publicar'])->name('auth.material.publicar ');


	Route::get('/auth/visitas', [VisitaController::class, 'index'])->name('auth.visitas');
	Route::get('/auth/visita/ver/{registro:slug}', [VisitaController::class, 'ver'])->name('auth.visita.ver');
	Route::put('/auth/visitas/atualizar/{id}', [VisitaController::class, 'atualizar'])->name('auth.visita.atualizar');
	Route::get('/auth/visitas/deletar/{id}', [VisitaController::class, 'deletar'])->name('auth.visita.deletar');

	Route::get('/auth/acesso_gerenciamento', [RegisterController::class, 'gerenciarSolicitacao'])->name('auth.acesso_gerenciamento');
	Route::get('/auth/acesso_gerenciamento/aceitarSolicitacao/{id}', [RegisterController::class, 'aceitarSolicitacao'])->name('auth.acesso_gerenciamento.aceitarSolicitacao');
	Route::get('/auth/acesso_gerenciamento/recusarSolicitacao/{id}', [RegisterController::class, 'recusarSolicitacao'])->name('auth.acesso_gerenciamento.recusarSolicitacao');

	Route::get('/auth/contatos', [ContatoController::class, 'index'])->name('auth.contatos');
	Route::get('/auth/contato/adicionar', [ContatoController::class, 'adicionar'])->name('auth.contato.adicionar');
	Route::post('/auth/contato/salvar', [ContatoController::class, 'salvar'])->name('auth.contato.salvar');
	Route::get('/auth/contato/editar/{registro:slug}', [ContatoController::class, 'editar'])->name('auth.contato.editar');
	Route::put('/auth/contato/atualizar/{id}', [ContatoController::class, 'atualizar'])->name('auth.contato.atualizar');
	Route::get('/auth/contato/deletar/{registro:slug}', [ContatoController::class, 'deletar'])->name('auth.contato.deletar');

});

Route::post('/auth/passwords/reset', [ContaController::class, 'resetPassword'])->name('auth.password.resetPassword');
Route::post('/auth/passwords/email', [ContaController::class, 'validatePasswordRequest'])->name('auth.password.validatePasswordRequest');
