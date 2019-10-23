<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Dashboard Travoy</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="description" content="peta padam, petapadam, up2d, kalbar, kalimantan barat, kalimantanbarat" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" type="image/png" href="{{ secure_asset('img/icon.png') }}"/>
  <link rel="stylesheet" href="{{ secure_asset('libs/assets/animate.css/animate.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ secure_asset('libs/assets/font-awesome/css/font-awesome.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ secure_asset('libs/assets/simple-line-icons/css/simple-line-icons.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ secure_asset('libs/jquery/bootstrap/dist/css/bootstrap.css') }}" type="text/css" />

  <link rel="stylesheet" href="{{ secure_asset('src/css/font.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ secure_asset('src/css/app.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ secure_asset('css/aside-fix.css') }}" type="text/css" />

  <style type="text/css">
    .app-aside-footer .navi > ul > li > ul {
      top: auto!important;
      bottom: -3.75rem!important;
    }
  </style>

  @stack('css')

  @stack('styles')
</head>
<body>

<div class="app app-aside-folded app-aside-fixed">
{{-- <div class="app app-header-fixed app-aside-folded"> --}}
  <!-- header -->
  @include('partials.header')
  <!-- / header -->

  <!-- aside -->
  @include('partials.sidebar')
  <!-- / aside -->

  <!-- content -->
  @yield('content')
  <!-- /content -->

  <!-- footer -->
  <div class="maximize hidden"><!-- settings -->
    <button class="btn btn-default no-shadow pos-abt">
      <i class="fa fa-chevron-down animated fadeInDown infinite"></i>
    </button>
  </div>
  <!-- / footer -->
</div>

@stack('modals')

<script src="{{ secure_asset('libs/jquery/jquery/dist/jquery.js') }}"></script>
<script src="{{ secure_asset('libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ secure_asset('libs/jquery/redirect/jquery.redirect.js') }}"></script>
<script src="{{ secure_asset('libs/assets/chartjs/Chart.bundle.js') }}"></script>
<script src="{{ secure_asset('libs/assets/chartjs/utils.js') }}"></script>
<script src="{{ secure_asset('src/js/ui-load.js') }}"></script>
<script src="{{ secure_asset('src/js/ui-jp.config.js') }}"></script>
<script src="{{ secure_asset('src/js/ui-jp.js') }}"></script>
<script src="{{ secure_asset('src/js/ui-nav.js') }}"></script>
<script src="{{ secure_asset('src/js/ui-toggle.js') }}"></script>
<script src="{{ secure_asset('src/js/ui-client.js') }}"></script>
<script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>


@stack('js')

<script>
  $(document).ready(function($) {
    $('.minimize').trigger('click');
  });

  $(document).on('click', '.minimize', function(e) {
    $('.maximize').toggleClass('hidden');
    $('header.navbar').fadeOut(500);
    $('.app-content-full').animate({
      top: "-=50"
    }, 500);
  });

  $(document).on('click', '.maximize', function(e) {
    $('.maximize').toggleClass('hidden');
    $('header.navbar').fadeIn(500);
    $('.app-content-full').animate({
      top: "+=50"
    }, 500);
  });

  $(document).on('click', '.logout', function(e){
    $.redirect("{{ route('logout') }}", { _token: "{{ csrf_token() }}" })
  });
</script>

@stack('scripts')

</body>
</html>
