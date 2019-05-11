$(document).ready(function() {
  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

  
  var link_show   = BASE_URL+'api/kelas/show/'+token
  // alert(token)

  var table = $('#detail_kelas').DataTable({
    columnDefs :[{
      targets:[],
      searchable:false
    },{
      targets:[],
      orderable:false
    }],
    responsive:true,
    processing:true,
    ajax:link_show,
    columns:[
      {"data":"kelas"},
      {"data":"nip"},
      {"data":"nama"},
      {"data":null,"render":function(data,type,row){

          return `<a href="#/edit_kelas/${row.kelas}" id="btn_edit" class="btn  btn-sm btn-success" >Edit</a> <button type="button" data-id="${row.kelas}" data-name="${row.kelas}" id="btn_delete" class="btn  btn-sm btn-danger" >Hapus</button>`

      }},
    ],
    order:[[0,'desc']]
  });

  // Ajax Delete Maspel
  $(document).on('click','#btn_delete',function(){

    var kelas = $(this).attr('data-id');
    var nama = $(this).attr('data-name');

    Swal.fire({
      title: `Hapus kelas ${nama} ?`,
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      width: 400

    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: BASE_URL+`api/kelas/delete/${token}?kelas=${kelas}`,
          type: 'GET',
          dataType: 'JSON',
          // beforeSend:function(){},
          success:function(response){
            Toast.fire({
                type: 'success',
                title: response.message,
              })
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
  });

});
