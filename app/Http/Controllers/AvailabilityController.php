<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Http\Resources\AvailabilityResource;

//use App\Http\Requests\Order\StoreRequest;

class AvailabilityController extends ApiController
{

    public function index()
    {
        $dates = Availability::all()->unique('start_date')->pluck('start_date', 'id')->toArray();
        $times = Availability::TIME;

        return $this->respondSuccess(['dates' => $dates, 'times' => $times]);
    }

    public function show(Availability $availability, string $time)
    {
        return $this->respondSuccess(new AvailabilityResource(Availability::where('start_date', $availability->start_date)->where('time', Availability::TIME[$time])->first()));
    }

}
