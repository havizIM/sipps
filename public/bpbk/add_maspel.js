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

  // Ajax Add Kapel
  $('#form_addkat').on('submit',function(e){
    e.preventDefault();

    var kapel = $('#kapel').val();

    // alert(kapel)

    $.ajax({
      url: BASE_URL+'api/kapel/add/'+token,
      type: 'POST',
      dataType: 'JSON',
      data: {
        kategori_pelanggaran : kapel
      },
      beforeSend:function(){
        $('#add_kategori').addClass('disabled').attr('disabled','disabled').html('<span>Tambah<i class="fas fa-spinner fa-spin"></i></span>')

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
        $('#form_addkat')[0].reset();
        table.ajax.reload();
        $('#add_kategori').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
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
                type: 'Error',
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

  // Ajax Add maspel
  $('#form_addmaspel').on('submit',function(e){
    e.preventDefault();

    var dpel = $('#deskripsi_pelanggaran').val();
    var poin = $('#poin_pelanggaran').val();
    var kapel = $('#show_kapel').val();
    var id_kapel = $('#show_idkapel').val();

    if (dpel === '' || poin === '' || kapel === '') {
      Toast.fire({
        type: 'warning',
        title: 'Data tidak boleh kosong ...',
      })

    }else {
      $.ajax({
        url: BASE_URL+'api/maspel/add/'+token,
        type: 'POST',
        dataType: 'JSON',
        data: $('#form_addmaspel').serialize(),
        beforeSend:function(){
            $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah Pelanggaran<i class="fas fa-spinner fa-spin"></i></span>')
        },
        success:function(response){
          if (response.status === 200) {
            Swal.fire({
              type: 'success',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })
            location.hash='#/m_pelanggaran'
          }else {
            Swal.fire({
              type: 'error',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })
            $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Pelanggaran</span>')
          }
          $('#form_addmaspel')[0].reset();
          table.ajax.reload();
        },
        error:function(){
          Swal.fire({
           type: 'warning',
           title: 'Tidak dapat mengakses server ...',
           showConfirmButton: false,
           timer: 2000
          })
          $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Pelanggaran</span>')
        }
      });
    }
  })
});
