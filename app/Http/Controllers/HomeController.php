<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = User::all();
            $link = Link::findOrFail(1);
            return view('home.admin', compact('data', 'link'));
        } else {
            return view('home.index');
        }
    }

    public function go_link()
    {
        $link = Link::find(1);

        return redirect()->away($link->link);
    }

    public function go_absen()
    {
        $link = Crypt::encrypt('https://ee.kobotoolbox.org/x/fawc4PrB');
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
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tps' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
        ]);

        try {
            // Save data to the database
            User::create([
                'name' => $request->nama,
                'email' => $request->nik,
                'role' => 'user',
                'password' => Hash::make($request->nik),
                'tps' => $request->tps,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
            ]);

            return redirect()->back()->with('success', 'Data has been saved successfully!');
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error and redirect to an error page
            Log::error($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'Data has been deleted successfully!');
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error and redirect to an error page
            Log::error($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update_link(Request $request)
    {
        $request->validate([
            'link' => 'required'
        ]);

        try {
            $link = Link::findOrFail(1);

            $link->update([
                'link' => $request->link
            ]);

            return redirect()->back()->with('success', 'Data link berhasil di update');
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error and redirect to an error page
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred during the update process.');
        }
    }
}
