<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    // public function showLaporan()
    // {
    //     $peminjaman = Peminjaman::with(['buku', 'anggota'])->paginate(10);

    //     return view('laporan', compact('peminjaman'));
    // }
    public function showLaporan(Request $request)
{
    $query = Peminjaman::with(['buku', 'anggota']);

    // Filter by month and year if provided
    if ($request->filled('bulan')) {
        $query->whereMonth('tgl_peminjaman', $request->bulan);
    }
    if ($request->filled('tahun')) {
        $query->whereYear('tgl_peminjaman', $request->tahun);
    }

    $peminjaman = $query->paginate(10);

    // Get distinct years from tgl_peminjaman
    $years = Peminjaman::select(DB::raw('YEAR(tgl_peminjaman) as year'))
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');

    return view('laporan', compact('peminjaman', 'years'));
}

    public function downloadPDF()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])->get();

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('laporan-pdf', compact('peminjaman')));

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline or attachment)
        return $dompdf->stream("laporan_peminjaman.pdf");
    }
}
