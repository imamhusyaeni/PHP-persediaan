<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Barang;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('name', 'password')))
        {
            return redirect('/dashboard');
        }
        return redirect('/')->with('status', 'Login Gagal !! Username atau Password Salah !!');
    }

    public function gantipassword()
    {
        $barang = Barang::all();

        return view('auth.password', compact('barang'));
    }

    public function postgantipassword(Request $request)
    {
        $request->validate([
            'lama' => ['required', new MatchOldPassword],
            'baru' => 'required',
            'ulang' => 'same:baru'
        ]);

        $user = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->baru)]);return redirect('/gantipassword')->with('status', 'Password Berhasil Diubah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
