@extends('layouts.master')

@section('title','Data Outlet')

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
													<button onclick="tampilForm();" class="btn btn-sm btn-primary" style="height: 30px;">Tambah Outlet</button>
										</div>
                    <h4 class="card-title">Data Outlet</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div id="app-invoice-wrapper" class="">
                          <table id="data-outlet" class="table" style="width: 100%;">
                            <thead class="border-bottom border-dark">
                              <tr>
                                <th>No</th>
                                <th>Nama Outlet</th>
                                <!-- <th>Pemilik Outlet</th> -->
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
    @include('layouts.modals._outlet')
    @include('layouts.modals._tampil_outlet')
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
    <!-- Custom -->
    <script>
        // Select Option
        $(".select2").select2();
        $(".jq-bs-validation").jqBootstrapValidation();
    </script>
    
    <script>

			// Data Table
			var table = $('#data-outlet').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('json.outlet') }}",
				columns: [
						{data: 'DT_RowIndex', name:'DT_RowIndex'},
						{data: 'nama', name: 'nama'},
						// {data: 'pemilik', name: 'pemilik'},
						{data: 'tlp', name: 'tlp'},
						{data: 'alamat', name: 'alamat'},
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
					$('#form-store-outlet').text("Tambah Outlet");
					$(".btn-outline-primary").show();
			}

			// Tambah Data
			$(function () {
					$('#form-cu form').on('submit', function (e) {
							if (!e.isDefaultPrevented()) {
							var id = $('#id').val();
							if (save_method == 'add') url = "{{ url('outlet') }}";
							else url = "{{ url('outlet') . '/' }}" + id;

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
															toastr.success('Data Berhasil Diperbarui','Sukses');
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


			// Tampil Detail
			function tampilDetail(id) {
					save_method = "tampilDetail";
					$('input[name=_method]').val('GET');
					$('#form-cu form')[0].reset();

					$.ajax({
							url: "{{ url('outlet') }}"+ '/' + id,
							type: "GET",
							dataType: "JSON",
							success: function (data) {
									$("#form-tampil").modal('show');
									$(".modal-title").text("Detail Outlet");
									$(".btn-outline-secondary").text("Tutup");
									$(".btn-outline-primary").hide();

									// Disable Input
									$("#tnamaOutlet").prop('disabled', true);
									$("#tnoTelpon").prop('disabled', true);
									$("#talamat").prop('disabled', true);

									$('#id').val(data.id);
									$('#tnamaOutlet').val(data.nama);
									$('#tnoTelpon').val(data.tlp);
									$('#talamat').val(data.alamat);
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

			// Edit Data
			function update(id) {
					save_method = "edit";
					$('input[name=_method]').val('POST');
					$('#form-tampil form')[0].reset();

					$.ajax({
							url: "{{ url('outlet') }}" + '/' + id + '/edit',
							type: "GET",
							dataType: "JSON",
							success: function (data) {
									$('#form-tampil').modal('show');
									$('.modal-title').text('Edit Outlet');
									$(".btn-outline-primary").show();

									// Enable Input
									$("#tnamaOutlet").prop('disabled', false);
									$("#tnoTelpon").prop('disabled', false);
									$("#talamat").prop('disabled', false);

									$('#id').val(data.id);
									$('#tnamaOutlet').val(data.nama);
									$('#tnoTelpon').val(data.tlp);
									$('#talamat').val(data.alamat);
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

        // Hapus Data
        function destroy(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
  
            Swal.fire({
              title: 'Hapus!',
              text: "Outlet Dengan ID "+ id +"?",
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
                        url: "{{ url('outlet') }}" + '/' + id,
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