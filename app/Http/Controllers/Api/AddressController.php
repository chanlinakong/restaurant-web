<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Get authenticated user's addresses.
     */
    public function index(Request $request): JsonResponse
    {
        $addresses = $request->user()
            ->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $addresses,
        ]);
    }

    /**
     * Create a new address.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line' => ['required', 'string'],
            'district' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'is_default' => ['nullable', 'boolean'],
        ]);

        $user = $request->user();

        $isDefault = $validated['is_default'] ?? false;

        $address = DB::transaction(function () use (
            $user,
            $validated,
            $isDefault
        ) {
            if ($isDefault) {
                $user->addresses()
                    ->update([
                        'is_default' => false,
                    ]);
            }

            // First address automatically becomes default.
            if ($user->addresses()->count() === 0) {
                $isDefault = true;
            }

            return $user->addresses()->create([
                'label' => $validated['label'],
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'address_line' => $validated['address_line'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'note' => $validated['note'] ?? null,
                'is_default' => $isDefault,
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Address created successfully.',
            'data' => $address,
        ], 201);
    }

    /**
     * Get one address.
     */
    public function show(Request $request, Address $address): JsonResponse
    {
        $this->authorizeAddress($request, $address);

        return response()->json([
            'success' => true,
            'data' => $address,
        ]);
    }

    /**
     * Update an address.
     */
    public function update(
        Request $request,
        Address $address
    ): JsonResponse {
        $this->authorizeAddress($request, $address);

        $validated = $request->validate([
            'label' => ['required', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line' => ['required', 'string'],
            'district' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'is_default' => ['nullable', 'boolean'],
        ]);

        $isDefault = $validated['is_default'] ?? false;

        DB::transaction(function () use (
            $request,
            $address,
            $validated,
            $isDefault
        ) {
            if ($isDefault) {
                $request->user()
                    ->addresses()
                    ->where('id', '!=', $address->id)
                    ->update([
                        'is_default' => false,
                    ]);
            }

            $address->update([
                'label' => $validated['label'],
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'address_line' => $validated['address_line'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'note' => $validated['note'] ?? null,
                'is_default' => $isDefault,
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully.',
            'data' => $address->fresh(),
        ]);
    }

    /**
     * Delete an address.
     */
    public function destroy(
        Request $request,
        Address $address
    ): JsonResponse {
        $this->authorizeAddress($request, $address);

        $wasDefault = $address->is_default;

        $address->delete();

        // If the deleted address was default,
        // automatically make another address default.
        if ($wasDefault) {
            $newDefault = $request->user()
                ->addresses()
                ->latest()
                ->first();

            if ($newDefault) {
                $newDefault->update([
                    'is_default' => true,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully.',
        ]);
    }

    /**
     * Set address as default.
     */
    public function setDefault(
        Request $request,
        Address $address
    ): JsonResponse {
        $this->authorizeAddress($request, $address);

        DB::transaction(function () use ($request, $address) {
            $request->user()
                ->addresses()
                ->update([
                    'is_default' => false,
                ]);

            $address->update([
                'is_default' => true,
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Default address updated.',
            'data' => $address->fresh(),
        ]);
    }

    /**
     * Make sure the address belongs to the logged-in user.
     */
    private function authorizeAddress(
        Request $request,
        Address $address
    ): void {
        abort_unless(
            $address->user_id === $request->user()->id,
            403,
            'You do not have permission to access this address.'
        );
    }
}