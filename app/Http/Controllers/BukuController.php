<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Peminjaman;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->has('search')) {
            $query->where('nama_buku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('kode_buku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('penulis_buku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('tahun_terbit', 'LIKE', '%' . $request->search . '%');
        }

        $buku = $query->paginate(10);
        return view('data-buku', compact('buku'));
    }

    public function pencarian(Request $request)
    {
        $query = Buku::query();

        if ($request->has('search')) {
            $query->where('nama_buku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('kode_buku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('penulis_buku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('tahun_terbit', 'LIKE', '%' . $request->search . '%');
        }

        $buku = $query->get();
        return view('pencarian', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku',
            'nama_buku' => 'required',
            'penulis_buku' => 'required',
            // 'jumlah_buku' => 'required',
            'tahun_terbit' => 'required'
        ]);

        $buku = new Buku([
            'kode_buku' => $request->input('kode_buku'),
            'nama_buku' => $request->input('nama_buku'),
            'penulis_buku' => $request->input('penulis_buku'),
            // 'jumlah_buku' => $request->input('jumlah_buku'),
            'tahun_terbit' => $request->input('tahun_terbit')
        ]);

        $buku->save();

        return redirect()->back()->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $buku = Buku::where('kode_buku', 'LIKE', "%{$query}%")
            ->where('status_buku', false)
            ->get();

        $data = [];
        foreach ($buku as $item) {
            $data[] = $item->kode_buku;
        }

        return response()->json($data);
    }
    public function getBukuDetails(Request $request)
    {
        $kode_buku = $request->get('kode_buku');
        $peminjaman = Peminjaman::with('buku', 'anggota')
            ->whereHas('buku', function ($query) use ($kode_buku) {
                $query->where('kode_buku', $kode_buku);
            })
            ->where('status_peminjaman', true) // Add this line
            ->first();

        if ($peminjaman) {
            return response()->json([
                'judul_buku' => $peminjaman->buku->nama_buku,
                'nama_anggota' => $peminjaman->anggota->nama_anggota,
                'tgl_peminjaman' => $peminjaman->tgl_peminjaman,
                'tgl_pengembalian' => $peminjaman->tgl_pengembalian,
            ]);
        } else {
            return response()->json([
                'judul_buku' => '-',
                'nama_anggota' => '-',
                'tgl_peminjaman' => '-',
                'tgl_pengembalian' => '-',
            ]);
        }
    }
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus.');
    }

    public function update(Request $request, $id_buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $id_buku . ',id_buku',
            'nama_buku' => 'required',
            'penulis_buku' => 'required',
            'tahun_terbit' => 'required'
        ]);

        $buku = Buku::findOrFail($id_buku);
        $buku->update([
            'kode_buku' => $request->input('kode_buku'),
            'nama_buku' => $request->input('nama_buku'),
            'penulis_buku' => $request->input('penulis_buku'),
            'tahun_terbit' => $request->input('tahun_terbit')
        ]);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diupdate.');
    }
}
