@extends('layouts.app')

@section('titulo', 'Agendar visita')
@section('content')
    <x-ui.section>
        <x-ui.form id="form-visita" :action="route('site.visita.salvar')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Agendar visita"
                description="Preencha os dados do responsável e as informações da visita." />

            <x-ui.form.body>
                <x-ui.form.section title="Informações do responsável">
                    <div class="grid gap-4 md:grid-cols-2">
                        {{-- Nome --}}
                        <div>
                            <x-ui.field name="name" label="Nome" required>
                                <x-ui.input name="name"
                                    value="{{ isset($userExiste->name) ? $userExiste->name : old('name') }}" />
                            </x-ui.field>
                            {{-- CPF --}}
                            <x-ui.field name="cpf" label="CPF" required>
                                <x-ui.input name="cpf"
                                    value="{{ isset($userExiste->cpf) ? $userExiste->cpf : old('cpf') }}" required="true"
                                    autocomplete="cpf" placeholder="Ex.: 123.456.789-10" />
                            </x-ui.field>
                        </div>


                        <div>
                            {{-- Email --}}
                            <x-ui.field name="email" label="E-mail" required>
                                <x-ui.input name="email" value="{{ isset($email) ? $email : old('email') }}"
                                    required="true" autocomplete="email" type="email" placeholder="exemplo@exemplo.com" />
                            </x-ui.field>
                            {{-- Telefone --}}
                            <x-ui.field name="telephone" label="Telefone" required>
                                <x-ui.input name="telephone"
                                    value="{{ isset($userExiste->telephone) ? $userExiste->telephone : old('telephone') }}"
                                    required="true" class="telefone" autocomplete="telefone"
                                    placeholder="Ex.: (81) 99999-9999" />
                            </x-ui.field>
                        </div>

                    </div>
                </x-ui.form.section>

                <x-ui.form.section title="Informações da visita" divider>
                    <div class="grid gap-4 md:grid-cols-3">
                        {{-- Data --}}
                        <div class="md:col-span-1">
                            <x-ui.field name="data" label="Data" :required="true">
                                <x-ui.input name="data" type="date"
                                    value="{{ isset($registro->data) ? $registro->data : old('data') }}" required />
                            </x-ui.field>


                        </div>

                        {{-- Hora início --}}
                        <div class="md:col-span-1">
                            <x-ui.field name="hora_inicial" label="Hora de início" :required="true">
                                <x-ui.input name="hora_inicial" type="time" value="{{ old('hora_inicial') }}" required />
                            </x-ui.field>

                        </div>

                        {{-- Hora fim --}}
                        <div class="md:col-span-1">
                            <x-ui.field name="hora_final" label="Hora de fim" :required="true">
                                <x-ui.input name="hora_final" type="time" value="{{ old('hora_final') }}" required />
                            </x-ui.field>
                        </div>

                        {{-- Descrição --}}
                        <div class="md:col-span-3">
                            <x-ui.field name="descricao" label="Descrição" :required="true">
                                <x-ui.textarea name="descricao" rows="4" placeholder="Mínimo de 10 caracteres."
                                    value="{{ old('hora_final') }}"
                                    required>{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</x-ui.textarea>
                            </x-ui.field>

                        </div>
                    </div>
                </x-ui.form.section>

                <x-ui.form.actions>
                    @if (Auth::user())
                        <div class="space-y-3">
                            <label class="flex items-start gap-3 text-sm text-slate-700">
                                <input id="confirmada" type="checkbox" name="confirmada" value="true"
                                    {{ isset($registro->confirmada) && $registro->confirmada == true ? 'checked' : '' }}
                                    class="mt-0.5 h-4 w-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-700/20">
                                <span>
                                    Criar esta visita já confirmada?
                                </span>
                            </label>

                            <p class="text-sm text-slate-600">
                                Agendando uma visita você concorda com nossos
                                <a href="{{ route('termo.privacidade') }}"
                                    class="font-semibold text-slate-900 hover:underline">
                                    Termos & Privacidade
                                </a>.
                            </p>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-800
                                  hover:bg-slate-50">
                            Voltar
                        </a>

                        <button form="form-visita" type="submit"
                            class="inline-flex justify-center rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white
                                   shadow-sm hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                            Agendar
                        </button>
                    </div>

                </x-ui.form.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>

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
