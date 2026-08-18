<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItemResource;
use App\Services\MenuItemService;

class MenuItemController extends Controller
{
    public function __construct(
        protected MenuItemService $menuItemService
    ) {
    }

    /**
     * Display available menu items.
     */
    public function index()
    {
        $menuItems = $this->menuItemService->getAvailableMenuItems();

        return MenuItemResource::collection($menuItems);
    }
}