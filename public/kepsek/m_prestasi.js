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
      targets:[0,3,4],
      searchable:false
    },{
      targets:[0,1],
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
      {"data":"status"}
    ],
    order:[[0,'desc']]
  });
});
