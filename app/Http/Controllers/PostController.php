<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::select('id', 'judul', 'sampul', 'id_kategori')->latest()->paginate(10);
        return view('admin/post/index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::select('id', 'nama')->get();
        $kategori = Kategori::select('id', 'nama')->get();
        return view('admin/post/create', compact('kategori', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'sampul' => 'required|mimes:jpg,jpeg,png',
            'konten' => 'required',
            'kategori' => 'required',
            'tag' => 'required',
        ]);

        $sampul = time() .'-' .$request->sampul->getClientOriginalName();
        $request->sampul->move('upload/post', $sampul);

        Post::create([
            'sampul' => $sampul,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'id_kategori' => $request->kategori,
            'slug' => Str::slug($request->judul, '-'),
        ])->tag()->attach($request->tag);

        $request->session()->flash('sukses', '
            <div class="alert alert-success" role="alert">
                Data berhasil ditambahkan
            </div>
        ');
        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::select('id', 'judul', 'sampul', 'konten', 'created_at')->whereId($id)->firstOrFail();
        return view('admin/post/show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::select('id', 'nama')->get();
        $kategori = Kategori::select('id', 'nama')->get();
        $post = Post::select('id', 'judul', 'sampul', 'konten', 'id_kategori')->whereId($id)->firstOrFail();
        return view('admin/post/edit', compact('post', 'kategori', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'sampul' => 'mimes:jpg,jpeg,png',
            'konten' => 'required',
            'kategori' => 'required',
            'tag' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'slug' => Str::slug($request->judul, '-'),
        ];

        $post = Post::select('sampul', 'id')->whereId($id)->first();
        if ($request->sampul) {
            File::delete('upload/post/' .$post->sampul);

            $sampul = time() . '-' . $request->sampul->getClientOriginalName();
            $request->sampul->move('upload/post', $sampul);

            $data['sampul'] = $sampul;
        }

        $post->update($data);
        $post->tag()->sync($request->tag);

        $request->session()->flash('sukses', '
            <div class="alert alert-success" role="alert">
                Data berhasil diubah
            </div>
        ');
        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::select('sampul', 'id')->whereId($id)->first();
        File::delete('upload/post/' . $post->sampul);
        $post->delete();

        request()->session()->flash('sukses', '
            <div class="alert alert-success" role="alert">
                Data berhasil dihapus
            </div>
        ');
        return redirect('/post');
    }
}
