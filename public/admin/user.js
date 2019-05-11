console.log('user is running')

$(document).ready(function() {
  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

  var table = $('#detail_user').DataTable({
    columnDefs :[{
      targets:[0,2,3,4,5,6,7],
      searchable:false
    },{
      targets:[2,3,7],
      orderable:false
    }],
    responsive:true,
    processing:true,
    ajax: BASE_URL+'api/user/show/'+token,
    columns:[
      {"data":"nip"},
      {"data":"nama"},
      {"data":"username"},
      {"data":"password"},
      {"data":"level"},
      {"data":"tgl_registrasi"},
      {"data":"status"},
      {"data":null,"render":function(data,type,row){

          return `<button type="button" id="btn_edit" data-id="${row.nip}" class="btn  btn-sm btn-success">Edit</button> <button type="button" data-id="${row.nip}" data-name="${row.nama}" id="btn_delete" class="btn  btn-sm btn-danger">Hapus</button>`

      }},
    ],
    order:[[5,'desc']]
  });

  // Ajax Add User
  $('#form_adduser').on('submit',function(e){
    e.preventDefault();

    var nip = $('#nip').val();
    var nama = $('#nama_user').val();
    var username = $('#username').val();
    var level = $('#select_level').val();

    if (nip === '' || nama === '' || username === '' || level === '') {
      Toast.fire({
        type: 'warning',
        title: 'Data tidak boleh kosong ...',
      })

    }else {
      $.ajax({
        url: link_add,
        type: 'POST',
        dataType: 'JSON',
        data:$('#form_adduser').serialize(),
        beforeSend:function(){
          $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah <i class="fas fa-spinner fa-spin"></i></span>')

        },
        success:function(response){
          if (response.status === 200) {
            Toast.fire({
              type: 'success',
              title: response.message,
            })
            $('#modal_add').modal('hide');
          }else {
            Toast.fire({
              type: 'error',
              title: response.message,
            })
          }
          $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
          $('#form_adduser')[0].reset();
          table.ajax.reload();
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

  // Ajax Delete
  $(document).on('click','#btn_delete',function(e){
    e.preventDefault();

    var nip         = $(this).attr('data-id')
    var nama        = $(this).attr('data-name')
    var link_delete = BASE_URL+`api/user/delete/${token}?nip=${nip}`

    Swal.fire({
      title: `Hapus ${nama} ?`,
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: link_delete,
          type: 'GET',
          dataType: 'JSON',
          // data: {},
          // beforeSend:function(){
          //   $('#btn_delete').addClass('disabled').attr('disabled','disabled').html('<span>Hapus <i class="fas fa-spinner fa-spin"></i></span>')
          // },
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
              // $('#btn_delete').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Hapus</span>')
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
            // $('#btn_delete').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Hapus</span>')
          }
        });
      }
    });
  })

  // Modal Edit User
  $(document).on('click','#btn_edit',function(e){
    e.preventDefault()

    var nip       = $(this).attr('data-id')
    var link_show = BASE_URL+`api/user/show/${token}?nip=${nip}`
    // alert(id_user)

    $.ajax({
      url: link_show,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      beforeSend:function(){},
      success:function(response){

        $('#modal_edit').modal('show')

        $.each(response.data,function(k,v){
          $('#edit_nama_user').val(v.nama);
          $('#edit_username').val(v.username);
          $('#edit_level').val(v.level);
          $('#select_status').val(v.status);
          $('#edit_id').val(v.nip);
        })
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
  })

  // Ajax Edit user
  $('#form_edituser').on('submit',function(e){
    e.preventDefault()

    var edit_nama     = $('#edit_nama_user').val();
    var edit_username = $('#edit_username').val();
    var status        = $('#select_status').val();
    var level         = $('#edit_level').val();

    var edit_id       = $('#edit_id').val();
    var link_edit     = BASE_URL+`api/user/edit/${token}?nip=${edit_id}`


    // alert(edit_id)

    if (edit_nama === '' || edit_username === '' || status === '' || level === '') {
      Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
    }else {
      $.ajax({
        url: link_edit,
        type: 'POST',
        dataType: 'JSON',
        data: {
            nip : edit_id,
            nama : edit_nama,
            username : edit_username,
            status : status,
            level : level
        },
        beforeSend:function(){
          $('#btn_simpan').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan <i class="fas fa-spinner fa-spin"></i></span>')
        },
        success:function(response){
          if (response.status === 200) {
            Toast.fire({
              type: 'success',
              title: response.message,
            })
            $('#form_edituser')[0].reset();
            $('#modal_edit').modal('hide');
          }else {
            Toast.fire({
              type: 'error',
              title: response.message,
            })
          }
          table.ajax.reload();
          $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
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

  // Modal Add Show
  $('#btn_adduser').on('click',function(){
    $('#modal_add').modal('show')
  })
});
