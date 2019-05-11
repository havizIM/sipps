<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Edit Siswa</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/kelas">Siswa</a>
              </li>
              <li class="breadcrumb-item active">Edit Siswa
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <a href="#/siswa" class="btn btn-round btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
        <div class="card-body">
          <form id="form_editsiswa" enctype="multipart/form-data">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Siswa</label>
                  <input type="text" class="form-control" id="nama_siswa" name="nama_siswa">
                </div>
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin" id="jkel">
                    <option value="">-- Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tempat</label>
                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir">
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select class="form-control" name="kelas" id="kelas"></select>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran">
                </div>
                <div class="form-group">
                  <label>Nama Wali</label>
                  <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="number" class="form-control" id="telepon" name="telepon">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" id="alamat" rows="6" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                  </select>
                </div>
                <div class="card text-white bg-success">
                  <div class="card-header">
                    <label class="card-title text-white">Upload Gambar</label>
                  </div>
                  <div class="card-block ">
                    <div class="card-body row">
                      <fieldset class="form-group">
                        <input type="file" class="form-control-file" id="foto" name="foto">
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-footer mt-2">
              <center><button type="submit" id="btn_simpan" class="btn btn-md btn-info">Simpan Perubahan</button></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="" id="error">

  </div>
</div>

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/admin/edit_siswa.js' ?>"></script>
