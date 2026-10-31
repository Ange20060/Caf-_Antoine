<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\UserRole;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role,[
          $user -> UserRole::ADMIN,
          $user -> UserRole::CUISINE,
        ],true);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        /* return false; */
        if($user->role === UserRole::ADMIN){
          return true;
        }
        return $user->role ===UserRole::USERS
        && $order->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role=== UserRole::USERS;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        return in_array($user->role,[
          $user->role===UserRole::ADMIN,
          $user->role===UserRole::CUISINE
        ], true);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function cancel(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN
            || (
                $user->role === UserRole::USERS
                && $order->user_id === $user->id
                );
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return false;
    }
}
