<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        if ($request->has('search')) {
            $query->where('nama_anggota', 'LIKE', '%' . $request->search . '%')
                ->orWhere('alamat', 'LIKE', '%' . $request->search . '%')
                ->orWhere('chat_id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('jabatan', 'LIKE', '%' . $request->search . '%');
        }

        // Menggunakan paginasi dengan 10 item per halaman
        $anggota = $query->paginate(10);
        return view('data-anggota', compact('anggota'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'jabatan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:255',
            'kelas' => 'nullable|string',
            'chat_id' => 'nullable|string',
            'nisn_nip' => 'required|string|unique:anggota,nisn_nip' // Ensure nisn_nip is unique in the 'anggota' table
        ], [
            'nisn_nip.unique' => 'NISN/NIP Telah terdaftar.',
        ]);

        if ($request->jabatan === 'guru') {
            $validatedData['kelas'] = null;
        }

        try {
            $anggota = new Anggota($validatedData);
            $anggota->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['nisn_nip']);
        }

        return redirect()->route('anggota.store')->with('success', 'Data anggota berhasil disimpan.');
    }
    public function publicStore(Request $request)
{
    $validatedData = $request->validate([
        'nama_anggota' => 'required|string|max:255',
        'jabatan' => 'required|string',
        'jenis_kelamin' => 'required|string',
        'alamat' => 'required|string|max:255',
        'kelas' => 'nullable|string',
        'chat_id' => 'nullable|string',
        'nisn_nip' => 'required|string|unique:anggota,nisn_nip' // Ensure nisn_nip is unique in the 'anggota' table
    ], [
        'nisn_nip.unique' => 'NISN/NIP Telah terdaftar.',
    ]);

    if ($request->jabatan === 'guru') {
        $validatedData['kelas'] = null;
    }

    try {
        $anggota = new Anggota($validatedData);
        $anggota->save();
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withInput()->withErrors(['nisn_nip']);
    }

    return redirect()->route('pencarian')->with('success', 'Data anggota berhasil disimpan.');
}



    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'chat_id' => 'required|string|max:255',
            'jabatan' => 'required|string',
            'nisn_nip' => 'nullable|integer',
            'kelas' => 'nullable|integer',
            'jenis_kelamin' => 'required|string|in:pria,wanita',
        ]);

        // Temukan anggota berdasarkan ID
        $anggota = Anggota::findOrFail($id);

        // Update data anggota
        $anggota->nama_anggota = $request->input('nama_anggota');
        $anggota->alamat = $request->input('alamat');
        $anggota->chat_id = $request->input('chat_id');
        $anggota->jabatan = $request->input('jabatan');
        $anggota->nisn_nip = $request->input('nisn_nip');
        $anggota->kelas = $request->input('jabatan') === 'siswa' ? $request->input('kelas') : null; // Set kelas hanya jika jabatan adalah siswa
        $anggota->jenis_kelamin = $request->input('jenis_kelamin');
        // Simpan perubahan
        $anggota->save();

        // Redirect ke halaman data anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }
}
