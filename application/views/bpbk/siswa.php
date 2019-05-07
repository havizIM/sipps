<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Siswa</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                </li>
              <li class="breadcrumb-item active">Siswa
              </li>
            </ol>
          </div>
        </div>
      </div>

    </div><hr>
    <div class="content-body">
      <section>
        <div class="card">
          <div class="card-header">
            <h3>Detail Siswa</h3>
          </div>
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_siswa" >
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIS</th>
                      <th>Jenis Kelamin</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Status</th>
                      <th>Wali</th>
                      <th>Email</th>
                      <th>Telepon</th>
                      <th>Alamat</th>
                      <th>#</th>

                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </section>
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

    var session     = localStorage.getItem('sipps');
    var auth        = JSON.parse(session);
    var token       = auth.token;
    var link_show   = '<?= base_url().'api/siswa/show/'?>'+token
    // alert(token)

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
          return `<img src="<?= base_url().'doc/siswa/' ?>${row.foto}" class="avatar" alt="Foto" style="width:70px; height: 70px;">`
        }}
      ],
      order:[[7,'desc']]
    });

  
  });
</script>
