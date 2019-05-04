<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-9 mb-2">
        <h3 class="content-header-title mb-0">Siswa</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                </li>
              <li class="breadcrumb-item active">Siswa
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
        <div class="btn-group">
          <a href="#/add_siswa" class="btn btn-round btn-info"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <section>
        <div class="card">
          <div class="card-header">
            <h3>Detail Siswa</h3>
          </div>
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_siswa" >
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIS</th>
                      <th>Jenis Kelamin</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Status</th>
                      <th>Wali</th>
                      <th>Email</th>
                      <th>Telepon</th>
                      <th>Alamat</th>
                      <th>#</th>
                      <th>#</th>
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
    var link_show   = '<?= base_url().'api/siswa/show/'?>'+token
    // alert(token)

    var table = $('#detail_siswa').DataTable({
      columnDefs :[{
        targets:[3,4,5,8,9,10,11,12,13],
        searchable:false
      },{
        targets:[3,4,5,8,9,10,11,12,13],
        orderable:false
      }],
      responsive:true,
      processing:true,
      ajax:link_show,
      columns:[
        {"data":"nama_siswa"},
        {"data":"nis"},
        {"data":"jenis_kelamin"},
        {"data":"tempat_lahir"},
        {"data":"tgl_lahir"},
        {"data":"kelas"},
        {"data":"tahun_ajaran"},
        {"data":"status"},
        {"data":"nama_wali"},
        {"data":"email"},
        {"data":"telepon"},
        {"data":"alamat"},
        {"data":null,"render":function(data,type,row){
          return `<img src="<?= base_url().'doc/siswa/' ?>${row.foto}" class="avatar" alt="Foto" style="width:70px; height: 70px;">`
        }},
        {"data":null,"render":function(data,type,row){

            return `<a href="#/edit_siswa/${row.nis}" id="btn_edit" class="btn  btn-sm btn-success">Edit</a> <button type="button" data-id="${row.nis}" id="btn_delete" class="btn  btn-sm btn-danger" >Hapus</button>`

        }},
      ],
      order:[[7,'desc']]
    });

    // Ajax Delete Maspel
    $(document).on('click','#btn_delete',function(){

      var nis           = $(this).attr('data-id');
      var link_delete   = `<?= base_url().'api/siswa/delete/' ?>${token}?nis=${nis}`

      Swal.fire({
        title: 'Apakah anda yakin...',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        width: 400

      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: link_delete,
            type: 'GET',
            dataType: 'JSON',
            // beforeSend:function(){},
            success:function(response){
              Swal.fire({
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
              table.ajax.reload();
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
      });
    });

  });
</script>
