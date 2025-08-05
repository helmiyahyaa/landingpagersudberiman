<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Categories; // Pastikan model di-import

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Ganti target view ke 'welcome' atau '*' agar berlaku di semua view
        View::composer('layouts.app', function ($view) {
            $mainMenus = Categories::active()
                                ->mainMenu()
                                ->with('children') // Eager load submenu
                                ->get();

            $view->with('mainMenus', $mainMenus);
        });
    }
}