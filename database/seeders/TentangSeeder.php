<?php

namespace Database\Seeders;

use App\Models\Tentang;
use Illuminate\Database\Seeder;

class TentangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tentang::create([
            'konten' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum ipsa magnam non nam aut dolore beatae provident dolorem, corrupti quibusdam. Iure est sint odit doloremque exercitationem qui veniam quia tempora?',
            'facebook' => 'www.facebook.com',
            'instagram' => 'www.instagram.com',
            'twitter' => 'www.twitter.com'
        ]);
    }
}
