<?php

namespace App\Http\Controllers\admin;

use App\Models\pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;


class laporanController extends Controller
{
    public function cariLaporan(Request $request)
    {
        $from = $request->from . ' ' . '00:00:00';
        $to = $request->to . ' ' . '23:59:59';

        $pengaduan = pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        return view('admin.laporan.index', ['pengaduan' => $pengaduan, 'from' => $from, 'to' => $to]);
    }

     public function print($from, $to)
    {
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        $pdf = PDF::loadView('admin.laporan.cetak', ['pengaduan' => $pengaduan]);
        return $pdf->download('laporan-pengaduan.pdf');
    }
}
