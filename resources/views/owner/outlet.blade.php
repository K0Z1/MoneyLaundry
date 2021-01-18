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
                                <th>Telpon</th>
                                <th>Alamat</th>
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
   
    <script>
        // Data Table
    	var table = $('#data-outlet').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('json.outlet.owner') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'tlp', name: 'tlp'},
                    {data: 'alamat', name: 'alamat', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 }
                 ]
            });
    </script>
@stop