<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Dashboard Travoy</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}"/>
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="{{ asset('src/css/font.css') }}">
  <link rel="stylesheet" href="{{ asset('src/css/login/app.css') }}">
  <link rel="stylesheet" href="{{ asset('src/css/login/login.css') }}">

  <meta name="theme-color" content="#fafafa">
</head>

<body id="aa">

  <div class="w-100 h-100">
    <div class="row mx-0 h-100 align-items-center">

      <div class="d-none d-lg-flex col-lg-6 px-0">
        <div class="w-75 px-4 ml-auto mr-5 text-right">
          <img src="{{ asset('img/icon-large.png') }}" alt="Main Icon" width="500">
          <!-- <h1 class="text-white">Dashboard Travoy</h1> -->
          <hr class="my-5">
          <h1 class="text-white">
            <center><strong>Dashboard Travoy</strong></center>
          </h1>
        </div>

        <div class="footer px-5 py-3 text-white w-50 text-right" style="left: -1rem">
          {{-- <a href="#">Terms of Use</a> · <a href="#">Privacy policy</a> --}}
        </div>
      </div>

      <div class="col-12 col-lg-6 px-0 h-100 bg-white d-flex">
        @yield('content')
      </div>
    </div>
  </div>

  <script src="{{ asset('src/js/jquery-3.3.1.slim.min.js') }}"></script>
  <script src="{{ asset('src/js/popper.min.js') }}"></script>
</body>

</html>
