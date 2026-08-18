<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserService
{ /** * Get all users */
    public function getAll()
    {
        return User::latest()->paginate(10);
    } /** * Get all users without pagination */
    public function getAllWithoutPagination()
    {
        return User::latest()->get();
    } /** * Find one user */
    public function find(User $user)
    {
        return $user;
    } /** * Create user */
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    } /** * Update user */
    public function update(User $user, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return $user;
    } /** * Delete user */
    public function delete(User $user)
    {
        return $user->delete();
    }
}