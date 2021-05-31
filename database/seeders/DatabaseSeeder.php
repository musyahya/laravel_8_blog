<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,

            KategoriSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            
            BannerSeeder::class,
            LogoSeeder::class,
            FooterSeeder::class,
            TentangSeeder::class,
        ]);
    }
}
