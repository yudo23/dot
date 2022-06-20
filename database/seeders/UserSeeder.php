<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ],[
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => bcrypt('admin')
        ]);
    }
}
