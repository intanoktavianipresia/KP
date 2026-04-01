<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('*', function ($view) {

            $menunggu = DB::table('pemohons')
                ->where('status','menunggu')
                ->count();

            $view->with('menunggu', $menunggu);
        });
    }
}