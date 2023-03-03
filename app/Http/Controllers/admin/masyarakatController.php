<?php

namespace App\Http\Controllers\admin;

use App\Models\pengaduan;
use App\Models\masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class masyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = masyarakat::all();

        return view('admin.masyarakat.index', ['masyarakat' => $masyarakat]);
    }

    public function detail($nik)
    {
        $masyarakat = masyarakat::where('nik', $nik)->first();

        return view('admin.masyarakat.detail', ['masyarakat' => $masyarakat]);
    }

    public function hapus($nik)
    {
        // $pengaduan = pengaduan::where('nik', $masyarakat->nik)->first();
        $masyarakat = masyarakat::where('nik', $nik)->first();

        // if (!$pengaduan) {
            $masyarakat->delete();

            return redirect('/admin/masyarakat');
        // } else {
            // return redirect()->back()->with(['notif' => 'Can\'t delete. Masyarakat has a relationship!']);
        // }
    }
}
