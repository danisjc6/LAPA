<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Http\Requests\UpdateContatoRequest;
use App\Models\Contato;
use App\Models\User;
use Validator;
use Auth;

class ContatoController extends Controller
{


    public function edit(Contato $contato)
    {
        $contato = Contato::firstOrFail();

        return view('contatos.edit', compact('contato'));
    }

    public function update(UpdateContatoRequest $request)
    {
        $contato = Contato::firstOrFail();

        $contato->update($request->validated());

        return redirect()
            ->route('contatos.edit')
            ->with('success', 'Informações atualizadas com sucesso.');
    }

}
