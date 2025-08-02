@extends('layouts.app')

@section('titulo', 'Agendar visita')
@section('content')
        <div class="container">

            <form class="card px-5 pb-5 pt-4" id="form-visita" action="{{ route('site.visita.salvar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="mb-3">Agendar visita</h2>
                @include('auth.visitas._form')
                <div class="input-btn">
                    <button form="form-visita" type="submit" class="btn btn-success">Agendar</button>
                </div>
            </form>
        </div>
@endsection
@section('scripts')

    <script>
        // Todas as horas possíveis
        var $horas = {!! json_encode($horas) !!};

        // Todas as visitas agendadas
        var $visitas = {!! json_encode($visitas) !!};
    </script>
    <script src="{{ asset('js/visitas.js') }}"></script>

@endsection