<div class="modal fade text-left" id="form-cu" tabindex="-1" role="dialog" aria-labelledby="form-store-paket" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="form-store-paket">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" novalidate action="{{ route('paket.store') }}">
            @csrf
            {{ method_field('POST') }}
          <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="id_outlet" name="id_outlet" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="namaPaket">Nama Paket</label>
                            <div class="controls">
                                <input type="text" name="nama_paket" class="form-control" required
                                    data-validation-required-message="Nama Paket Harus Diisi" placeholder="Masukkan Nama Paket" id="namaPaket">
                            </div>
                        </div>

                        {{-- 
                            <div class="form-group">
                            <label for="id_outle">Outlet</label>
                            <div class="controls">                                
                                <select class="form-control select2" name="id_outlet" style="width: 100%;">
                                    <optgroup label="Nama Outlet">
                                        @forelse($outlet as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @empty
                                        <option disabled="">-- Tidak Ada Outlet --</option>
                                        @endforelse
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        --}}

                        <div class="form-group">
                            <label for="jenis">Jenis Cucian</label>
                            <select class="custom-select block" name="jenis" id="jenis">
                                <option selected="" disabled="">-- Pilih Jenis Cucian --</option>
                                <option value="kiloan">Kiloan</option>
                                <option value="selimut">Selimut</option>
                                <option value="bad_cover">Bad Cover</option>
                                <option value="kaos">Kaos</option>
                                <option value="lain">Lain</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga Paket</label>
                            <div class="controls">
                                <input type="number" name="harga" class="form-control" required
                                    data-validation-required-message="Harga Harus Diisi" placeholder="1000" id="harga">
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