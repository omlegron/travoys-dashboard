<script src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        // console.log('djancok',$('select[name="event_id"]').val());
        $.ajax({
        url: '{{ url($pageUrl) }}/post-scan',
        type: 'POST',
        data: {_token: "{{ csrf_token() }}", _method: "POST",trans_id:$('input[name="trans_id"]').val(), barcode:content},
        success: function(resp){
          swal(
            'Tersimpan!',
            'Data Berhasil Di Simpan.',
            'success'
            );
            dt.draw();
          },
          error : function(resp){
            if(resp.responseJSON.message.length > 0){
              swal(
                'Gagal!',
                ''+resp.responseJSON.message,
                'error'
              )
              dt.draw();
            }else{
              swal(
                'Gagal!',
                'Data gagal disimpan',
                'error'
                )
              dt.draw();
            }
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