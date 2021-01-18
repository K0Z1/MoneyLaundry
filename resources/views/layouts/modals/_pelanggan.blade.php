<div class="modal fade text-left" id="form-cu" tabindex="-1" role="dialog" aria-labelledby="form-store-outlet" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-store-pelanggan"></h4>
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
                            <label for="namaPelanggan">Nama Lengkap</label>
                            <div class="controls">
                                <input type="text" name="nama" class="form-control" required
                                    data-validation-required-message="Nama Lengkap Harus Diisi" placeholder="Masukkan Nama Lengkap" id="namaPelanggan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <div class="controls">
                                <input type="radio" name="jk" id="L" value="L" required data-validation-required-message="Jenis Kelamin Harus Diisi"> L &nbsp;
                                <input type="radio" name="jk" id="P" value="P"> P
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="noTelpon">No. Telpon Pelanggan</label>
                            <div class="controls">
                                <input type="number" name="tlp" class="form-control" required
                                    data-validation-required-message="No. Telpon Pelanggan Harus Diisi" placeholder="Masukkan No. Telpon Pelanggan" id="noTelpon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Pelanggan</label>
                            <div class="controls">
                                <textarea name="alamat" id="alamat" class="form-control" required="" placeholder="Masukkan Alamat Pelanggan" data-validation-required-message="Alamat Pelanggan Harus Diisi" aria-invalid="true" rows="5"></textarea>
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