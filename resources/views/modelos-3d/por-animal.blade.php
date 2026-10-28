@extends('layouts.app')

@section('content')
    <x-ui.section>

        <x-ui.page-header
            title="Modelos 3D do {{ $animal->nome }}"
            description="Explore os modelos anatômicos tridimensionais disponíveis para este animal."
        />
        <section
            class="
                mb-8 flex flex-col gap-5
                rounded-2xl border border-slate-200
                bg-white p-4
                sm:flex-row sm:items-center
            "
        >
            <div
                class="
                    h-36 w-full shrink-0 overflow-hidden
                    rounded-xl bg-slate-100
                    sm:h-38 sm:w-46
                "
            >
                @if ($animal->imagem_path)
                    <img
                        src="{{ asset('storage/' . $animal->imagem_path) }}"
                        alt="{{ $animal->nome }}"
                        class="h-full w-full object-cover"
                    >
                @else
                    <div
                        class="
                            flex h-full w-full items-center justify-center
                            text-slate-400
                        "
                    >
                        <i class="fa-solid fa-paw text-3xl"></i>
                    </div>
                @endif
            </div>

            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-3">
                    <h2 class="text-2xl font-semibold text-slate-900">
                        {{ $animal->nome }}
                    </h2>

                    <span
                        class="
                            inline-flex items-center gap-2
                            rounded-full bg-emerald-50
                            px-3 py-1
                            text-sm font-medium text-emerald-700
                        "
                    >
                        <i class="fa-solid fa-cube text-xs"></i>

                        {{ $modelos->total() }}

                        {{ $modelos->total() === 1
                            ? 'modelo disponível'
                            : 'modelos disponíveis'
                        }}
                    </span>
                </div>

                <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-600">
                    Acesse os modelos anatômicos tridimensionais de
                    {{ strtolower($animal->nome) }} disponíveis para estudo e visualização.
                </p>
            </div>
        </section>

        @if ($modelos->count())
            <section>
                <div
                    class="
                        grid grid-cols-1 gap-5
                        md:grid-cols-2
                        xl:grid-cols-3
                    "
                >
                    @foreach ($modelos as $modelo)
                        <x-modelos-3d.modelo-card
                            :modelo="$modelo"
                        />
                    @endforeach
                </div>

                @if ($modelos->hasPages())
                    <div class="mt-8">
                        {{ $modelos->links() }}
                    </div>
                @endif
            </section>
        @else
            <section
                class="
                    rounded-2xl
                    border border-dashed border-slate-300
                    bg-slate-50
                    px-6 py-16
                    text-center
                "
            >
                <div
                    class="
                        mx-auto flex size-12
                        items-center justify-center
                        rounded-full bg-emerald-50
                        text-emerald-700
                    "
                >
                    <i class="fa-solid fa-cube text-lg"></i>
                </div>

                <h2 class="mt-4 text-lg font-semibold text-slate-800">
                    Nenhum modelo disponível
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Este animal ainda não possui modelos 3D cadastrados.
                </p>
            </section>
        @endif
    </x-ui.section>
@endsection
