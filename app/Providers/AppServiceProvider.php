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
        $this->app->bind('App\Services\v1\ItemService', 'App\Services\v1\impl\ItemServiceImpl');
        $this->app->bind('App\Services\v1\InvoiceService', 'App\Services\v1\impl\InvoiceServiceImpl');
        $this->app->bind('App\Services\v1\InvoiceItemsService', 'App\Services\v1\impl\InvoiceItemsServiceImpl');
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
