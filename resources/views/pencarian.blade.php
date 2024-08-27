<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@include('partials.head')
<body>
    <div class="container my-4">
        <section class="py-4 py-xl-5 rounded-4" style="background: linear-gradient(-162deg, rgba(0,0,0,0.5) 6%, rgba(255,255,255,0)), url(&quot;assets/img/159231988_ba6308de-ca55-42e3-969f-eee97d4d2c3c.jpg&quot;) bottom / cover no-repeat;">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div class="text-light">
                            <h2 class="text-uppercase fw-bold mb-3">Biben dum<br>fringi dictum, augue purus</h2>
                            <p class="mb-4">Etiam a rutrum, mauris lectus aptent convallis. Fusce vulputate aliquam, sagittis odio metus. Nulla porttitor vivamus viverra laoreet, aliquam netus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row my-4">
            <div class="col col-12">
                <div>
                    <h1 class="text-center">Cari Buku</h1>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-9 col-md-10 col-lg-11 col-xl-11 col-xxl-11">
                <div>
                    <form action="{{ route('pencarian') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" value="{{ request()->get('search') }}">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-3 col-md-2 col-lg-1 col-xl-1 col-xxl-1">
                @include('partials.modal-tambah-data-anggota-public')
                <button class="btn btn-primary ms-0 ms-md-2 w-100" type="button"
                    data-bs-target="#modal-tambah-data-anggota" data-bs-toggle="modal" style="max-width: 140px;">
                    <i class="fas fa-plus-circle me-1"></i>Daftar
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" id="myAlert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->has('nisn_nip'))
                            <div class="alert alert-danger" id="myAlert">
                                {{ $errors->first('nisn_nip') }}
                            </div>
                        @endif
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-striped my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Kode Buku</th>
                                        <th>Nama Buku</th>
                                        <th>Penulis Buku</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($buku as $item)
                                        <tr>
                                            <td>{{ $item->kode_buku }}</td>
                                            <td>{{ $item->nama_buku }}</td>
                                            <td>{{ $item->penulis_buku }}</td>
                                            <td>{{ $item->tahun_terbit }}</td>
                                            <td>
                                                @if ($item->status_buku)
                                                    <span class="badge text-bg-success">Tesedia</span>
                                                @else
                                                    <span class="badge text-bg-danger">Dipinjam</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
                document.getElementById('myAlert').remove();
            }, 3000);
    </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jabatanSelect = document.getElementById('jabatan');
            const kelasInput = document.getElementById('input_kelas');
            const editJabatanSelect = document.getElementById('edit_jabatan');
            const editKelasInput = document.getElementById('edit_input_kelas');

            const toggleKelasInput = (selectElement, inputElement) => {
                selectElement.addEventListener('change', function() {
                    if (this.value === 'siswa') {
                        inputElement.hidden = false;
                    } else {
                        inputElement.hidden = true;
                    }
                });
            };

            toggleKelasInput(jabatanSelect, kelasInput);
            toggleKelasInput(editJabatanSelect, editKelasInput);

        });
    </script>
</body>
</html>
