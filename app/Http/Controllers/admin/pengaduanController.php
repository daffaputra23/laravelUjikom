<?php

namespace App\Http\Controllers\admin;

use App\Models\pengaduan;
use App\Models\tanggapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class pengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.pengaduan.index', ['pengaduan' => $pengaduan]);
    }

    public function detail($id_pengaduan)
    {
        $pengaduan = pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        $tanggapan = tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('admin.pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }
}
