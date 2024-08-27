<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Anggota</th>
                <th>Jabatan</th>
                <th>Kelas</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $pinjam)
                <tr>
                    <td>{{ $pinjam->anggota->nama_anggota }}</td>
                    <td>{{ $pinjam->anggota->jabatan }}</td>
                    <td>{{ $pinjam->anggota->kelas }}</td>
                    <td>{{ $pinjam->buku->nama_buku }}</td>
                    <td>{{ $pinjam->tgl_peminjaman }}</td>
                    <td>{{ $pinjam->tgl_pengembalian }}</td>
                    <td>
                        @if ($pinjam->status_peminjaman)
                            Dipinjam
                        @else
                            Dikembalikan
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
