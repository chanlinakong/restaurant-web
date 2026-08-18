<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\MenuItemService;

class MenuItemController extends Controller
{
    public function __construct(
        protected MenuItemService $menuItemService
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = $this->menuItemService->getAvailableMenuItems();

        $categories = Category::orderBy('name')->get();

        return view('pages.menu', compact('menuItems', 'categories'));
    }


    /**
     * Display the shopping cart & checkout view.
     * 
     * Route: GET /checkout
     */
    public function checkout()
    {
        return view('pages.checkout');
    }
    /**
     * Show the form for creating a new resource.
     */
}
