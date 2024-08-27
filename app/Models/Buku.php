<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'kode_buku',
        'nama_buku',
        'penulis_buku',
        // 'jumlah_buku',
        'tahun_terbit',
        'status_buku'
    ];

    public $timestamps = false;
}
