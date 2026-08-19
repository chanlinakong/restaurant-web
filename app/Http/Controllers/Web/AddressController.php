<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display user's addresses.
     */
    public function index()
    {
        $addresses = Auth::user()
            ->addresses()
            ->latest()
            ->get();

        return view('pages.addresses.index', compact('addresses'));
    }

    /**
     * Show create address form.
     */
    public function create()
    {
        return view('pages.addresses.form');
    }

    /**
     * Store a new address.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'note' => ['nullable', 'string', 'max:500'],
            'is_default' => ['nullable', 'boolean'],
        ]);

        $user = Auth::user();

        $isDefault = $request->boolean('is_default');

        // If this is the first address, make it default automatically.
        if ($user->addresses()->count() === 0) {
            $isDefault = true;
        }

        // Remove default from other addresses.
        if ($isDefault) {
            $user->addresses()->update([
                'is_default' => false,
            ]);
        }

        $validated['is_default'] = $isDefault;

        $user->addresses()->create($validated);

        return redirect()
            ->route('addresses.index')
            ->with('success', __('Address added successfully.'));
    }

    /**
     * Show edit address form.
     */
    public function edit(Address $address)
    {
        $this->authorizeAddress($address);

        return view('pages.addresses.form', compact('address'));
    }

    /**
     * Update address.
     */
    public function update(Request $request, Address $address)
    {
        $this->authorizeAddress($address);

        $validated = $request->validate([
            'label' => ['required', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'note' => ['nullable', 'string', 'max:500'],
            'is_default' => ['nullable', 'boolean'],
        ]);

        $isDefault = $request->boolean('is_default');

        if ($isDefault) {
            Auth::user()->addresses()->update([
                'is_default' => false,
            ]);
        }

        $validated['is_default'] = $isDefault;

        $address->update($validated);

        return redirect()
            ->route('addresses.index')
            ->with('success', __('Address updated successfully.'));
    }

    /**
     * Set address as default.
     */
    public function setDefault(Address $address)
    {
        $this->authorizeAddress($address);

        Auth::user()->addresses()->update([
            'is_default' => false,
        ]);

        $address->update([
            'is_default' => true,
        ]);

        return back()->with(
            'success',
            __('Default address updated successfully.')
        );
    }

    /**
     * Delete address.
     */
    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        $wasDefault = $address->is_default;

        $address->delete();

        // If deleted address was default,
        // make another address default.
        if ($wasDefault) {
            $newDefault = Auth::user()
                ->addresses()
                ->latest()
                ->first();

            if ($newDefault) {
                $newDefault->update([
                    'is_default' => true,
                ]);
            }
        }

        return back()->with(
            'success',
            __('Address deleted successfully.')
        );
    }

    /**
     * Ensure address belongs to current user.
     */
    private function authorizeAddress(Address $address)
    {
        abort_unless(
            $address->user_id === Auth::id(),
            403
        );
    }
}