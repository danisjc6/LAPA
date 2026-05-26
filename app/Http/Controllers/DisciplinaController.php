<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\User;
use App\Http\Requests\CriarDisciplinaRequest;
use App\Http\Requests\AtualizarDisciplinaRequest;

class DisciplinaController extends Controller
{

    public function index(Request $request)
    {
        $registros = Disciplina::latest()->get();

        return view('disciplinas.index', compact('registros'));
    }

    public function adicionar()
    {
        $users = User::where('user_type', 'admin')
            ->whereNotNull('cpf_verified_at')
            ->get();
        return view('disciplinas.adicionar', compact('users'));

    }

    public function salvar(CriarDisciplinaRequest $request)
    {
        $request['nome'] = strtolower($request['nome']);

        $request->validated();

        $dados = $request->all();
        $disciplina = Disciplina::create($dados);
        $disciplina['slug'] = str_slug($disciplina->nome).'-'. $disciplina->id;
        $disciplina->update($disciplina->attributesToArray());
        return redirect()->route('auth.disciplinas')->with('success', 'Assunto adicionado com sucesso!');
    }

    public function editar(Disciplina $registro)
    {
        $users = User::all();
        return view('disciplinas.editar', compact('registro', 'users'));

    }

    public function atualizar(AtualizarDisciplinaRequest $request, $disciplina_id)
    {
        $request['nome'] = strtolower($request['nome']);

        $request->validated();

        $dados = $request->all();
        $dados['slug'] = str_slug($dados['nome']).'-'.$disciplina_id;
        $disciplina = Disciplina::find($disciplina_id);
        if($disciplina->nome != $request['nome']) {
            return redirect()->back()->withErrors(['nome' => 'O nome do assunto não pode ser alterado']);
        }

        $disciplina->update($dados);

        return redirect()->route('auth.disciplinas')->with('success', 'Assunto atualizado com sucesso!');
    }

    public function deletar(Disciplina $disciplina)
    {
        $disciplina->delete();
        return redirect()->route('auth.disciplinas')->with('success', 'Assunto deletado com sucesso!');
    }
}
