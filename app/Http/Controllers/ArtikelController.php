<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Footer;
use App\Models\Kategori;
use App\Models\Logo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Tentang;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->footer = Footer::select('konten')->first();
    }

    public function index()
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->latest()->get();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $home = true;
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'home'));
    }

    public function artikel($slug)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $artikel = Post::select('id', 'judul', 'konten', 'id_kategori', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/artikel', compact('artikel', 'kategori', 'logo', 'footer'));
    }

    public function kategori($slug)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $kategori = Kategori::select('id')->where('slug', $slug)->firstOrFail();
        $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_kategori', $kategori->id)->latest()->get();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $kategori_dipilih = Kategori::select('nama', 'slug')->where('slug', $slug)->firstOrFail();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'kategori_dipilih'));
    }

    public function tag($slug)  
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $artikel = Tag::select('id')->where('slug', $slug)->latest()->firstOrFail();
        $artikel = $artikel->post;
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $tag_dipilih = Tag::select('nama')->where('slug', $slug)->firstOrFail();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'tag_dipilih'));
    }

    public function banner($slug)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('id', 'judul', 'konten', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        return view('artikel/banner', compact('banner', 'kategori', 'logo', 'footer'));
    }

    public function tentang()
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $tentang = Tentang::select('konten', 'facebook', 'twitter', 'instagram')->first();
        return view('artikel/tentang', compact('tentang', 'kategori', 'logo', 'footer'));
    }
}
