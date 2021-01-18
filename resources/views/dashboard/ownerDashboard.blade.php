@extends('layouts.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/project.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
@stop

@section('content')
<section class="row">
  <div class="col-md-12">
      <div class="card">
        <div class="card-head">
            <div class="card-header">
              <h4 class="card-title">Laporan Bulan - {{ $bulan }}</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                  <span class="badge badge-info">{{ $tanggal }}</span>
              </div>
            </div>
        </div>
        <!-- project-info -->
        <div id="project-info" class="card-body row">
            <div class="project-info-count col-lg-4 col-md-12">
              <!-- Coming Soon! >_! -->
            </div>
            <div class="project-info-count col-lg-4 col-md-12">
              <div class="project-info-icon">
                  <h2>{{ $laporan }}</h2>
                  <div class="project-info-sub-icon">
                    <span class="fa fa-calendar-check-o"></span>
                  </div>
              </div>
              <div class="project-info-text pt-1">
                  <h5>Total Laporan</h5>
              </div>
            </div>
            <div class="project-info-count col-lg-4 col-md-12">
              <!-- Coming Soon! >_! -->
            </div>
        </div>
        <!-- project-info -->
        <div class="card-body">
            <div class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
              <span>Status Transaksi</span>
            </div>
            <div class="row grouped-multiple-statistics-card">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                          <span class="card-icon primary d-flex justify-content-center mr-3">
                            <i class="icon p-1 icon-note customize-icon font-large-2 p-1"></i>
                          </span>
                          <div class="stats-amount mr-3">
                            <h3 class="heading-text text-bold-600">{{ $baru }}</h3>
                            <p class="sub-heading">Baru</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                          <span class="card-icon danger d-flex justify-content-center mr-3">
                            <i class="icon p-1 icon-refresh customize-icon font-large-2 p-1"></i>
                          </span>
                          <div class="stats-amount mr-3">
                            <h3 class="heading-text text-bold-600">{{ $proses }}</h3>
                            <p class="sub-heading">Proses</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                          <span class="card-icon success d-flex justify-content-center mr-3">
                            <i class="icon p-1 icon-bag customize-icon font-large-2 p-1"></i>
                          </span>
                          <div class="stats-amount mr-3">
                            <h3 class="heading-text text-bold-600">{{ $selesai }}</h3>
                            <p class="sub-heading">Selesai</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start">
                          <span class="card-icon warning d-flex justify-content-center mr-3">
                            <i class="icon p-1 icon-user-following customize-icon font-large-2 p-1"></i>
                          </span>
                          <div class="stats-amount mr-3">
                            <h3 class="heading-text text-bold-600">{{ $diambil }}</h3>
                            <p class="sub-heading">Diambil</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</section>
@stop

@section('footer')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/pages/project-summary.min.js')}}"></script>
	
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
