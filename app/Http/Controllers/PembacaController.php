<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\User;
use Illuminate\Http\Request;

class PembacaController extends Controller
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
            $pembaca = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('role_id', 3)
            ->where('name', 'LIKE', '%' . request()->search . '%')
            ->select('id', 'name', 'email')
            ->paginate(10);
            $search = request()->search;

            if (count($pembaca) == 0) {
                request()->session()->flash('search', '
                    <div class="alert alert-success mt-4" role="alert">
                        Data yang anda cari tidak ada
                    </div>
                ');
            }
        } else {
            $pembaca = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->where('role_id', 3)
                ->select('id', 'name', 'email')
                ->paginate(10);
        }

        return view('admin/pembaca/index', compact('pembaca', 'footer', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
