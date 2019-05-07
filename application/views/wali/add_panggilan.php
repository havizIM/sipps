<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Tambah Panggilan</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/panggilan">Panggilan</a>
              </li>
              <li class="breadcrumb-item active">Tambah Panggilan
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
          <form id="form_addpang">
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
              <center><button type="submit" id="btn_add" class="btn btn-info">Tambah Panggilan</button></center>
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

<script type="text/javascript">
  $(document).ready(function() {
    const Toast = Swal.mixin({
                    toast: true,
                    position:'bottom-end',
                    showConfirmButton: false,
                    timer: 2500
                  });

    var session     = localStorage.getItem('sipps');
    var auth        = JSON.parse(session);
    var token       = auth.token

    // Modal show Lookup
    $('#modal_lookup').on('click', function(){
      $('#lookup_nis').modal('show');
    });
    var table = $('#t_nis').DataTable({
      columnDefs: [{
          targets: [0,1,2,4],
          orderable: false
      },{
        targets: [0,3,4],
        searchable: false
      }],
      processing : true,
      ajax : '<?= base_url().'api/siswa/show/' ?>'+token,
      columns : [
        {"data" : null, "render" : function(data, type, row){
          return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.nis}" data-nama="${row.nama_siswa}">Pilih</button>`;
        }},
        {"data" : "nis"},
        {"data" : "nama_siswa"},
        {"data" : "kelas"},
        {"data" : "sisa_poin"},
      ],
      order : [[3, 'desc']]
    });

    // Pilih Nis
    $('#t_nis tbody').on('click', '#pilih', function(){
      // alert('Coba');
      var nis = $(this).attr('data-id');
      var nama_siswa = $(this).attr('data-nama');

      $('#show_idnis').val(nis);
      $('#show_nis').val(`${nis} - ${nama_siswa}`);

      $('#lookup_nis').modal('hide');
    });

    $('#form_addpang').on('submit',function(e){
      e.preventDefault();

      var nis = $('#show_idnis').val()
      var keterangan = $('#keterangan').val()
      var file = $('#file').val()

      if (nis === '' || keterangan === '' || file === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
      }else {
        $.ajax({
          url: '<?= base_url().'api/panggilan/add/' ?>'+token,
          type: 'POST',
          dataType: 'JSON',
          data: new FormData(this),
          processData:false,
          contentType:false,
          beforeSend:function(){
              $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah Panggilan <i class="fas fa-spinner fa-spin"></i></span>')
          },
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
              location.hash='#/panggilan'
            }else {
              Toast.fire({
                type: 'error',
                title: response.message,
              })
              $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Panggilan</span>')
            }
          },
          error:function(err){
            // Swal.fire({
            //  type: 'warning',
            //  title: 'Tidak dapat mengakses server ...',
            //  showConfirmButton: false,
            //  timer: 2000
            // })
            $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Panggilan</span>')
            console.log(err);
          }
        });
      }

    })

  });
</script>
