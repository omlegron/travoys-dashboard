@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('libs/assets/bootstrap-select/bootstrap-select.min.css') }}" type="text/css" />
    <style type="text/css">
        .navbar-brand {
            margin-top: 15px;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('libs/assets/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('libs/jquery/redirect/jquery.redirect.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endpush

@section('content')

<div id="content" class="app-content" role="main">
    <div class="app-content-body app-content-full">
        <div class="hbox hbox-auto-xs hbox-auto-sm" >
            <!-- main -->
            @yield('body')
            <!-- / main -->
        </div>
    </div>
</div>
@endsection

@push('modals')
    <!-- Large modal -->
    <div id="largeModal" class="modal fade form-modal-lg" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="loading dimmer padder-v">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Standar modal -->
    <div id="mediumModal" class="modal fade form-modal-md" tabindex="-1" role="dialog" aria-labelledby="mediumModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="loading dimmer padder-v">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Small modal -->
    <div id="smallModal" class="modal fade form-modal-sm" tabindex="-1" role="dialog" aria-labelledby="smallModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="loading dimmer padder-v">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>
@endpush