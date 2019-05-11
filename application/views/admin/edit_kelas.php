<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Edit Kelas</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/kelas">Kelas</a>
              </li>
              <li class="breadcrumb-item active">Edit Kelas
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <a href="#/kelas" class="btn btn-round btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
        <div class="card-body">
          <form id="form_editkelas">
            <div class="form-group">
              <label>Kelas</label>
              <input type="text" class="form-control" id="kelas" name="kelas" readonly>
            </div>
            <div class="form-group">
              <label>Wali Kelas</label>
              <select class="form-control" name="nip" id="nip" ></select>
            </div>
            <div class="content-footer">
              <center><button type="submit" id="btn_simpan" class="btn btn-info">Simpan Perubahan</button></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/admin/edit_kelas.js' ?>"></script>
