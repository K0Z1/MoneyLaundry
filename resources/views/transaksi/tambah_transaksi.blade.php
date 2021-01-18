@extends('layouts.master')

@section('title','Tambah Transaksi')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.min.css')}}">
@stop

@section('content')
<div class="row">  
  <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
    <div class="card">
      <div class="card-header">
        Tambah Transaksi
      </div>
      <hr>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <!-- / -->
            <form class="form" method="POST" action="{{ route('transaksi.store') }}">
              @csrf
              <div class="form-body">
                <div class="row">
                  <div class="form-group col-md-6 mb-2">
                    <label for="outlet">Outlet</label>
										<select class="form-control select2" name="id_outlet" id="outlet" style="width: 100%;">
                          <optgroup label="Nama Outlet">
                              <option readonly value="0">-- Pilih Outlet --</option>
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
                        <input type='text' class="form-control pickadate-selectors" name="batas_waktu" placeholder="Batas Waktu Pengambilan" required="" id="batas_waktu" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="fa fa-calendar-o"></span>
                            </span>
                        </div>
                    </div> 
                  </div>
                  
                  <div class="form-group col-md-6 mb-2">
                    <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                    <div class="input-group">
                        <input type='text' class="form-control pickadate-selectors" name="tgl_bayar" placeholder="Tanggal Pembayaran" id="tgl_bayar" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="fa fa-calendar-o"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                </div>
                </div>

                <div class="form-actions">
                    <button type="button" id="reset" class="btn btn-warning mr-1">
                      <i class="icon-reload"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Selanjutnya <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
              </form>
            <!-- / -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('footer')
<script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<!-- DateTimePicker -->
<script src="{{asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/pickers/dateTime/bootstrap-datetime.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js')}}"></script>

<!-- Invoice -->
<script src="{{asset('app-assets/js/scripts/pages/app-invoice.min.js')}}"></script>

<!-- Dynamic Dropdown -->
<script>
      // Custom Select Option
      $(".select2").select2();

      // Reset
      $("#reset").click(function() {
        $("#outlet").val("");
        $("#pelanggan").val("");
        $("#batas_waktu").val("");
        $("#tgl_bayar").val("");
      })

      $(document).ready(function() {
        // Hide
        $('#hideElmen').hide();

        // Show
        $('#pelanggan').on('change', function (e) {
            var idPelanggan = e.target.value;

            $.get('/json/'+idPelanggan+'/cari-pelanggan', function (data) {
                $('#hideElmen').show();
                $('#tlp_pelanggan').val(data.tlp);
                $('#alamat_pelanggan').val(data.alamat);
            })
        })
      });
</script>
@stop