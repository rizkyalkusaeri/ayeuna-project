<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function actionlogin(Request $request)
    {
        $user = User::where('email', $request->input('nik'))->first();

        if ($user) {
            $data = [
                'email' => $user->email,
                'password' => $user->email,
            ];

            if (Auth::Attempt($data)) {
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Maaf NIK anda tidak terdaftar di sistem');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Maaf NIK anda tidak terdaftar di sistem');
            return redirect()->back();
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
