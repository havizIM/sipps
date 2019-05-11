$(document).ready(function() {
  const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });

    var link_show = BASE_URL+'api/siswa/show/'+token

  // Modal show Lookup
  $('#modal_lookup').on('click', function(){
    $('#lookup_nis').modal('show');
  });
  var table = $('#t_nis').DataTable({
    columnDefs: [{
        targets: [0,1,2,4],
        orderable: false
    },{
      targets: [0,3,4],
      searchable: false
    }],
    processing : true,
    ajax : link_show,
    columns : [
      {"data" : null, "render" : function(data, type, row){
        return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.nis}" data-nama="${row.nama_siswa}">Pilih</button>`;
      }},
      {"data" : "nis"},
      {"data" : "nama_siswa"},
      {"data" : "kelas"},
      {"data" : "sisa_poin"},
    ],
    order : [[3, 'desc']]
  });

  // Pilih Nis
  $('#t_nis tbody').on('click', '#pilih', function(){
    // alert('Coba');
    var nis = $(this).attr('data-id');
    var nama_siswa = $(this).attr('data-nama');

    $('#show_idnis').val(nis);
    $('#show_nis').val(`${nis} - ${nama_siswa}`);

    $('#lookup_nis').modal('hide');
  });

  $('#form_addpang').on('submit',function(e){
    e.preventDefault();

    var link_add = BASE_URL+'api/panggilan/add/'+token

    var nis = $('#show_idnis').val()
    var keterangan = $('#keterangan').val()
    var file = $('#file').val()

    if (nis === '' || keterangan === '' || file === '') {
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
            $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah Panggilan <i class="fas fa-spinner fa-spin"></i></span>')
        },
        success:function(response){
          if (response.status === 200) {
            Toast.fire({
              type: 'success',
              title: response.message,
            })
            location.hash='#/panggilan'
          }else {
            Toast.fire({
              type: 'error',
              title: response.message,
            })
            $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Panggilan</span>')
          }
        },
        error:function(err){
          Swal.fire({
           type: 'warning',
           title: 'Tidak dapat mengakses server ...',
           showConfirmButton: false,
           timer: 2000
          })
          $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Panggilan</span>')
        }
      });
    }
  })
});
