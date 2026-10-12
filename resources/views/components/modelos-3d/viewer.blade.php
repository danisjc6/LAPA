@props([
    'modelo',
    'height' => '700px',
])

<div
    {{ $attributes->merge([
        'class' => '
            relative
            w-full
            overflow-hidden
            rounded-xl
            border
            border-slate-700
            bg-slate-900
            shadow-sm
        '
    ]) }}
    data-viewer-3d
    data-model="{{ asset('storage/' . $modelo->arquivo_path) }}"
    style="height: {{ $height }}"
>
    {{-- Área de renderização do Three.js --}}
    <div
        data-viewer-canvas
        class="
            absolute
            inset-0
            h-full
            w-full
        "
    ></div>

    {{-- Loading --}}
    <div
        data-viewer-loading
        class="
            absolute
            inset-0
            z-20
            flex
            items-center
            justify-center
            bg-slate-900
        "
    >
        <div
            class="
                flex
                flex-col
                items-center
                gap-3
            "
        >
            <i
                class="
                    fa-solid
                    fa-circle-notch
                    fa-spin
                    text-2xl
                    text-emerald-400
                "
            ></i>

            <span
                class="
                    text-sm
                    font-medium
                    text-slate-300
                "
            >
                Carregando modelo 3D...
            </span>
        </div>
    </div>

    {{-- Erro --}}
    <div
        data-viewer-error
        class="
            absolute
            inset-0
            z-20
            hidden
            items-center
            justify-center
            bg-slate-900
            px-6
        "
    >
        <div
            class="
                max-w-md
                text-center
            "
        >
            <i
                class="
                    fa-solid
                    fa-triangle-exclamation
                    mb-3
                    text-2xl
                    text-red-400
                "
            ></i>

            <p
                class="
                    font-medium
                    text-white
                "
            >
                Não foi possível carregar o modelo 3D.
            </p>

            <p
                class="
                    mt-1
                    text-sm
                    text-slate-400
                "
            >
                Tente atualizar a página.
            </p>
        </div>
    </div>

    {{-- Barra de controles --}}
    <div
        class="
            absolute
            bottom-4
            left-1/2
            z-10
            flex
            -translate-x-1/2
            items-center
            gap-1
            rounded-xl
            border
            border-slate-700
            bg-slate-800/90
            p-1.5
            shadow-lg
            backdrop-blur-md
        "
    >
        {{-- Restaurar --}}
        <button
            type="button"
            data-viewer-reset
            class="
                flex
                h-10
                w-10
                items-center
                justify-center
                rounded-lg
                text-slate-300
                transition
                duration-150
                hover:bg-slate-700
                hover:text-white
                focus:outline-none
                focus:ring-2
                focus:ring-emerald-500
                focus:ring-offset-2
                focus:ring-offset-slate-800
            "
            title="Restaurar visualização"
            aria-label="Restaurar visualização"
        >
            <i class="fa-solid fa-rotate-left"></i>
        </button>

        {{-- Rotação automática --}}
        <button
            type="button"
            data-viewer-rotate
            class="
                flex
                h-10
                w-10
                items-center
                justify-center
                rounded-lg
                text-slate-300
                transition
                duration-150
                hover:bg-slate-700
                hover:text-white
                focus:outline-none
                focus:ring-2
                focus:ring-emerald-500
                focus:ring-offset-2
                focus:ring-offset-slate-800
            "
            title="Ativar rotação automática"
            aria-label="Ativar rotação automática"
        >
            <i class="fa-solid fa-arrows-rotate"></i>
        </button>

        {{-- Separador --}}
        <div
            class="
                mx-1
                h-6
                w-px
                bg-slate-600
            "
        ></div>

        {{-- Tela cheia --}}
        <button
            type="button"
            data-viewer-fullscreen
            class="
                flex
                h-10
                w-10
                items-center
                justify-center
                rounded-lg
                text-slate-300
                transition
                duration-150
                hover:bg-slate-700
                hover:text-white
                focus:outline-none
                focus:ring-2
                focus:ring-emerald-500
                focus:ring-offset-2
                focus:ring-offset-slate-800
            "
            title="Tela cheia"
            aria-label="Tela cheia"
        >
            <i class="fa-solid fa-expand"></i>
        </button>
    </div>
</div>
