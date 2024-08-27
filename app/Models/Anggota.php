<?php

// Anggota.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'nama_anggota',
        'jabatan',
        'kelas',
        'nisn_nip',
        'jenis_kelamin',
        'alamat',
        'chat_id',
    ];

    public $timestamps = false;

    // Relasi dengan model Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota', 'id_anggota');
    }
}

