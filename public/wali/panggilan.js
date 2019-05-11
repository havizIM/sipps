$(document).ready(function() {

  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

  var link_add    = BASE_URL+'api/panggilan/add/'+token
  var link_show   = BASE_URL+'api/panggilan/show/'+token
  // alert(token)

  var table = $('#detail_panggilan').DataTable({
    columnDefs :[{
      targets:[0,1,2,5,6,7,8],
      searchable:false
    },{
      targets:[0,1,3,4,6,7,8],
      orderable:false
    }],
    responsive:true,
    processing:true,
    ajax:link_show,
    columns:[
      {"data":"keterangan"},
      {"data":null,"render":function(data,type,row){
        return `<a href="${BASE_URL}doc/panggilan/${row.file}" class="btn  btn-sm btn-info" target="blank">Download</a>`
      }},
      {"data":"tgl_input"},
      {"data":"nis"},
      {"data":"nama_siswa"},
      {"data":"kelas"},
      {"data":"wali_kelas"},
      {"data":"pemberi_sanksi"},
      {"data":null,"render":function(data,type,row){

          return `<a href="#/edit_panggilan/${row.id_panggilan}" class="btn  btn-sm btn-success">Edit</a> <button type="button" data-id="${row.id_panggilan}" id="btn_delete" class="btn  btn-sm btn-danger">Hapus</button>`

      }},
    ],
    order:[[2,'desc']]
  });


  // Ajax Delete
  $(document).on('click','#btn_delete',function(e){
    e.preventDefault();

    var id_panggilan = $(this).attr('data-id')
    var link_delete   = BASE_URL+`api/panggilan/delete/${token}?id_panggilan=${id_panggilan}`

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
          }
        });
      }
    });
  })
});
