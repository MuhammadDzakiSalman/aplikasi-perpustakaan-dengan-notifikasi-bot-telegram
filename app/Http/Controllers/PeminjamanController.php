<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use GuzzleHttp\Client;

use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function index()
    {
        $anggota = Anggota::withCount('peminjaman')->paginate(10);
        return view('riwayat', compact('anggota'));
    }

    public function create()
    {
        return view('pengembalian');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'kode_buku' => 'required|exists:buku,kode_buku',
    //         'nama_anggota' => 'required|exists:anggota,nama_anggota',
    //         'tgl_peminjaman' => 'required|date',
    //         'tgl_pengembalian' => 'required|date'
    //     ]);

    //     $id_buku = Buku::where('kode_buku', $request->kode_buku)->value('id_buku');
    //     $status_buku = Buku::where('id_buku', $id_buku)->value('status_buku');
    //     if (!$status_buku) {
    //         return redirect()->back()->with('error', 'Buku sedang dipinjam.');
    //     }

    //     $id_anggota = Anggota::where('nama_anggota', $request->nama_anggota)->value('id_anggota');

    //     $peminjaman = Peminjaman::create([
    //         'id_buku' => $id_buku,
    //         'id_anggota' => $id_anggota,
    //         'tgl_peminjaman' => $request->tgl_peminjaman,
    //         'tgl_pengembalian' => $request->tgl_pengembalian,
    //         'status_peminjaman' => true
    //     ]);

    //     Buku::where('id_buku', $id_buku)->update(['status_buku' => false]);

    //     return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke daftar pinjam.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|exists:buku,kode_buku',
            'nama_anggota' => 'required|exists:anggota,nama_anggota',
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date'
        ]);

        $id_buku = Buku::where('kode_buku', $request->kode_buku)->value('id_buku');
        $status_buku = Buku::where('id_buku', $id_buku)->value('status_buku');
        if (!$status_buku) {
            return redirect()->back()->with('error', 'Buku sedang dipinjam.');
        }

        $id_anggota = Anggota::where('nama_anggota', $request->nama_anggota)->value('id_anggota');

        // Create the message
        $anggota = Anggota::find($id_anggota);
        $message = "Halo, {$anggota->nama_anggota}

Buku dengan kode {$request->kode_buku} telah berhasil Anda pinjam.
Tanggal peminjaman: {$request->tgl_peminjaman}.
Tanggal pengembalian: {$request->tgl_pengembalian}.";

        // Create the peminjaman record with the message
        $peminjaman = Peminjaman::create([
            'id_buku' => $id_buku,
            'id_anggota' => $id_anggota,
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status_peminjaman' => true,
            'riwayat_chat' => $message
        ]);

        Buku::where('id_buku', $id_buku)->update(['status_buku' => false]);

        // Send the Telegram message
        $this->sendTelegramMessage($anggota->chat_id, $message);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke daftar pinjam.');
    }

    private function sendTelegramMessage($chatId, $message)
    {
        $token = '6750677729:AAFiORHOZjaa84q6m1uJu6PdSrh42wQuUZA'; // Ganti dengan token bot Anda
        $client = new Client();
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = $client->post($url, [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message
            ]
        ]);
    }

    public function storePengembalian(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|exists:buku,kode_buku',
        ]);

        $buku = Buku::where('kode_buku', $request->kode_buku)->first();
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        $peminjaman = Peminjaman::where('id_buku', $buku->id_buku)
            ->where('status_peminjaman', true)
            ->first();

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Buku ini tidak sedang dipinjam.');
        }

        // Mengubah status peminjaman menjadi selesai (false)
        $peminjaman->update(['status_peminjaman' => false]);

        // Mengubah status buku menjadi tersedia (true)
        $buku->update(['status_buku' => true]);

        // Menyimpan data pengembalian ke tabel pengembalian
        $pengembalian = new Pengembalian();
        $pengembalian->id_peminjaman = $peminjaman->id_peminjaman;
        $pengembalian->save();

        return redirect()->route('pengembalian.create')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function getBooks(Request $request)
    {
        $query = $request->input('query');
        $books = Buku::where('kode_buku', 'like', '%' . $query . '%')->get();
        return response()->json($books);
    }

    public function getMembers(Request $request)
    {
        $query = $request->input('query');
        $members = Anggota::where('nama_anggota', 'like', '%' . $query . '%')->get();
        return response()->json($members);
    }

    public function show($id)
    {
        $anggota = Anggota::with('peminjaman.buku')->findOrFail($id);
        return view('detail-riwayat', compact('anggota'));
    }
}
