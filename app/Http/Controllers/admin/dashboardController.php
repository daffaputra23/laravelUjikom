<?php

namespace App\Http\Controllers\admin;

use App\Models\petugas;
use App\Models\pengaduan;
use App\Models\masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class dashboardController extends Controller
{
    public function index()
    {
        $semuaMasyarakat = masyarakat::all();
        $semuaPetugas = petugas::all();

        $petugas = petugas::all()->count();

        $masyarakat = masyarakat::all()->count();

        $pending = pengaduan::where('status', '0')->get()->count();


        $proses = pengaduan::where('status', 'proses')->get()->count();

        $selesai = pengaduan::where('status', 'selesai')->get()->count();

        return view('admin.dashboard.index', ['petugas' => $petugas, 'masyarakat' => $masyarakat, 
        'semuaMasyarakat' => $semuaMasyarakat, 'semuaPetugas' => $semuaPetugas, 'proses' => $proses, 
        'selesai' => $selesai, 'pending' => $pending]);

    }
}
// 'proses' => $proses, 'selesai' => $selesai