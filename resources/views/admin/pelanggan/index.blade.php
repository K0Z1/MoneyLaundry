@extends('layouts.master')

@section('title','Data Pelanggan')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/checkboxes-radios.min.css')}}">
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                	<div class="float-right">
                        <button onclick="tampilForm();" class="btn btn-sm btn-primary" style="height: 30px;">Tambah Pelanggan</button>
                	</div>
                    <h4 class="card-title">Data Pelanggan</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div id="app-invoice-wrapper" class="">
                          <table id="data-pelanggan" class="table" style="width: 100%;">
                            <thead class="border-bottom border-dark">
                              <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>JK</th>
                                <th>Telpon</th>
                                <th>Alamat</th>
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
    @include('layouts.modals._pelanggan')
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
    <!-- Radio -->
    <script src="{{asset('app-assets/js/scripts/forms/checkbox-radio.min.js')}}"></script>

    <script>
        // Data Table
    	var table = $('#data-pelanggan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('json.pelanggan') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                    {data: 'tlp', name: 'tlp'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'opsi', name: 'opsi', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 }
                ]
            });

        /////////////////
        // Tampil Form //
        /////////////////
        function tampilForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#form-cu').modal('show');
            $('#form-cu form')[0].reset();
            $('#form-store-pelanggan').text("Tambah Pelanggan");
        }

        /////////////////
        // Tambah Data //
        /////////////////
        $(function () {
            $('#form-cu form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                if (save_method == 'add') url = "{{ url('pelanggan') }}";
                else url = "{{ url('pelanggan') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $("#form-cu form").serialize(),
                        success: function($data) {
                            $("#form-cu").modal('hide');
                            table.ajax.reload();
                            
                            if (save_method == 'add') {
                                toastr.success('Data Berhasil Ditambahkan','Sukses');
                            } else {
                                toastr.success('Data Berhasil Diperbharui','Sukses');
                            }
                        },
                        error: function () {
                            alert("Opps! Error...!");
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
            $('#form-cu form')[0].reset();

            $.ajax({
                url: "{{ url('pelanggan') }}" + '/' + id + '/edit',
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#form-cu').modal('show');
                    $('.modal-title').text('Edit Pelanggan');

                    $('#id').val(data.id);
                    $('#namaPelanggan').val(data.nama);
                    $('input[name=jk][value='+ data.jenis_kelamin +']')[0].checked = true;
                    $('#noTelpon').val(data.tlp);
                    $('#alamat').val(data.alamat);

                    console.log(data.jenis_kelamin);
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
              text: "Pelanggan Dengan ID "+ id +"?",
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
                        url: "{{ url('pelanggan') }}" + '/' + id,
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