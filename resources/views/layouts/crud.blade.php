@extends('layouts.base')

@include('libs.datatable-custom')
@include('libs.actions')

@section('side-header')

@endsection

@section('body')
    <div class="panel panel-default">
        <div class="panel-body">
            @section('headerButton')
            <div class="row">
                <div class="col-sm-9">
                    <form id="dataFilters" class="form-inline" role="form">
                        @yield('filters')
                    </form>
                </div>
                <div class="col-sm-3 text-right">
                    @section('buttons')
                    <button class="btn m-b-xs btn-success btn-addon add button"><i class="fa fa-plus"></i>Add New</button>
                    @show
                </div>
            </div>
            @show
        </div>
        <div class="table-responsive">
            @if(isset($tableStruct))
            <table id="dataTable" class="table table-bordered m-t-none" style="width: 100%">
                <thead>
                    <tr>
                        @foreach ($tableStruct as $struct)
                            <th class="text-center">{{ $struct['label'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @yield('tableBody')
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var modal = '#mediumModal';
        var onShow = function(){};
        $(document).on('click', '.add-page.button', function(event) {
            var url = "{!! route($routes.'.create') !!}";
            window.location = url;
        });
        $(document).on('click', '.add.button', function(e){
            loadModal({
                url: "{!! route($routes.'.create') !!}",
                modal: modal,
            }, function(resp){
                $(modal).find('.loading.dimmer').hide();
                $('.selectpicker').selectpicker();
                onShow();
            });
        });

        $(document).on('click', '.edit.button', function(e){
            var idx = $(this).data('id');

            loadModal({
                url: "{!! route($routes.'.index') !!}/" + idx + '/edit',
                modal: modal,
            }, function(resp){
                $(modal).find('.loading.dimmer').hide();
                $('.selectpicker').selectpicker();
                onShow();
            });
        });

        $(document).on('click', '.others-modal.button', function(e){
            // var idx = $(this).data('id');
            var url = $(this).data('url');
            // console.log('url',url);
            loadModal({
                url: url,
                modal: modal,
            }, function(resp){
                $(modal).find('.loading.dimmer').hide();
                $('.selectpicker').selectpicker();
                onShow();
            });
        });


        $(document).on('click', '.save.button', function(e){
            saveData('formData', function(resp){
                $(modal).modal('hide');
                dt.draw(false);
            });
        });

        $(document).on('click', '.save-page.button', function(e){
            savePageData('formData', function(resp){
                $(modal).modal('hide');
                dt.draw(false);
            });
        });

        $(document).on('click', '.delete.button', function(e){
            var idx = $(this).data('id');
            console.log('sad',$(this).data('url'))
            var url = '{!! route($routes.'.index') !!}/' + idx;
            if($(this).data('url')){
                url = $(this).data('url');
            }
            deleteData(url,function(resp){
                dt.draw(false);
            });
        });

        $(document).on('submit', '#formData', function(e){
            e.preventDefault();

            $('.save.button').trigger('click');
        });

        $(document).on('click', '.approve.button', function(e){
            swal({
                title: "Approve Data",
                text: "Are you sure want to approve this data?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                reverseButtons: true,
                cancelButtonText: 'No'
            }).then((result) => {
                if (result) {
                    swal(
                    'Successfully!',
                    'Status Has Been Approved.',
                    'success'
                    )
                }
            })
        });

        $(document).on('click', '.un-approve.button', function(e){
            swal({
                title: "Close Data",
                text: "Are you sure want to close this data?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                reverseButtons: true,
                cancelButtonText: 'No'
            }).then((result) => {
                if (result) {
                    swal(
                    'Successfully!',
                    'Status Has Been Closed.',
                    'success'
                    )
                }
            })
        })
    </script>

    @yield('js-extra')
@endpush