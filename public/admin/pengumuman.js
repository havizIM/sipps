$(document).ready(function() {

  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });


  var link_add    = BASE_URL+'api/pengumuman/add/'+token
  var link_show   = BASE_URL+'api/pengumuman/show/'+token
  // alert(token)

  var table = $('#detail_pengumuman').DataTable({
    columnDefs :[{
      targets:[0,1,2],
      searchable:false
    },{
      targets:[0,1,3,4],
      orderable:false
    }],
    responsive:true,
    processing:true,
    ajax:link_show,
    columns:[
      {"data":"deskripsi"},
      {"data":"tgl_input"},
      {"data":"nip"},
      {"data":"nama"},

      {"data":null,"render":function(data,type,row){

          return `<a href="${BASE_URL}doc/pengumuman/${row.file}" class="btn  btn-sm btn-info" target="blank">Download</a> <button type="button" data-id="${row.id_pengumuman}" id="btn_delete" class="btn  btn-sm btn-danger">Hapus</button>`

      }},
    ],
    order:[[2,'desc']]
  });


  // Ajax Delete
  $(document).on('click','#btn_delete',function(e){
    e.preventDefault();

    var id_pengumuman = $(this).attr('data-id')
    var link_delete   = BASE_URL+`api/pengumuman/delete/${token}?id_pengumuman=${id_pengumuman}`

    Swal.fire({
      title: 'Hapus data ?',
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

  // Ajax Add Pengumuman

  $('#form_addpeng').on('submit',function(e){
    e.preventDefault();

    var deskripsi = $('#deskripsi').val();
    var file      = $('#file').val()

    if (deskripsi === '' || file === '') {
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
            $('#modal_add').modal('hide')
          }else {
              Toast.fire({
                type: 'error',
                title: response.message,
              })
          }
          table.ajax.reload();
          $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
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

  // Modal Add Show
  $('#btn_addpeng').on('click',function(){
    $('#modal_add').modal('show')
    $('#form_addpeng')[0].reset();
  })

});
