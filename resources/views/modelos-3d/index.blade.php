@extends('layouts.app')

@section('titulo', 'Anatomia 3D')

@section('content')
<x-ui.section>
        <x-ui.page-header
            title="Anatomia 3D"
            description="Explore os modelos anatômicos tridimensionais disponíveis por espécie."
        />
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($animais as $animal)
                <x-modelos-3d.animal-card
                    :animal="$animal"
                />
            @endforeach
        </div>
    </x-ui.section>
@endsection
