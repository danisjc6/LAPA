@extends('layouts.app')

@section('titulo', 'Gerenciar Usuários')
@section('content')
    <x-ui.section>
        <x-ui.page-header
            title="Usuários"
            description="Gerencie os usuários do sistema."
        >
            <x-slot:actions>
                <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white
                        shadow-sm hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                    Criar Usuário
                </a>
            </x-slot:actions>
        </x-ui.page-header>

        <x-ui.table
            title="Usuários"
            subtitle="Gerencie os usuários cadastrados no sistema."
            :count="$users->total()"
        >

            <x-ui.table.head>
                <x-ui.table.row :hover="false">
                    <x-ui.table.th>
                        Nome
                    </x-ui.table.th>

                    <x-ui.table.th>
                        E-mail
                    </x-ui.table.th>

                    <x-ui.table.th align="center">
                        Status
                    </x-ui.table.th>

                    <x-ui.table.th align="right">
                        Ações
                    </x-ui.table.th>
                </x-ui.table.row>
            </x-ui.table.head>

            <x-ui.table.body>
                @forelse ($users as $usuario)
                    <x-ui.table.row>
                        <x-ui.table.td>
                            <div class="font-medium text-slate-900">
                                {{ $usuario->nome }}
                            </div>
                        </x-ui.table.td>

                        <x-ui.table.td>
                            {{ $usuario->email }}
                        </x-ui.table.td>

                        <x-ui.table.td align="center">
                            <span
                                class="
                                    inline-flex rounded-full
                                    bg-green-50 px-2.5 py-1
                                    text-xs font-medium
                                    text-green-700
                                "
                            >
                                {{ $usuario->status }}
                            </span>
                        </x-ui.table.td>

                        <x-ui.table.td align="right">
                            <div
                                class="
                                    flex items-center
                                    justify-end gap-2
                                "
                            >
                                <a
                                    href="#"
                                    class="
                                        inline-flex h-9 w-9
                                        items-center justify-center
                                        rounded-lg text-slate-500
                                        transition
                                        hover:bg-slate-100
                                        hover:text-slate-900
                                    "
                                    title="Visualizar"
                                >
                                    <i class="fa-regular fa-eye"></i>
                                </a>

                                <a
                                    href="{{ route('users.edit', $usuario) }}"
                                    class="
                                        inline-flex h-9 w-9
                                        items-center justify-center
                                        rounded-lg text-slate-500
                                        transition
                                        hover:bg-slate-100
                                        hover:text-slate-900
                                    "
                                    title="Editar"
                                >
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </div>
                        </x-ui.table.td>
                    </x-ui.table.row>
                @empty
                    <x-ui.table.empty
                        :colspan="4"
                        title="Nenhum usuário cadastrado"
                        description="Os usuários cadastrados aparecerão aqui."
                        icon="fa-regular fa-user"
                    />
                @endforelse
            </x-ui.table.body>

            @if ($users->hasPages())
                <x-slot:footer>
                    {{ $users->links() }}
                </x-slot:footer>
            @endif
        </x-ui.table>

    </x-ui.section>

@endsection
