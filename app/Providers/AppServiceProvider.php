<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Make categories available in the layout for the navbar and sidebar
        View::composer('layouts.app', function ($view) {
            $view->with('navCategories', Category::orderBy('name')->get());
        });
    }
}
