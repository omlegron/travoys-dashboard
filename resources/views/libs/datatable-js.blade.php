<script type="text/javascript">
    $(document).ready(function() {
        /* datatable kebutuhan khusus */
        createDatatable = function(tableId, param){
            // option base
            var ops = {
                dom: 'rt<"bottom"ip><"clear">',
                responsive: false,
                autoWidth: false,
                processing: false,
                serverSide: true,
                lengthChange: false,
                pageLength: 10,
                paging:false,
                info:false,
                filter: false,
                sorting: [],
                language: {
                    // url: "{/{ asset('plugins/datatables/Indonesian.json') }}"
                },
                ajax:  {
                    url     : (typeof param['url'] !== 'undefined') ? param['url'] : "/grid",
                    type    : 'POST',
                    data    : (typeof param['filter'] !== 'undefined') ? param['filter'] : function (d) {d._token = "{{ csrf_token() }}";},
                }, 
                drawCallback: function() {
                    // var api = this.api();
                    // api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i, x, y) {
                    //     cell.innerHTML = parseInt(cell.innerHTML)+i+1;
                    //     // cell.innerHTML = i+1;
                    // } );

                    // $('[data-content]').popup({
                    //     hoverable: true,
                    //     position : 'top center',
                    //     delay: {
                    //         show: 300,
                    //         hide: 800
                    //     }
                    // });
                }
            }

            $.extend(ops, param)

            dtable = $(tableId).DataTable(ops)

            $(tableId).on( 'error.dt', function ( e, settings, techNote, message ) {
                console.log( 'An error has been reported by DataTables: ', message );
            })

            return dtable
        }
    });
</script>