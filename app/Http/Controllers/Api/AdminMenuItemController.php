<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Services\MenuItemService;
use Illuminate\Http\JsonResponse;

class AdminMenuItemController extends Controller
{
    public function __construct(
        protected MenuItemService $menuItemService
    ) {
    }

    /**
     * Display a listing of menu items.
     */
    public function index()
    {
        $menuItems = $this->menuItemService->getAllMenuItems();

        return MenuItemResource::collection($menuItems);
    }

    /**
     * Store a newly created menu item.
     */
    public function store(StoreMenuItemRequest $request): JsonResponse
    {
        $menuItem = $this->menuItemService->create(
            $request->validated()
        );

        $menuItem->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Menu item created successfully.',
            'data' => new MenuItemResource($menuItem),
        ], 201);
    }

    /**
     * Display the specified menu item.
     */
    public function show(MenuItem $menuItem): JsonResponse
    {
        $menuItem = $this->menuItemService->find($menuItem);

        $menuItem->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Menu item retrieved successfully.',
            'data' => new MenuItemResource($menuItem),
        ]);
    }

    /**
     * Update the specified menu item.
     */
    public function update(
        UpdateMenuItemRequest $request,
        MenuItem $menuItem
    ): JsonResponse {
        $menuItem = $this->menuItemService->update(
            $menuItem,
            $request->validated()
        );

        $menuItem->fresh()->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Menu item updated successfully.',
            'data' => new MenuItemResource($menuItem),
        ]);
    }

    /**
     * Remove the specified menu item.
     */
    public function destroy(MenuItem $menuItem): JsonResponse
    {
        $this->menuItemService->delete($menuItem);

        return response()->json([
            'success' => true,
            'message' => 'Menu item deleted successfully.',
        ]);
    }
}