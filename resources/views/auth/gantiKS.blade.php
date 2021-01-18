<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  
<head>
    <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ganti Kata Sandi | Laundry</title>

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/login-register.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/style.css')}}">
  </head>
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="content-wrapper">
			<div class="content-header row">
			</div>
			<div class="content-body">
					<section class="row flexbox-container">
							<div class="col-12 d-flex align-items-center justify-content-center">
									<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
											<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
													<div class="card-header border-0">
															<div class="card-title text-center">
																	Ganti Kata Sandi
															</div>
													</div>
													<div class="card-content">
															<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Masukkan Kata Sandi Lama Dan Baru</span></p>
															<div class="card-body">
																	<form class="form-horizontal" method="POST" action="{{ route('pengguna.gantiPw', $data->id) }}">
																			@csrf
																			<fieldset class="form-group position-relative has-icon-left {{$errors->has('sandiLama') ? ' has-error' : ''}}">
																					<input type="password" class="form-control" name="sandiLama" id="sandiLama" placeholder="Masukkan Kata Sandi Lama" required value="{{ old('sandiLama') }}">
																					<div class="form-control-position">
																							<i class="fa fa-key"></i>
																					</div>

																					@if($errors->has('sandiLama'))
																							<span class="help-block text-danger">Sandi Lama Harus Diisi!</span>
																					@endif
																			</fieldset>

																			<fieldset class="form-group position-relative has-icon-left {{$errors->has('sandiBaru') ? ' has-error' : ''}}">
																					<input type="password" class="form-control" name="sandiBaru" id="sandiBaru" placeholder="Masukkan Kata Sandi Baru" required>
																					<div class="form-control-position">
																							<i class="fa fa-key"></i>
																					</div>

																					@if($errors->has('sandiBaru'))
																							<span class="help-block text-danger">Sandi Baru Minimal 8 Karakter!</span>
																					@endif
																			</fieldset>
																			<div class="form-group row">
																					<div class="col-sm-6 col-12 text-center text-sm-left pr-0">
																							<fieldset>
																									<input type="checkbox" id="checkPw" class="">
																									<label for="checkPw"> Tampilkan Sandi</label>
																							</fieldset>
																					</div>
																			</div>
																			<button type="submit" class="btn btn-outline-primary btn-block">
																					<i class="icon-unlock"></i> Simpan</button>
																	</form>
																	<a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-block mt-1">
																					<i class="icon-unlock"></i> Batal</a>
															</div>
															<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>
																	Copyright © <script>document.write(new Date().getFullYear());</script> Dikembangkan Oleh - Fauzi Rahman
															</span>
													</p>
													</div>
											</div>
									</div>
							</div>
					</section>
			</div>
		</div>
	</div>


	<!-- Core JS -->
	<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
	<script src="{{asset('app-assets/js/core/app-menu.min.js')}}"></script>
	<script src="{{asset('app-assets/js/core/app.min.js')}}"></script>
	<script src="{{asset('app-assets/js/scripts/forms/form-login-register.min.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>

	<!-- Show Password  Baru-->
	<script>
			$(document).ready(function() {
					$('#checkPw').click(function() {
							if($(this).is(':checked')){
									$('#sandiLama').attr('type', 'text');
									$('#sandiBaru').attr('type', 'text');
							} else {
									$('#sandiLama').attr('type', 'password');
									$('#sandiBaru').attr('type', 'password');
							}
					});
			});
	</script>
	
	<!-- alert -->
	<script>
	@if(Session::has('error'))
			Swal.fire({
				title: 'Error!',
				text: 'Kata Sandi Lama Tidak Sesuai!',
				type: 'error',
				timer: 4000,
				confirmButtonText: 'Oke'
			});   
	@endif
	</script>

</body>
</html>