<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\User;
use Validator;
use App\Models\Http\Requests\CriarPostagemRequest;
use App\Models\Http\Requests\AtualizarPostagemRequest;
use Auth;
use App\Models\Util\ConvertToEmbedableImageLink;

class PostagemController extends Controller
{

    // Model de postagem adicionado ao controller para evitar uso estatico
    protected $postagem;
    protected $user;


    public function __construct(Postagem $postagem, User $user)
    {
        $this->middleware('auth', ['except' => [
            'siteHome',
            'siteIndexNoticia',
            'siteIndexEvento',
            'siteIndexEdital',
            'siteVisualizarPostagem',
        ]]);
        $this->postagem = $postagem;
        $this->user = $user;
    }

    public function index()
    {
        $registros = $this->postagem;
        $filtros['nomes'] = array();

        if(request()->has('publicado') && request('publicado') != '') {
            $registros = $registros->where('publicado', request('publicado'));
            $filtros['publicado'] = request('publicado');
            $filtros['nomes'] = [request('publicado') ? 'publicados' : 'rascunhos'];
        }

        if(request()->has('tipo_postagem') && request('tipo_postagem') != '') {
            $registros = $registros->where('tipo_postagem', request('tipo_postagem'));
            $filtros['tipo_postagem'] = request('tipo_postagem');
            //$filtros['nomes'] = [request('tipo_postagem') ? 'edital' : 'evento'];
            $filtros['nomes'] = request('tipo_postagem');
            // array_push($filtros['nomes'],$this->postagem->find(request('tipo_postagem')));
        }


        $tipo_postagens= $this->postagem->getEnumValues();
        $registros = $registros->latest()->get();
        return view('auth.postagem.index', compact('registros','filtros','tipo_postagens'));
    }
    public function adicionar()
    {
        $tipo_postagens= $this->postagem->getEnumValues();
        return view('auth.postagem.adicionar', compact('tipo_postagens'));
    }

    public function salvar(CriarPostagemRequest $request)
    {
        $request->validated();
        $this->user = Auth::user();
        $anexo = null;
        $publicado = false;

        if(isset($request['publicar'])) {
            $publicado = true;
        }
        if($request['tipo_postagem']=='evento'){
            if($request['data']==null){
                return redirect()->back()->withErrors(['data' => 'Selecionar data quando a postagem for um evento é obrigatório'])->withInput();
            }
            else if($request['hora']==null){
                return redirect()->back()->withErrors(['hora' => 'Selecionar a hora quando a postagem for um evento é obrigatório'])->withInput();
            }
        }
        $post=$this->postagem->create([
            'titulo' => $request ['titulo'],
            'descricao' => $request ['descricao'],
            'anexo' =>  $anexo,
            'tipo_postagem' => $request['tipo_postagem'],
            'user_id' =>$this->user->id,
            'publicado'=>$publicado,
            'data'=>$request['data'],
            'hora'=>$request['hora'],
            'tipo_anexo' => $request['tipo_anexo'],
        ]);
        $post['slug'] = str_slug($post->titulo).'-'.$post->id;

        /* Se o link for web nao entra no if
        * se for drive ele entra no if para converter o link para ser embarcado na página
        * se for upload ele entra no else if para arrumar o nome do arquivo
        */
        $post['anexo'] = $request['anexo_web'];
        if($request['tipo_anexo'] == 'link_drive') {
            $post['anexo'] = ConvertToEmbedableImageLink::convertToEmbedableImageLink($request['anexo_drive']);
        } else if (($request['tipo_anexo'] == 'upload') && $request->hasFile('anexo_upload')) {
            $anexo = $request->file('anexo_upload');
            $dir = 'img/postagens/';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$post->tipo_postagem.'-'.$post->id.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $post['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $post->update($post->attributesToArray());
        return redirect()->route('auth.postagens')->with('success', 'Postagem adicionada com sucesso!');
    }

    public function editar(Postagem $registro)
    {
        $tipo_postagens= $this->postagem->getEnumValues();
        return view('auth.postagem.editar', compact('registro','tipo_postagens'));
    }

    public function atualizar(AtualizarPostagemRequest $request, $identifier)
    {
        $request->validated();
        $dados = $request->all();
        $dados['publicado'] = false;
        $post=$this->postagem->find($identifier);

        /* Se o link for web nao entra no if
        * se for drive ele entra no if para converter o link para ser embarcado na página
        * se for upload ele entra no else if para arrumar o nome do arquivo
        */
        $dados['anexo'] = $post->anexo;
        $dados['tipo_anexo'] = $request['tipo_anexo'];
        if($request['tipo_anexo'] == 'link_drive') {
            $dados['anexo'] = ConvertToEmbedableImageLink::convertToEmbedableImageLink($request['anexo_drive']);
        } else if(($request['tipo_anexo'] == 'upload') && $request->hasFile('anexo_upload')) {
            $anexo = $request->file('anexo_upload');
            $dir = 'img/postagens/';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$post->tipo_postagem.'-'.$post->id.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo']= $dir.'/'.$nomeAnexo;
        }


        if(isset($request['publicar'])) {
            $dados['publicado'] = true;
        }
        if($request['tipo_postagem']=='evento'){
            if($request['data']==null){
                return redirect()->back()->withErrors(['data' => 'Selecionar data quando a postagem for um evento é obrigatório']);
            } else if($request['hora']==null){
                return redirect()->back()->withErrors(['hora' => 'Selecionar a hora quando a postagem for um evento é obrigatório']);
            }
        }

        $dados['slug']=str_slug($dados['titulo']).'-'.$identifier;
        $post->update($dados);
        return redirect()->route('auth.postagens')->with('success', 'Postagem atualizada com sucesso!');
    }

    public function deletar(Postagem $registro)
    {
        $registro->delete();
        return redirect()->route('auth.postagens')->with('success', 'Postagem deletada com sucesso!');
    }

     public function siteHome(){//ordenar por data

        $registros = $this->postagem->where('publicado', true)
                                ->where( 'tipo_postagem', 'noticia')
                                ->latest()->take(3)->get();
        $eventos = $this->postagem->where('publicado', true)
                                ->where( 'tipo_postagem', 'evento')
                                ->latest()->take(3)->get();
        $editais = $this->postagem->where('publicado', true)
                                ->where( 'tipo_postagem', 'edital')
                                ->latest()->take(3)->get();

        return view('site.postagens.home', compact('registros', 'eventos', 'editais'));
    }

    public function siteIndexEvento()
    {
        $posts = $this->postagem->where('tipo_postagem', 'evento');

        $agenda = [];
        foreach($posts->get() as $post) {
            $item = [
                'location' => $post->slug,
                'date' => $post->data,
                'hora_inicial' => date('H:i', strtotime($post->hora)),
                'hora_final' => null,
                'title' => $post->titulo,
            ];
            array_push($agenda, $item);
        }

        $registros = $posts->latest()->where('publicado',true)->paginate(6);
        return view('site.postagens.indexEvento', compact('registros', 'agenda'));
    }

    public function siteIndexEdital(){
       $posts = $this->postagem->where( 'tipo_postagem', 'edital')->latest();
       $registros = $posts->where('publicado',true)->paginate(6);
       return view('site.postagens.indexEdital', compact('registros'));
    }

    public function siteIndexNoticia(){
        $posts = $this->postagem->where( 'tipo_postagem', 'noticia')->latest();
        $registros = $posts->where('publicado',true)->paginate(6);
        return view('site.postagens.indexNoticia', compact('registros'));
    }

    public function siteVisualizarPostagem(Postagem $registro){
        return view('site.postagens.visualizarPostagem', compact('registro'));
    }

    public function publicar_postagem(Postagem $registro)
    {
        $dados = ['publicado' => true];

        $registro->update($dados);
        return redirect()->back()->with('success', 'Postagem publicada com sucesso.');
    }
    public function visualizarRascunho(Postagem $registro){
        return view('auth.postagem.ver', compact('registro'));
    }



}
