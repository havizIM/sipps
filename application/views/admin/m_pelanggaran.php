<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Master Pelanggaran</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                </li>
              <li class="breadcrumb-item active">Master Pelanggaran
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="#/add_maspel" class="btn btn-round btn-info"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table table-hover dataTable" id="detail_maspel" >
                <thead>
                  <tr>
                    <th>ID Pelanggaran</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Point</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });

    var session   = localStorage.getItem('sipps');
    var auth      = JSON.parse(session);
    var token     = auth.token;
    var nip       = auth.nip;
    // alert(token)

    var table = $('#detail_maspel').DataTable({
      columnDefs :[{
        targets:[0,3,4,5],
        searchable:false
      },{
        targets:[0,1,5],
        orderable:false
      }],
      responsive:true,
      processing:true,
      ajax:'<?= base_url().'api/maspel/show/'?>'+token,
      columns:[
        {"data":"id_maspel"},
        {"data":"deskripsi_pelanggaran"},
        {"data":"poin_pelanggaran"},
        {"data":"kategori_pelanggaran"},
        {"data":"status"},
        {"data":null,"render":function(data,type,row){

            return `<a href="#/edit_maspel/${row.id_maspel}" id="btn_edit" class="btn  btn-sm btn-success" name="button">Edit</a> <button type="button" data-id="${row.id_maspel}" id="btn_delete" class="btn  btn-sm btn-danger" name="button">Hapus</button>`

        }},
      ],
      order:[[0,'desc']]
    });

    // Ajax Delete Maspel
    $(document).on('click','#btn_delete',function(){

      var id_maspel = $(this).attr('data-id');


      Swal.fire({
        title: 'Apakah anda yakin...',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        width: 400

      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: `<?= base_url().'api/maspel/delete/' ?>${token}?id_maspel=${id_maspel}`,
            type: 'GET',
            dataType: 'JSON',
            // beforeSend:function(){},
            success:function(response){
              Swal.fire({
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
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
</script>
