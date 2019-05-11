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

  var id_maspel   = location.hash.substr(14);


  // Show value edit
  $.ajax({
    url: BASE_URL+`api/maspel/show/${token}?id_maspel=${id_maspel}`,
    type: 'GET',
    dataType: 'JSON',
    // data: {},
    // beforeSend:function(){},
    success:function(response){
      $.each(response.data,function(k,v){
        $('#edit_deskripsi_pelanggaran').val(v.deskripsi_pelanggaran);
        $('#edit_poin_pelanggaran').val(v.poin_pelanggaran);
        $('#show_kapel').val(v.kategori_pelanggaran);
        $('#select_status').val(v.status);
        $('#show_idkapel').val(v.id_kapel);
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

  // Ajax Edit maspel
  $('#form_editmaspel').on('submit',function(e){
    e.preventDefault()

    var edit_desc = $('#edit_deskripsi_pelanggaran').val();
    var edit_poin = $('#edit_poin_pelanggaran').val();
    var status = $('#select_status').val();
    var kapel = $('#show_kapel').val();

    // alert($('#form_editmaspel').serialize())

    if (edit_desc === '' || edit_poin === '' || status === '' || kapel === '') {
      Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
    }else {
      $.ajax({
        url: BASE_URL+`api/maspel/edit/${token}?id_maspel=${id_maspel}`,
        type: 'POST',
        dataType: 'JSON',
        data: $('#form_editmaspel').serialize(),
        beforeSend:function(){
          $('#btn_simpan').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan<i class="fas fa-spinner fa-spin"></i></span>')
        },
        success:function(response){
          if (response.status === 200) {
            Toast.fire({
                type: 'success',
                title: response.message,
              })
            location.hash='#/m_pelanggaran'
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
    $('#lookup_kapel').modal('show');
  });
  var table = $('#t_kapel').DataTable({
    columnDefs: [{
        targets: [0,3],
        orderable: false
    },{
      targets: [0,1,3],
      searchable: false
    }],
    processing : true,
    ajax : BASE_URL+'api/kapel/show/'+token,
    columns : [
      {"data" : null, "render" : function(data, type, row){
        return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.id_kapel}" data-nama="${row.kategori_pelanggaran}"><i class="icon-trash"></i> Pilih</button>`;
      }},
      {"data" : "id_kapel"},
      {"data" : "kategori_pelanggaran"},
      {"data" : null, "render": function(data,type,row){
        return `<button type="button" class="btn btn-danger btn-sm" id="btn_delete" data-id="${row.id_kapel}"><i class="fas fa-trash"></i> Hapus</button>`;
      }}
    ],
    order : [[1, 'desc']]
  });

  // Ajax Add Kategori
  $('#form_addkat').on('submit',function(e){
    e.preventDefault();

    var kapel = $('#kapel').val();

    // alert(kapel)

    $.ajax({
      url: BASE_URL+'api/kapel/add/'+token,
      type: 'POST',
      dataType: 'JSON',
      data: $('#form_addkat').serialize(),
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
        $('#form_addkat')[0].reset();
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
  $('#t_kapel tbody').on('click', '#pilih', function(){
    // alert('Coba');
    var id_kapel = $(this).attr('data-id');
    var nama_kategori = $(this).attr('data-nama');

    $('#show_idkapel').val(id_kapel);
    $('#show_kapel').val(nama_kategori);

    $('#lookup_kapel').modal('hide');
  });

  // Ajax Delete
  $(document).on('click','#btn_delete',function(e){
    e.preventDefault();

    var id_kapel = $(this).attr('data-id')

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
          url: BASE_URL+`api/kapel/delete/${token}?id_kapel=${id_kapel}`,
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
