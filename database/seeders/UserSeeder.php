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
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123')
        ])->assignRole('admin');
      
        User::create([
            'name' => 'penulis',
            'email' => 'penulis@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123')
        ])->assignRole('penulis');
      
        User::create([
            'name' => 'pembaca',
            'email' => 'pembaca@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123')
        ])->assignRole('pembaca');
    }
}
