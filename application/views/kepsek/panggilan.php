<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Panggilan</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                </li>
              <li class="breadcrumb-item active">Panggilan
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
            <h3>Detail Panggilan</h3>
          </div>
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_panggilan" >
                  <thead>
                    <tr>
                      <th>Keterangan</th>
                      <th>Document</th>
                      <th>Tanggal</th>
                      <th>Nis</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Wali Kelas</th>
                      <th>Pemberi Sanksi</th>
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
    var nip         = auth.nip;
    var link_add    = '<?= base_url().'api/panggilan/add/' ?>'+token
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
      ajax:'<?= base_url().'api/panggilan/show/'?>'+token,
      columns:[
        {"data":"keterangan"},
        {"data":null,"render":function(data,type,row){
          return `<a href="<?= base_url().'doc/panggilan/' ?>${row.file}" target="blank">${row.file}</a>`
        }},
        {"data":"tgl_input"},
        {"data":"nis"},
        {"data":"nama_siswa"},
        {"data":"kelas"},
        {"data":"wali_kelas"},
        {"data":"pemberi_sanksi"},

      ],
      order:[[2,'desc']]
    });
  });
</script>
