<div class="modal fade text-left" id="form-cu" tabindex="-1" role="dialog" aria-labelledby="form-store-paket" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-store-transaksi">Tambah Transaksi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('transaksi.store') }}" method="POST" novalidate="">
        @csrf
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-6 mb-2">
								<label for="outlet">Outlet</label>
									<select class="form-control select2" name="id_outlet" id="outlet" style="width: 100%;">
                      <optgroup label="Nama Outlet">
                          <option readonly value="">-- Pilih Outlet --</option>
                          @forelse($outlet as $dataO)
                          <option value="{{ $dataO->id }}">{{ $dataO->nama }}</option>
                          @empty
                          <option disabled="">-- Tidak Ada Outlet --</option>
                          @endforelse
                      </optgroup>
                  </select>
              </div>

              <div class="form-group col-md-6 mb-2">
                <label for="pelanggan">Pelanggan</label>
                <select class="form-control select2" id="pelanggan" name="id_member" style="width: 100%;">
                    <optgroup label="Nama Pelanggan">
                        <option readonly="" value="0">-- Pilih Pelanggan --</option>
                        @forelse($pelanggan as $dataP)
                        <option value="{{ $dataP->id }}">{{ $dataP->nama }}</option>
                        @empty
                        <option disabled="">-- Tidak Ada Pelanggan --</option>
                        @endforelse
                    </optgroup>
                </select>
              </div>
            </div>

            <div class="row" id="hideElmen">
              <div class="form-group col-md-6 mb-2">
                <label for="tlp_pelanggan">Telpon Pelanggan</label>
                <input type="text" class="form-control" name="tlp_pelanggan" id="tlp_pelanggan" readonly="">
              </div>

              <div class="form-group col-md-6 mb-2">
                <label for="alamat_pelanggan">Alamat Pelanggan</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" readonly="" cols="30" class="form-control" rows="2"></textarea>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6 mb-2">
                <label for="batas_waktu">Batas Waktu Pengambilan</label>
                <div class="input-group">
                    <input type='datetime-local' class="form-control" name="batas_waktu" placeholder="Batas Waktu Pengambilan" required="" id="batas_waktu" />
                </div> 
              </div>
              
              <div class="form-group col-md-6 mb-2">
                <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                <div class="input-group">
                    <input type='datetime-local' class="form-control pickadate-selectors" name="tgl_bayar" placeholder="Tanggal Pembayaran" id="tgl_bayar" />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-arrow-right"></i> Selanjutnya</button>
          </div>
        </form>
    </div>
  </div>
</div>