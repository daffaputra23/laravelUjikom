<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\admin\petugasController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\pengaduanController;
use App\Http\Controllers\admin\masyarakatController;
use App\Http\Controllers\admin\tanggapanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user.index');
// });

// ini route user untuk authentication
Route::get('/', function () {
    return view('user.auth.login');
});

Route::get('/register', function () {
    return view('user.auth.register');
});
// ini route user untuk authetication


// route untuk send and profile
// Route::get('/profile', function () {
//     return view('user.sendProfile.pesan');
// });

Route::get('/profile/pengaduan', function () {
    return view('user.sendProfile.pengaduan');
});
// route untuk send and profile


Route::get('/adminLogin', function () {
    return view('admin.login.index');
});



// Route::get('/admin/pengaduan', function () {
//     return view('admin.pengaduan.index');
// });

// Route::get('/admin/pengaduan/show', function () {
//     return view('admin.pengaduan.show');
// });



Route::get('/admin/petugas/tambah', function () {
    return view('admin.petugas.tambah');
});



Route::get('/admin/masyarakat/detail', function () {
    return view('admin.masyarakat.detail');
});

Route::get('/admin/laporan', function () {
    return view('admin.laporan.index');
});



// routes auth guest
Route::post('/register/auth', [userController::class, 'register'])->name('auth.register');
Route::post('/login/auth', [userController::class, 'login'])->name('auth.login');
Route::get('/logout', [userController::class, 'logout'])->name('auth.logout');
// routes auth guest

// routes untuk admin petugas
Route::post('/admin/petugas/create', [petugasController::class, 'create'])->name('admin.create');
Route::get('/admin/petugas', [petugasController::class, 'index'])->name('admin.petugas');
Route::get('/admin/petugas/detail/{id_petugas}', [petugasController::class, 'detail'])->name('admin.petugas.detail');
Route::put('/admin/petugas/update/{id_petugas}', [petugasController::class, 'update'])->name('admin.petugas.update');
// routes untuk admin petugas

// routes untuk admin dashboard
Route::get('/admin/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/masyarakat', [masyarakatController::class, 'index'])->name('admin.masyarakat');
Route::get('/admin/masyarakat/detail/{nik}', [masyarakatController::class, 'detail'])->name('admin.masyarakat.detail');
Route::delete('/admin/masyarakat/hapus/{nik}', [masyarakatController::class, 'hapus'])->name('admin.masyarakat.hapus');
// route untuk admin dashboard


// admin login auth
Route::post('/adminLogin/auth', [adminController::class, 'login'])->name('admin.auth.login');
Route::get('/admin/logout', [adminController::class, 'logout'])->name('admin.auth.logout');
Route::get('/search', [adminController::class, 'search'])->name('search');

// admin login auth

// routes untuk kirim pengaduan 
Route::post('/profile/kirimPengaduan', [userController::class, 'kirimPengaduan'])->name('profile.kirimPengaduan');
Route::get('/profile/{siapa?}', [userController::class, 'pengaduan'])->name('profile.pengaduan');
// routes untuk kirim pengaduan


Route::get('/admin/pengaduan', [pengaduanController::class, 'index'])->name('admin.pengaduan');
Route::get('/admin/pengaduan/detail/{id_pengaduan}', [pengaduanController::class, 'detail'])->name('admin.pengaduan.detail');
Route::get('/admin/pengaduan/detail', [tanggapanController::class, 'detail'])->name('admin.pengaduan.detail.balas');

Route::post('/admin/pengaduan/tanggapan', [tanggapanController::class, 'tanggapan'])->name('admin.pengaduan.tanggapan');


