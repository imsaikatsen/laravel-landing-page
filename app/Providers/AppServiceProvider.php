<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PageSeo;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('site.includes.header', function ($view) {
            $menus = DynMainMenu::with(['subMenus'])->where([['location', '=', 'Main Menu']])->get();
            $view->with('menus', $menus);
        });
    }
}
