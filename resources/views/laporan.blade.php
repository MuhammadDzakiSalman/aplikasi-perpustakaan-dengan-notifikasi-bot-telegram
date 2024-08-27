@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col d-xl-flex justify-content-xl-start align-items-xl-center col-md-5 col-12 col-lg-7">
                <h5 class="fw-semibold m-0">Laporan Peminjaman</h5>
            </div>
            <div class="col flex-column flex-sm-row d-flex gap-1 align-items-end">
                <div class="input-group">
                    <input id="searchInput" class="form-control" type="text" placeholder="Cari nama anggota...">
                    <button id="searchButton" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
                <a href="{{ route('laporan.pdf') }}" class="btn btn-primary ms-0 ms-md-2 w-100" style="max-width: 140px;"><i
                        class="far fa-file-alt me-1"></i>Unduh PDF</a>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header">
                        <div>
                            <div class="d-flex mb-2 gap-2 justify-content-end align-items-center">
                                <h6 class="m-0">Filter</h6>
                                <select class="form-select-sm form-select" aria-label="filter-bulan" id="filterBulan"
                                    style="max-width: 180px;">
                                    <option value="" selected="">Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">February</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option                                     value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <select class="form-select-sm form-select" aria-label="filter-tahun" id="filterTahun"
                                    name="tahun" style="max-width: 180px;">
                                    <option value="" selected="">Tahun</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary btn-sm py-2" type="button"
                                    id="applyFilters">Terapkan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-start">Nama Anggota</th>
                                        <th class="text-start">Jabatan</th>
                                        <th class="text-start">Kelas</th>
                                        <th class="text-start">Judul Buku</th>
                                        <th class="text-start">Tgl. Peminjaman</th>
                                        <th class="text-start">Tgl. Pengembalian</th>
                                        <th class="text-start">Status Pengembalian</th>
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
                                                    <span class="badge text-bg-danger">Dipinjam</span>
                                                @else
                                                    <span class="badge text-bg-success">Dikembalikan</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $peminjaman->links('vendor.pagination.simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("searchButton").addEventListener("click", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Ganti angka 0 dengan indeks kolom yang ingin Anda cari
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });

        document.getElementById("applyFilters").addEventListener("click", function() {
            var bulan = document.getElementById("filterBulan").value;
            var tahun = document.getElementById("filterTahun").value;
            var url = new URL(window.location.href);
            if (bulan) {
                url.searchParams.set('bulan', bulan);
            } else {
                url.searchParams.delete('bulan');
            }
            if (tahun) {
                url.searchParams.set('tahun', tahun);
            } else {
                url.searchParams.delete('tahun');
            }
            window.location.href = url.toString();
        });
    </script>
@endsection
