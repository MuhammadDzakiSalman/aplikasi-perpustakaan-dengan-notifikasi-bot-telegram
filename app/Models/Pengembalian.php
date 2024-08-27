<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $primaryKey = 'id_pengembalian';

    // public $timestamps = false;

    protected $fillable = [
        'id_peminjaman',
        'status_peminjaman'
        // tambahkan field lain yang diperlukan untuk proses pengembalian
    ];


    // Relasi dengan model Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
