@extends('layouts.app')

@section('titulo', 'Atlas Interativo')
@section('content')
<div class="d-flex position-relative overflow-hidden">

    @if (count($paginas) >= 1)

        @include('site.atlas._sidebar')

    @endif

    <div id="page" class="d-flex flex-column py-4 col-lg-8">
        @if (count($paginas) < 1)
            <p>Ops, essa área de conhecimento ainda não possui páginas</p>
        @else

            @foreach ($paginas as $pagina)
                @php
                    $anexos = App\Models\Anexo::where('atla_id', $pagina->id)->get();
                @endphp
                <div class="row justify-content-between fadeInDown" data-anime="300">
                    <div class="col-md-7 col-12 text-left">
                        <h2 class="title pb-3">{{ $pagina->titulo }}</h2>
                        <p class="info" style="text-transform: capitalize;">
                            <a style="color: white;" href="{{ route('site.atlas.index') }}">
                                <span class="tag evento">Atlas Interativo</span>
                            </a>
                            <span class="tag evento">/</span>
                            <a style="color: white;" href="{{ route('site.atlas.disciplina', $categoria->disciplina) }}">
                                <span class="tag evento">{{ $categoria->disciplina->nome}}</span>
                            </a>
                            <span class="tag evento">/</span>

                            <a style="color: white;" href="{{ route('site.atlas.categoria', $categoria) }}">
                                <span class="tag evento">{{ $categoria->nome }}</span>
                            </a>
                        </p>
                        <p class="text">
                            {!! $pagina->toArray()['descricao'] !!}
                        </p>
                    </div>
                    @if(isset($anexos[0]))
                        <div id="overlay"></div>
                        <div class="col-md-5 col-12 mb-4">
                            <div id="carouselAnexos" class="carousel slide atlas">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselAnexos" data-slide-to="0" class="active">
                                        <img class="d-block w-100" src="{{ asset($anexos[0]->foto) }}" alt="{{ $anexos[0]->descricao ?? $anexos[0]->descricao }}">
                                    </li>
                                    @for($i = 1; $i < count($anexos); $i++)
                                        <li data-target="#carouselAnexos" data-slide-to="{{ $i }}">
                                            <img class="d-block w-100" src="{{ asset($anexos[$i]->foto) }}" alt="{{ $anexos[$i]->descricao ?? $anexos[$i]->descricao }}">
                                        </li>
                                    @endfor
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-interval="0">
                                        <img class="img d-block w-100" src="{{ asset($anexos[0]->foto) }}" alt="{{ $anexos[0]->descricao ?? $anexos[0]->descricao }}">
                                        <a class="carousel-caption rounded-bottom d-none d-md-block">
                                            <p>{{ $anexos[0]->descricao }}</p>
                                        </a>
                                    </div>
                                    @for ($i = 1; $i < count($anexos); $i++)
                                        <div class="carousel-item" data-interval="0">
                                            <img class="img d-block w-100" src="{{ asset($anexos[$i]->foto) }}" alt="{{ $anexos[$i]->descricao ?? $anexos[$i]->descricao }}">
                                            <a class="carousel-caption rounded-bottom d-none d-md-block">
                                                <p>{{ $anexos[$i]->descricao }}</p>
                                            </a>
                                        </div>
                                    @endfor
                                </div>
                                <a class="carousel-control-prev" href="#carouselAnexos" role="button" data-slide="prev">
                                    <span class="fas fa-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselAnexos" role="button" data-slide="next">
                                    <span class="fas fa-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-md-center mt-auto pagination-container fadeInDown" data-anime="700">
                    {{ $paginas->links() }}
                </div>
            @endforeach

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
