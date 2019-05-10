<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-9 mb-2">
          <h3 class="content-header-title mb-0">Kelas</h3>
          <div class="row breadcrumbs-top mt-1 mb-0">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                  </li>
                <li class="breadcrumb-item active">Kelas
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right mt-2 col-md-6 col-3">
          <div class="btn-group">
            <a href="#/add_kelas" class="btn btn-round btn-info"><i class="fas fa-plus"></i> Tambah</a>
          </div>
        </div>
      </div><hr>
      <div class="content-body">
        <div class="card">
            <div class="card-body">
              <div class="table-responsive" >
                <table class="table table-hover dataTable" id="detail_kelas" >
                  <thead>
                    <tr>
                      <th>Kelas</th>
                      <th>Nip</th>
                      <th>Nama Wali Kelas</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
        </div>
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
      var nip         = auth.nip;
      var link_show   = '<?= base_url().'api/kelas/show/'?>'+token
      // alert(token)

      var table = $('#detail_kelas').DataTable({
        columnDefs :[{
          targets:[],
          searchable:false
        },{
          targets:[],
          orderable:false
        }],
        responsive:true,
        processing:true,
        ajax:link_show,
        columns:[
          {"data":"kelas"},
          {"data":"nip"},
          {"data":"nama"},
          {"data":null,"render":function(data,type,row){

              return `<a href="#/edit_kelas/${row.kelas}" id="btn_edit" class="btn  btn-sm btn-success" >Edit</a> <button type="button" data-id="${row.kelas}" data-name="${row.kelas}" id="btn_delete" class="btn  btn-sm btn-danger" >Hapus</button>`

          }},
        ],
        order:[[0,'desc']]
      });

      // Ajax Delete Maspel
      $(document).on('click','#btn_delete',function(){

        var kelas = $(this).attr('data-id');
        var nama = $(this).attr('data-name');

        Swal.fire({
          title: `Hapus kelas ${nama} ?`,
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          width: 400

        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: `<?= base_url().'api/kelas/delete/' ?>${token}?kelas=${kelas}`,
              type: 'GET',
              dataType: 'JSON',
              // beforeSend:function(){},
              success:function(response){
                Toast.fire({
  			            type: 'success',
  			            title: response.message,
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
