<?php

namespace App\Http\Controllers;

use App\Models\Sistema;
use App\Services\AtlasSidebarService;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public function index(AtlasSidebarService $atlasSidebarService)
    {
        $sistemas = Sistema::all();
        $menu_lateral = $atlasSidebarService->montarNavegacaoLateral();

        return view('atlas.sistemas.index', compact('sistemas', 'menu_lateral'));
    }

    public function create()
    {
        $disciplinas = Disciplina::all();
        return view('categorias.adicionar', compact('disciplinas'));

    }

    public function salvar(CategoriaRequest $request)
    {
        $request['nome'] = strtolower($request['nome']);
        $request->validated();

        $dados = $request->all();

        if($this->buscarCategoriaDisciplina($dados['nome'], $dados['disciplina_id']) != 0) {
            return redirect()->back()->withErrors(['nome' => 'Essa área de conhecimento já existe nesse assunto'])->withInput();
        }

        $categotia = Categoria::create($dados);
        $categotia['slug'] = str_slug($categotia->nome).'-'.$categotia->id;
        $categotia->update($categotia->attributesToArray());
        return redirect()->route('auth.categorias')->with('success', 'Área de conhecimento adicionada com sucesso!');
    }

    public function edit(Categoria $registro)
    {
        $disciplinas = Disciplina::all();
        return view('categorias.editar', compact('registro', 'disciplinas'));

    }

    public function update(CategoriaRequest $request, $categoria_id)
    {
        $request['nome'] = strtolower($request['nome']);
        $request->validated();

        $dados = $request->all();

        if($this->buscarCategoriaDisciplina($dados['nome'], $dados['disciplina_id']) != 0) {
            return redirect()->back()->withErrors(['nome' => 'Essa área de conhecimento já existe nesse assunto ou você está tentando colocar o mesmo nome'])->withInput();
        }

        $dados['slug'] = str_slug($dados['nome']).'-'.$categoria_id;
        Categoria::find($categoria_id)->update($dados);
        return redirect()->route('auth.categorias')->with('success', 'Área de conhecimento atualizada com sucesso!');;
    }

    public function destroy(Categoria $registro)
    {
        $registro->delete();
        return redirect()->route('auth.categorias')->with('success', 'Área de conhecimento deletada com sucesso!');;
    }

    public function buscarCategoriaDisciplina($nome, $disciplina_id) {
        return Categoria::where('nome', $nome)
                    ->where('disciplina_id', $disciplina_id)
                    ->count();
    }
}
