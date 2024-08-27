@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col d-xl-flex justify-content-xl-start align-items-xl-center col-12">
                <h5 class="fw-semibold m-0">Pengembalian Buku</h5>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-body px-2 px-lg-5">
                        @if (session('success'))
                            <div class="alert alert-success" id="successAlert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('pengembalian.store') }}" method="POST">
                            @csrf
                            <div class="row mb-1 mb-md-2">
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3 col-xxl-2 col-2">
                                    <label class="col-form-label">Kode Buku</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="kode_buku" name="kode_buku"
                                        autocomplete="off" required>
                                </div>
                            </div>
                            <div class="row mb-2 mb-1 mb-md-2">
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3 col-xxl-2 col-2">
                                    <label class="col-form-label">Judul Buku</label>
                                </div>
                                <div class="col">
                                    <span id="judul_buku">-</span>
                                </div>
                            </div>
                            <div class="row mb-2 mb-1 mb-md-2">
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3 col-xxl-2 col-2">
                                    <label class="col-form-label">Nama Peminjam</label>
                                </div>
                                <div class="col">
                                    <span id="nama_anggota">-</span>
                                </div>
                            </div>
                            <div class="row gy-2 mb-2 mb-1 mb-md-2">
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3 col-xxl-2 col-2">
                                    <label class="col-form-label">Tgl. Peminjaman</label>
                                </div>
                                <div class="col-sm-9 col-md-8 col-lg-3 col-xl-3 col-xxl-4">
                                    <span id="tgl_peminjaman">-</span>
                                </div>
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-2">
                                    <label class="col-form-label">Tgl. Pengembalian</label>
                                </div>
                                <div class="col-sm-9 col-md-8 col-lg-3 col-xl-4 col-xxl-4">
                                    <span id="tgl_pengembalian">-</span>
                                </div>
                            </div>
                            <div class="float-end mt-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var path = "{{ route('autocomplete.kodes') }}"; // Route to get the autocomplete data
            $('#kode_buku').typeahead({
                source: function(query, process) {
                    return $.get(path, {
                        query: query
                    }, function(data) {
                        return process(data);
                    });
                },
                afterSelect: function(item) {
                    // Fetch details after selecting a kode_buku
                    $.ajax({
                        url: "{{ route('get.buku.details') }}", // Route to get book details
                        method: 'GET',
                        data: {
                            kode_buku: item
                        },
                        success: function(data) {
                            $('#judul_buku').text(data.judul_buku);
                            $('#nama_anggota').text(data.nama_anggota);
                            $('#tgl_peminjaman').text(data.tgl_peminjaman);
                            $('#tgl_pengembalian').text(data.tgl_pengembalian);
                        },
                        error: function() {
                            // Handle errors
                            $('#judul_buku').text('-');
                            $('#nama_anggota').text('-');
                            $('#tgl_peminjaman').text('-');
                            $('#tgl_pengembalian').text('-');
                        }
                    });
                }
            });
        });
        setTimeout(function() {
            document.getElementById('successAlert').remove();
        }, 3000);
    </script>
@endsection
