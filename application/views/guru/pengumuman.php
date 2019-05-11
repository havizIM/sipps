<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Pengumuman</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                </li>
              <li class="breadcrumb-item active">Pengumuman
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
            <h3>Detail Pengumuman</h3>
          </div>
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_pengumuman" >
                  <thead>
                    <tr>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
                      <th>Nip</th>
                      <th>Nama</th>
                      <th></th>
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

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/guru/pengumuman.js' ?>"></script>
