<?php

namespace App\Providers;

use App\Models\Contato;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::anonymousComponentPath(
            resource_path('views/atlas'),
            'atlas'
        );

        View::composer('layouts.components.nav', function($view){
            $view->with('contato', Contato::first());
        });
    }
}
