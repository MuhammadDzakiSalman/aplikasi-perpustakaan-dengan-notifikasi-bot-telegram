@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col col-12">
                <h5 class="fw-semibold m-0">Detail Riwayat</h5>
            </div>
        </div>
        <section>
            <div class="row mt-3">
                <div class="col">
                    <h6 class="fw-semibold">Nama Anggota:&nbsp;<span>{{ $anggota->nama_anggota }}</span></h6>
                </div>
            </div>
            <div class="row py-2">
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Tgl. Peminjaman</th>
                                            <th><strong>Tgl. Pengembalian</strong></th>
                                            <th><strong>Riwayat Chat</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($anggota->peminjaman as $index => $peminjaman)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $peminjaman->buku->nama_buku }}</td>
                                                <td>{{ $peminjaman->tgl_peminjaman }}</td>
                                                <td>{{ $peminjaman->tgl_pengembalian }}</td>
                                                <td style="max-width: 500px;">{{ $peminjaman->riwayat_chat }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
