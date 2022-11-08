<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'start_date'];

    const TIME = [
        1 => '10:00',
        2 => '12:00',
        3 => '14:00',
        4 => '16:00',
        5 => '18:00',
        6 => '20:00'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
