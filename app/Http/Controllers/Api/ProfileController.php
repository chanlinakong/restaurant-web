<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Get current authenticated user.
     */
    public function show(Request $request)
    {
        return response()->json([
            'data' => $this->userData($request->user()),
        ]);
    }

    /**
     * Update profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
        ]);

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'user' => $this->userData($user->fresh()),
        ]);
    }

    /**
     * Upload / replace profile image.
     */
    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $user = $request->user();

        $image = $request->file('profile_image');

        // Delete old profile image
        if ($user->profile_image) {
            $oldImage = public_path(
                'images/profiles/' . $user->profile_image
            );

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // Generate unique filename
        $filename = $image->hashName();

        // Make sure directory exists
        $directory = public_path('images/profiles');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save image
        $image->move(
            $directory,
            $filename
        );

        // Save filename in database
        $user->update([
            'profile_image' => $filename,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile image updated successfully.',

            'user' => $this->userData(
                $user->fresh()
            ),
        ]);
    }

    /**
     * Change password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = $request->user();

        if (
            !Hash::check(
                $validated['current_password'],
                $user->password
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 422);
        }

        $user->update([
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
        ]);
    }

    /**
     * Format user response for Flutter.
     */
    private function userData($user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,

            'profile_image_url' => $user->profile_image
                ? url('images/profiles/' . basename($user->profile_image))
                : null,
        ];
    }
}