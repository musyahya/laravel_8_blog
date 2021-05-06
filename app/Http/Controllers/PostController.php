<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Kategori;
use App\Models\Post;
use App\Models\Rekomendasi;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert; 

class PostController extends Controller
{
    public function __construct()
    {
        $this->footer = Footer::select('konten')->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footer = $this->footer;

        $search = '';
        if (request()->search) {
            $post = Post::select('id', 'judul', 'sampul', 'id_kategori')->where('id_user', Auth::user()->id)->where('judul', 'LIKE', '%'. request()->search .'%')->latest()->paginate(10);
            $search = request()->search;

            if (count($post) == 0) {
                request()->session()->flash('search', '
                    <div class="alert alert-success mt-4" role="alert">
                        Data yang anda cari tidak ada
                    </div>
                '); 
            }
        } else {
            $post = Post::select('id', 'judul', 'sampul', 'id_kategori')->where('id_user', Auth::user()->id)->latest()->paginate(10);
        }
       
        return view('admin/post/index', compact('post', 'footer', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $footer = $this->footer;
        $tag = Tag::select('id', 'nama')->get();
        $kategori = Kategori::select('id', 'nama')->get();
        return view('admin/post/create', compact('kategori', 'tag', 'footer'));
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
            'id_user' => Auth::user()->id
        ])->tag()->attach($request->tag);

        Alert::success('Sukses', 'Data berhasil ditambahkan');
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
        $footer = $this->footer;
        $post = Post::select('id', 'judul', 'sampul', 'konten', 'created_at')->whereId($id)->where('id_user', Auth::user()->id)->firstOrFail();
        return view('admin/post/show', compact('post', 'footer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footer = $this->footer;
        $tag = Tag::select('id', 'nama')->get();
        $kategori = Kategori::select('id', 'nama')->get();
        $post = Post::select('id', 'judul', 'sampul', 'konten', 'id_kategori')->whereId($id)->where('id_user', Auth::user()->id)->firstOrFail();
        return view('admin/post/edit', compact('post', 'kategori', 'tag', 'footer'));
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
            'id_kategori' => $request->kategori,
            'slug' => Str::slug($request->judul, '-'),
            'id_user' => Auth::user()->id
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

        Alert::success('Sukses', 'Data berhasil diubah');
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
    //    
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan !', 'Anda yakin akan menghapus data ?')
        ->showConfirmButton('<a href="/post/' . $id . '/delete" class="text-white" style="text-decoration: none"> Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/post');
    }

    public function delete($id)
    {
        $post = Post::select('sampul', 'id')->whereId($id)->where('id_user', Auth::user()->id)->firstOrFail();
        File::delete('upload/post/' . $post->sampul);
        $post->delete();

        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/post');
    }

    public function rekomendasi($id)
    {
        $post = DB::table('post')
            ->join('rekomendasi', 'post.id', '=', 'rekomendasi.id_post')
            ->where('rekomendasi.id_post', $id)
            ->get();

        if ($post->isEmpty()) {
            Rekomendasi::create([
                'id_post' => $id
            ]);

            Alert::success('Sukses', 'Post berhasil direkomendasikan');
            return redirect('/post');
        } else {
            Rekomendasi::where('id_post', $id)->delete();
            Alert::success('Sukses', 'Post batal direkomendasikan');
            return redirect('/post');
        }
        
    }
}
