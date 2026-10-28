<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $dados = $request->safe()->except('foto_perfil');
        $path = null;

        try {
            if ($request->hasFile('foto_perfil')) {
                $path = $request->file('foto_perfil')->store('users/fotos', 'public');

                if ($path === false) {
                    throw new \RuntimeException('Não foi possível armazenar a foto de perfil.');
                }
            }
            $user = DB::transaction(function () use ($dados, $path) {
                return User::create([
                    ...$dados,
                    'foto_perfil' => $path,
                    'status' => StatusUser::Pendente,
                ]);
            });
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            throw $e;
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
