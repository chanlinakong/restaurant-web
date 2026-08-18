<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\MenuItemService;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\MenuItem;


class AdminMenuItemController extends Controller
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

        return view(
            'pages.admin.menu-items.index',
            compact('menuItems', 'categories')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'pages.admin.menu-items.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuItemRequest $request)
    {
        $this->menuItemService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        $menuItem = $this->menuItemService->find($menuItem);

        return view(
            'pages.admin.menu-items.show',
            compact('menuItem')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();

        return view(
            'pages.admin.menu-items.edit',
            compact('menuItem', 'categories')
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateMenuItemRequest $request,
        MenuItem $menuItem
    ) {

        $this->menuItemService->update(
            $menuItem,
            $request->validated()
        );

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        $this->menuItemService->delete($menuItem);

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }

}

