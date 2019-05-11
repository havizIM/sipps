<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Edit Panggilan</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/panggilan">Panggilan</a>
              </li>
              <li class="breadcrumb-item active">Edit Panggilan
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <a href="#/panggilan" class="btn btn-round btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
        <div class="card-body">
          <form id="form_editpang">
            <div class="form-group">
              <label>Nomor Induk Siswa</label>
              <div class="input-group">
                <input type="hidden" name="nis" id="show_idnis">
                <input type="text" class="form-control" class="form-control" id="show_nis" placeholder="-- Cari Siswa --" readonly>
                <div class="input-group-append">
                  <span class="input-group-text bg-info text-white" id="modal_lookup" style="cursor:pointer;">Cari</span>
                </div>
              </div>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="card text-white bg-success">
              <div class="card-header">
                <label class="card-title text-white">Upload Dokumen</label>
              </div>
              <div class="card-block ">
                <div class="card-body row">
                  <fieldset class="form-group">
                    <input type="file" class="form-control-file" id="file" name="file">
                  </fieldset>
                </div>
              </div>
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

<!-- Modal Lookup -->
<div class="modal" tabindex="-1" role="dialog" id="lookup_nis">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Daftar Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table" id="t_nis" style="width: 100%">
            <thead>
              <th></th>
              <th>NIS</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Point</th>
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
<script src="<?= base_url().'public/bpbk/edit_panggilan.js' ?>"></script>
