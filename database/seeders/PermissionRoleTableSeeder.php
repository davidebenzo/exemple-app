<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

 


    public function run(): void
    {
        Role::findOrFail(1)->permissions()->sync([1, 2, 3]);
    }
}
