<?php

namespace App\Services;

use App\Models\Categories;

class MenuService
{
    public function getMenuData()
    {
        // Ambil semua menu utama (parent_menu = 0 atau NULL)
        $mainMenus = Categories::where(function($query) {
            $query->where('parent_menu', 0)
                  ->orWhereNull('parent_menu');
        })
        ->where('status', 'aktif')
        ->orderBy('id')
        ->with(['children' => function($query) {
            $query->where('status', 'aktif')->orderBy('id');
        }])
        ->get();

        return $mainMenus;
    }
}