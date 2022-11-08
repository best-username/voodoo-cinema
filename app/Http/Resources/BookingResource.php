<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'availability_id' => $this->availability_id,
            'seat_number' => $this->seat_number,
        ];
    }

}
