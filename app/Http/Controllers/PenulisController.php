<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert; 

class PenulisController extends Controller
{
    public function __construct()
    {
        $this->footer = Footer::select('konten')->first();
    }

    public function index()
    {
        $footer = $this->footer;
        $search = '';
        if (request()->search) {
            $penulis = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('role_id', 2)
            ->where('name', 'LIKE', '%' . request()->search . '%')
            ->select('id', 'name', 'email')
            ->paginate(10);
            $search = request()->search;

            if (count($penulis) == 0) {
                request()->session()->flash('search', '
                    <div class="alert alert-success mt-4" role="alert">
                        Data yang anda cari tidak ada
                    </div>
                ');
            }
        } else {
            $penulis = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('role_id', 2)
            ->select('id', 'name', 'email')
            ->paginate(10);
        }
      
        return view('admin/penulis/index', compact('penulis', 'footer', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $footer = $this->footer;
        return view('admin/penulis/create', compact('footer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('asd');
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:9|confirmed',
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ])->assignRole('penulis');

        Alert::success('Sukses', 'Data berhasil ditambahkan');
        return redirect('/penulis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        ->showConfirmButton('<a href="/penulis/' . $id . '/delete" class="text-white" style="text-decoration: none"> Hapus</a>', '#3085d6')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/penulis');
    }

    public function delete($id)
    {
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        User::whereId($id)->delete();

        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/penulis');
    }
}
