<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\petugas;
use App\Models\masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class adminController extends Controller
{
    public function login(Request $request)
    {
        $username = petugas::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar!']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai!']);
        }

        $auth = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]);

        if ($auth) {
            return redirect('/admin/dashboard');
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/adminLogin');
    }

    public function search(Request $request)
    {
        $masyarakat = masyarakat::where([
            ['nama', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->orWhere('nama', 'LIKE', '%' . $s . '%')
                        ->orWhere('email', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(6);

        return view('admin.masyarakat.index', compact('masyarakat'));
    }


}
