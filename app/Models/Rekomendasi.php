<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi';
    protected $fillable = ['id_post'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
}
