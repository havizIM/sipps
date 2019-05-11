
// Load Data From Ajax to Basic Select
function loadBasicSelect()
{
  var link_show   = BASE_URL+`api/user/show/${token}?level=Wali`

  $.ajax({
    url: link_show,
    type: 'GET',
    dataType: 'JSON',
    beforeSend: function(){
      $('#nip').html('<option value="">-- Pilih User --</option>');
    },
    success: function(response){
      var html = `<option value="">-- Pilih User --</option>`;

      $.each(response.data, function(k, v){

          html += `<option value="${v.nip}">${v.nama}</option>`;

      });

      $('#nip').html(html);

    },
    error: function(){
      alert('Tidak dapat mengakses server')
    }
  });
}

  $(document).ready(function() {

    loadBasicSelect();

    const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });


    var link_add    = BASE_URL+'api/kelas/add/'+token


    // Ajax Add Kapel
    $('#form_addkelas').on('submit',function(e){
      e.preventDefault();

      var kelas = $('#kelas').val()
      var nip = $('#nip').val()
      // alert(kelas)
      // alert(nip)

      if (kelas === '' || nip === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
      }else {
        $.ajax({
          url: link_add,
          type: 'POST',
          dataType: 'JSON',
          data: $('#form_addkelas').serialize(),
          beforeSend:function(){
              $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah <i class="fas fa-spinner fa-spin"></i></span>')
          },
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
              location.hash='#/kelas'
            }else {
                Toast.fire({
                  type: 'error',
                  title: response.message,
                })
                $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah </span>')
            }
            $('#form_addkelas')[0].reset();
          },
          error:function(){
            Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })
              $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah </span>')
          }
        });
      }
    })
  });
