<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Cliente\ClienteRepositoryInterface',
            'App\Repositories\Cliente\ClienteRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Produto\ProdutoRepositoryInterface',
            'App\Repositories\Produto\ProdutoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Venda\VendaRepositoryInterface',
            'App\Repositories\Venda\VendaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\ItensVenda\ItensVendaRepositoryInterface',
            'App\Repositories\ItensVenda\ItensVendaRepositoryEloquent'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
