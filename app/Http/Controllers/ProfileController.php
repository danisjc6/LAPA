<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('users.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $dados = $request->safe()->except('foto_perfil');
        $foto_anterior = $user->foto_perfil;
        $path = null;

        try {
            if ($request->hasFile('foto_perfil')) {
                $path = $request->file('foto_perfil')->store('users/fotos', 'public');

                if ($path === false) {
                    throw new \RuntimeException('Não foi possível armazenar a foto de perfil.');
                }
            }

            DB::transaction(function () use ($user, $dados, $path) {
                $user->fill($dados);

                if ($path !== null) {
                    $user->foto_perfil = $path;
                }

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

        if ($path && $foto_anterior && $foto_anterior !== $path) {
            try {
                Storage::disk('public')->delete($foto_anterior);
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
