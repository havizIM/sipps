
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

    var kelas       = location.hash.substr(13);
    var link_edit   = BASE_URL+`api/kelas/edit/${token}?kelas=${kelas}`
    var link_show   = BASE_URL+`api/kelas/show/${token}?kelas=${kelas}`
    // alert(link_edit)

    // Show value edit
    $.ajax({
      url: link_show,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $.each(response.data,function(k,v){
          $('#kelas').val(v.kelas)
          $('#nip').val(v.nip)
        })
        // console.log(response);
      },
      error:function(){
        Swal.fire({
             type: 'warning',
             title: 'Tidak dapat mengakses server ...',
             showConfirmButton: false,
             timer: 2000
            })
      }
    });

    // Ajax Edit Kelas
    $('#form_editkelas').on('submit',function(e){
      e.preventDefault();

      var wali = $('#nip').val()

      if (wali === '') {
        Toast.fire({
            type: 'warning',
            title: 'Data tidak boleh kosong ...',
          })
      }else {
        $.ajax({
          url: link_edit,
          type: 'POST',
          dataType: 'JSON',
          data: $('#form_editkelas').serialize(),
          beforeSend:function(){
            $('#btn_simpan').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan <i class="fas fa-spinner fa-spin"></i></span>')
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
              $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
            }
          },
          error:function(){
            Swal.fire({
             type: 'warning',
             title: 'Tidak dapat mengakses server ...',
             showConfirmButton: false,
             timer: 2000
            })
            $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
          }
        });

      }
    })

  });
