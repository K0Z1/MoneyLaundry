@extends('layouts.master')

@section('title','Edit Transaksi')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/checkboxes-radios.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
@stop

@section('content')
<div class="row">  
  <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <span class="invoice-id font-weight-bold">Invoice# </span>
          <span>{{ $data->kode_invoice }}</span>
        </div>
        Edit Transaksi - {{ $data->pelanggan->nama }}
      </div>
      <hr>
      <div class="card-body">
        <!-- / -->
        <form class="form row" id="tambahPaket">
          @csrf
            {{ method_field('POST') }}
            <div class="form-group col-sm-12 col-md-2">
                <label for="paket">Paket</label>
                <select class="form-control" name="nama_paket" id="paket" class="nama_paket">
                  <option>-- Pilih Paket --</option>
                </select>
                <input type="hidden" name="id_paket" id="id_paket">
            </div>

            <div class="form-group col-sm-12 col-md-2">
               <label for="jenis">Jenis Cucian</label>
               <select class="form-control" id="jenis">
                  <option>-- Pilih Cucian --</option>
                </select>
            </div>

            <div class="form-group col-sm-12 col-md-2">
               <label for="jmlCucian" class="cursor-pointer">Jumlah Cucian</label>
               <input type="number" class="form-control" name="qty" id="jmlCucian" placeholder="1" required>
            </div>

            <div class="form-group col-sm-12 col-md-2">
               <label for="harga">Harga</label>
               <p class="form-control-static" id="harga">Rp. 0</p>
            </div>

            <div class="form-group col-sm-12 col-md-2">
               <label for="keterangan">Keterangan</label>
               <textarea name="keterangan" id="keterangan" rows="2" class="form-control"></textarea>
            </div>

            <div class="form-group col-sm-12 col-md-2">
                <button type="submit" class="btn btn-primary mt-2">
                  <i class="fa fa-plus"></i> Tambahkan
                </button>
            </div>
          </form>
        <!-- / -->
        <hr>
         <!-- Table -->
        <div class="row">
          <div class="col-12">
             <div class="card">
                <div class="card-header">
                  Paket Yang Di Pesan
                </div>
                <div class="card-content">
                  <div id="tambahPaket" class="table-responsive position-relative">
                    <table class="table" id="detail-transaksi"style="width: 100%;">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Paket</th>
                          <th>Jenis Cucian</th>
                          <th>Jumlah Cucian</th>
                          <th>Harga</th>
                          <th>Keterangan</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- /table -->
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-content">
                 <form class="form" method="POST" action="{{ route('transaksi.update', $data->id) }}">
                  @csrf
                  {{ method_field('PATCH') }}
                  <div class="form-body">
                    <div class="row my-2">
                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                        <label for="outlet">Outlet</label>
                        <input type="text" class="form-control" name="id_outlet" value="{{ $data->outlet->nama }}" readonly="">
                      </div>

                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                        <label for="pelanggan">Pelanggan</label>
                        <select class="form-control select2" id="pelanggan" name="id_member" style="width: 100%;">
                            <optgroup label="Nama Pelanggan">
                                <option readonly="" value="0">-- Pilih Pelanggan --</option>
                                @forelse($pelanggan as $dataP)
                                <option value="{{ $dataP->id }}" @if($data->pelanggan->id == $dataP->id) selected @endif>{{ $dataP->nama }}</option>
                                @empty
                                <option disabled="">-- Tidak Ada Pelanggan --</option>
                                @endforelse
                            </optgroup>
                        </select>
                      </div>
                    </div>

                    <div class="row my-2">
                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                        <label for="batas_waktu">Batas Waktu Pengambilan</label>
                        <div class="input-group">
                          @php
                            $date = date('Y-m-d h:m',strtotime($data->batas_waktu));
                            $bayar = date('Y-m-d h:m',strtotime($data->tgl_bayar));
                          @endphp
                            <input type='datetime-local' class="form-control" name="batas_waktu" placeholder="Batas Waktu Pengambilan" value="{{ $data->batas_waktu }}" id="batas_waktu" required />
                            <input type="text" class="form-control" readonly="" value="{{ $date }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fa fa-calendar-o"></span>
                                </span>
                            </div>
                        </div> 
                      </div>
                  
                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                        <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                        <div class="input-group">
                            <input type='datetime-local' class="form-control" value="{{ $data->tgl_bayar }}" name="tgl_bayar" placeholder="Tanggal Pembayaran" id="tgl_bayar" required />
                            <input type="text" readonly="" class="form-control" value="{{ $bayar }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fa fa-calendar-o"></span>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="row my-2">
                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                          <label for="biaya_tambahan">Biaya Tambahan</label>
                          <input type="number" class="form-control" id="biaya_tambahan" name="biaya_tambahan" placeholder="Biaya Tambahan" value="{{ $data->biaya_tambahan }}">
                      </div>

                     <div class="col-sm-6 col-12 order-2 order-sm-1">
                          <label for="pajak">Pajak</label>
                          <input type="number" class="form-control" id="pajak" name="pajak" placeholder="Pajak" value="{{ $data->pajak }}">
                      </div>
                    </div>

                    <div class="row my-2">
                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                          <label for="diskon">Diskon (%)</label>
                          <input type="number" class="form-control" id="diskon" name="diskon" placeholder="Diskon" max="100" value="{{ $data->diskon }}">
                      </div>

                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                          <label for="status">Status Pesanan</label>
                          <select class="custom-select block" name="status" id="status" required >
                              <option value="baru" @if($data->status == 'baru') selected @endif>Baru</option>
                              <option value="proses" @if($data->status == 'proses') selected @endif>Proses</option>
                              <option value="selesai" @if($data->status == 'selesai') selected @endif>Selesai</option>
                              <option value="diambil" @if($data->status == 'diambil') selected @endif>Diambil</option>
                          </select>
                      </div>
                    </div>

                    <div class="row my-2">
                      <div class="col-sm-6 col-12 order-2 order-sm-1">
                          <label for="dibayar">Status Pembayaran</label>
                          <fieldset>
                            <input type="radio" name="dibayar" id="dibayar" value="dibayar" required @if($data->dibayar == 'dibayar') checked @endif>
                            <label for="dibayar">Dibayar</label>&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="dibayar" id="belum_dibayar" value="belum_dibayar" @if($data->dibayar == 'belum_dibayar') checked @endif>
                            <label for="belum_dibayar">Belum Dibayar</label>
                          </fieldset>
                      </div>
                    </div>

                    <div class="invoice-total">
                        <div class="row justify-content-between">
                            <div class="col-12 col-md-6 col-lg-6 col-xl-5">
                                
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-5 offset-xl-2">
                                <button type="submit"  class="btn btn-primary mt-1 btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('footer')
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
<!-- Radio -->
<script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/forms/checkbox-radio.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.min.js')}}"></script>

<!-- Dynamic Dropdown -->
<script>
  jQuery(function () {
         // Custom Select Option
         $(".select2").select2();
         // Cari Paket
         var outlet_id = "{{ $data->outlet->id }}";
         console.log(outlet_id);

         $.get('/json/cari-paket/' + outlet_id,function(data) {
           $('#paket').empty();
           $('#paket').append('<option value="0" disable="true" selected="true">-- Pilih Paket --</option>');

         $.each(data, function(index, paketObj){
             $('#paket').append('<option value="'+ paketObj.nama_paket +'">'+ paketObj.nama_paket +'</option>');
           })
         });

         // Cari Jenis Paket
         $('#paket').on('change', function(e){
            var idPaket = "{{ $data->outlet->id }}";
            var namaPaket = e.target.value;
            
            $.get('/json/cari-jenis/'+ idPaket +'/'+ namaPaket,function(data) {
              $('#jenis').empty();
              $('#jenis').append('<option value="0" disable="true" selected="true">-- Pilih Cucian --</option>');

              $.each(data, function(index, jenisObj){
                $('#jenis').append('<option value="'+ jenisObj.id +'">'+ jenisObj.jenis +'</option>');
              })
            });
          });

         // Cari Harga
         $('#jenis').on('change', function(e){
            console.log(e);
            var harga = e.target.value;
            
            $.get('/json/cari-harga/'+ harga,function(data) {
              $('#harga').empty();

              $.each(data, function(index, harga){
                $('#harga').append('<span> Rp. '+ harga.harga + '/' + harga.jenis +'</span>');
              })
              $('#id_paket').val(data[0]['id']);
            });
          });

         // Show Hide Elemen
         $('.hideElmen').hide();
             $("#dibayar").click(function() {
           $('.hideElmen').show();
          });

         $("#belum_dibayar").click(function() {
           $('.hideElmen').hide();
         });
    });

      // Data Table
        var table = $('#detail-transaksi').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/json/cari-paket/{{ $data->id }}/detail-transaksi",
              columns: [
                  {data: 'DT_RowIndex', name:'DT_RowIndex'},
                  {data: 'nama_paket', name: 'nama_paket'},
                  {data: 'jenis', name: 'jenis'},
                  {data: 'qty', name: 'qty'},
                  {data: 'harga', name: 'harga'},
                  {data: 'keterangan', name: 'keterangan'},
                  {data: 'opsi', name: 'opsi', orderable: false, searchable: false}
              ],
              "columnDefs": [
                  { "width": "5%", "targets": 0 }
               ]
          });

        /////////////////
        // Tambah Data //
        /////////////////
        $(function () {
             $('#tambahPaket').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    // Ajax
                    $.ajax({
                        url: "/tambah-paket/{{ $data->id }}/detail-transaksi",
                        type: "POST",
                        data: $("#tambahPaket").serialize(),
                        success: function($data) {
                            table.ajax.reload();
                            toastr.success('Paket Berhasil Ditambahkan','Sukses');
                            $('#jmlCucian').val('');
                            $('#keterangan').val('');
                        },
                        error: function () {
                            Swal.fire(
                              'Opps!',
                              'Terjadi Error...!',
                              'error',
                              '1500'
                            )
                        }
                    });
                    return false;
                }
            });
        });

        /////////////////
        // Hapus Paket  //
        /////////////////
        function destroy(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
  
            Swal.fire({
              title: 'Hapus!',
              text: "Paket Ini?",
              type: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonColor: '#00B5B8',
              confirmButtonText: 'Oke',
              reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('dPaket') }}" + '/' + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function (data) {
                            toastr.success('Paket Berhasil Dihapus','Sukses');
                            table.ajax.reload();
                        },
                        error: function () {
                            Swal.fire(
                              'Opps!',
                              'Terjadi Error...!',
                              'error',
                              '1500'
                            )
                        }
                    })
                }
            })
        }
</script>
@stop