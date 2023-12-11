<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Berita;
use App\Models\Halaman;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(): void
    {   
        //komponen header
        View::composer('components.header', function($view){
            $view->with('header',Halaman::take(3)->orderBy('updated_at','desc')->get());
        });
        //komponen footer
        View::composer('components.footer', function($view){
            $view->with('kategori',Category::take(10)->get());
        });
        
        //komponen aside
        View::composer('components.aside',function($view){
            $view->with('kategori',Category::all());
            $view->with('newest',Berita::take(5)->orderBy('created_at','desc')->get());
        });

        Blade::component('alert',\App\View\Components\alert::class);
        
    }
}
