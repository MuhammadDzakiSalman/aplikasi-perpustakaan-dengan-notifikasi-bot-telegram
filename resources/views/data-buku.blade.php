@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col d-xl-flex justify-content-xl-start align-items-xl-center col-md-5 col-12 col-lg-7">
                <h5 class="fw-semibold m-0">Data Buku</h5>
            </div>
            <div class="col flex-column flex-sm-row d-flex gap-1 align-items-end">
                <form action="{{ route('buku.index') }}" method="GET" class="d-flex w-100">
                    <input class="form-control" type="text" name="search" value="{{ request('search') }}"
                        style="border-radius: 0.375rem 0rem 0rem 0.375rem;">
                    <button class="btn btn-primary" style="border-radius: 0rem 0.375rem 0.375rem 0rem;" type="submit"><i
                            class="fas fa-search"></i></button>
                </form>
                <button class="btn btn-primary ms-0 ms-md-2 w-100" type="button" data-bs-target="#modal-tambah-data-buku"
                    data-bs-toggle="modal" style="max-width: 140px;"><i class="fas fa-plus-circle me-1"></i>Tambah
                    Data</button>
                {{-- Modal tambah data buku --}}
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf
                    <div class="modal fade" role="dialog" tabindex="-1" id="modal-tambah-data-buku">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Buku</h4><button class="btn-close" type="button"
                                        aria-label="Close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <div class="mb-1"><label class="form-label mb-1" for="kode_buku">Kode
                                                        Buku</label>
                                                    <div id="kode_buku"><input type="text" name="kode_buku"
                                                            class="form-control" required></div>
                                                </div>
                                            </div>
                                            <div class="mb-1 col-6"><label class="form-label mb-1" for="tahun_terbit">Tahun
                                                    Terbit</label>
                                                <div id="tahun_buku"><input type="text" name="tahun_terbit"
                                                        class="form-control" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1"><label class="form-label mb-1" for="nama_buku">Nama Buku</label>
                                        <div id="nama_buku"><input type="text" name="nama_buku" class="form-control"
                                                required></div>
                                    </div>
                                    <div class="mb-1"><label class="form-label mb-1" for="penulis_buku">Penulis
                                            Buku</label>
                                        <div id="penulis_buku"><input type="text" name="penulis_buku"
                                                class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button"
                                        data-bs-dismiss="modal">Batal</button><button class="btn btn-primary"
                                        type="submit">Simpan</button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- End modaltambah data buku --}}
        </div>
        {{-- Modal edit data buku --}}
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" role="dialog" tabindex="-1" id="modal-edit-data-buku">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data Buku</h4>
                            <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="row">
                                    <div class="col col-6">
                                        <div class="mb-1">
                                            <label class="form-label mb-1" for="edit_kode_buku">Kode Buku</label>
                                            <input id="edit_kode_buku" type="text" name="kode_buku" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-6">
                                        <label class="form-label mb-1" for="edit_tahun_terbit">Tahun Terbit</label>
                                        <input id="edit_tahun_terbit" type="text" name="tahun_terbit"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label mb-1" for="edit_nama_buku">Nama Buku</label>
                                <input id="edit_nama_buku" type="text" name="nama_buku" class="form-control"
                                    required>
                            </div>
                            <div class="mb-1">
                                <label class="form-label mb-1" for="edit_penulis_buku">Penulis Buku</label>
                                <input id="edit_penulis_buku" type="text" name="penulis_buku" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- End modal edit data data --}}
        <div class="row py-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" id="successAlert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive table mt-2" id="" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Penulis</th>
                                        <th>kode Buku</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $perPage = $buku->perPage(); // Jumlah item per halaman
                                        $currentPage = $buku->currentPage(); // Halaman saat ini
                                        $counter = ($currentPage - 1) * $perPage + 1; // Menghitung nomor awal item di halaman saat ini
                                    @endphp
                                    @foreach ($buku as $detail_buku)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $detail_buku->nama_buku }}</td>
                                            <td>{{ $detail_buku->penulis_buku }}</td>
                                            {{-- <td>{{ $detail_buku->jumlah_buku }}</td> --}}
                                            <td>{{ $detail_buku->kode_buku }}</td>
                                            <td>{{ $detail_buku->tahun_terbit }}</td>
                                            <td>
                                                @if ($detail_buku->status_buku)
                                                    <span class="badge text-bg-success">Tesedia</span>
                                                @else
                                                    <span class="badge text-bg-danger">Dipinjam</span>
                                                @endif
                                            </td>
                                            <td class="d-flex gap-1 border-0">
                                                <button class="btn btn-primary btn-sm btn-edit" type="button"
                                                    data-buku="{{ json_encode($detail_buku) }}"
                                                    data-bs-target="#modal-edit-data-buku" data-bs-toggle="modal">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <form
                                                    action="{{ route('buku.destroy', ['id' => $detail_buku->id_buku]) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            {{ $buku->links('vendor.pagination.simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('successAlert').remove();
        }, 3000);

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.btn-edit');
            var editForm = document.getElementById('editForm');
            var kodeBukuInput = document.getElementById('edit_kode_buku');
            var namaBukuInput = document.getElementById('edit_nama_buku');
            var penulisBukuInput = document.getElementById('edit_penulis_buku');
            var tahunTerbitInput = document.getElementById('edit_tahun_terbit');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var buku = this.dataset.buku;
                    buku = JSON.parse(buku);

                    editForm.action = `/data-buku/${buku.id_buku}/update`;
                    kodeBukuInput.value = buku.kode_buku;
                    namaBukuInput.value = buku.nama_buku;
                    penulisBukuInput.value = buku.penulis_buku;
                    tahunTerbitInput.value = buku.tahun_terbit;

                    var editModal = new bootstrap.Modal(document.getElementById(
                        'modal-edit-data-buku'));
                    editModal.show();
                });
            });
        });
    </script>
@endsection()
