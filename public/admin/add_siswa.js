
// Load Data From Ajax to Basic Select
function loadBasicSelect()
{

  
  var link_show   = BASE_URL+`api/kelas/show/${token}`

  $.ajax({
    url: link_show,
    type: 'GET',
    dataType: 'JSON',
    beforeSend: function(){
      $('#kelas').html('<option value="">-- Pilih Kelas --</option>');
    },
    success: function(response){
      var html = `<option value="">-- Pilih Kelas --</option>`;

      $.each(response.data, function(k, v){

          html += `<option value="${v.kelas}">${v.kelas}</option>`;

      });

      $('#kelas').html(html);

    },
    error: function(){
      Swal.fire({
         type: 'warning',
         title: 'Tidak dapat mengakses server ...',
         showConfirmButton: false,
         timer: 2000
        })
    }
  });
}
  $(document).ready(function() {
    loadBasicSelect()

    const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });


    var link_add    = BASE_URL+'api/siswa/add/'+token

    // Ajax Add Kapel
    $('#form_addsiswa').on('submit',function(e){
      e.preventDefault();

      var nis           = $('#nis').val()
      var nama_siswa    = $('#nama_siswa').val()
      var jkel          = $('#jkel').val()
      var tempat_lahir  = $('#tempat_lahir').val()
      var tgl_lahir     = $('#tgl_lahir').val()
      var kelas         = $('#kelas').val()
      var tahun_ajaran  = $('#tahun_ajaran').val()
      var nama_wali     = $('#nama_wali').val()
      var email         = $('#email').val()
      var telepon       = $('#telepon').val()
      var alamat        = $('#alamat').val()
      var foto          = $('#foto').val()


      // if (jQuery.inArray(foto,['png','jpg','jpeg']) == -1) {
      //   alert('File tidak ditemukan')
      //   $('#foto').val('')
      //   return false;
      // .split('.').pop().toLowerCase();
      // }

      if (nis === '' || nama_siswa === '' ||jkel === '' ||tempat_lahir === '' ||tgl_lahir === '' ||kelas === '' ||tahun_ajaran === '' ||nama_wali === '' ||email === '' ||telepon === '' ||alamat === '' || foto === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
      }else {
        $.ajax({
          url: link_add,
          type: 'POST',
          dataType: 'JSON',
          data: new FormData(this),
          processData:false,
          contentType:false,
          beforeSend:function(){
            $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah <i class="fas fa-spinner fa-spin"></i></span>')

          },
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
              location.hash='#/siswa'
            }else {
                Toast.fire({
                  type: 'error',
                  title: response.message,
                })
                $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
            }
          },
          error:function(){
            Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })
              $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
          }
        });
      }
    })


    $('#tgl_lahir').datepicker({
      dateFormat:"yy-mm-dd"
    });

  });
