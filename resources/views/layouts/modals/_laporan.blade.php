<div class="modal fade text-left" id="form-cari" tabindex="-1" role="dialog" aria-labelledby="form-store-pengguna" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-store-pengguna">Cari Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="{{ route('laporan.cari') }}" novalidate>
          @csrf
					{{ method_field('POST') }}
          <div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="dari">Tanggal - Dari</label>
									<div class='input-group'>
										<input type='date' name="q" class="form-control" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggalSampai">Tanggal - Sampai</label>
									<div class='input-group'>
										<input type='date' name="s" class="form-control" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="outlet">Outlet</label>
									<select class="form-control" name="o" id="outlet">
										@foreach($outlet as $data)
										<option value="{{ $data->id }}">{{ $data->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="status">Status</label>
									<select class="form-control" name="st" id="status">
										<option value="baru">Baru</option>
										<option value="proses">Proses</option>
										<option value="selesai">Selesai</option>
										<option value="diambil">Diambil</option>
									</select>
								</div>
							</div>
						</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-primary"><i class="icon-paper-plane"></i> Cari</button>
          </div>
        </form>
    </div>
  </div>
</div>