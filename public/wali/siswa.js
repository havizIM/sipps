$(document).ready(function() {
  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

  var link_show   = `${BASE_URL}api/siswa/show/${token}`
  console.log(link_show);

  var table = $('#detail_siswa').DataTable({
    columnDefs :[{
      targets:[3,4,5,8,9,10,11,12],
      searchable:false
    },{
      targets:[3,4,5,8,9,10,11,12],
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
      }}
    ],
    order:[[7,'desc']]
  });
});
