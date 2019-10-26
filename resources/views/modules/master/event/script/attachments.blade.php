<script type="text/javascript">
     $(document)
        .on('click', '.ui.file.input input:text, .ui.button', function(e) {
            console.log('asd')
            $(e.target).parent().find('input:file').click();
        })
        ;

        $(document)
        .on('change', '.ui.file.input input:file', function(e) {
            console.log('change')
            var file = $(e.target);
            var name = '';

            for (var i=0; i<e.target.files.length; i++) {
              name += e.target.files[i].name + ', ';
          }
                    // remove trailing ","
                    name = name.replace(/,\s*$/, '');
                    console.log(name);

                    $('input:text', file.parent()).val(name);
                })
        ;
</script>