<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Edit Pelanggaran</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/m_pelanggaran">Master Pelanggaran</a>
              </li>
              <li class="breadcrumb-item active">Edit Pelanggaran
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <a href="#/m_pelanggaran" class="btn btn-round btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
        <div class="card-body">
          <form id="form_editmaspel">
            <div class="form-group">
              <label>Deskripsi</label>
              <input type="text" class="form-control" id="edit_deskripsi_pelanggaran" name="deskripsi_pelanggaran">
            </div>
            <div class="form-group">
              <label>Point</label>
              <input type="text" class="form-control" id="edit_poin_pelanggaran" name="poin_pelanggaran">
            </div>
            <div class="form-group">
              <label>Kategori Pelanggaran</label>
              <div class="input-group">
                <input type="hidden" name="id_kapel" id="show_idkapel">
                <input type="text" class="form-control" name="kategori_pelanggaran" class="form-control" id="show_kapel" placeholder="-- Pilih Kategori --" readonly>
                <div class="input-group-append">
                  <span class="input-group-text bg-info text-white" id="modal_lookup" style="cursor:pointer;">Cari</span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status" id="select_status">
                <option value="">--Pilih Status--</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Non Aktif</option>
              </select>
            </div>
            <div class="content-footer">
              <center><button type="submit" id="btn_simpan" class="btn btn-success">Simpan Perubahan</button></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Lookup -->
<div class="modal" tabindex="-1" role="dialog" id="lookup_kapel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kategori Pelanggaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addkat">
          <div class="input-group">
            <input type="text" class="form-control" name="kategori_pelanggaran" id="kapel" placeholder="Nama Kategori">
            <div class="input-group-append">
              <button class="btn btn-md btn-info" type="submit" id="add_kategori">Tambah</button>
            </div>
          </div><br>
        </form>
        <div class="table-responsive">
          <table class="table" id="t_kapel" style="width: 100%">
            <thead>
              <th></th>
              <th>ID</th>
              <th>Kategori Pelanggaran</th>
              <th></th>
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
<script src="<?= base_url().'public/admin/edit_maspel.js' ?>"></script>
