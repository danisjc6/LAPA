@props([
    'name',
    'id' => null,
    'label' => null,
    'src' => null,
    'shape' => 'square',
    'hint' => 'JPG, PNG ou WebP. Tamanho máximo: 2 MB.',
    'accept' => 'image/jpeg,image/png,image/webp',
    'required' => false,
    'disabled' => false,
])
@php
    $id = $id ?? $name;
@endphp
<div x-data="{
    preview: @js($src),
    original: @js($src),
    fileName: null,
    objectUrl: null,
    selecionar(event) {
        const file = event.target.files?.[0];
        if (!file) return;
        if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
        this.objectUrl = URL.createObjectURL(file);
        this.preview = this.objectUrl;
        this.fileName = file.name;
    },
    desfazer() {
        if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
        this.objectUrl = null;
        this.preview = this.original;
        this.fileName = null;
        this.$refs.fileInput.value = '';
    },
    destroy() {
        if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
    }
}" {{ $attributes->class(['w-full']) }}>
    @if ($label)
        <label for="{{ $id }}" class="mb-2 block text-sm font-semibold text-slate-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif
    <div @class([
        'rounded-xl border bg-white p-3 transition-all duration-200 focus-within:border-slate-400 focus-within:ring-2 focus-within:ring-slate-200',
        'border-red-400' => $errors->has($name),
        'border-slate-200 hover:border-slate-300 hover:shadow-sm' => !$errors->has(
            $name),
        'opacity-60' => $disabled,
    ])>
        <div @class([
            'grid items-center gap-4',
            'grid-cols-[4.5rem_minmax(0,1fr)] sm:grid-cols-[4.5rem_minmax(0,1fr)_auto]' =>
                $shape !== 'landscape',
            'grid-cols-[6rem_minmax(0,1fr)] sm:grid-cols-[6rem_minmax(0,1fr)_auto]' =>
                $shape === 'landscape',
        ])>
            <div @class([
                'flex h-[4.5rem] shrink-0 items-center justify-center overflow-hidden border border-slate-200 bg-slate-50',
                'w-[4.5rem] rounded-full' => $shape === 'circle',
                'w-[4.5rem] rounded-lg' => $shape === 'square',
                'w-24 rounded-lg' => $shape === 'landscape',
            ])>
                <img x-show="preview" x-cloak :src="preview" alt="Pré-visualização da imagem"
                    class="h-full w-full object-cover">
                <i x-show="!preview" class="fa-regular fa-image text-2xl text-slate-400" aria-hidden="true"></i>
            </div>
            <div class="min-w-0">
                <p x-text="fileName || (original ? 'Imagem atual' : 'Nenhuma imagem selecionada')"
                    class="truncate text-sm font-semibold text-slate-800"></p>
                @if ($hint)
                    <p id="{{ $id }}-hint" class="mt-1 text-xs leading-5 text-slate-500">{{ $hint }}
                    </p>
                @endif
                <button x-show="fileName" x-cloak type="button" @click="desfazer()"
                    class="mt-1 cursor-pointer text-xs font-medium text-slate-600 underline underline-offset-2 transition-colors hover:text-slate-900">Desfazer
                    seleção</button>
            </div>
            <div class="col-start-2 flex items-center sm:col-start-3">
                <input x-ref="fileInput" id="{{ $id }}" name="{{ $name }}" type="file"
                    accept="{{ $accept }}" @change="selecionar($event)" @required($required)
                    @disabled($disabled)
                    @if ($hint) aria-describedby="{{ $id }}-hint" @endif
                    class="sr-only">
                <button type="button" @click="$refs.fileInput.click()" @disabled($disabled)
                    class="inline-flex min-h-10 cursor-pointer items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-emerald-800 bg-emerald-800 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-emerald-950 hover:bg-emerald-950 hover:shadow-md active:translate-y-0 active:shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-700 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:translate-y-0">
                    <i class="fa-solid fa-arrow-up-from-bracket text-xs" aria-hidden="true"></i>
                    <span x-text="preview ? 'Substituir imagem' : 'Selecionar imagem'">Selecionar imagem</span>
                </button>
            </div>
        </div>
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
    @enderror
</div>
