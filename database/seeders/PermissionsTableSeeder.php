<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $permissions = [
        [
            'id' => 1,
            'title' => 'task_create',
        ],
        [
            'id' => 2,
            'title' => 'task_edit',
        ],
        [
            'id' => 3,
            'title' => 'task_destroy',
        ],
    ];
    Permission::insert($permissions);
}
}
