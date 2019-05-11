$(document).ready(function() {

  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

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
        return `<a href="${BASE_URL}doc/pengumuman/${row.file}" class="btn  btn-sm btn-info" target="blank">Download</a>`
      }}
    ],
    order:[[2,'desc']]
  });
});
