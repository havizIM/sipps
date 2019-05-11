<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-9 mb-2">
          <h3 class="content-header-title mb-0">Master Prestasi</h3>
          <div class="row breadcrumbs-top mt-1 mb-0">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                  </li>
                <li class="breadcrumb-item active">Master Prestasi
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
          <div class="btn-group">
            <a href="#/add_maspres" class="btn btn-round btn-info"><i class="fas fa-plus"></i> Tambah</a>
          </div>
        </div>
      </div><hr>
      <div class="content-body">
        <div class="card">
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_maspres" >
                  <thead>
                    <tr>
                      <th>ID Prestasi</th>
                      <th>Jenis Prestasi</th>
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

  <script>
    var BASE_URL = '<?= base_url() ?>';
  </script>
  <script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
  <script src="<?= base_url().'public/bpbk/m_prestasi.js' ?>"></script>
