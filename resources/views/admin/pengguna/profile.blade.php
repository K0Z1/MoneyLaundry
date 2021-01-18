@extends('layouts.master')

@section('title')
	Profil {{ $data->nama }}
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
@stop

@section('content')
<section id="page-account-settings">
    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item">
                    <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill"
                        href="#account-vertical-general" aria-expanded="true">
                        <i class="icon-globe"></i>
                        Informasi Umum
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                        aria-expanded="false">
                        <i class="icon-lock"></i>
                        Ubah Kata Sandi
                    </a>
                </li>
            </ul>
        </div>
        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                aria-labelledby="account-pill-general" aria-expanded="true">
                                
					        <div class="col-12">
					          <table class="table table-borderless">
					            <tbody>
					              <tr>
					                <td>Nama Lengkap :</td>
					                <td class="users-view-username">{{ $data->nama }}</td>
					              </tr>
					              <tr>
					                <td>Username :</td>
					                <td class="users-view-name">{{ $data->username }}</td>
					              </tr>
					              <tr>
					                <td>Role :</td>
					                <td class="users-view-email">{{ $data->role }}</td>
					              </tr>
					            </tbody>
					          </table>
                              @if($totalTransaksi != '')
                              <div class="row rounded mb-2 mx-25 text-center text-lg-left">
                                  <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Total Outlet <br><span class="font-large-1 align-middle">{{ $totalOutlet }}</span></h6>
                                  </div>
                                  <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Total Transaksi <br><span class="font-large-1 align-middle">{{ $totalTransaksi }}</span></h6>
                                  </div>
                              </div>
                              @endif
                              @if($data->role == 'owner')
															<h5 class="mb-1"><i class="icon-layers"></i> Data Outlet Yang Dimiliki - {{ $data->nama }}</h5>
                              @else
                                  <h5 class="mb-1"><i class="icon-layers"></i> Data Outlet Kasir - {{ $data->nama }}</h5>
                              @endif
					          <table class="table table-borderless">
					            <tbody>
                                  @forelse($outlet as $dataO)
					              <tr>
					                <td class="text-primary">{{ $dataO->nama }}</td>
                                    <td>{{ $dataO->tlp }}</td>
					                <td>{{ $dataO->alamat }}</td>
					              </tr>
                                  @empty
                                  <tr>
                                    <td><b><i>Tidak Ada Data</i></b></td>
                                  </tr>
                                  @endforelse
					            </tbody>
					          </table>
					        </div>
                            </div>
                            <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                                aria-labelledby="account-pill-password" aria-expanded="false">
                                <div id="form-password">
                                    <form method="POST" action="{{ route('updatePw.pengguna', $data->id) }}" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-new-password">Kata Sandi Baru</label>
                                                    <input type="password" name="password"
                                                        class="form-control jq-bs-validation" placeholder="Kata Sandi Baru" required id="sandiBaru" 
                                                        data-validation-required-message="Kata Sandi Baru Harus Diisi"
                                                        minlength="8">
                                                        <br>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkPw" class="">
                                                            <label for="checkPw"> Tampilkan Sandi</label>
                                                        </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                            <button type="reset" class="btn btn-light">Reset</button>
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
</section>
@stop

@section('footer')
    <!-- Link -->
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>

    @if(Session::has('suksespw'))
    <script>
        toastr.success('Password Berhasil Diperbharui','Sukses');
    </script>
    @endif
    
    <!-- Custom -->
    <script>
        $(".jq-bs-validation").jqBootstrapValidation();

        $(document).ready(function() {
            $('#checkPw').click(function() {
                if($(this).is(':checked')){
                    $('#sandiBaru').attr('type', 'text');
                } else {
                    $('#sandiBaru').attr('type', 'password');
                }
            });
        });
    </script>
@stop