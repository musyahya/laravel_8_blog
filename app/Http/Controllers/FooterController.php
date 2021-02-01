<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::select('id', 'konten')->first();
        return view('admin/footer/index', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'konten' => 'required',
        ]);

        Footer::whereId($id)->update([
            'konten' => $request->konten
        ]);

        alert()->success('Sukses', 'Data berhasil diubah');
        return redirect('/footer');
    }
}
