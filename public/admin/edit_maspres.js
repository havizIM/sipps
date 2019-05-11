$(document).ready(function() {
  const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });

  const Toast1 = Swal.mixin({
                  toast: true,
                  position:'center',
                  showConfirmButton: true,
                  // timer: 2500
                });


  var id_maspres  = location.hash.substr(15);


  // Show value edit
  $.ajax({
    url: BASE_URL+`api/maspres/show/${token}?id_maspres=${id_maspres}`,
    type: 'GET',
    dataType: 'JSON',
    // data: {},
    // beforeSend:function(){},
    success:function(response){
      $.each(response.data,function(k,v){
        $('#edit_deskripsi_prestasi').val(v.deskripsi_prestasi);
        $('#edit_poin_prestasi').val(v.poin_prestasi);
        $('#show_kapres').val(v.kategori_prestasi);
        $('#select_status').val(v.status);
        $('#show_idkapres').val(v.id_kapres);
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

  // Ajax Edit maspres
  $('#form_editmaspres').on('submit',function(e){
    e.preventDefault()

    var edit_desc = $('#edit_deskripsi_prestasi').val();
    var edit_poin = $('#edit_poin_prestasi').val();
    var status = $('#select_status').val();
    var kapres = $('#show_kapres').val();

    // alert($('#form_editmaspel').serialize())

    if (edit_desc === '' || edit_poin === '' || status === '' || kapres === '') {
      Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
    }else {
      $.ajax({
        url: BASE_URL+`api/maspres/edit/${token}?id_maspres=${id_maspres}`,
        type: 'POST',
        dataType: 'JSON',
        data: $('#form_editmaspres').serialize(),
        beforeSend:function(){
          $('#btn_simpan').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan<i class="fas fa-spinner fa-spin"></i></span>')

        },
        success:function(response){
          if (response.status === 200) {
            Toast.fire({
                type: 'success',
                title: response.message,
              })
            location.hash='#/m_prestasi'
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

  // Modal show Lookup
  $('#modal_lookup').on('click', function(){
    $('#lookup_kapres').modal('show');
  });
  var table = $('#t_kapres').DataTable({
    columnDefs: [{
        targets: [0,3],
        orderable: false
    },{
      targets: [0,1,3],
      searchable: false
    }],
    processing : true,
    ajax : BASE_URL+'api/kapres/show/'+token,
    columns : [
      {"data" : null, "render" : function(data, type, row){
        return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.id_kapres}" data-nama="${row.kategori_prestasi}"><i class="icon-trash"></i> Pilih</button>`;
      }},
      {"data" : "id_kapres"},
      {"data" : "kategori_prestasi"},
      {"data" : null, "render": function(data,type,row){
        return `<button type="button" class="btn btn-danger btn-sm" id="btn_delete" data-id="${row.id_kapres}"><i class="fas fa-trash"></i> Hapus</button>`;
      }}
    ],
    order : [[1, 'desc']]
  });

  // Ajax Add Kategori
  $('#form_addpres').on('submit',function(e){
    e.preventDefault();

    var kapres = $('#kapres').val();

    // alert(kapres)

    $.ajax({
      url: BASE_URL+'api/kapres/add/'+token,
      type: 'POST',
      dataType: 'JSON',
      data: $('#form_addpres').serialize(),
      beforeSend:function(){
      $('#add_kategori').addClass('disabled').attr('disabled','disabled').html('<span>Tambah <i class="fas fa-spinner fa-spin"></i></span>')

      },
      success:function(response){
        if (response.status === 200) {
          Toast.fire({
            type: 'success',
            title: response.message,
          })
        }else {
            Toast.fire({
              type: 'error',
              title: response.message,
            })
        }
        $('#add_kategori').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
        $('#form_addpres')[0].reset();
        table.ajax.reload();
      },
      error:function(){
        Swal.fire({
           type: 'warning',
           title: 'Tidak dapat mengakses server ...',
           showConfirmButton: false,
           timer: 2000
          })
          $('#add_kategori').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
      }
    });
  })
  $('#t_kapres tbody').on('click', '#pilih', function(){
    // alert('Coba');
    var id_kapres = $(this).attr('data-id');
    var nama_kategori = $(this).attr('data-nama');

    $('#show_idkapres').val(id_kapres);
    $('#show_kapres').val(nama_kategori);

    $('#lookup_kapres').modal('hide');
  });

  // Ajax Delete
  $(document).on('click','#btn_delete',function(e){
    e.preventDefault();

    var id_kapres = $(this).attr('data-id')

    Toast1.fire({
      title: 'Hapus kategori ?',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: BASE_URL+`api/kapres/delete/${token}?id_kapres=${id_kapres}`,
          type: 'GET',
          dataType: 'JSON',
          // data: {},
          beforeSend:function(){},
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
            }else {
              Toast.fire({
                type: 'error',
                title: response.message,
              })
            }
            table.ajax.reload();
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
      }
    });
  })
});
