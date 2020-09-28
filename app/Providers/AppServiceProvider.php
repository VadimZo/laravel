<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
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
        view()->composer('blog.pages.sidebar',function ($view){
            $view->with('popularPost',Post::orderBy('views','desc')->take(3)->get());
            $view->with('featuredPost',Post::where('is_featured',1)->take(3)->get());
            $view->with('newPost',Post::orderBy('date','desc')->take(4)->get());
            $view->with('categories',Category::all());
        });
    }
}
