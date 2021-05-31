<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['lenovo', 'php', 'samsung'];

        foreach ($tags as $tag) {
            Tag::create([
                'nama' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}
