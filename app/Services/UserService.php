<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
class UserService
{ /** * Get all users */
    public function getAll()
    {
        return User::latest()->paginate(10);
    }
    /** * Get all users without pagination */
    public function getAllWithoutPagination()
    {
        return User::latest()->get();
    }
    /** * Find one user */
    public function find(User $user)
    {
        return $user;
    }
    /** * Create user */
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function updateProfile(User $user, array $data): User
    {
        /*
        |--------------------------------------------------------------------------
        | Remove Profile Image
        |--------------------------------------------------------------------------
        */

        if (!empty($data['remove_image']) && $data['remove_image'] == 1) {

            $this->deleteProfileImage($user->profile_image);

            $data['profile_image'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Upload New Profile Image
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['profile_image']) &&
            $data['profile_image'] instanceof UploadedFile
        ) {

            // Delete old image
            $this->deleteProfileImage(
                $user->profile_image
            );


            $image = $data['profile_image'];


            // Generate unique filename
            $filename = Str::slug(
                pathinfo(
                    $image->getClientOriginalName(),
                    PATHINFO_FILENAME
                )
            )
                . '-'
                . Str::random(8)
                . '.'
                . $image->getClientOriginalExtension();


            // Directory
            $directory = public_path(
                'images/profiles'
            );


            // Create directory if needed
            if (!is_dir($directory)) {

                mkdir(
                    $directory,
                    0755,
                    true
                );

            }


            // Move file
            $image->move(
                $directory,
                $filename
            );


            // Store ONLY filename
            $data['profile_image'] = $filename;
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Helper Field
        |--------------------------------------------------------------------------
        */

        unset($data['remove_image']);


        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $user->update($data);


        return $user;
    }
    public function update(User $user, array $data): User
    {
        /*
        |--------------------------------------------------------------------------
        | Remove Profile Image
        |--------------------------------------------------------------------------
        */

        if (!empty($data['remove_image']) && $data['remove_image'] == 1) {

            $this->deleteProfileImage($user->profile_image);

            $data['profile_image'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Upload New Profile Image
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['profile_image']) &&
            $data['profile_image'] instanceof UploadedFile
        ) {

            // Delete old image
            $this->deleteProfileImage($user->profile_image);

            $image = $data['profile_image'];

            $filename = Str::slug(
                pathinfo(
                    $image->getClientOriginalName(),
                    PATHINFO_FILENAME
                )
            )
                . '-'
                . Str::random(8)
                . '.'
                . $image->getClientOriginalExtension();


            // Make sure directory exists
            $directory = public_path('images/profiles');

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }


            // Move image
            $image->move(
                $directory,
                $filename
            );


            // Store ONLY filename in database
            $data['profile_image'] = $filename;
        }

        //Password

        if (!empty($data['password'])) {

            $data['password'] = Hash::make(
                $data['password']
            );

        } else {

            unset($data['password']);

        }

        //| Remove helper fields


        unset($data['remove_image']);

        // Update user


        $user->update($data);

        return $user;
    }

    private function deleteProfileImage(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path(
            'images/profiles/' . $filename
        );

        if (file_exists($path)) {
            unlink($path);
        }
    }
    /** * Delete user */
    public function delete(User $user)
    {
        // Delete profile image before deleting user
        $this->deleteProfileImage($user->profile_image);

        return $user->delete();
    }

    public function search($search = null, $role = null)
    {
        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if ($role) {
            $query->where('role', $role);
        }

        return $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}