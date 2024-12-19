<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\User;
use File;
class UserTableSeeder extends Seeder
{

public function run()
{
    $users = [
        [
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'remember_token' => null,
        ],
        [
            'id' => 2,
            'name' => 'User',
            'email' => 'davidebenzo@gmail.com',
            'password' => bcrypt('12345678'),
            'remember_token' => null,
        ],
    ];
    User::insert($users);
}
}

?>