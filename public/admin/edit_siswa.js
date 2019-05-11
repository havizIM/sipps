
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
      alert('Tidak dapat mengakses server')
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


    var nis         = location.hash.substr(13);
    var link_get    = BASE_URL+`api/siswa/show/${token}?nis=${nis}`;
    var link_edit   = BASE_URL+`api/siswa/edit/${token}?nis=${nis}`;

    $.ajax({
      url: link_get,
      type: 'GET',
      dataType: 'JSON',
      success: function(response){
        $.each(response.data, function(k, v){
          $('#nama_siswa').val(v.nama_siswa)
          $('#jkel').val(v.jenis_kelamin)
          $('#tempat_lahir').val(v.tempat_lahir)
          $('#tgl_lahir').val(v.tgl_lahir)
          $('#kelas').val(v.kelas)
          $('#tahun_ajaran').val(v.tahun_ajaran)
          $('#nama_wali').val(v.nama_wali)
          $('#email').val(v.email)
          $('#telepon').val(v.telepon)
          $('#alamat').val(v.alamat)
          $('#status').val(v.status)
        })
      },
      error: function(e){
        Swal.fire({
           type: 'warning',
           title: 'Tidak dapat mengakses server ...',
           showConfirmButton: false,
           timer: 2000
          })
      }
    });

    // Ajax edit siswa
    $('#form_editsiswa').on('submit',function(e){
      e.preventDefault();

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
      var status        = $('#status').val()
      var foto          = $('#foto').val()


      // if (jQuery.inArray(foto,['png','jpg','jpeg']) == -1) {
      //   alert('File tidak ditemukan')
      //   $('#foto').val('')
      //   return false;
      // .split('.').pop().toLowerCase();
      // }

      if (nama_siswa === '' ||jkel === '' ||tempat_lahir === '' ||tgl_lahir === '' ||kelas === '' ||tahun_ajaran === '' ||nama_wali === '' ||email === '' ||telepon === '' ||alamat === '' || status === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
      }else {

        $.ajax({
          url: link_edit,
          type: 'POST',
          dataType: 'JSON',
          data: new FormData(this),
          processData:false,
          contentType:false,
          beforeSend:function(){
            $('#btn_simpan').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan <i class="fas fa-spinner fa-spin"></i></span>')

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
                $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
            }
          },
          error:function(err){
            Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })
              $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
            $('#error').html(err.responseText);
          }
        });
      }
    })


    $('#tgl_lahir').datepicker({
      dateFormat:"yy-mm-dd"
    });

  });
