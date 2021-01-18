@extends('layouts.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
@stop

@section('content')
<div class="row grouped-multiple-statistics-card">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon primary d-flex justify-content-center mr-3">
                <i class="icon p-1 icon-login customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">{{ $totalTransaksiBaru }}</h3>
                <p class="sub-heading">Transaksi Baru</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon danger d-flex justify-content-center mr-3">
                <i class="icon p-1 icon-pin customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">{{ $totalTransaksiProses }}</h3>
                <p class="sub-heading">Transaksi Diproses</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
              <span class="card-icon success d-flex justify-content-center mr-3">
                <i class="icon p-1 icon-check customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">{{ $totalTransaksiSelesai }}</h3>
                <p class="sub-heading">Transaksi Selesai</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start">
              <span class="card-icon warning d-flex justify-content-center mr-3">
                <i class="icon p-1 icon-user-following customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">{{ $totalTransaksiDiambil }}</h3>
                <p class="sub-heading">Transaksi Diambil</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card" style="height: 386.75px; zoom: 1;">
            <div class="card-header">
                <h4 class="card-title">Transaksi Terbaru</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="fa fa-repeat"></i></a></li>
                        <li><a data-action="expand"><i class="icon-frame"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p>{{ $totalTransaksiBaru }} Transaksi Baru. <span class="float-right"><a href="{{ route('transaksi.index') }}" target="_blank">Semua Transaksi <i class="icon-arrow-right"></i></a></span></p>
                </div>
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                        <thead>
                            <tr>
                                <th>Outlet</th>
                                <th>Kode Invoice</th>
                                <th>Nama Pelanggan</th>
                                <!-- <th>Status</th> -->
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse($transaksi as $data)
                            <tr>
                                <td class="text-truncate">{{ $data->outlet->nama }}</td>
                                <td class="text-truncate"><a href="/transaksi/{{ $data->id }}" target="_blank">{{ $data->kode_invoice }}</a></td>
                                <td class="text-truncate">{{ $data->pelanggan->nama }}</td>
                                {{-- <td class="text-truncate"><span class="badge badge-info">{{ $data->status }}</span></td> --}}
                                <td class="text-truncate">{{ date('d/m/Y', strtotime($data->tgl)) }}</td>
                            </tr>
                          @empty
                          <tr>
                            <td colspan="5"><b><i>Tidak Ada Transaksi</i></b></td>
                          </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card" style="height: 386.75px;">
            <div class="card-content">
                <div class="card-body sales-growth-chart">
                    <div id="monthly-sales" class="height-250" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="250" version="1.1" width="290.859" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.9375px; top: -0.6875px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.3.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="42.859375" y="211" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#e4e7ed" d="M55.359375,211.5H265.859" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="42.859375" y="164.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">750</tspan></text><path fill="none" stroke="#e4e7ed" d="M55.359375,164.5H265.859" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="42.859375" y="118" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,500</tspan></text><path fill="none" stroke="#e4e7ed" d="M55.359375,118.5H265.859" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="42.859375" y="71.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2,250</tspan></text><path fill="none" stroke="#e4e7ed" d="M55.359375,71.5H265.859" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="42.859375" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">3,000</tspan></text><path fill="none" stroke="#e4e7ed" d="M55.359375,25.5H265.859" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="257.0881822916666" y="223.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Dec</tspan></text><text x="169.38000520833333" y="223.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Jul</tspan></text><text x="99.21346354166667" y="223.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Mar</tspan></text><rect x="61.49894739583333" y="97.23" width="5.262490624999999" height="113.77" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="79.04058281249999" y="64.928" width="5.262490624999999" height="146.072" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="96.58221822916667" y="120.542" width="5.262490624999999" height="90.458" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="114.12385364583332" y="131.082" width="5.262490624999999" height="79.918" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="131.6654890625" y="108.886" width="5.262490624999999" height="102.114" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="149.20712447916668" y="77.328" width="5.262490624999999" height="133.672" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="166.74875989583333" y="97.23" width="5.262490624999999" height="113.77" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="184.29039531249998" y="64.928" width="5.262490624999999" height="146.072" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="201.83203072916666" y="120.542" width="5.262490624999999" height="90.458" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="219.37366614583334" y="131.082" width="5.262490624999999" height="79.918" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="236.9153015625" y="108.886" width="5.262490624999999" height="102.114" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="254.45693697916664" y="77.328" width="5.262490624999999" height="133.672" rx="0" ry="0" fill="#00b5b8" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg><div class="morris-hover morris-default-style" style="display: none;"></div></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="chart-title mb-1 text-center">
                    <h6>Total monthly Sales.</h6>
                </div>
                <div class="chart-stats text-center">
                    <a href="#" class="btn btn-sm btn-primary mr-1">Statistics <i class="feather icon-bar-chart"></i></a> <span class="text-muted">for the last year.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
  <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
	
	@if(Session::has('selamatdatang'))
	<script>
		toastr.info('{{ auth()->user()->nama }}','Selamat Datang Kembali!');
	</script>
	@endif

  @if(Session::has('suksespw'))
  <script>
		toastr.success('Password Berhasil Diperbharui','Sukses');
  </script>
  @endif
@stop
