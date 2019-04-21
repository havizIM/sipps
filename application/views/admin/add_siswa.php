<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Tambah Siswa</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/kelas">Siswa</a>
              </li>
              <li class="breadcrumb-item active">Tambah Siswa
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
          <form id="form_addsiswa" enctype="multipart/form-data">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nis / Nomor Induk Siswa</label>
                  <input type="number" class="form-control" id="nis" name="nis" maxlength="20">
                </div>
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
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Wali</label>
                  <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="number" class="form-control" id="telepon" name="telepon">
                </div>
                <div class="form-group mb-4">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" id="alamat" rows="6" cols="80"></textarea>
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
              <center><button type="submit" id="btn_add" class="btn btn-md btn-info">Tambah Siswa</button></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

// Load Data From Ajax to Basic Select
function loadBasicSelect()
{

  var session     = localStorage.getItem('sipps');
  var auth        = JSON.parse(session);
  var token       = auth.token;
  var link_show   = `<?= base_url().'api/kelas/show/'?>${token}`

  $.ajax({
    url: link_show,
    type: 'GET',
    dataType: 'JSON',
    beforeSend: function(){
      $('#kelas').html('<option value="">-- Pilih Kelas --</option>');
    },
    success: function(response){
      var html = `<option value="">-- Pilih Kelas --</option>`;

      $.each(response.data, function(k, v){

          html += `<option value="${v.kelas}">${v.kelas}</option>`;

      });

      $('#kelas').html(html);

    },
    error: function(){
      alert('Tidak dapat mengakses server')
    }
  });
}
  $(document).ready(function() {
    loadBasicSelect()

    const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });

    var session     = localStorage.getItem('sipps');
    var auth        = JSON.parse(session);
    var token       = auth.token;
    var link_add    = '<?= base_url().'api/siswa/add/'?>'+token

    // Ajax Add Kapel
    $('#form_addsiswa').on('submit',function(e){
      e.preventDefault();

      var nis           = $('#nis').val()
      var nama_siswa    = $('#nama_siswa').val()
      var jkel          = $('#jkel').val()
      var tempat_lahir  = $('#tempat_lahir').val()
      var tgl_lahir     = $('#tgl_lahir').val()
      var kelas         = $('#kelas').val()
      var tahun_ajaran  = $('#tahun_ajaran').val()
      var nama_wali     = $('#nama_wali').val()
      var email         = $('#email').val()
      var telepon       = $('#telepon').val()
      var alamat        = $('#alamat').val()
      var foto          = $('#foto').val()

      // alert(foto)

      // if (jQuery.inArray(foto,['png','jpg','jpeg']) == -1) {
      //   alert('File tidak ditemukan')
      //   $('#foto').val('')
      //   return false;
      // .split('.').pop().toLowerCase();
      // }

      if (nis === '' || nama_siswa === '' ||jkel === '' ||tempat_lahir === '' ||tgl_lahir === '' ||kelas === '' ||tahun_ajaran === '' ||nama_wali === '' ||email === '' ||telepon === '' ||alamat === '' || foto === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })
      }else {
        $.ajax({
          url: link_add,
          type: 'POST',
          dataType: 'JSON',
          data: new FormData(this),
          processData:false,
          contentType:false,
          beforeSend:function(){},
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
              location.hash='#/siswa'
            }else {
                Toast.fire({
                  type: 'error',
                  title: response.message,
                })
            }
            $('#form_addsiswa')[0].reset();
          },
          error:function(){
            Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })

          }
        });
      }
    })


    $('#tgl_lahir').datepicker({
      dateFormat:"yy-mm-dd"
    });

  });
</script>
