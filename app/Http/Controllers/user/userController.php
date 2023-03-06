<?php

namespace App\Http\Controllers\user;

use App\Models\masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\File;

class userController extends Controller
{

    public function formRegister()
    {
        // Arahkan ke file user/register.blade.php
        return view('user.auth.register');
    }

    
    public function formPengaduan()
    {
                // Membuat variable $terverifikasi isinya menghitung pengaduan status pending
        $terverifikasi = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        // Membuat variable $terverifikasi isinya menghitung pengaduan status proses
        $proses = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        // Membuat variable $terverifikasi isinya menghitung pengaduan status selesai
        $selesai = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $all = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik]])->count();

        $finish = pengaduan::where('status', 'selesai')->get()->count();



        // Masukkan 3 variable diatas ke dalam variable array $hitung
        $hitung = [$terverifikasi, $proses, $selesai, $all, $finish];

        // Arahkan ke file user/register.blade.php
        return view('user.sendProfile.pengaduan', ['hitung' => $hitung]);
    }



    
 
    public function register(Request $request)
    {
        // Masukkan semua data yg dikirim ke variable $data 
        $data = $request->all();

        // Buat variable $validate kemudian isinya Validator::make(datanya, [nama_field => peraturannya])
        $validate = Validator::make($data, [
            'nik' => ['required', 'unique:masyarakats'],
            'nama' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:masyarakats'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:masyarakats'],
            'password' => ['required', 'min:6'],

        ]);

        // // Pengecekan jika validate fails atau gagal
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        // // Mengecek email
        $email = masyarakat::where('email', $request->username)->first();

        // // Pengecekan jika email sudah terdaftar
        if ($email) {
            return redirect()->back()->with(['pesan' => 'Email susdfsdfsdfdah terdaftar'])->withInput(['email' => 'asd']);
        }

        // // Mengecek username
        $username = masyarakat::where('username', $request->username)->first();

        // // Pengecekan jika username sudah terdaftar
        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username ssdfsdfudah terdaftar'])->withInput(['username' => null]);
        }

        // Memasukkan data kedalam table Masyarakat
        masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'foto' => $data['foto'] ?? '',
            'password' => Hash::make($data['password']),
        ]);

        // Kirim link verifikasi email
        // $link = URL::temporarySignedRoute('pekat.verify', now()->addMinutes(30), ['nik' => $data['nik']]);
        // Mail::to($data['email'])->send(new VerifikasiEmailUntukRegistrasiPengaduanMasyarakat($data['nama'], $link));

        // Arahkan ke route pekat.index
        return redirect('/');
    }

    public function login(Request $request)
    {
        // Pengecekan $request->username isinya email atau username
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            // jika isinya string email, cek email nya di table masyarakat
            $email = Masyarakat::where('email', $request->username)->first();

            // Pengecekan variable $email jika tidak ada di table masyarakat
            if (!$email) {
                return redirect()->back()->with(['pesan' => 'Email tidak terdaftar']);
            }

            // jika email ada, langsung check password yang dikirim di form dan di table, hasilnya sama atau tidak
            $password = Hash::check($request->password, $email->password);

            // Pengecekan variable $password jika password tidak sama dengan yang dikirimkan
            if (!$password) {
                return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
            }

            // Jalankan fungsi auth jika berjasil melewati validasi di atas
            if (Auth::guard('masyarakat')->attempt(['email' => $request->username, 'password' => $request->password])) {
                // Jika login berhasil
                return redirect()->route('profile.pengaduan', 'me');
            } else {
                // Jika login gagal
                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        } else {
            // jika isinya string username, cek username nya di table masyarakat
            $username = Masyarakat::where('username', $request->username)->first();

            // Pengecekan variable $username jika tidak ada di table masyarakat
            if (!$username) {
                return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
            }

            // jika username ada, langsung check password yang dikirim di form dan di table, hasilnya sama atau tidak
            $password = Hash::check($request->password, $username->password);

            // Pengecekan variable $password jika password tidak sama dengan yang dikirimkan
            if (!$password) {
                return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
            }

            // Jalankan fungsi auth jika berjasil melewati validasi di atas
            if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
                // Jika login berhasil
                return redirect()->route('profile.pengaduan', 'me');
            } else {
                // Jika login gagal
                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        }
    }

    public function logout()
    {
        // Fungsi logout dengan guard('masyarakat')
        Auth::guard('masyarakat')->logout();

        // Arahkan ke route pekat.index
        return redirect('/');
    }

    public function kirimPengaduan(Request $request)
    {
        // Pengecekan jika tidak ada masyarakat yang sedang login
        if (!Auth::guard('masyarakat')->user()) {
            return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }

        // Masukkan semua data yg dikirim ke variable $data 
        $data = $request->all();
        // dd($request->file('foto'));

        // Buat variable $validate kemudian isinya Validator::make(datanya, [nama_field => peraturannya])
        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            'kategori_kejadian' => ['required'],
        ]);

        // Pengecekan jika validate fails atau gagal
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        
        // if ($request->file('foto')) {
        //     $data['foto'] = $request->file('foto')->store('image/gambar', 'public');
        // }
        // $image_path = $request->file('foto')->store('image', 'public');
        

        // Pengecekan jika ada file foto yang dikirim
        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        // Set timezone waktu ke Asia/Bangkok
        date_default_timezone_set('Asia/Bangkok');

        // Membuat variable $pengaduan isinya Memasukkan data kedalam table Pengaduan
        $pengaduan = pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'kategori_kejadian' => $data['kategori_kejadian'],
            'foto' => $data['foto'] ?? '',
            'status' => '0',
        ]);

        // Pengecekan variable $pengaduan
        if ($pengaduan) {
            // Jika mengirim pengaduan berhasil
            return redirect()->route('profile.pengaduan.me', 'me')->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            // Jika mengirim pengaduan gagal
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    public function pengaduan($siapa = '')
    {
        // Membuat variable $terverifikasi isinya menghitung pengaduan status pending
        $terverifikasi = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        // Membuat variable $terverifikasi isinya menghitung pengaduan status proses
        $proses = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        // Membuat variable $terverifikasi isinya menghitung pengaduan status selesai
        $selesai = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();
       
        $all = pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik]])->count();
       
        $finish = pengaduan::where('status', 'selesai')->get()->count();



        // Masukkan 3 variable diatas ke dalam variable array $hitung
        $hitung = [$terverifikasi, $proses, $selesai, $all, $finish];

        // Pengecekan jika ada parameter $siapa yang dikirimkan di url
        if ($siapa == 'me') {
            // Jika $siapa isinya 'me'
            $pengaduan = pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            // Arahkan ke file user/laporan.blade.php sebari kirim data pengaduan, hitung, siapa
            return view('user.sendProfile.pesan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else {
            // Jika $siapa kosong
            $pengaduan = pengaduan::where([['nik', '!=', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get();

            // Arahkan ke file user/laporan.blade.php sebari kirim data pengaduan, hitung, siapa
            return view('user.sendProfile.pesan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa, 'all'=> $all]);
        }
    }


}
