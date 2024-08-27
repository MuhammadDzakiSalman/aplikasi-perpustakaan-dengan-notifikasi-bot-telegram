@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col d-xl-flex justify-content-xl-start align-items-xl-center col-12">
                <h5 class="fw-semibold m-0">Peminjaman Buku</h5>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="card mb-2">
                        <div class="card-body px-2 px-lg-5">
                            @if (session('success'))
                                <div class="alert alert-success" id="successAlert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" id="successAlert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            {{-- @if (session('error'))
                                <div class="alert alert-danger" id="errorAlert">
                                    {{ session('error') }}
                                </div>
                            @endif --}}
                            <div class="row mb-1 mb-md-2">
                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-2"><label class="col-form-label">Kode
                                        Buku</label></div>
                                <div class="col">
                                    <input class="form-control" type="text" name="kode_buku" id="kode_buku_input">
                                    <div id="kode_buku_dropdown" class="dropdown-menu w-50 border-0 shadow"
                                        style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 mb-md-2">
                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-2"><label class="col-form-label">Judul
                                        Buku</label></div>
                                <div class="col d-flex align-items-center"><span id="nama_buku">-</span></div>
                            </div>
                            <div class="row mb-1 mb-md-2">
                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-2"><label class="col-form-label">Nama
                                        Anggota</label></div>
                                <div class="col">
                                    <input class="form-control" type="text" name="nama_anggota" id="nama_anggota_input">
                                    <div id="nama_anggota_dropdown" class="dropdown-menu w-50 border-0 shadow"
                                        style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 mb-md-2">
                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-2"><label
                                        class="col-form-label">Alamat</label></div>
                                <div class="col d-flex align-items-center"><span id="alamat">-</span></div>
                            </div>
                            <div class="row mb-1 mb-md-2">
                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-2"><label class="col-form-label">No.
                                        Telegram</label></div>
                                <div class="col d-flex align-items-center"><span id="chat_id">-</span></div>
                            </div>
                            <div class="row gy-2 mb-1 mb-md-2">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-2"><label
                                        class="col-form-label">Tgl. Peminjaman</label></div>
                                <div class="col-md-8 col-lg-3 col-xl-3"><input class="form-control" name="tgl_peminjaman"
                                        type="date"></div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 col-2"><label
                                        class="col-form-label">Tgl. Pengembalian</label></div>
                                <div class="col-md-8 col-lg-3 col-xl-4"><input class="form-control" name="tgl_pengembalian"
                                        type="date"></div>
                            </div>
                            <div class="float-end"><button class="btn btn-primary mt-2" type="submit">Simpan</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#kode_buku_input').on('input', function() {
                var inputVal = $(this).val();
                // Kirim permintaan ke server untuk mencari opsi buku yang cocok
                $.ajax({
                    url: '{{ route('get.books') }}', // Ganti dengan URL endpoint Anda
                    type: 'GET',
                    data: {
                        query: inputVal
                    },
                    success: function(response) {
                        var dropdown = $('#kode_buku_dropdown');
                        if (inputVal.length === 0) {
                            dropdown.hide(); // Sembunyikan dropdown jika input kosong
                            return; // Keluar dari fungsi jika tidak ada input
                        }
                        dropdown.empty(); // Bersihkan konten dropdown terlebih dahulu
                        if (response.length > 0) { // Periksa jika response memiliki elemen
                            $.each(response, function(key, value) {
                                dropdown.append(
                                    '<a class="dropdown-item" href="#" data-id="' +
                                    value.id + '" data-name="' + value.nama_buku +
                                    '">' +
                                    value.kode_buku + '</a>'
                                );
                            });
                            dropdown.show(); // Tampilkan dropdown hanya jika ada data
                        } else {
                            dropdown.hide(); // Sembunyikan dropdown jika tidak ada data
                        }
                    }
                });
            });

            // Handle pemilihan opsi buku
            $(document).on('click', '#kode_buku_dropdown .dropdown-item', function() {
                var bookId = $(this).data('id');
                var bookCode = $(this).text(); // Ambil kode buku dari teks item dropdown
                var bookName = $(this).data('name'); // Ambil nama buku dari data-name
                $('#kode_buku_input').val(bookCode); // Isi input dengan kode buku yang dipilih
                $('#nama_buku').text(bookName); // Tampilkan nama buku di <span id="nama_buku"></span>
                $('#kode_buku_dropdown').hide(); // Sembunyikan dropdown
                // Jika perlu, Anda bisa menyimpan ID buku yang dipilih untuk digunakan dalam menyimpan data peminjaman
                $('#selected_book_id').val(bookId);
            });
        });
        // Buku
        $(document).ready(function() {
            $('#kode_buku_input').on('input', function() {
                var inputVal = $(this).val();
                // Kirim permintaan ke server untuk mencari opsi buku yang cocok
                $.ajax({
                    url: '{{ route('get.books') }}', // Ganti dengan URL endpoint Anda
                    type: 'GET',
                    data: {
                        query: inputVal
                    },
                    success: function(response) {
                        var dropdown = $('#kode_buku_dropdown');
                        if (inputVal.length === 0) {
                            dropdown.hide(); // Sembunyikan dropdown jika input kosong
                            return; // Keluar dari fungsi jika tidak ada input
                        }
                        dropdown.empty(); // Bersihkan konten dropdown terlebih dahulu
                        if (response.length > 0) { // Periksa jika response memiliki elemen
                            $.each(response, function(key, value) {
                                dropdown.append(
                                    '<a class="dropdown-item" href="#" data-id="' +
                                    value.id + '" data-name="' + value.nama_buku +
                                    '">' +
                                    value.kode_buku + '</a>'
                                );
                            });
                            dropdown.show(); // Tampilkan dropdown hanya jika ada data
                        } else {
                            dropdown.hide(); // Sembunyikan dropdown jika tidak ada data
                        }
                    }
                });
            });

            // Handle pemilihan opsi buku
            $(document).on('click', '#kode_buku_dropdown .dropdown-item', function() {
                var bookId = $(this).data('id');
                var bookCode = $(this).text(); // Ambil kode buku dari teks item dropdown
                var bookName = $(this).data('name'); // Ambil nama buku dari data-name
                $('#kode_buku_input').val(bookCode); // Isi input dengan kode buku yang dipilih
                $('#nama_buku').text(bookName); // Tampilkan nama buku di <span id="nama_buku"></span>
                $('#kode_buku_dropdown').hide(); // Sembunyikan dropdown
                // Jika perlu, Anda bisa menyimpan ID buku yang dipilih untuk digunakan dalam menyimpan data peminjaman
                $('#selected_book_id').val(bookId);
            });
        });

        // Anggota
        $(document).ready(function() {
            $('#nama_anggota_input').on('input', function() {
                var inputVal = $(this).val();
                $.ajax({
                    url: '{{ route('get.members') }}', // Adjust the endpoint as necessary
                    type: 'GET',
                    data: {
                        query: inputVal
                    },
                    success: function(response) {
                        var dropdown = $('#nama_anggota_dropdown');
                        if (inputVal.length === 0) {
                            dropdown.hide();
                            return;
                        }
                        dropdown.empty();
                        if (response.length > 0) {
                            $.each(response, function(key, value) {
                                dropdown.append(
                                    '<a class="dropdown-item" href="#" data-id="' +
                                    value.id + '" data-address="' + value.alamat +
                                    '" data-telegram="' + value.chat_id + '">' +
                                    value.nama_anggota + '</a>'
                                );
                            });
                            dropdown.show();
                        } else {
                            dropdown.hide();
                        }
                    }
                });
            });

            $(document).on('click', '#nama_anggota_dropdown .dropdown-item', function() {
                var memberId = $(this).data('id');
                var memberName = $(this).text();
                var memberAddress = $(this).data('address');
                var memberTelegram = $(this).data('telegram');
                $('#nama_anggota_input').val(memberName);
                $('#alamat').text(memberAddress);
                $('#chat_id').text(memberTelegram);
                $('#nama_anggota_dropdown').hide();
            });
        });
        setTimeout(function() {
            document.getElementById('successAlert').remove();
        }, 3000);
    </script>
@endsection
