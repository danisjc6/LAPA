<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Conteudo;
use App\Models\Sistema;

class AtlasController extends Controller
{
    public function index()
    {
        return view('atlas.index');
    }

    public function indexSistemas()
    {
        $sistemas = Sistema::all();

        return view('atlas.sistemas.index', compact('sistemas'));
    }

    public function showSistema(Sistema $sistema)
    {
        $conteudos = $sistema->conteudos()->get();

        return view('atlas.sistemas.show', compact('sistema', 'conteudos'));
    }

    public function indexAnimais()
    {
        $animais = Animal::all();

        return view('atlas.animais.index', ['animais' => $animais]);
    }

    public function showAnimal(Animal $animal)
    {
        $conteudos = $animal->conteudos()->get();

        return view('atlas.animais.show', compact('animal', 'conteudos'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update( $request, )
    {

    }

    public function destroy()
    {

    }

    public function show(Conteudo $conteudo)
    {
        $conteudo->load([
            'area',
            'secoes',
            'secoes.arquivos',
            'animal',
        ]);
        return view('atlas.show', compact('conteudo'));
    }
}
