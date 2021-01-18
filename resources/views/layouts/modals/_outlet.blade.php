<div class="modal fade text-left" id="form-cu" tabindex="-1" role="dialog" aria-labelledby="form-store-outlet" aria-hidden="true">
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
						<div class="form-group row">
							<label class="col-md-2">Outlet </label>
							<div class="col-md-10">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control jq-bs-validation" name="nama_outlet" required placeholder="Nama Outlet" id="namaOutlet">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="number" name="tlp" class="form-control jq-bs-validation" required placeholder="No. Telepon Outlet" id="noTelpon">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
												<textarea name="alamat" id="alamat" class="form-control jq-bs-validation" required="" placeholder="Masukkan Alamat Outlet" aria-invalid="true" rows="5"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<label class="col-md-2">Pemilik Dan Kasir </label>
							<div class="col-md-10">
									<div class="row">
										<div class="col-md-6">
											<select class="form-control select2" name="id_owner" style="width: 100%;" required="">
												<optgroup label="Nama Pemilik">
													@forelse($owner as $pemilik)
													<option value="{{ $pemilik->id }}">{{ $pemilik->nama }}</option>
													@empty
													<option readonly selected="">-- Tidak Ada Pemilk Outlet --</option>
													@endforelse
												</optgroup>
											</select>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<select class="form-control select2" name="id_kasir" style="width: 100%;">
													<optgroup label="Nama Kasir">
													@forelse($kasir as $ksir)
													<option value="{{ $ksir->id }}">{{ $ksir->nama }}</option>
													@empty
													<option readonly selected="">-- Tidak Ada Kasir --</option>
													@endforelse
													</optgroup>
												</select>
											</div>
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