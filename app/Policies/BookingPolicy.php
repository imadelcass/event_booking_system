<?php

namespace App\Policies;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isCustomer();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isCustomer();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Booking $booking): bool
    {
        return false;
    }

    /**
     * Determine whether the user can cancel the model.
     */
    public function cancel(User $user, Booking $booking): bool
    {

        return $user->isCustomer()
            && $booking->user_id === $user->id
            && $booking->status !== BookingStatusEnum::CANCELLED->value;
    }
}
