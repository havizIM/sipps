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
    var token       = auth.token;
    var nip         = auth.nip;
    var link_add    = '<?= base_url().'api/pengumuman/add/' ?>'+token
    // alert(token)

    var table = $('#detail_pengumuman').DataTable({
      columnDefs :[{
        targets:[0,1,2],
        searchable:false
      },{
        targets:[0,1,3,4],
        orderable:false
      }],
      responsive:true,
      processing:true,
      ajax:'<?= base_url().'api/pengumuman/show/'?>'+token,
      columns:[
        {"data":"deskripsi"},
        {"data":"tgl_input"},
        {"data":"nip"},
        {"data":"nama"},

        {"data":null,"render":function(data,type,row){

            return `<a href="<?= base_url().'doc/pengumuman/' ?>${row.file}" class="btn  btn-sm btn-info" target="blank">Download</a> <button type="button" data-id="${row.id_pengumuman}" id="btn_delete" class="btn  btn-sm btn-danger">Hapus</button>`

        }},
      ],
      order:[[2,'desc']]
    });


    // Ajax Delete
    $(document).on('click','#btn_delete',function(e){
      e.preventDefault();

      var id_pengumuman = $(this).attr('data-id')
      var link_delete   = `<?= base_url().'api/pengumuman/delete/'?>${token}?id_pengumuman=${id_pengumuman}`

      Swal.fire({
        title: 'Hapus data ?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: link_delete,
            type: 'GET',
            dataType: 'JSON',
            // data: {},
            // beforeSend:function(){
            //   $('#btn_delete').addClass('disabled').attr('disabled','disabled').html('<span>Hapus <i class="fas fa-spinner fa-spin"></i></span>')
            // },
            success:function(response){
              if (response.status === 200) {
                Toast.fire({
  			            type: 'success',
  			            title: response.message,
  			          })
              }else {
                Toast.fire({
  			            type: 'error',
  			            title: response.message,
  			          })
                // $('#btn_delete').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Hapus</span>')
              }
              table.ajax.reload();
            },
            error:function(){
              Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })
              // $('#btn_delete').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Hapus</span>')
            }
          });
        }
      });
    })

    // Ajax Add Pengumuman

    $('#form_addpeng').on('submit',function(e){
      e.preventDefault();

      var deskripsi = $('#deskripsi').val();
      var file      = $('#file').val()

      if (deskripsi === '' || file === '') {
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
          beforeSend:function(){
            $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah <i class="fas fa-spinner fa-spin"></i></span>')
          },
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                type: 'success',
                title: response.message,
              })
              $('#modal_add').modal('hide')
            }else {
                Toast.fire({
                  type: 'error',
                  title: response.message,
                })
            }
            table.ajax.reload();
            $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
          },
          error:function(){
            Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })
              $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
          }
        });

      }

    })

    // Modal Add Show
    $('#btn_addpeng').on('click',function(){
      $('#modal_add').modal('show')
      $('#form_addpeng')[0].reset();
    })

  });
</script>
