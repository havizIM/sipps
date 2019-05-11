<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">User</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                </li>
              <li class="breadcrumb-item active">User
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <button class="btn btn-round btn-info" id="btn_adduser" type="button"><i class="fas fa-plus"></i> Tambah</button>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <section>
        <div class="card">
          <div class="card-header">
            <h3>Detail User</h3>
          </div>
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_user" >
                  <thead>
                    <tr>
                      <th>NIP</th>
                      <th style="width:15%;">Nama</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Level</th>
                      <th>Tgl.Regist</th>
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
      </section>
    </div>
  </div>
</div>

<!-- [ MODAL Tambah User ] start -->
<div class="modal fade" id="modal_add">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bg-info">
      <h5 class="modal-title text-white" id="exampleModalLabel">Tambah User</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form id="form_adduser">
      <div class="modal-body">
        <div class="form-group">
            <label>Nip</label>
            <input type="text" class="form-control" id="nip" name="nip">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="nama_user" name="nama">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label>Level</label>
            <select class="form-control" name="level" id="select_level">
              <option value="">--Pilih Level--</option>
              <option value="Guru">Guru</option>
              <option value="Wali">Wali</option>
              <option value="Bpbk">BPBK</option>
              <option value="Kepsek">Kepsek</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn_add" class="btn btn-info">Tambah</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- [ Modal Tambah User ] end -->

<!-- [ MODAL edit User ] start -->
<div class="modal fade" id="modal_edit">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bg-info">
      <h5 class="modal-title text-white" id="exampleModalLabel">Edit User</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form id="form_edituser">
      <div class="modal-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="edit_nama_user" name="nama">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="edit_username" name="username">
        </div>
        <div class="form-group">
            <label>Level</label>
            <select class="form-control" name="level" id="edit_level">
              <option value="">--Pilih Level--</option>
              <option value="Guru">Guru</option>
              <option value="Wali">Wali</option>
              <option value="Bpbk">BPBK</option>
              <option value="Kepsek">Kepsek</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" id="select_status">
              <option value="">--Pilih Status--</option>
              <option value="Aktif">Aktif</option>
              <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_user" value="" id="edit_id">
        <button type="submit" id="btn_simpan" class="btn btn-info">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- [ Modal Tambah User ] end -->
<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/localStorageGlobal.js' ?>"></script>
<script src="<?= base_url().'public/admin/user.js' ?>"></script>
