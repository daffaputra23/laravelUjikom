<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaduan extends Model
{
    use HasFactory;
    
    protected $table = 'pengaduans';

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'judul_laporan',
        'isi_laporan',
        'tgl_kejadian',
        'lokasi_kejadian',
        'kategori_kejadian',
        'foto',
        'status',
    ];

    protected $dates = [
        'tgl_pengaduan',
        'tgl_kejadian',
    ];

    public function user()
    {
        return $this->hasOne(masyarakat::class, 'nik', 'nik');
    }

    public function tanggapan()
    {
        return $this->hasOne(tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    
}
