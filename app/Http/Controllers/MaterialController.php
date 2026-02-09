<?php

namespace App\Http\Controllers;


use App\Models\Material;
use App\Models\Disciplina;
use App\Http\Requests\CriarMaterialRequest;
use App\Http\Requests\AtualizarMaterialRequest;
use Auth;
use App\Util\SaveFileUtil;

class MaterialController extends Controller
{
   protected $material;
   protected $disciplina;

    public function __construct(Material $material, Disciplina $disciplina)
    {

        $this->material = $material;
        $this->disciplina = $disciplina;

        $this->middleware('auth', ['except' => [
            'materiaisPorDisciplina',
            'ver',
            'siteIndex',
            'siteVisualizarMaterial',
        ]]);

    }

    public function index()
    {
        $registros = $this->material;
        $filtros['nomes'] = array();

        if(request()->has('publicado') && request('publicado') != '') {
            $registros = $registros->where('publicado', request('publicado'));
            $filtros['publicado'] = request('publicado');
            $filtros['nomes'] = [request('publicado') ? 'publicados' : 'rascunhos'];
        }
        if(request()->has('disciplina') && request('disciplina') != '') {
            $registros = $registros->where('disciplina_id', request('disciplina'));
            $filtros['disciplina'] = request('disciplina');
            array_push($filtros['nomes'], $this->disciplina->find(request('disciplina'))->nome);
        }

        $disciplinas = $this->disciplina->all();
        $registros = $registros->latest()->get();
        return view('auth.materiais.index', compact('registros', 'disciplinas', 'filtros'));

   }

    public function adicionar()
    {
        $disciplinas = $this->disciplina->all();
        return view('auth.materiais.adicionar', compact('disciplinas'));
    }

    public function salvar(CriarMaterialRequest $request)
    {
        $request->validated();
        $this->user = Auth::user();
        $anexo = "Anexo";
        $publicado = false;

        if(isset($request['publicar'])) {
            $publicado = true;
        }

        $material=$this->material->create([
            'titulo' => $request ['titulo'],
            'texto' => $request ['texto'],
            'anexo' => $anexo,
            'publicado' => $publicado,
            'disciplina_id' => $request ['disciplina_id'],
            'tipo_anexo' => $request ['tipo_anexo'],

        ]);
        $material['slug'] = str_slug($material->titulo).'-'.$material->id;

        $material['anexo'] = $request['anexo_web'];
        if (($request['tipo_anexo'] == 'upload') && $request->hasFile('anexo_upload')) {
            $material['anexo'] = SaveFileUtil::saveFIle(
                $request->file('anexo_upload'),
                $material->id,
                'img/materiais/'
            );
        }

        $material->update($material->attributesToArray());
        if($publicado) {
            return redirect()->route('auth.materiais')->with('success', 'Material adicionado com sucesso!');
        }
        return redirect()->route('auth.material.visualizar', $material)->with('success', 'Página do Material salva com sucesso!');


    }

    public function editar(Material $registro)
    {
	    $disciplinas=$this->disciplina->all();
        return view('auth.materiais.editar', compact('registro','disciplinas'));
    }

    public function atualizar(AtualizarMaterialRequest $request, $identifier)
    {
        $request->validated();
        $dados = $request->all();
        $dados['publicado'] = false;
        $material = $this->material->find($identifier);

        if(isset($request['publicar'])) {
            $publicado = true;
        }

        $dados['anexo'] = $material->anexo;
        $dados['tipo_anexo'] = $request['tipo_anexo'];
        if(($request['tipo_anexo'] == 'upload') && $request->hasFile('anexo_upload')) {
            $dados['anexo'] = SaveFileUtil::saveFIle(
                $request->file('anexo_upload'),
                $material->id,
                'img/materiais/'
            );


        }

        $dados['slug'] = str_slug($dados['titulo']).'-'.$identifier;
        $material->update($dados);
        if($dados['publicado']) {
            return redirect()->route('auth.materiais')->with('success', 'Material atualizado com sucesso!');
        }

        return redirect()->route('auth.material.visualizar', $material)->with('success', 'Material salvo com sucesso!');
    }

    public function publicar(Material $registro)
    {
        $dados = ['publicado' => true];
        $registro->update($dados);
        return redirect()->back()->with('success', 'Material publicado com sucesso.');

    }

    public function ver(Material $registro)
    {
        $disciplinas = $registro->disciplina;
        return view('auth.materiais.ver', compact('registro', 'disciplinas'));
    }

    public function deletar(Material $registro)
    {
        $registro->delete();
        return redirect()->route('auth.materiais')->with('success', 'Material deletado com sucesso!');
    }


    public function siteIndex()
    {
        $registros = $this->material->where('publicado', true)->latest()->get();

        $disciplinas = $this->disciplina->whereHas('material', function($queryMaterials) {
            $queryMaterials->where('publicado', true);
        })->latest()->get();
        return view('site.materiais.index', compact('registros', 'disciplinas'));
    }

    public function materiaisPorDisciplina(Disciplina $disciplina)
    {
        $busca = $this->material->where('disciplina_id', $disciplina->id);
        $registros = $busca->latest()->get();
        $paginas = $busca->latest()->paginate(1);
        return view('site.materiais.ver_materiais', compact('registros', 'disciplina', 'paginas'));
    }

    public function siteVisualizarMaterial(Material $registro){
        return view('site.materiais.visualizarMaterial', compact('registro'));
    }



}
