<?php

namespace App\Http\Controllers;

use App\Models\Atla;
use App\Models\Categoria;
use App\Models\Disciplina;
use App\Models\Anexo;
use App\Http\Requests\CriarAtlaRequest;
use App\Http\Requests\AtualizarAtlaRequest;
use Auth;
use App\Util\SaveFileUtil;

class AtlaController extends Controller
{

    // Model de atla adicionado ao controller para evitar uso estatico
    protected $atla;
    protected $categoria;
    protected $disciplinas;



    public function __construct(Atla $atla, Categoria $categoria, Disciplina $disciplina, Anexo $anexo)
    {
        $this->atla = $atla;
        $this->categoria = $categoria;
        $this->disciplina = $disciplina;
        $this->anexo = $anexo;

        $this->middleware('auth', ['except' => [
            'atlasPorCategoria',
            'atlasPorDisciplina',
            'siteIndex',
        ]]);
    }

    public function index()
    {

        $registros = $this->atla;
        $filtros['nomes'] = array();

        if(request()->has('publicado') && request('publicado') != '') {
            $registros = $registros->where('publicado', request('publicado'));
            $filtros['publicado'] = request('publicado');
            $filtros['nomes'] = [request('publicado') ? 'publicados' : 'rascunhos'];
        }

        if(request()->has('categoria') && request('categoria') != '') {
            $registros = $registros->where('categoria_id', request('categoria'));
            $filtros['categoria'] = request('categoria');
            array_push($filtros['nomes'], $this->categoria->find(request('categoria'))->nome);
        }

        $categorias = $this->categoria->all();
        $registros = $registros->latest()->get();
        return view('auth.atlas.index', compact('registros', 'categorias', 'filtros'));
    }

    public function adicionar()
    {
        $categorias = $this->categoria->all();
        return view('auth.atlas.adicionar', compact('categorias'));

    }

    public function salvar(CriarAtlaRequest $request)
    {
        $request->validated();
        $this->user = Auth::user();
        $anexo = "Anexo";
        $publicado = false;

        if(isset($request['publicar'])) {
            $publicado = true;
        }

        $atla = $this->atla->create([
            'titulo' => $request ['titulo'],
            'descricao' => $request ['descricao'],
            'publicado'=> $publicado,
            'categoria_id' => $request ['categoria_id'],
        ]);
        $atla['slug'] = str_slug($atla->titulo).'-'.$atla->id;

        // Salva cada foto anexada a pagina do atlas
        if(isset($request['anexos'])) {
            for($i = 0; $i < count($request['anexos']); $i++) {

                $anexo = [
                    'descricao' => $request['descricao_anexos'][$i] ?? null,
                    'foto' => $request['anexos'][$i],
                    'atla_id' => $atla->id,
                ];

                $anexoSalvo = $this->anexo->create($anexo);

                if(isset($request->file('anexos')[$i])) {
                    $anexo['foto'] = SaveFileUtil::saveFile($request->file('anexos')[$i], $anexoSalvo->id, 'img/atlas');
                    $anexoSalvo->update($anexo);
                }
            }
        }

        $atla->update($atla->attributesToArray());

        if($publicado) {
            return redirect()->route('auth.atlas')->with('success', 'Página do atlas adicionada com sucesso!');
        }

        return redirect()->route('auth.atla.visualizar', $atla)->with('success', 'Página do atlas salva com sucesso!');
    }

    public function editar(Atla $registro)
    {
        $categorias = $this->categoria->all();
        return view('auth.atlas.editar', compact('registro', 'categorias'));

    }

    public function atualizar(AtualizarAtlaRequest $request, $identifier)
    {
        $request->validated();
        $dados = $request->all();
        $dados['publicado'] = false;
        $atla = $this->atla->find($identifier);

        // Mover anexos salvos na coluna anexo para a tabela de Anexos, assim no futuro a coluna pode ser excluida
        if($atla->anexo) {
            $anexo = [
                'descricao' => '',
                'foto' => $atla->anexo,
                'atla_id' => $atla->id,
            ];

            $this->anexo->create($anexo);
        }

        if(isset($request['publicar'])) {
            $dados['publicado'] = true;
        }
        $dados['slug'] = str_slug($dados['titulo']).'-'.$identifier;

        // Salva cada foto anexada a pagina do atlas
        if(isset($request['anexos'])) {
            for($i = 0; $i < count($request['anexos']); $i++) {

                $anexo = [
                    'descricao' => $request['descricao_anexos'][$i] ?? null,
                    'foto' => $request['anexos'][$i],
                    'atla_id' => $atla->id,
                ];

                $anexoSalvo = $this->anexo->create($anexo);

                if(isset($request->file('anexos')[$i])) {
                    $anexo['foto'] = SaveFileUtil::saveFile($request->file('anexos')[$i], $anexoSalvo->id, 'img/atlas');
                    $anexoSalvo->update($anexo);
                }
            }
        }

        $atla->update($dados);

        if($dados['publicado']) {
            return redirect()->route('auth.atlas')->with('success', 'Página do atlas atualizada com sucesso!');
        }

        return redirect()->route('auth.atla.visualizar', $atla)->with('success', 'Página do atlas salva com sucesso!');
    }

    public function publicar(Atla $registro)
    {
        $dados = ['publicado' => true];

        $registro->update($dados);
        return redirect()->back()->with('success', 'Página do atlas publicada com sucesso.');
    }

    public function deletar(Atla $registro)
    {
        $registro->delete();
        return redirect()->route('auth.atlas')->with('success', 'Página do atlas deletada com sucesso!');
    }

    public function siteIndex()
    {
        $registros = $this->atla->where('publicado', true)->latest()->get();

        $categorias = $this->categoria->whereHas('atla', function($query) {
            $query->where('publicado', true);
        })->latest()->get();

        $disciplinas = $this->disciplina->whereHas('categoria', function($queryCategorias) {
            $queryCategorias->whereHas('atla', function($queryDisciplinas) {
                $queryDisciplinas->where('publicado', true);
            });
        })->latest()->get();
        return view('site.atlas.index', compact('registros', 'categorias', 'disciplinas'));
    }

    public function atlasPorCategoria(Categoria $categoria)
    {

        $busca = $this->atla->where('publicado', true)
            ->where('categoria_id', $categoria->id);
        $registros = $busca->get();
        $paginas = $busca->paginate(1);
        return view('site.atlas.ver_atlas', compact('paginas', 'registros', 'categoria'));
    }

    public function atlasPorDisciplina(Disciplina $disciplina)
    {

        $busca = $this->categoria->where('disciplina_id', $disciplina->id)
                                ->whereHas('atla', function($query) {
                                    $query->where('publicado', true);
        });
        $registros = $busca->get();
        $paginas = $busca->paginate(1);
        return view('site.atlas.ver_atlas_disciplinas', compact('paginas', 'registros', 'disciplina'));
    }

    public function ver(Atla $registro)
    {
        $categoria = $registro->categoria;
        return view('auth.atlas.ver', compact('registro', 'categoria'));
    }

    public function deletarAnexo(Anexo $registro)
    {
        $registro->delete();
        return redirect()->back();
    }


}
