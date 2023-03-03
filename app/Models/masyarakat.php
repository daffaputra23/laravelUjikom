<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class masyarakat extends Authenticatable
{
    
    use HasFactory;

    protected $table = 'masyarakats';

    protected $primaryKey = 'nik';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'email_verified_at',
        'username',
        'password',
        'provider_id',
        'provider',
    ];
}
