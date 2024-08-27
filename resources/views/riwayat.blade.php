@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col-12 col-lg-6">
                <h5 class="fw-semibold m-0">Riwayat</h5>
            </div>
            <div class="col flex-column flex-sm-row d-flex gap-1 align-items-end">
                <div class="input-group">
                    <input id="searchInput" class="form-control" type="text" placeholder="Cari nama anggota...">
                    <button id="searchButton" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Jabatan</th>
                                        <th>Total Peminjaman</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $perPage = $anggota->perPage(); // Jumlah item per halaman
                                        $currentPage = $anggota->currentPage(); // Halaman saat ini
                                        $counter = ($currentPage - 1) * $perPage + 1; // Menghitung nomor awal item di halaman saat ini
                                    @endphp
                                    @foreach ($anggota as $member)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $member->nama_anggota }}</td>
                                            <td>{{ $member->jabatan }}</td>
                                            <td>{{ $member->peminjaman_count }}</td>
                                            <td class="d-flex gap-1 border-0">
                                                <a class="btn btn-primary btn-sm" role="button"
                                                    href="{{ route('detail-riwayat', $member->id_anggota) }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $anggota->links('vendor.pagination.simple-bootstrap-5') }}
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
    </script>
@endsection
