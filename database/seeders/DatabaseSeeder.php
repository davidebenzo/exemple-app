<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\CommercialActivity;
use App\Models\Category;
use App\Models\Province;
use App\Models\Region;
use App\Models\Zip;
use App\Models\Zone;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(ZoneSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ZipSeeder::class);
        $this->call(CategorySeeder::class);



        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        CommercialActivity::factory(20)->create();
    }
}
