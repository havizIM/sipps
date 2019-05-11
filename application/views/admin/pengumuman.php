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
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <button class="btn btn-round btn-info" id="btn_addpeng" type="button"><i class="fas fa-plus"></i> Tambah</button>
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

<!-- [ MODAL Tambah Pengumuman ] start -->
<div class="modal fade" id="modal_add">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bg-info">
      <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Pengumuman</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form id="form_addpeng">
      <div class="modal-body">
        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
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
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn_add" class="btn btn-info">Tambah</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- [ Modal Tambah Pengumuman ] end -->

<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/admin/pengumuman.js' ?>"></script>
