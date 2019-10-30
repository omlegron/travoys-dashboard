<script src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        // console.log('djancok',$('select[name="event_id"]').val());
        $.ajax({
        url: '{{ url($pageUrl) }}/post-scan',
        type: 'POST',
        data: {_token: "{{ csrf_token() }}", _method: "POST",event:$('select[name="event_id"]').val(), scan:content},
        success: function(resp){
          swal(
            'Tersimpan!',
            'Data Berhasil Di Simpan.',
            'success'
            );
          },
          error : function(resp){
            swal(
              'Gagal!',
              'Data gagal disimpan',
              'error'
              )
            }
        });
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
</script>