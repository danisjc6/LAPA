@extends('layouts.app')

@section('titulo', 'Atlas Interativo')
@section('content')
<div class="d-flex position-relative">
    <div id="page" class="d-flex flex-column container py-4 col-lg-10">
        @if (!isset($registro))
            <p>Ops, essa página não existe</p>
        @else

            @if(isset($registro))
                <p>Essa página do atlas está <strong>{{ $registro->publicado ? 'publicada' : 'salva no rascunho' }}.</strong></p>
                @php
                    $anexos = App\Models\Anexo::where('atla_id', $registro->id)->get();
                @endphp
            @endif
            <div class="input-btn">
                <a href="{{ route('auth.atla.editar', $registro->slug) }}" class="btn btn-outline">Editar publicação</a>

                @if(isset($registro) && !$registro->publicado)
                    <a href="{{ route('auth.atla.publicar', $registro->slug) }}" class="btn">Publicar agora</a>
                @endif
            </div>


        @endif
    </div>
    @if(isset($anexos[0]))
        <div id="toggleRightSidebar" class="d-lg-none position-absolute shadow-sm">
            <a class="btn">
                <span class="fas fa-chevron-left"></span>
            </a>
        </div>
        <div id="rightSidebar" class="col-lg-2 border-left p-4">
            <p>
                Fotos na página
            </p>
            <input class="form-control mb-3" id="pesquisa_fotos" type="search" id="form-autocomplete" placeholder="Pesquisar...">
            <div id="fotosAtlas" class="list-group p-0 text-left">
                <a href="#" data-target="#carouselAnexos" data-slide-to="0" class="list-group-item list-group-item-action">
                    {{ $anexos[0]->descricao }}
                </a>
                @for($i = 1; $i < count($anexos); $i++)
                    <a href="#" data-target="#carouselAnexos" data-slide-to="{{ $i }}" class="list-group-item list-group-item-action">
                        {{ $anexos[$i]->descricao ?? 'Foto '.$i }}
                    </a>
                @endfor
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/toggle_sidebar.js') }}"></script>
@endsection
