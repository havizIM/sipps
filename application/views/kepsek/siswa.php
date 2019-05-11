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

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/kepsek/siswa.js' ?>"></script>
