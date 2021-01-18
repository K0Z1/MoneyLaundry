@extends('layouts.master')

@section('title','Daftar Transaksi')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
								<div class="float-right">
											<a href="#" onclick="tampilForm();" class="btn btn-sm btn-primary" style="height: 30px; padding: 8px;">Tambah Transaksi</a>
								</div>
                <h4 class="card-title">Daftar Transaksi</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div id="app-invoice-wrapper" class="">
                      <table id="data-transaksi" class="table" style="width: 100%;">
                        <thead class="border-bottom border-dark">
                          <tr>
                            <th>No</th>
                            <th>
                              <span class="align-middle">Kode Invoice</span>
                            </th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Outlet</th>
                            <th>Kasir</th>
                            <th>Status</th>
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
        </div>
    </div>
</div>

    <!-- Include -->
    @include('layouts.modals._transaksi')
    @include('layouts.modals._transaksi_status')
@stop

@section('footer')
    <!-- Data Table -->
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/pages/app-invoice.min.js')}}"></script>
    <!-- /Data Table -->
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <!-- Alert -->
    @if(Session::has('sukses'))
    <script>
        toastr.success('Data Berhasil Ditambahkan','Sukses');
    </script>
    @endif

    @if(Session::has('suksesTransaksi'))
    <script>
        toastr.success('Transaksi Berhasil Ditambahkan','Sukses');
    </script>
    @endif

    @if(Session::has('updateTransaksi'))
    <script>
        toastr.success('Transaksi Berhasil Diperbharui','Sukses');
    </script>
    @endif
    <script>
        // Custom Select Option
        $(".select2").select2();
        
        // Data Table
        var table = $('#data-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('json.transaksi') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'Invoice', name: 'Invoice'},
                    {data: 'Pelanggan', name: 'Pelanggan'},
                    {data: 'tgl', name: 'tgl'},
                    {data: 'Outlet', name: 'Outlet'},
                    {data: 'Kasir', name: 'Kasir'},
                    {data: 'status', name: 'status'},
                    {data: 'opsi', name: 'opsi', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 }
                ]
            });

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
        });
    });

        function status(id) {
            $('input[name=_method]').val('PATCH');
            $('#form-status').modal('show');
            $('#form-status form')[0].reset();

            $.ajax({
                url: "/json/"+id+"/status",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#id').val(data.id);
                    $('#status_pesanan').val(data.status);
                },
                error : function () {
                    Swal.fire(
                      'Opps!',
                      'Terjadi Error...!',
                      'error',
                      '1500'
                    )
                }
            });
        }

        $(function () {
            $('#form-status form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                url = "/status/"+id+"/update";

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $("#form-status form").serialize(),
                        success: function($data) {
                            $("#form-status").modal('hide');
                            table.ajax.reload();
                            toastr.success('Status Berhasil Diperbharui','Sukses');
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

        // Tampil Form
        function tampilForm() {
            $('#form-cu').modal('show');
            $('#form-cu form')[0].reset();
            $('#form-store-outlet').text("Tambah Data");
        }

        // Hapus Data
        function destroy(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
  
            Swal.fire({
              title: 'Hapus!',
              text: "Transaksi Dengan ID "+ id +"?",
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
                        url: "{{ url('transaksi') }}" + '/' + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function (data) {
                            toastr.success('Data Berhasil Dihapus','Sukses');
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