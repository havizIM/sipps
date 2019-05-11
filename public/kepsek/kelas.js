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
      {"data":"nama"}
    ],
    order:[[0,'desc']]
  });
});
