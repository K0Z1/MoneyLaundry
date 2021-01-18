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
    <div class="col-xl-12 col-lg-12">
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
