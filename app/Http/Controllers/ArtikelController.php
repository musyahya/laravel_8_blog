<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Kategori;
use App\Models\Logo;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->latest()->get();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo'));
    }

    public function artikel($slug)
    {
        $logo = Logo::select('gambar')->first();
        $artikel = Post::select('id', 'judul', 'konten', 'id_kategori', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/artikel', compact('artikel', 'kategori', 'logo'));
    }

    public function kategori($slug)
    {
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $kategori = Kategori::select('id')->where('slug', $slug)->firstOrFail();
        $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_kategori', $kategori->id)->latest()->get();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo'));
    }

    public function tag($slug)  
    {
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $artikel = Tag::select('id')->where('slug', $slug)->latest()->firstOrFail();
        $artikel = $artikel->post;
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo'));
    }

    public function banner($slug)
    {
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('id', 'judul', 'konten', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/banner', compact('banner', 'kategori', 'logo'));
    }
}
