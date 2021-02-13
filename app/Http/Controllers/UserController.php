<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->footer = Footer::select('konten')->first();
    }

    public function setting()
    {
        $footer = $this->footer;
        return view('admin/user/setting', compact('footer'));
    }

    public function ubah_password(Request $request, $id)
    {
        $request->validate([
            'password_lama' => 'required|min:8',
            'password_baru' => 'required|min:8|confirmed',
            'password_baru_confirmation' => 'required|min:8',
        ]);

        $user = User::select('id','password')->whereId($id)->firstOrFail();
        if (Hash::check($request->password_lama, $user->password)) {
            $user->update(['password' => Hash::make($request->password_baru)]);

            alert()->success('Sukses', 'Data berhasil diubah');
            return redirect('/user/' .$id .'/setting');
        } else {
            return redirect()->back()->with('gagal', '<small class="text-danger">Password lama anda salah</small>');
        }
        
    }
}
