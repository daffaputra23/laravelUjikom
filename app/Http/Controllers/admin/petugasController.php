<?php

namespace App\Http\Controllers\admin;

use App\Models\petugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class petugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();

        return view('admin.petugas.index', ['petugas' => $petugas]);
    }

    public function create(Request $request)
    {

        
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:petugas'],
            'password' => ['required', 'string', 'min:6'],
            'telp' => ['required'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $username = petugas::where('username', $data['username'])->first();

        if ($username) {
            return redirect()->back()->with(['notif' => 'Username sudah digunakan!']);
        }

        petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect('/admin/petugas');
    }

    public function detail($id_petugas)
    {
        $petugas = petugas::where('id_petugas', $id_petugas)->first();

        return view('admin.petugas.edit', ['petugas' => $petugas]);
    }

    public function update(Request $request, $id_petugas)
    {
        $data = $request->all();

        $petugas = petugas::find($id_petugas);

        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect('/admin/petugas');
    }

}
