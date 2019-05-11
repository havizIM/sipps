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

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/kepsek/m_pelanggaran.js' ?>"></script>
