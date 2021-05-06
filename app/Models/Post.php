<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $fillable = ['judul', 'konten', 'sampul', 'slug', 'id_kategori', 'id_user'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'id_post', 'id_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function rekomendasi()
    {
        return $this->hasOne(Rekomendasi::class, 'id_post');
    }
}
