@extends('layouts.master')

@section('title','Cari Laporan')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            	<div class="float-right ml-1">
            		<button onclick="tampilForm();" class="btn btn-block btn-primary glow"><i class="fa fa-search pr-1"></i> Cari</button>
            	</div>
            	<div class="float-right">
                    <div class="btn-group">
		              <button class="btn btn-primary" style="height: 40px;" type="button"><i class="fa fa-file-o pr-1"></i> Export</button>
		              <button class="btn btn-primary dropdown-toggle" style="height: 40px;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Export</span></button>
		              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(113px, 41px, 0px);">
		              	<a class="dropdown-item" href="{{ route('export.excel') }}">Excel</a>
		              	<a class="dropdown-item" href="{{ route('export.pdf') }}">PDF</a>
                    <!-- <div class="dropdown-divider"></div>
		              	<a class="dropdown-item" href="#">Print</a> 
                    Coming Soon! >_!
                    -->
		              </div>
		            </div>
            	</div>
                <h4 class="card-title">Laporan</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div id="results" class="">
                      <table id="data-laporan" class="table" style="width: 100%;">
                        <thead class="border-bottom border-dark">
                          <tr>
                            <th>No</th>
                            <th>Kode Invoice</th>
                            <th>Nama Pelanggan</th>
                            <th>Telpon Pelanggan</th>
                            <th>Outlet</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                          </tr>
                        </thead>
                        <tbody>
												@forelse($cari as $data)
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td><a href="{{ route('transaksi.show',$data->id) }}">{{ $data->kode_invoice }}</a></td>
													<td>{{ $data->pelanggan->nama }}</td>
													<td>{{ $data->pelanggan->tlp }}</td>
													<td>{{ $data->outlet->nama }}</td>
													<td>{{ ucwords($data->status) }}</td>
													<td>{{ $data->tanggal() }}</td>
												</tr>
												@empty
												<tr>
													<td colspan="7"><i><b>Tidak Ada Data</b></i></td>
												</tr>
												@endforelse
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include -->
@include('layouts.modals._laporan')
@stop

@section('footer')
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/pages/app-invoice.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.min.js')}}"></script>

<script>
  $('#data-laporan').DataTable();
</script>

<!-- Ajax -->
<script>
		  // Tampil Form
      function tampilForm() {
          $('#form-cari').modal('show');
          $('#form-cari form')[0].reset();
      }
</script>
@stop