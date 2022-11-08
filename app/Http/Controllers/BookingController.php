<?php

namespace App\Http\Controllers;

use App\Models\Booking;
//use App\Http\Resources\OrderResource;
use App\Http\Requests\BookingStoreRequest;

class BookingController extends ApiController
{

    public function store(BookingStoreRequest $request)
    {
        if (count($request->seat_number) > 1) {
            foreach ($request->seat_number as $value) {
                $booking = Booking::create([
                            'seat_number' => $value,
                            'availability_id' => $request->availability_id
                ]);
            }
        } else {
            $booking = Booking::create($request->all());
        }

        return $this->respondSuccess(($booking));
//        return $this->respondSuccess(new OrderResource($booking));
    }

}
