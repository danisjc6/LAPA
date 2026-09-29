<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $dados = $request->validated();

        $foto = null;

        try {
            if ($request->hasFile('foto_perfil')) {
                $foto = $request
                    ->file('foto_perfil')
                    ->store('fotos-perfil', 'public');

                $dados['foto_perfil'] = $foto;
            }

            DB::transaction(function () use ($dados) {
                User::create($dados);
            });

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuário cadastrado com sucesso.');

        } catch (\Throwable $e) {

            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $dados = $request->validated();

        unset($dados['remover_foto']);

        if (empty($dados['password'])) {
            unset($dados['password']);
        }

        $fotoAntiga = $user->foto_perfil;
        $novaFoto = null;
        $removerFoto = $request->boolean('remover_foto');

        try {
            if ($request->hasFile('foto_perfil')) {
                $novaFoto = $request
                    ->file('foto_perfil')
                    ->store('fotos-perfil', 'public');

                $dados['foto_perfil'] = $novaFoto;
            } elseif ($removerFoto) {
                $dados['foto_perfil'] = null;
            }

            DB::transaction(function () use (
                $user,
                $dados
            ) {
                $user->update($dados);
            });

            /*
            * Só removemos a foto antiga depois que
            * a alteração no banco deu certo.
            */
            if (
                $fotoAntiga &&
                ($novaFoto || $removerFoto)
            ) {
                Storage::disk('public')->delete(
                    $fotoAntiga
                );
            }

            return redirect()
                ->route('users.index')
                ->with(
                    'success',
                    'Usuário atualizado com sucesso.'
                );

        } catch (\Throwable $e) {

            /*
            * O banco falhou.
            * Se uma nova foto foi enviada,
            * removemos o arquivo novo.
            */
            if ($novaFoto) {
                Storage::disk('public')->delete(
                    $novaFoto
                );
            }

            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
