<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

  

    public function run(): void
    {
        User::findOrFail(1)->roles()->pluck('id');
     
    }
}