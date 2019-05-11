$(document).ready(function() {
  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

  var link_show = BASE_URL+'api/maspres/show/'+token
  // alert(token)

  var table = $('#detail_maspres').DataTable({
    columnDefs :[{
      targets:[0,3,4,5],
      searchable:false
    },{
      targets:[0,1,5],
      orderable:false
    }],
    responsive:true,
    processing:true,
    ajax:link_show,
    columns:[
      {"data":"id_maspres"},
      {"data":"deskripsi_prestasi"},
      {"data":"poin_prestasi"},
      {"data":"kategori_prestasi"},
      {"data":"status"},
      {"data":null,"render":function(data,type,row){

          return `<a href="#/edit_maspres/${row.id_maspres}" class="btn  btn-sm btn-success">Edit</a> <button type="button" data-id="${row.id_maspres}" id="btn_delete" class="btn  btn-sm btn-danger" >Hapus</button>`

      }},
    ],
    order:[[0,'desc']]
  });

  // Ajax Delete Maspel
  $(document).on('click','#btn_delete',function(){

    var id_maspres    = $(this).attr('data-id');
    var link_delete   = BASE_URL+`api/maspres/delete/${token}?id_maspres=${id_maspres}`


    Swal.fire({
      title: 'Hapus data ?',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      width: 400

    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: link_delete,
          type: 'GET',
          dataType: 'JSON',
          // beforeSend:function(){},
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
              type: 'error',
              title: 'Gagal mengakses server',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }
    });
  });
});
