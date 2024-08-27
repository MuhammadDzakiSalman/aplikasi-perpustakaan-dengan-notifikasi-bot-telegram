<?php

// Peminjaman.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_buku',
        'id_anggota',
        'tgl_peminjaman',
        'tgl_pengembalian',
        'status_peminjaman',
        'riwayat_chat'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

     public function pengembalian()
     {
         return $this->hasMany(Pengembalian::class, 'id_peminjaman', 'id_peminjaman');
     }
}
