<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';
    protected $fillable = ['nama', 'slug'];

    public function post()
    {
        // return $this->belongsToMany(Post::class, 'post_tag', 'id_post', 'id_tag');
        return $this->belongsToMany(Post::class, 'post_tag', 'id_tag', 'id_post');
    }
}
