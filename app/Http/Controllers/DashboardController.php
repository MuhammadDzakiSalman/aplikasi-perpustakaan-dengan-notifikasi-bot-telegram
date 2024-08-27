<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])->paginate(10);
        $jumlah_buku = Buku::count();
        $sedang_dipinjam = Buku::where('status_buku', false)->count();
        $jumlah_anggota = Anggota::count();

        // Data untuk chart
        $today = Carbon::today();
        $peminjaman_hari_ini = Peminjaman::whereDate('created_at', $today)->count();
        $pengembalian_hari_ini = Pengembalian::whereDate('created_at', $today)->count();

        return view('/dashboard', compact('peminjaman', 'jumlah_buku', 'sedang_dipinjam', 'jumlah_anggota', 'peminjaman_hari_ini', 'pengembalian_hari_ini'));
    }
}
