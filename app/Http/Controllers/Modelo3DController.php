<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\ModeloAnatomico3D;
use Illuminate\Http\Request;

class Modelo3DController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animais = Animal::whereHas('modelos3D', function ($query) {
                $query->where('ativo', true);
            })
            ->get();

        return view('modelos-3d.index', compact('animais'));
    }

    public function porAnimal(Animal $animal)
    {
        $modelos = $animal->modelos3D()
            ->where('ativo', true)
            ->orderBy('ordem')
            ->paginate(12);

        return view(
            'modelos-3d.por-animal',
            compact('animal', 'modelos')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ModeloAnatomico3d $modelo)
    {
        $modelos = ModeloAnatomico3D::where('animal_id', $modelo->animal_id)
            ->where('ativo', true)
            ->orderBy('ordem')
            ->get();

        return view('modelos-3d.show', compact('modelo', 'modelos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModeloAnatomico3d $modeloAnatomico3d)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModeloAnatomico3d $modeloAnatomico3d)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModeloAnatomico3d $modeloAnatomico3d)
    {
        //
    }
}
