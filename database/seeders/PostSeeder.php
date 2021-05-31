<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\Rekomendasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // post 1
        
        $post = Post::create([
            'id_kategori' => '1',
            'id_user' => 1,
            'sampul' => 'post1.jpg',
            'judul' => 'Tutorial cara merawat laptop',
            'konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto itaque, pariatur quod et consectetur quasi quas eum quidem, placeat illo, similique optio deserunt nemo iste eos omnis. In, veritatis corrupti?',
            'slug' => Str::slug('Tutorial cara merawat laptop')
        ]);

        DB::table('post_tag')->insert([
            'id_post' => $post->id,
            'id_tag' => 1
        ]);
      
        DB::table('post_tag')->insert([
            'id_post' => $post->id,
            'id_tag' => 3
        ]);

        Rekomendasi::create([
            'id_post' => $post->id
        ]);
       
        // post 2

        $post = Post::create([
            'id_kategori' => '2',
            'id_user' => 2,
            'sampul' => 'post2.jpeg',
            'judul' => 'Belajar Laravel',
            'konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto itaque, pariatur quod et consectetur quasi quas eum quidem, placeat illo, similique optio deserunt nemo iste eos omnis. In, veritatis corrupti?',
            'slug' => Str::slug('Belajar Laravel')
        ]);

        DB::table('post_tag')->insert([
            'id_post' => $post->id,
            'id_tag' => 2
        ]);

        Like::create([
            'id_post' => $post->id,
            'id_user' => 3
        ]);

        Rekomendasi::create([
            'id_post' => $post->id
        ]);
     
        // post 3

        $post = Post::create([
            'id_kategori' => '2',
            'id_user' => 2,
            'sampul' => 'post3.jpg',
            'judul' => 'Belajar Laravel Autentifikasi',
            'konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto itaque, pariatur quod et consectetur quasi quas eum quidem, placeat illo, similique optio deserunt nemo iste eos omnis. In, veritatis corrupti?',
            'slug' => Str::slug('Belajar Laravel Autentifikasi')
        ]);

        DB::table('post_tag')->insert([
            'id_post' => $post->id,
            'id_tag' => 2
        ]);

        Like::create([
            'id_post' => $post->id,
            'id_user' => 3
        ]);
      
        // post 4

        $post = Post::create([
            'id_kategori' => '3',
            'id_user' => 1,
            'sampul' => 'post4.jpg',
            'judul' => 'Rekomendasi Hp Tahun 2021',
            'konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto itaque, pariatur quod et consectetur quasi quas eum quidem, placeat illo, similique optio deserunt nemo iste eos omnis. In, veritatis corrupti?',
            'slug' => Str::slug('Rekomendasi Hp Tahun 2021')
        ]);

        DB::table('post_tag')->insert([
            'id_post' => $post->id,
            'id_tag' => 3
        ]);

        DB::table('post_tag')->insert([
            'id_post' => $post->id,
            'id_tag' => 1
        ]);
    }
}
