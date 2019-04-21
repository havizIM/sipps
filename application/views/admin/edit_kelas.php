<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
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
      <div class="content-header-right text-md-right col-md-6 col-12">
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
              <center><button type="submit" id="btn_edit" class="btn btn-info">Simpan Perubahan</button></center>
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
  var link_show   = `<?= base_url().'api/user/show/'?>${token}?level=Wali`

  $.ajax({
    url: link_show,
    type: 'GET',
    dataType: 'JSON',
    beforeSend: function(){
      $('#nip').html('<option value="">-- Pilih User --</option>');
    },
    success: function(response){
      var html = `<option value="">-- Pilih User --</option>`;

      $.each(response.data, function(k, v){

          html += `<option value="${v.nip}">${v.nama}</option>`;

      });

      $('#nip').html(html);

    },
    error: function(){
      alert('Tidak dapat mengakses server')
    }
  });
}
  $(document).ready(function() {
    loadBasicSelect();

    const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });

    var session     = localStorage.getItem('sipps');
    var auth        = JSON.parse(session);
    var token       = auth.token;
    var kelas       = location.hash.substr(13);
    var link_edit   = `<?= base_url().'api/kelas/edit/' ?>${token}?kelas=${kelas}`
    var link_show   = `<?= base_url().'api/kelas/show/' ?>${token}?kelas=${kelas}`
    // alert(link_edit)

    // Show value edit
    $.ajax({
      url: link_show,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $.each(response.data,function(k,v){
          $('#kelas').val(v.kelas)
          $('#nip').val(v.nip)
        })
        // console.log(response);
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


    $('#form_editkelas').on('submit',function(e){
      e.preventDefault();

      var wali = $('#nip').val()

      if (wali === '') {
        Toast.fire({
            type: 'warning',
            title: 'Data tidak boleh kosong ...',
          })
      }else {
        $.ajax({
          url: link_edit,
          type: 'POST',
          dataType: 'JSON',
          data: $('#form_editkelas').serialize(),
          beforeSend:function(){},
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                  type: 'success',
                  title: response.message,
                })
                location.hash='#/kelas'

            }else {
              Toast.fire({
                  type: 'error',
                  title: response.message,
                })
            }
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

  });
</script>