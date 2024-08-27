<div id="modal-edit-data-anggota" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit data anggota</h4>
                <button class="btn-close" aria-label="Close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-1">
                                <label class="form-label mb-1" for="edit_nama_anggota">Nama Anggota</label>
                                <input class="form-control" type="text" id="edit_nama_anggota" name="nama_anggota" value="" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-1">
                                <label class="form-label mb-1" for="edit_jabatan">Jabatan</label>
                                <select class="form-select" name="jabatan" id="edit_jabatan" required>
                                    <option selected disabled>Pilih jabatan</option>
                                    <option value="guru">Guru/Staf</option>
                                    <option value="siswa">Siswa</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label mb-1" for="edit_nisn_nip">NISN/NIP</label>
                        <input class="form-control" id="edit_nisn_nip" name="nisn_nip" type="text" />
                    </div>
                    <div id="edit_input_kelas" class="mb-1" hidden>
                        <div class="mb-1">
                            <label class="form-label mb-1" for="edit_kelas">Kelas</label>
                            <select class="form-select" name="kelas" id="edit_kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label mb-1" for="edit_jenis_kelamin">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="edit_pria" value="pria" required>
                            <label class="form-check-label" for="edit_pria">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="edit_wanita" value="wanita" required>
                            <label class="form-check-label" for="edit_wanita">Perempuan</label>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label mb-1" for="edit_alamat">Alamat</label>
                        <input class="form-control" id="edit_alamat" name="alamat" type="text" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label mb-1" for="edit_chat_id">Chat ID</label>
                        <input class="form-control" id="edit_chat_id" name="chat_id" type="text" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal" type="button">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
