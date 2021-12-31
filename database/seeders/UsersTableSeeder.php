<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'username'=>'tintin',
                'name'=>'Tintin',
                'email'=>'test@gmail.com',
                'password'=>bcrypt('123456'),
            ],

        );
    }
}
