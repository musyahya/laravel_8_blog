<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'sampul' => 'banner1.jpg',
            'judul' => 'Tips dan Trik Membeli Laptop Secara Online',
            'konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto itaque, pariatur quod et consectetur quasi quas eum quidem, placeat illo, similique optio deserunt nemo iste eos omnis. In, veritatis corrupti?',
            'slug' => Str::slug('Tips dan Trik Membeli Laptop Secara Online')
        ]);

        Banner::create([
            'sampul' => 'banner2.jpg',
            'judul' => 'Cara mengatasi error didalam belajar programing',
            'konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto itaque, pariatur quod et consectetur quasi quas eum quidem, placeat illo, similique optio deserunt nemo iste eos omnis. In, veritatis corrupti?',
            'slug' => Str::slug('Cara mengatasi error didalam belajar programing')
        ]);
    }
}
