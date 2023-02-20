<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'role_id' => 2,
                'name' => 'Gonalu Kaler',
                'username' => 'gonalukaler',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'name' => 'Jamal Jacob',
                'username' => 'jamaljacob',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'name' => 'Ramdhani Akbar',
                'username' => 'ramdhaniakbar',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'name' => 'Anggana Putra',
                'username' => 'angganaputra',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
