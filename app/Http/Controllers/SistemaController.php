<?php

namespace App\Http\Controllers;

use App\Models\Sistema;
use App\Services\AtlasSidebarService;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public function index(AtlasSidebarService $atlasSidebarService)
    {
        $sistemas = Sistema::all();
        $menu_lateral = $atlasSidebarService->montarNavegacaoLateral();

        return view('atlas.sistemas.index', compact('sistemas', 'menu_lateral'));
    }

    public function create()
    {

    }

    public function salvar()
    {
    }

    public function edit()
    {

    }

    public function update()
    {
    }

    public function destroy()
    {
    }

   
}
