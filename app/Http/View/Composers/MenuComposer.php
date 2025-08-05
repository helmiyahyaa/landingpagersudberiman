<?php

namespace App\Http\View\Composers;

use App\Services\MenuService;
use Illuminate\View\View;

class MenuComposer
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function compose(View $view)
    {
        $view->with('menus', $this->menuService->getMenuData());
    }
}