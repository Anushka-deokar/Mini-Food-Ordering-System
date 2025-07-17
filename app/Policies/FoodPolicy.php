<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Food;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any food items.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the food item.
     */
    public function view(User $user, Food $food): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create food items.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the food item.
     */
    public function update(User $user, Food $food): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the food item.
     */
    public function delete(User $user, Food $food): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the food item.
     */
    public function restore(User $user, Food $food): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the food item.
     */
    public function forceDelete(User $user, Food $food): bool
    {
        return $user->isAdmin();
    }
}