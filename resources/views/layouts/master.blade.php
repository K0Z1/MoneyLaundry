<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Laundry - @yield('title')</title>


	<!-- Core CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/card-statistics.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/vertical-timeline.min.css')}}">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/style.css')}}">

	@yield('css')

</head>
<body class="vertical-layout vertical-menu-modern 2-columns  fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- Navbar -->
    @include('layouts.includes._navbar')

    <!-- Sidebar -->
    @include('layouts.includes._sidebar')


    <!-- Content -->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

                @yield('content')

        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">
        Copyright © <script>document.write(new Date().getFullYear());</script> Dikembangkan Oleh - Fauzi Rahman
      </span></p>
    </footer>


    <!-- Core JS -->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.min.js')}}"></script>
    
    @yield('footer')

</body>
</html>