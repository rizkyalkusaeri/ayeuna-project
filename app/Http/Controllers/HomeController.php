<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = User::all();
            return view('home.admin', compact('data'));
        } else {
            return view('home.index');
        }
    }

    public function go_absen()
    {
        $link = Crypt::encrypt('https://ee.kobotoolbox.org/x/16aAw4kS');
        $link_absensi = Crypt::decrypt($link);

        return redirect()->away($link_absensi);
    }

    public function go_isi()
    {
        $link = Crypt::encrypt('https://ee.kobotoolbox.org/x/sfhQcOa1');
        $link_isi = Crypt::decrypt($link);

        return redirect()->away($link_isi);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new UsersImport(), $request->file('file'));

            return redirect()->back()->with('success', 'Data user berhasil di import');
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error and redirect to an error page
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred during the import process.');
        }
    }
}
