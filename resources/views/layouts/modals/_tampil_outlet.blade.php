<div class="modal fade text-left" id="form-tampil" tabindex="-1" role="dialog" aria-labelledby="form-store-outlet" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-store-outlet"></h4>
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
                            <label for="tnamaOutlet">Nama Outlet</label>
                            <div class="controls">
                                <input type="text" name="nama" class="form-control" required
                                    data-validation-required-message="Nama Outlet Harus Diisi" placeholder="Masukkan Nama Outlet" id="tnamaOutlet">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="noTelpon">No. Telpon Outlet</label>
                            <div class="controls">
                                <input type="number" name="tlp" class="form-control" required
                                    data-validation-required-message="No. Telpon Outlet Harus Diisi" placeholder="Masukkan No. Telpon Outlet" id="tnoTelpon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Outlet</label>
                            <div class="controls">
                                <textarea name="alamat" id="talamat" class="form-control" required="" placeholder="Masukkan Alamat Outlet" data-validation-required-message="Alamat Outlet Harus Diisi" aria-invalid="true" rows="5"></textarea>
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