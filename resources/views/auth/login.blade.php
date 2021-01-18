<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Laundry</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">  
	<!-- Sweetalert CSS-->
	<link rel="stylesheet" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
	<!-- Custom Styles -->
	<link rel="stylesheet" href="{{ asset('app-assets/css/signin.css') }}">
</head>
<body class="text-center">
	<main class="form-signin">
  <form method="POST" action="{{ route('post.login') }}">
	@csrf
    <img class="mb-4" src="{{ asset('app-assets/images/avatar/user.png') }}" alt="" width="100" height="100">
    <h1 class="h3 mb-3">Login Money Laundry</h1>
    <input type="text" id="username" class="form-control" name="username" placeholder="Username" required autofocus>
    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
    <div class="checkbox mb-2">
      <label>
        <input type="checkbox" id="checkPw" class=""> Tampilkan Password
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy;<script>document.write(new Date().getFullYear());</script> <b>Money Laundry</b></p>
  </form>
</main>

    <!-- Core JS -->
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
		<script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>

    <!-- Show Password -->
    <script>
        $(document).ready(function() {
            $('#checkPw').click(function() {
                if($(this).is(':checked')){
										$('#password').attr('type', 'text');
										$('#password').css('margin-bottom', '10px')
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>

    <!-- alert -->
    <script>
    @if(Session::has('gagal'))
        Swal.fire({
          title: 'Error!',
          text: 'Nama Pengguna Atau Kata Sandi Salah',
          type: 'error',
          timer: 3000,
          confirmButtonText: 'Oke'
        });   
    @endif
    </script>

</body>
</html>
