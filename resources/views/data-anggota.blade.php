@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-4 py-3">
            <div class="col d-xl-flex justify-content-xl-start align-items-xl-center col-md-5 col-12 col-lg-7">
                <h5 class="fw-semibold m-0">Data Anggota</h5>
            </div>
            <div class="col flex-column flex-sm-row d-flex gap-1 align-items-end">
                <div class="input-group">
                    <form action="{{ route('anggota.index') }}" method="GET" class="d-flex w-100">
                        <input class="form-control" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari anggota..." style="border-radius: 0.375rem 0rem 0rem 0.375rem;">
                        <button class="btn btn-primary" style="border-radius: 0rem 0.375rem 0.375rem 0rem;"
                            type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <button class="btn btn-primary ms-0 ms-md-2 w-100" type="button"
                    data-bs-target="#modal-tambah-data-anggota" data-bs-toggle="modal" style="max-width: 140px;">
                    <i class="fas fa-plus-circle me-1"></i>Tambah Data
                </button>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" id="successAlert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->has('nisn_nip'))
                            <div class="alert alert-danger" id="myAlert">
                                {{ $errors->first('nisn_nip') }}
                            </div>
                        @endif
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Alamat</th>
                                        <th>Chat ID</th>
                                        <th>Jabatan</th>
                                        <th>Kelas</th>
                                        <th>Jenis Kelamin</th>
                                        <th>NISN/NIP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $perPage = $anggota->perPage();
                                        $currentPage = $anggota->currentPage();
                                        $counter = ($currentPage - 1) * $perPage + 1;
                                    @endphp
                                    @foreach ($anggota as $detail_anggota)
                                        <tr data-id="{{ $detail_anggota->id_anggota }}">
                                            <td>{{ $counter }}</td>
                                            <td>{{ $detail_anggota->nama_anggota }}</td>
                                            <td>{{ $detail_anggota->alamat }}</td>
                                            <td>{{ $detail_anggota->chat_id }}</td>
                                            <td>{{ $detail_anggota->jabatan }}</td>
                                            <td>{{ $detail_anggota->kelas }}</td>
                                            <td>{{ $detail_anggota->jenis_kelamin }}</td>
                                            <td>{{ $detail_anggota->nisn_nip }}</td>
                                            <td class="d-flex gap-1 border-0">
                                                <button class="btn btn-primary btn-sm" type="button"
                                                    data-bs-target="#modal-edit-data-anggota" data-bs-toggle="modal"><i
                                                        class="fas fa-edit"></i></button>
                                                <form action="{{ route('anggota.destroy', ['id' => $detail_anggota->id_anggota]) }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
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
    @include('partials.modal-tambah-data-anggota')
    @include('partials.modal-edit-data-anggota')
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

            setTimeout(() => {
                document.getElementById('successAlert').remove();
            }, 3000);

            const editButtons = document.querySelectorAll('[data-bs-target="#modal-edit-data-anggota"]');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const id = row.dataset.id;
                    const namaAnggota = row.querySelector('td:nth-child(2)').textContent;
                    const alamat = row.querySelector('td:nth-child(3)').textContent;
                    const chatId = row.querySelector('td:nth-child(4)').textContent;
                    const jabatan = row.querySelector('td:nth-child(5)').textContent;
                    const kelas = row.querySelector('td:nth-child(6)').textContent;
                    const jenisKelamin = row.querySelector('td:nth-child(7)').textContent;
                    const nisn_nip = row.querySelector('td:nth-child(8)').textContent;

                    document.querySelector('#edit_nama_anggota').value = namaAnggota;
                    document.querySelector('#edit_alamat').value = alamat;
                    document.querySelector('#edit_chat_id').value = chatId;
                    document.querySelector('#edit_jabatan').value = jabatan;
                    document.querySelector('#edit_kelas').value = kelas;
                    document.querySelector('#edit_nisn_nip').value = nisn_nip;

                    if (jenisKelamin === 'pria') {
                        document.querySelector('#edit_pria').checked = true;
                    } else {
                        document.querySelector('#edit_wanita').checked = true;
                    }

                    if (jabatan === 'siswa') {
                        editKelasInput.hidden = false;
                    } else {
                        editKelasInput.hidden = true;
                    }

                    const form = document.getElementById('editForm');
                    form.action = `/data-anggota/${id}`;
                });
            });
        });
    </script>
    <script>
        setTimeout(() => {
                document.getElementById('myAlert').remove();
            }, 3000);
    </script>
@endsection
