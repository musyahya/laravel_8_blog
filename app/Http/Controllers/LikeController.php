<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($id_post)
    {
        $like = Like::where('id_post', $id_post)->where('id_user', auth()->user()->id)->first();

        if ($like) {
            $like->delete();
            return back();
        } else {
            Like::create([
                'id_post' => $id_post,
                'id_user' => auth()->user()->id
            ]);
            return back();
        }
        
    }
}
