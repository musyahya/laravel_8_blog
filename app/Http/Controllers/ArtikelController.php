<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Footer;
use App\Models\Kategori;
use App\Models\Logo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Tentang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

        request()->session()->forget('search');
        if (request()->search) {
            $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('judul', 'LIKE', '%'. request()->search .'%')->latest()->paginate(6);

            if (count($artikel) == 0) {
                request()->session()->flash('search', 'Post yang anda cari tidak ada');
            }
            $search = request()->search;
        } else {
            $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->latest()->paginate(6);
            $search = '';
        }

        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $home = true;
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'home', 'author', 'search'));
    }

    public function artikel($slug)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $artikel = Post::select('id', 'judul', 'konten', 'id_kategori', 'created_at', 'sampul', 'id_user')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/artikel', compact('artikel', 'kategori', 'logo', 'footer', 'author'));
    }

    public function kategori($slug)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $kategori = Kategori::select('id')->where('slug', $slug)->firstOrFail();
       
        request()->session()->forget('search');
        if (request()->search) {
            $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_kategori', $kategori->id)->where('judul', 'LIKE', '%' . request()->search . '%')->latest()->paginate(6);
            if (count($artikel) == 0) {
                request()->session()->flash('search', 'Post yang anda cari tidak ada');
            }
            $search = request()->search;
        } else {
            $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_kategori', $kategori->id)->latest()->paginate(6);
            $search = '';
        }

        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $kategori_dipilih = Kategori::select('nama', 'slug')->where('slug', $slug)->firstOrFail();
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'kategori_dipilih', 'author', 'search'));
    }

    public function tag($slug)  
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();
        $artikel = Tag::select('id')->where('slug', $slug)->latest()->firstOrFail();
        $artikel = $this->paginate($artikel->post);

        $search = '';
        request()->session()->forget('search');
        if (request()->search) {
            $search = request()->search;
            $filter = $artikel->filter(function($item) use ($search){
                if (stripos($item->judul, $search) !== false) {
                    return true;
                }
            });
            $artikel = $this->paginate($filter);

            if (count($artikel) == 0) {
                request()->session()->flash('search', 'Post yang anda cari tidak ada');
            }
        }
        

        $artikel->withPath(request()->url());
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $tag_dipilih = Tag::select('nama')->where('slug', $slug)->firstOrFail();
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'tag_dipilih', 'author', 'search'));
    }

    public function paginate($items, $perPage = 6, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function banner($slug)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('id', 'judul', 'konten', 'created_at', 'sampul')->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/banner', compact('banner', 'kategori', 'logo', 'footer', 'author'));
    }

    public function tentang()
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $tentang = Tentang::select('konten', 'facebook', 'twitter', 'instagram')->first();
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/tentang', compact('tentang', 'kategori', 'logo', 'footer', 'author'));
    }

    public function author($id)
    {
        $footer = $this->footer;
        $logo = Logo::select('gambar')->first();
        $banner = Banner::select('slug', 'sampul', 'judul')->latest()->get();

        request()->session()->forget('search');
        if (request()->search) {
            $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_user', $id)->where('judul', 'LIKE', '%' . request()->search . '%')->latest()->paginate(6);
            if (count($artikel) == 0) {
                request()->session()->flash('search', 'Post yang anda cari tidak ada');
            }
            $search = request()->search;
        } else {
            $artikel = Post::select('sampul', 'judul', 'slug', 'created_at')->where('id_user', $id)->latest()->paginate(6);
            $search = '';
        }

        $kategori = Kategori::select('slug', 'nama')->orderBy('nama', 'asc')->get();
        $author_dipilih = User::select('name')->whereId($id)->firstOrFail();
        $author = User::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('artikel/index', compact('artikel', 'kategori', 'banner', 'logo', 'footer', 'author_dipilih', 'author', 'search'));
    }
}
