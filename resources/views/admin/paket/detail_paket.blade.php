@extends('layouts.master')

@section('title','Data Paket Cucian')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
									<div class="float-right">
												<button onclick="tampilForm();" class="btn btn-sm btn-primary" style="height: 30px;">Tambah Paket</button>
									</div>
									<div class="float-left mr-2">
												<a href="{{ url('/paket') }}"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
									</div>
                    <h4 class="card-title">Data Paket Cucian - {{ $data->nama }}</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div id="app-invoice-wrapper" class="">
                          <table id="data-paket" class="table" style="width: 100%;">
                            <thead class="border-bottom border-dark">
                              <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Jenis Cucian</th>
                                <th>Harga Paket</th>
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

    <!-- Modal Store -->
    @include('layouts.modals._paket')
    @include('layouts.modals._updatepaket')
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
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    
    <!-- Alert -->
    @if(Session::has('sudahada'))
    <script>
        toastr.error('Data sudah ada!','Error');
    </script>
    @endif

    @if(Session::has('sukses'))
    <script>
        toastr.success('Data Berhasil Ditambahkan','Sukses');
    </script>
    @endif

    <script>
        $(".select2").select2();
    </script>
    <script>
        var idOutlet = {{ $data->id }};
        
				// Data Table
				var table = $('#data-paket').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/json/paket/" + idOutlet,
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'nama_paket', name: 'nama_paket'},
                    {data: 'jenis', name: 'jenis'},
                    {data: 'harga', name: 'harga'},
                    {data: 'opsi', name: 'opsi', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 }
                ]
            });

        // Tampil Form
        function tampilForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#form-cu').modal('show');
            $('#form-cu form')[0].reset();
            $('#form-store-paket').text("Tambah Paket");
        }

        /////////////////
        // Update Data //
        /////////////////
        $(function () {
							$('#form-update form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                url = "{{ url('paket') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $("#form-update form").serialize(),
                        success: function($data) {
                            $("#form-update").modal('hide');
                            table.ajax.reload();
                            toastr.success('Data Berhasil Diperbharui','Sukses');
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

        ///////////////
        // Ubah Data //
        /////////////
        function update(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#form-update form')[0].reset();

            $.ajax({
                url: "{{ url('paket') }}" + '/' + id + '/edit',
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#form-update').modal('show');
                    $('.modal-title').text('Edit Paket');

                    $('#id').val(data.id);
                    $('#unamaPaket').val(data.nama_paket);
                    $('#ujenis').val(data.jenis);
                    $('#uharga').val(data.harga);
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

        /////////////////
        // Hapus Data  //
        /////////////////
        function destroy(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
  
            Swal.fire({
              title: 'Hapus!',
              text: "Paket Dengan ID "+ id +"?",
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
                        url: "{{ url('paket') }}" + '/' + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function (data) {
                            table.ajax.reload();
                            toastr.success('Data Berhasil Dihapus','Sukses');
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