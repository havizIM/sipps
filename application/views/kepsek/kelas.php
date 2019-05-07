<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-9 mb-2">
          <h3 class="content-header-title mb-0">Kelas</h3>
          <div class="row breadcrumbs-top mt-1 mb-0">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                  </li>
                <li class="breadcrumb-item active">Kelas
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
                <table class="table table-hover dataTable" id="detail_kelas" >
                  <thead>
                    <tr>
                      <th>Kelas</th>
                      <th>Nip</th>
                      <th>Nama Wali Kelas</th>
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

      var session     = localStorage.getItem('sipps');
      var auth        = JSON.parse(session);
      var token       = auth.token;
      var nip         = auth.nip;
      var link_show   = '<?= base_url().'api/kelas/show/'?>'+token
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
          {"data":"nama"},
        ],
        order:[[0,'desc']]
      });

    });
  </script>
