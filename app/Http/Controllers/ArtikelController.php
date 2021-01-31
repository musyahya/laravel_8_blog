<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Kategori;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $banner = Banner::select('slug', 'sampul')->latest()->get();
        $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->latest()->get();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner'));
    }

    public function artikel($slug)
    {
        $artikel = Post::select('id', 'judul', 'konten', 'id_kategori', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/artikel', compact('artikel', 'kategori'));
    }

    public function kategori($slug)
    {
        $kategori = Kategori::select('id')->where('slug', $slug)->firstOrFail();
        $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_kategori', $kategori->id)->latest()->get();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori'));
    }

    public function tag($slug)  
    {
        $artikel = Tag::select('id')->where('slug', $slug)->latest()->firstOrFail();
        $artikel = $artikel->post;
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori'));
    }

    public function banner($slug)
    {
        $banner = Banner::select('id', 'judul', 'konten', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/banner', compact('banner', 'kategori'));
    }
}
