<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Data User</h3>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <button class="btn btn-round btn-info" id="btn_adduser" type="button"><i class="fas fa-plus"></i> Tambah</button>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <section>
        <div class="card">
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_user" >
                  <thead>
                    <tr>
                      <th>NIP</th>
                      <th>Nama</th>
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
              <option value="guru">Guru</option>
              <option value="wali">Wali</option>
              <option value="bpbk">BPBK</option>
              <option value="kepsek">Kepsek</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn_savepass" class="btn btn-info">Tambah</button>
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
      <h5 class="modal-title text-white" id="exampleModalLabel">Tambah User</h5>
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
            <label>Status</label>
            <select class="form-control" name="status" id="select_status">
              <option value="">--Pilih Level--</option>
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

<script type="text/javascript">
  $(document).ready(function() {
    const Toast = Swal.mixin({
                  toast: true,
                  position:'bottom-end',
                  showConfirmButton: false,
                  timer: 2500
                });

    var session = localStorage.getItem('sipps');
    var auth = JSON.parse(session);
    var token = auth.token;
    var nip = auth.nip;
    // alert(token)

    var table = $('#detail_user').DataTable({
      columnDefs :[{
        targets:[0,2,3,4,5,6,7],
        searchable:false
      }],
      responsive:true,
      processing:true,
      ajax:'<?= base_url().'api/user/show/'?>'+token,
      columns:[
        {"data":"nip"},
        {"data":"nama"},
        {"data":"username"},
        {"data":"password"},
        {"data":"level"},
        {"data":null,"render":function(data,type,row){
          return moment(row.tgl_registrasi,'YYYY-MM-DD hh:mm:ss').format('L')
        }},
        {"data":"status"},
        {"data":null,"render":function(data,type,row){

            return `<button type="button" id="btn_edit" data-id="${row.nip}" class="btn  btn-md btn-success" name="button">Edit</button> <button type="button" data-id="${row.nip}" id="btn_delete" class="btn  btn-md btn-danger" name="button">Hapus</button>`

        }},
      ],
      order:[[5,'asc']]
    });

    // Ajax Add User
    $('#form_adduser').on('submit',function(e){
      e.preventDefault();

      var nip = $('#nip').val();
      var nama = $('#nama_user').val();
      var username = $('#username').val();
      var level = $('#select_level').val();

      if (nip === '' || nama === '' || username === '' || level === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })

      }else {
        $.ajax({
          url: '<?= base_url().'api/user/add/' ?>'+token,
          type: 'POST',
          dataType: 'JSON',
          data: {
            nip : nip,
            nama : nama,
            username : username,
            level : level
          },
          // beforeSend:function(){},
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
              $('#modal_add').modal('hide');
            }else {
              Toast.fire({
                type: 'error',
                title: response.message,
              })
            }
            $('#form_adduser')[0].reset();
            table.ajax.reload();
          },
          error:function(){}
        });

      }
    })

    // Ajax Delete
    $(document).on('click','#btn_delete',function(e){
      e.preventDefault();

      var nip = $(this).attr('data-id')

      $.ajax({
        url: `<?= base_url().'api/user/delete/'?>${token}?nip=${nip}`,
        type: 'GET',
        dataType: 'JSON',
        // data: {},
        beforeSend:function(){},
        success:function(response){
          if (response.status === 200) {
            Toast.fire({
              type: 'success',
              title: response.message,
            })
          }else {
            Toast.fire({
              type: 'Error',
              title: response.message,
            })
          }
          table.ajax.reload();
        },
        error:function(){
          Toast.fire({
            type: 'Error',
            title: 'Gagal Mengakses Server ...',
          })
        }
      });
    })

    // Modal Edit User
    $(document).on('click','#btn_edit',function(e){
      e.preventDefault()

      var nip = $(this).attr('data-id')
      // alert(id_user)

      $.ajax({
        url: `<?= base_url().'api/user/show/' ?>${token}?nip=${nip}`,
        type: 'GET',
        dataType: 'JSON',
        // data: {},
        beforeSend:function(){},
        success:function(response){

          $('#modal_edit').modal('show')

          $.each(response.data,function(k,v){
            $('#edit_nama_user').val(v.nama);
            $('#edit_username').val(v.username);
            $('#select_status').val(v.status);
            $('#edit_id').val(v.nip);
          })
        },
        error:function(){
          alert('Tidak Dapat mengakses server ...')
        }
      });
    })

    // Ajax Edit user
    $('#form_edituser').on('submit',function(e){
      e.preventDefault()

      var edit_id = $('#edit_id').val();
      var edit_nama = $('#edit_nama_user').val();
      var edit_username = $('#edit_username').val();
      var status = $('#select_status').val();


      // alert(edit_id)

      if (edit_nama === '' || edit_username === '' || status === '') {
        Toast.fire({
            type: 'warning',
            title: 'Data tidak boleh kosong ...',
          })
      }else {
        $.ajax({
          url: `<?= base_url().'api/user/edit/' ?>${token}?nip=${edit_id}`,
          type: 'POST',
          dataType: 'JSON',
          data: {
              nip : edit_id,
              nama : edit_nama,
              username : edit_username,
              status : status
          },
          beforeSend:function(){},
          success:function(response){
            Toast.fire({
                  type: 'success',
                  title: response.message,
                })
            $('#form_edituser')[0].reset();
            $('#modal_edit').modal('hide');
            table.ajax.reload();
          },
          error:function(){
            Toast.fire({
                  type: 'warning',
                  title: 'Tidak dapat mengakses server ...',
                })
          }
        });
      }
    })

    // Modal Add Show
    $('#btn_adduser').on('click',function(){
      $('#modal_add').modal('show')
    })
  });

</script>
