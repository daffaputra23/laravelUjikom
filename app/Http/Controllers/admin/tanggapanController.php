<?php

namespace App\Http\Controllers\admin;

use App\Models\pengaduan;
use App\Models\tanggapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class tanggapanController extends Controller
{
    public function tanggapan(Request $request)
    {
        $pengaduan = pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $tanggapan = tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();

        if ($tanggapan) {
            $pengaduan->update(['status' => $request->status]);

            $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect('/admin/pengaduan/detail/{$pengaduan}', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim!']);
        } else {
            $pengaduan->update(['status' => $request->status]);

            $tanggapan = tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect('/admin/pengaduan/detail/{$pengaduan}', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim!']);
        }
    }

}
