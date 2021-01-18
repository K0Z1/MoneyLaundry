<div class="modal fade text-left" id="form-cu" tabindex="-1" role="dialog" aria-labelledby="form-store-pengguna" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-store-pengguna">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" novalidate>
					@csrf
					{{ method_field('POST') }}
          <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="nama" required data-validation-required-message="Nama Lengkap Harus Diisi" placeholder="Masukkan Nama Lengkap" id="namaLengkap">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="controls">
                                <input type="text" name="username" class="form-control" required
                                    data-validation-required-message="Username Harus Diisi" placeholder="Masukkan Username" id="username">
                            </div>
                        </div>

                        <div class="form-group hPass">
                            <label for="password">Password</label>
                            <div class="controls">
                                <input type="password" name="password" class="form-control" required
                                    data-validation-required-message="Password Harus Diisi" placeholder="Masukkan Password" id="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <div class="controls">
                                <select name="role" id="role" class="custom-select block">
                                    <option selected="" disabled="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-primary"><i class="icon-paper-plane"></i> Simpan</button>
          </div>
        </form>
    </div>
  </div>
</div>