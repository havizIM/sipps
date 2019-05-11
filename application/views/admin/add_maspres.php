<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Tambah Master Prestasi</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/m_prestasi">Master Prestasi</a>
              </li>
              <li class="breadcrumb-item active">Tambah Prestasi
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <a href="#/m_prestasi" class="btn btn-round btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
        <div class="card-body">
          <form id="form_addmaspres">
            <div class="form-group">
              <label>Deskripsi</label>
              <input type="text" class="form-control" id="deskripsi_prestasi" name="deskripsi_prestasi">
            </div>
            <div class="form-group">
              <label>Point</label>
              <input type="text" class="form-control" id="poin_prestasi" name="poin_prestasi">
            </div>
            <div class="form-group">
              <h3>Kategori Prestasi</h3>
              <div class="input-group">
                <input type="hidden" name="id_kapres" id="show_idkapres">
                <input type="text" name="kategori_prestasi" class="form-control" id="show_kapres" placeholder="-- Pilih Kategori --" readonly>
                <div class="input-group-append">
                  <span class="input-group-text bg-info text-white" id="modal_lookup" style="cursor:pointer;">Cari</span>
                </div>
              </div>
            </div>
            <div class="content-footer">
              <center><button type="submit" id="btn_add" class="btn btn-info">Tambah Prestasi</button></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Lookup -->
<div class="modal" tabindex="-1" role="dialog" id="lookup_kapres">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kategori Prestasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addpres">
          <div class="input-group">
            <input type="text" class="form-control" name="kategori_prestasi" id="kapres" placeholder="Nama Kategori">
            <div class="input-group-append">
              <button class="btn btn-md btn-info" type="submit" id="add_kategori">Tambah</button>
            </div>
          </div><br>
        </form>
        <div class="table-responsive">
          <table class="table" id="t_kapres" style="width:100%;">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Kategori Prestasi</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end modal lookup -->

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/admin/add_maspres.js' ?>"></script>
