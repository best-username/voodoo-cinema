<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\Availability;
use Carbon\CarbonPeriod;

class AvailabilitiesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $period = CarbonPeriod::create(now()->subDays(7), now()->addDays(7));
        $arr = [];

        $i = 1;

        foreach ($period->toArray() as $date) {
            foreach (Availability::TIME as $time) {
                $arr[] = [
                    'name' => 'VooDoo movie #' . $i,
                    'start_date' => date('d-m-Y', strtotime($date)),
                    'seats' => 55,
                    'booked' => 0,
                    'time' => $time];
            }
            $i++;
        }
        DB::table('availabilities')->insert($arr);
    }

}
