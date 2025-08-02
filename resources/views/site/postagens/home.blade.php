@extends('layouts.app')
@section('titulo', 'Início')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center p-5">
            <div class="border border-2 border-light rounded-4 text-center p-5 bg-light-subtle shadow-sm" style="max-width: 500px; width: 100%;">
                <div class="text-secondary mb-3">
                    <i class="bi bi-collection fs-1"></i>
                </div>
                <h4 class="fw-semibold text-dark-emphasis">Não há postagens no momento</h4>
                <p class="text-muted mb-0">
                    As postagens serão exibidas aqui assim que estiverem disponíveis.
                </p>
            </div>
        </div>

        @if (count($registros) >= 1)
            <div id="myCarousel" class="carousel slide mb-4 fadeInDown" data-ride="carousel" data-anime="150">
                <ol class="carousel-indicators">
                        @for($i = 0; $i < ( count($registros) < 3 ? count($registros) : 3); $i++)
                            <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : ''}}"></li>
                        @endfor
                </ol>
                <div class="carousel-inner">

                        @for($i = 0; $i < ( count($registros) < 3 ? count($registros) : 3); $i++)
                            <div class="carousel-item {{$i == 0 ? 'active' : '' }}" data-interval="5000">
                                <img src="{{ asset($registros[$i]->anexo) }}" class="d-block w-100" alt="Imagem do banner de postagens">
                                <a class="carousel-caption rounded-bottom" href="{{ route('site.noticias.visualizar', $registros[$i]->slug) }}">
                                    <h2>{{ $registros[$i]->titulo}}</h2>
                                </a>
                            </div>
                        @endfor

                </div>
                <a style="z-index: 11;" class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                        <span class="fas fa-chevron-left rounded" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                </a>
                <a style="z-index: 11;" class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="fas fa-chevron-right rounded" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                </a>
            </div>
            <a href="{{ route('site.postagens.indexNoticia') }}" class="btn fadeInDown" data-anime="300">Ver todas as notícias</a>
        @endif




        @if(isset($eventos) && count($eventos) != 0)
            <div class="mb-5">
                <h2 class="mb-3 mt-4  fadeInDown" data-anime="300">Próximos eventos</h2>
                <div class="d-flex flex-wrap justify-content-center">

                @foreach ($eventos as $registro)
                    @include('site.postagens._card')
                @endforeach

                </div>
                <a href="{{ route('site.postagens.indexEvento') }}" class="btn fadeInDown" data-anime="300">Ver todos</a>
            </div>
        @endif

        @if(isset($editais) && count($editais) != 0)
            <div class="mb-5">
                <h2 class="mb-3 mt-4  fadeInDown" data-anime="300">Últimos editais</h2>
                <div class="d-flex flex-wrap justify-content-center">

                @foreach ($editais as $registro)
                    @include('site.postagens._card')
                @endforeach

                </div>
                <a href="{{ route('site.postagens.indexEdital') }}" class="btn fadeInDown" data-anime="300">Ver todos</a>

            </div>
        @endif

    </div>
@endsection