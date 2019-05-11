$(document).ready(function() {

  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

  var link_show   = BASE_URL+'api/panggilan/show/'+token
  // alert(token)

  var table = $('#detail_panggilan').DataTable({
    columnDefs :[{
      targets:[0,1,2,5,6,7],
      searchable:false
    },{
      targets:[0,1,3,4,6,7],
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
      {"data":"pemberi_sanksi"}
    ],
    order:[[2,'desc']]
  });
});
