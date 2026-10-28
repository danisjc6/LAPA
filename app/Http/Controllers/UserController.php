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
        $dados = $request->safe()->except('foto_perfil');
        $path = null;

        try {
            if ($request->hasFile('foto_perfil')) {
                $path = $request->file('foto_perfil')->store('users/fotos', 'public');
                if ($path === false) {
                    throw new \RuntimeException('Não foi possível armazenar a foto de perfil.');
                }
                $dados['foto_perfil'] = $path;
            }
            DB::transaction(fn () => User::create($dados));
        } catch (\Throwable $e) {
            if ($path) {
                try {
                    Storage::disk('public')->delete($path);
                } catch (\Throwable $cleanupException) {
                    report($cleanupException);
                }
            }
            throw $e;
        }
        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso.');
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
        $dados = $request->safe()->except('foto_perfil');
        $foto_antiga = $user->foto_perfil;
        $path = null;

        if (empty($dados['password'])) {
            unset($dados['password']);
        }

        try {
            if ($request->hasFile('foto_perfil')) {
                $path = $request->file('foto_perfil')->store('users/fotos', 'public');

                if ($path === false) {
                    throw new \RuntimeException('Não foi possível armazenar a foto de perfil.');
                }

                $dados['foto_perfil'] = $path;
            }

            DB::transaction(function () use ($user, $dados) {
                $user->fill($dados);

                if ($user->isDirty('email')) {
                    $user->email_verified_at = null;
                }

                $user->save();
            });
        } catch (\Throwable $e) {
            if ($path) {
                try {
                    Storage::disk('public')->delete($path);
                } catch (\Throwable $cleanupException) {
                    report($cleanupException);
                }
            }

            throw $e;
        }

        if ($path && $foto_antiga && $foto_antiga !== $path) {
            try {
                Storage::disk('public')->delete($foto_antiga);
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
