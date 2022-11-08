<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seat_number' => 'array',
            'seat_number.*' => 'numeric',
            'availability_id' => Rule::exists('availabilities', 'id'),
        ];
    }

}
