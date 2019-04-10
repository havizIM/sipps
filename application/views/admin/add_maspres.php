

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Add Master Prestasi</h3>
      </div>
    </div>
    <div class="content-body">
      <div class="form-group">
        <label></label>
        <div class="input-group">
          <input type="hidden" name="id_kapres" id="show_idkapres">
          <input type="text" class="form-control" name="kategori_prestasi" class="form-control" id="show_kapres" placeholder="-- Pilih Kategori --" readonly>
          <div class="input-group-append">
            <span class="input-group-text bg-info text-white" id="modal_lookup">Cari</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Lookup -->
<div class="modal" tabindex="-1" role="dialog" id="lookup_kapres">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kategori Prestasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addpres">
          <div class="input-group">
            <input type="text" class="form-control" name="kategori_prestasi" id="kapres" placeholder="Nama Kategori">
            <div class="input-group-append">
              <button class="btn btn-md btn-info" type="submit" id="add_kategori">Tambah</button>
            </div>
          </div><br>
        </form>
        <div class="table-responsive">
          <table class="table" id="t_kapres" style="width:100%;">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Kategori Prestasi</th>
                <th></th>
              </tr>
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

    var session = localStorage.getItem('sipps');
    var auth = JSON.parse(session);
    var token = auth.token

    // Modal show Lookup
    $('#modal_lookup').on('click', function(){
      $('#lookup_kapres').modal('show');
    });
    var table = $('#t_kapres').DataTable({
      columnDefs: [{
          targets: [0,3],
          orderable: false
      },{
        targets: [0,1,3],
        searchable: false
      }],
      processing : true,
      ajax : '<?= base_url().'api/kapres/show/' ?>'+token,
      columns : [
        {"data" : null, "render" : function(data, type, row){
          return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.id_kapres}" data-nama="${row.kategori_prestasi}"><i class="icon-trash"></i> Pilih</button>`;
        }},
        {"data" : "id_kapres"},
        {"data" : "kategori_prestasi"},
        {"data" : null, "render": function(data,type,row){
          return `<button type="button" class="btn btn-danger btn-sm" id="btn_delete" data-id="${row.id_kapres}"><i class="fas fa-trash"></i> Hapus</button>`;
        }}
      ],
      order : [[1, 'desc']]
    });

    // Ajax Add Kategori
    $('#form_addpres').on('submit',function(e){
      e.preventDefault();

      var kapres = $('#kapres').val();

      // alert(kapres)

      $.ajax({
        url: '<?= base_url().'api/kapres/add/' ?>'+token,
        type: 'POST',
        dataType: 'JSON',
        data: {
          kategori_prestasi : kapres
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
          $('#form_addpres')[0].reset();
          table.ajax.reload();
        },
        error:function(){
          alert('Gagal mengakses server ...')
        }
      });
    })
    $('#t_kapres tbody').on('click', '#pilih', function(){
      // alert('Coba');
      var id_kapres = $(this).attr('data-id');
      var nama_kategori = $(this).attr('data-nama');

      $('#show_idkapres').val(id_kapres);
      $('#show_kapres').val(nama_kategori);

      $('#lookup_kapres').modal('hide');
    });

    // Ajax Delete
    $(document).on('click','#btn_delete',function(e){
      e.preventDefault();

      var id_kapres = $(this).attr('data-id')

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
            url: `<?= base_url().'api/kapres/delete/'?>${token}?id_kapres=${id_kapres}`,
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
        }
      });
    })

  });
</script>