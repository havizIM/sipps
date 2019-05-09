<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
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
      
    </div><hr>
    <div class="content-body">
      <div class="card">
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table table-hover dataTable" id="detail_maspel" >
                <thead>
                  <tr>
                    <th>ID Pelanggaran</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Jumlah Point</th>
                    <th>Kategori</th>
                    <th>Status</th>

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
        targets:[0,3,4],
        searchable:false
      },{
        targets:[0,1],
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
      ],
      order:[[0,'desc']]
    });

  });
</script>
