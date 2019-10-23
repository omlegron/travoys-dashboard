@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('libs/jquery/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js') }}"></script>
@endpush

@push('styles')
    <style>
        .panel .dataTables_wrapper{
            padding-top: 0 !important;
        }
        table.dataTable{
            margin-top: 0 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        var dt = null;
        
        $(function() {
            dt = $('#dataTable').DataTable({
                lengthChange: false,
                filter: false,
                processing: true,
                serverSide: true,
                sorting: [],
                ajax: {
                    url: '{!! route($routes.'.grid') !!}',
                    method: 'POST',
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        $('#dataFilters .filter-control').each(function(idx, el) {
                            var name = $(el).data('post');
                            var val = $(el).val();
                            d[name] = val;
                        })
                    }
                },
                columns: {!! json_encode($tableStruct) !!},
                drawCallback: function() {
                    var api = this.api();

                    if(!$(this).hasClass('unnumbered')){
                        api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i, x, y) {
                            cell.innerHTML = parseInt(cell.innerHTML)+i+1;
                        });
                    }

                    $('[data-toggle=popover]').popover({
                        trigger: 'hover',
                        placement: 'top',
                        template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content"></div></div>'
                    });
                    
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });

            $('select[name="filter[page]"]').on('change', function(e) {
                var length = this.value;
                length = (length != '') ? length : 10;
                dt.page.len(length).draw();
                e.preventDefault();
            });

            $('.filter.button').on('click', function(e) {
                dt.draw();
                e.preventDefault();
            });

            $('.filter-control').on('change, keyup', function(e) {
                dt.draw();
                e.preventDefault();
            });

            $('.filter-control').on('changed.bs.select', function(e) {
                dt.draw();
                e.preventDefault();
            });

            $('.reset.button').on('click', function(e) {
                $('.ui.dropdown').dropdown('clear');
                setTimeout(function() {
                    dt.draw();
                }, 200);
            });
        });
    </script>
@endpush