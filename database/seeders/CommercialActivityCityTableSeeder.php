<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommercialActivity;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CommercialActivityCityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

 


    public function run(): void
    {
        $activities=CommercialActivity::all();
        foreach($activities as $activity){
            $activity->id;
            $city=City::find($activity->city_id);
            $cityIds = DB::table('cities')
            ->select('id')
            ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - 
            radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$city->latitude, $city->longitude, $city->latitude])
            ->having('distance', '<=', $activity->rangeKm)
            ->pluck('id');
            CommercialActivity::findOrFail($activity->id)->deliveryCities()->sync($cityIds);
          

        }

    }
}
