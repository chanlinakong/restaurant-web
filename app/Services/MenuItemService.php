<?php

namespace App\Services;

use App\Models\MenuItem;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class MenuItemService
{
    public function getAvailableMenuItems()
    {
        return MenuItem::with('category')
            ->where('is_available', true)
            ->latest()
            ->get();
    }

    /**
     * Get all menu items
     */
    public function getAll()
    {
        return MenuItem::with('category')
            ->latest()
            ->paginate(10);
    }

    public function getAllWithoutPagination()
    {
        return MenuItem::with('category')
            ->latest();
    }


    /**
     * Create menu item
     */
    public function create(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {

            $image = $data['image'];

            $filename = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME))
                . '-' . Str::random(8)
                . '.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('images/menu'),
                $filename
            );

            $data['image_url'] = 'images/menu/' . $filename;

            unset($data['image']);
        }

        return MenuItem::create($data);
    }


    /**
     * Get single menu item
     */
    public function find(MenuItem $menuItem)
    {
        return $menuItem->load('category');
    }


    /**
     * Update menu item
     */
    public function update(MenuItem $menuItem, array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {

            // Delete old image if it exists
            if ($menuItem->image_url) {
                $oldImage = public_path($menuItem->image_url);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // Generate unique filename
            $image = $data['image'];

            $filename = Str::slug(
                pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
            ) . '-' . Str::random(8)
                . '.' . $image->getClientOriginalExtension();

            // Move new image
            $image->move(
                public_path('images/menu'),
                $filename
            );

            // Save path in database
            $data['image_url'] = 'images/menu/' . $filename;

            // Remove uploaded file from update data
            unset($data['image']);
        }

        $menuItem->update($data);

        return $menuItem;
    }


    /**
     * Delete menu item
     */
    public function delete(MenuItem $menuItem)
    {
        // Delete image file
        if ($menuItem->image_url) {
            $imagePath = public_path($menuItem->image_url);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete database record
        return $menuItem->delete();
    }

    public function search($search = null, $category = null)
    {
        $query = MenuItem::with('category')
            ->where('is_available', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        return $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}