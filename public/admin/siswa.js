$(document).ready(function() {
  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });


  var link_show   = BASE_URL+'api/siswa/show/'+token
  // alert(token)

  var table = $('#detail_siswa').DataTable({
    columnDefs :[{
      targets:[3,4,5,8,9,10,11,12,13],
      searchable:false
    },{
      targets:[3,4,5,8,9,10,11,12,13],
      orderable:false
    }],
    responsive:true,
    processing:true,
    ajax:link_show,
    columns:[
      {"data":"nama_siswa"},
      {"data":"nis"},
      {"data":"jenis_kelamin"},
      {"data":"tempat_lahir"},
      {"data":"tgl_lahir"},
      {"data":"kelas"},
      {"data":"tahun_ajaran"},
      {"data":"status"},
      {"data":"nama_wali"},
      {"data":"email"},
      {"data":"telepon"},
      {"data":"alamat"},
      {"data":null,"render":function(data,type,row){
        return `<img src="${BASE_URL}doc/siswa/${row.foto}" class="avatar" alt="Foto" style="width:70px; height: 70px;">`
      }},
      {"data":null,"render":function(data,type,row){

          return `<a href="#/edit_siswa/${row.nis}" id="btn_edit" class="btn  btn-sm btn-success">Edit</a> <button type="button" data-name="${row.nama_siswa}" data-id="${row.nis}" id="btn_delete" class="btn  btn-sm btn-danger" >Hapus</button>`

      }},
    ],
    order:[[7,'desc']]
  });

  // Ajax Delete Maspel
  $(document).on('click','#btn_delete',function(){

    var nis           = $(this).attr('data-id');
    var nama          = $(this).attr('data-name');

    var link_delete   = BASE_URL+`api/siswa/delete/${token}?nis=${nis}`

    Swal.fire({
      title: `Hapus siswa ${nama} ?`,
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
