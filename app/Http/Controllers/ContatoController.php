<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use App\Models\User;
use Validator;
use Auth;

class ContatoController extends Controller
{

    protected $contato;

    public function __construct(Contato $contato)
    {
        $this->middleware('auth');
        $this->contato = $contato;

    }

    public function index()
    {
        $registro = $this->contato->latest('updated_at')->first();

        if(!isset($registro)) {
            return view('auth.contato.adicionar');

        }

        return view('auth.contato.editar', compact('registro'));
    }

    public function adicionar()
    {
        return view('auth.contato.adicionar');
    }

    public function salvar(ContatoRequest $request)
    {
        $request->validated();
        $dados = $request->all();
        $dados["user_id"] = Auth::user()->id;
        $contato=$this->contato->create($dados);
        $contato['slug'] = str_slug($contato->email).'-'.$contato->id;
        $contato->update($contato->attributesToArray());

        return redirect()->back()->with('success', 'Informações do Contato adicionadas com sucesso!');
    }

    public function editar(Contato $contato)
    {
        return view('auth.contato.editar', compact('registro'));
    }

    public function atualizar(ContatoRequest $request, $identifier)
    {
        $request->validated();
        $dados = $request->all();
        $dados['slug'] = str_slug($dados['email']).'-'.$identifier;
        $this->contato->find($identifier)->update($dados);

        return redirect()->route('auth.contatos')->with('success', 'Informações do Contato atualizadas com sucesso!');
    }

}
