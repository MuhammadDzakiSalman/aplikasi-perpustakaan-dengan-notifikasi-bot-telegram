<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_buku' => 'required',
        ]);

        // Temukan peminjaman berdasarkan kode buku
        $peminjaman = Peminjaman::whereHas('buku', function ($query) use ($request) {
            $query->where('kode_buku', $request->kode_buku);
        })->first();

        // Jika peminjaman ditemukan, lakukan proses pengembalian
        if ($peminjaman) {
            // Buat data pengembalian
            Pengembalian::create([
                'id_peminjaman' => $peminjaman->id_peminjaman,
                // tambahkan field lain yang diperlukan untuk proses pengembalian
            ]);

            // Update status peminjaman menjadi false
            $peminjaman->update(['status_peminjaman' => false]);
            $peminjaman->save();

            // Update status buku menjadi true
            $peminjaman->buku->update(['status_buku' => true]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Peminjaman buku tidak ditemukan.');
        }
    }
}
