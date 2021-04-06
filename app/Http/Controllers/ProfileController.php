<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'password'  => 'confirmed',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        // if (!empty($request->password)) {
        //     $user->password = hash::make($request->password);
        // }

        $user->update();

        Toastr::success('Profile berhasil diupdate', '');
        return redirect('/cart');;
    }
}
