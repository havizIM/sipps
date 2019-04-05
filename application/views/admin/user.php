<div class="row">
  <div class="col-md-6">
    <h5 class="">Data User</h5>
  </div>
  <div class="col-md-6">
    <button type="button" class="btn btn-info btn-md" id="btn_adduser" name="button" style="float:right;"> <i class="fas fa-plus"></i>Tambah</button>
  </div>
</div>
<hr>
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

<!-- [ MODAL CHANGE PASS ] start -->
<div class="modal fade" id="modal_add">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bg-success">
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
            <input type="text" class="form-control" id="nama" name="nama">
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
        <button type="submit" id="btn_savepass" class="btn btn-primary">Tambah</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- [ Modal Change Pass ] end -->

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
    // alert(token)

    var table = $('#detail_user').DataTable({
      columnDefs :[{
        targets:[0,2,3,4,5,6,7],
        searchable:false
      }],
      responsive:true,
      processing:true,
      ajax:'<?= base_url().'api/user/show/' ?>'+token,
      columns:[
        {"data":"nip"},
        {"data":"nama"},
        {"data":"username"},
        {"data":"password"},
        {"data":"level"},
        {"data":null,"render":function(data,type,row){
          return moment(row.tgl_registrasi,'YYYY-MM-DD hh:mm:ss').format('LL')
        }},
        {"data":"status"},
        {"data":null,"render":function(data,type,row){

            return `<button type="button" id="btn_edit" class="btn  btn-md btn-success" name="button">Edit</button> <button type="button" data-id="${row.nip}" id="btn_delete" class="btn  btn-md btn-danger" name="button">Hapus</button>`

        }},
      ],
      order:[[5,'asc']]
    });

    // Ajax Add User
    $('#form_adduser').on('submit',function(e){
      e.preventDefault();

      var nip = $('#nip').val();
      var nama = $('#nama').val();
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
        url: `<?= base_url().'api/user/delete/${token}?nip=' ?>`+nip,
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
    // Modal Add Show
    $('#btn_adduser').on('click',function(){
      $('#modal_add').modal('show')
    })
  });

</script>
