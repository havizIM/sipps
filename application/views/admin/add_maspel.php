<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Tambah Master Pelanggaran</h3>
        <div class="row breadcrumbs-top mt-1 mb-0">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="#/m_pelanggaran">Master Pelanggaran</a>
              </li>
              <li class="breadcrumb-item active">Tambah Pelanggaran
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="#/m_pelanggaran" class="btn btn-round btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div><hr>
    <div class="content-body">
      <div class="card">
        <div class="card-body">
          <form id="form_addmaspel">
            <div class="form-group">
              <label>Deskripsi</label>
              <input type="text" class="form-control" id="deskripsi_pelanggaran" name="deskripsi_pelanggaran">
            </div>
            <div class="form-group">
              <label>Point</label>
              <input type="text" class="form-control" id="poin_pelanggaran" name="poin_pelanggaran">
            </div>
            <div class="form-group">
              <label>Kategori Pelanggaran</label>
              <div class="input-group">
                <input type="hidden" name="id_kapel" id="show_idkapel">
                <input type="text" class="form-control" name="kategori_pelanggaran" class="form-control" id="show_kapel" placeholder="-- Pilih Kategori --" readonly>
                <div class="input-group-append">
                  <span class="input-group-text bg-info text-white" id="modal_lookup" style="cursor:pointer;">Cari</span>
                </div>
              </div>
            </div>
            <div class="content-footer">
              <center><button type="submit" id="btn_add" class="btn btn-info">Tambah Pelanggaran</button></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Lookup -->
<div class="modal" tabindex="-1" role="dialog" id="lookup_kapel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kategori Pelanggaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addkat">
          <div class="input-group">
            <input type="text" class="form-control" name="kategori_pelanggaran" id="kapel" placeholder="Nama Kategori">
            <div class="input-group-append">
              <button class="btn btn-md btn-info" type="submit" id="add_kategori">Tambah</button>
            </div>
          </div><br>
        </form>
        <div class="table-responsive">
          <table class="table" id="t_kapel" style="width: 100%">
            <thead>
              <th></th>
              <th>ID</th>
              <th>Kategori Pelanggaran</th>
              <th></th>
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

    const Toast1 = Swal.mixin({
                    toast: true,
                    position:'center',
                    showConfirmButton: true,
                    // timer: 2500
                  });

    var session     = localStorage.getItem('sipps');
    var auth        = JSON.parse(session);
    var token       = auth.token

    // Modal show Lookup
    $('#modal_lookup').on('click', function(){
      $('#lookup_kapel').modal('show');
    });
    var table = $('#t_kapel').DataTable({
      columnDefs: [{
          targets: [0,3],
          orderable: false
      },{
        targets: [0,1,3],
        searchable: false
      }],
      processing : true,
      ajax : '<?= base_url().'api/kapel/show/' ?>'+token,
      columns : [
        {"data" : null, "render" : function(data, type, row){
          return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.id_kapel}" data-nama="${row.kategori_pelanggaran}"><i class="icon-trash"></i> Pilih</button>`;
        }},
        {"data" : "id_kapel"},
        {"data" : "kategori_pelanggaran"},
        {"data" : null, "render": function(data,type,row){
          return `<button type="button" class="btn btn-danger btn-sm" id="btn_delete" data-id="${row.id_kapel}"><i class="fas fa-trash"></i> Hapus</button>`;
        }}
      ],
      order : [[1, 'desc']]
    });

    // Ajax Add Kapel
    $('#form_addkat').on('submit',function(e){
      e.preventDefault();

      var kapel = $('#kapel').val();

      // alert(kapel)

      $.ajax({
        url: '<?= base_url().'api/kapel/add/' ?>'+token,
        type: 'POST',
        dataType: 'JSON',
        data: {
          kategori_pelanggaran : kapel
        },
        beforeSend:function(){},
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
          }
          $('#form_addkat')[0].reset();
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
    })
    $('#t_kapel tbody').on('click', '#pilih', function(){
      // alert('Coba');
      var id_kapel = $(this).attr('data-id');
      var nama_kategori = $(this).attr('data-nama');

      $('#show_idkapel').val(id_kapel);
      $('#show_kapel').val(nama_kategori);

      $('#lookup_kapel').modal('hide');
    });

    // Ajax Delete
    $(document).on('click','#btn_delete',function(e){
      e.preventDefault();

      var id_kapel = $(this).attr('data-id')

      Toast1.fire({
        title: 'Hapus kategori ?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: `<?= base_url().'api/kapel/delete/'?>${token}?id_kapel=${id_kapel}`,
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
    })

    // Ajax Add maspel
    $('#form_addmaspel').on('submit',function(e){
      e.preventDefault();

      var dpel = $('#deskripsi_pelanggaran').val();
      var poin = $('#poin_pelanggaran').val();
      var kapel = $('#show_kapel').val();
      var id_kapel = $('#show_idkapel').val();

      if (dpel === '' || poin === '' || kapel === '') {
        Toast.fire({
          type: 'warning',
          title: 'Data tidak boleh kosong ...',
        })

      }else {
        $.ajax({
          url: '<?= base_url().'api/maspel/add/' ?>'+token,
          type: 'POST',
          dataType: 'JSON',
          data: {
            deskripsi_pelanggaran:dpel,
            poin_pelanggaran:poin,
            id_kapel:id_kapel
          },
          // beforeSend:function(){},
          success:function(response){
            if (response.status === 200) {
              Swal.fire({
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
              location.hash='#/m_pelanggaran'
            }else {
              Swal.fire({
                type: 'error',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
            }

            $('#form_addmaspel')[0].reset();
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
    })
  });
</script>
