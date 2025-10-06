<?php

namespace App\Http\Requests;

use App\Enums\BookingStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Calculate available tickets
        $ticketBookings = $this->ticket->bookings()->whereNot('status', BookingStatusEnum::CANCELLED)->sum('quantity');
        $availableQuantity = $this->ticket->quantity - $ticketBookings;

        return [
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $availableQuantity],
        ];
    }
}
