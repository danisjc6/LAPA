<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//lembrar de criar middleware para ativar cpf
    {
        $this->middleware(['auth','verified'],['except' => ['index']]);
        //$this->middleware(['check.cpf'],['except' => ['gerenciar']]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('login');
    }

    public function gerenciar()
    {
        return view('auth.home');
    }
}
