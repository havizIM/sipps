$(document).ready(function() {
  const Toast = Swal.mixin({
                toast: true,
                position:'bottom-end',
                showConfirmButton: false,
                timer: 2500
              });

    var link_show = BASE_URL+'api/maspel/show/'+token
  // alert(token)

  var table = $('#detail_maspel').DataTable({
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
      {"data":"id_maspel"},
      {"data":"deskripsi_pelanggaran"},
      {"data":"poin_pelanggaran"},
      {"data":"kategori_pelanggaran"},
      {"data":"status"}
    ],
    order:[[0,'desc']]
  });

});
