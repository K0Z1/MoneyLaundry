<div class="modal fade text-left" id="form-status" tabindex="-1" role="dialog" aria-labelledby="form-status-transaksi" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-status-transaksi">Edit Status Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        @csrf
        {{ method_field('PATCH') }}
          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="row">
              <div class="col-12">
								<label for="status_pesanan">Status Pesanan</label>
									<select class="form-control" name="status_pesanan" id="status_pesanan" style="width: 100%;">
                    <option value="baru">Baru</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="diambil">Diambil</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
          </div>
        </form>
    </div>
  </div>
</div>