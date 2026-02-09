<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Categoria;
use App\Models\Disciplina;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{

    // Model de categoria adicionado ao controller para evitar uso estatico
    protected $categoria;
    protected $disciplina;


    public function __construct(Categoria $categoria, Disciplina $disciplina)
    {
        $this->middleware('auth');
        $this->categoria = $categoria;
        $this->disciplina = $disciplina;

    }

    public function index()
    {
        $registros = $this->categoria->latest()->get();
        return view('auth.categorias.index', compact('registros'));
    }

    public function adicionar()
    {
        $disciplinas = $this->disciplina->all();
        return view('auth.categorias.adicionar', compact('disciplinas'));

    }

    public function salvar(CategoriaRequest $request)
    {
        $request['nome'] = strtolower($request['nome']);
        $request->validated();

        $dados = $request->all();

        if($this->buscarCategoriaDisciplina($dados['nome'], $dados['disciplina_id']) != 0) {
            return redirect()->back()->withErrors(['nome' => 'Essa área de conhecimento já existe nesse assunto'])->withInput();
        }

        $categotia = $this->categoria->create($dados);
        $categotia['slug'] = str_slug($categotia->nome).'-'.$categotia->id;
        $categotia->update($categotia->attributesToArray());
        return redirect()->route('auth.categorias')->with('success', 'Área de conhecimento adicionada com sucesso!');
    }

    public function editar(Categoria $registro)
    {
        $disciplinas = $this->disciplina->all();
        return view('auth.categorias.editar', compact('registro', 'disciplinas'));

    }

    public function atualizar(CategoriaRequest $request, $identifier)
    {
        $request['nome'] = strtolower($request['nome']);
        $request->validated();

        $dados = $request->all();

        if($this->buscarCategoriaDisciplina($dados['nome'], $dados['disciplina_id']) != 0) {
            return redirect()->back()->withErrors(['nome' => 'Essa área de conhecimento já existe nesse assunto ou você está tentando colocar o mesmo nome'])->withInput();
        }

        $dados['slug'] = str_slug($dados['nome']).'-'.$identifier;
        $this->categoria->find($identifier)->update($dados);
        return redirect()->route('auth.categorias')->with('success', 'Área de conhecimento atualizada com sucesso!');;
    }

    public function deletar(Categoria $registro)
    {
        $registro->delete();
        return redirect()->route('auth.categorias')->with('success', 'Área de conhecimento deletada com sucesso!');;
    }

    public function buscarCategoriaDisciplina($nome, $disciplina_id) {
        return $this->categoria->where('nome', $nome)
                    ->where('disciplina_id', $disciplina_id)
                    ->count();
    }
}
