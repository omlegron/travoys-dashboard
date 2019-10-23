<!DOCTYPE html>
<html>
<title>PRINT Grafik</title>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('libs/jquery/bootstrap/dist/css/bootstrap.css') }}" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('src/css/app.css') }}" type="text/css" /> --}}
    <style>

      @media print
      {
          #non-printable { display: none; }
      }

      .canvas-con-inner, .legend-con {
          display: inline-block;
      }

      .legend-con {
          font-family: Roboto;
          display: inline-block;
      }
      .legend-con ul, ul.legend-con {
          list-style: none;
          padding-left: 10px;
      }

      .legend-con li {
          display: flex;
          align-items: center;
          margin-bottom: 4px;
      }

      .legend-con li span {
          display: inline-block;
          font-family:'Questrial';
      }

      .legend-con li span.chart-legend {
          width: 25px;
          height: 35px;
          margin-right: 10px;
      }
      .legend-con li span.chart-legend-sm {
          width: 25px;
          height: 15px;
          margin-right: 10px;
      }
    </style> 

</head>

<body>
    <div id="non-printable" class="navbar navbar-default">
      <div class="col-md-12">
        {{-- <a class="btn btn-default" href="{{ url('infografis-page') }}" id="cetak" style="margin-top: 5px;">
          Kembali Kehalaman Utama
        </a> --}}
        <button class="btn btn-success" type="button" id="cetak" style="margin-top: 5px;">
          Cetak PDF
        </button>
      </div>
    </div>
    <div class="col-md-12" id="printable">
      @yield('content')
    </div>
</body>
    <script src="{{ asset('libs/jquery/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('libs/assets/chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('libs/assets/chartjs/utils.js') }}"></script>
    <script src="{{ asset('src/js/ui-nav.js') }}"></script>
    <script src="{{ asset('libs/assets/chartjs/utils.js') }}"></script>
    <script src="{{ asset('libs/pdf/jquery.media.js') }}"></script>
    <script src="{{ asset('libs/assets/chartjs/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('js/gauge.min.js') }}"></script>
    <script>
      $(document).ready(function($) {
        $("#cetak").bind("click", function(event) {
          // alert('tara');
          window.print();
        });
      });
    </script> 
    @yield('scripts')
</html>