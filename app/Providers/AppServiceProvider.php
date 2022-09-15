<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use Illuminate\Pagination\Paginator;
>>>>>>> 9989a496f1dd5c140f4fd5f06aa63772036475a3

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
        //
<<<<<<< HEAD
=======
        Paginator::useBootstrap();
>>>>>>> 9989a496f1dd5c140f4fd5f06aa63772036475a3
    }
}
