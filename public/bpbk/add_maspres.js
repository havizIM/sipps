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
    ajax : BASE_URL+'api/kapres/show/'+token,
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

  // Ajax Add Kategori Prestasi
  $('#form_addpres').on('submit',function(e){
    e.preventDefault();

    var kapres = $('#kapres').val();

    // alert(kapres)

    $.ajax({
      url: BASE_URL+'api/kapres/add/'+token,
      type: 'POST',
      dataType: 'JSON',
      data: {
        kategori_prestasi : kapres
      },
      beforeSend:function(){
        $('#add_kategori').addClass('disabled').attr('disabled','disabled').html('<span>Tambah<i class="fas fa-spinner fa-spin"></i></span>')

      },
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
        $('#add_kategori').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
      },
      error:function(){
        Swal.fire({
             type: 'warning',
             title: 'Tidak dapat mengakses server ...',
             showConfirmButton: false,
             timer: 2000
            })
        $('#add_kategori').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah</span>')
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
          url: BASE_URL+`api/kapres/delete/${token}?id_kapres=${id_kapres}`,
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
                type: 'error',
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

  // Ajax Add maspres
  $('#form_addmaspres').on('submit',function(e){
    e.preventDefault();

    var dpres = $('#deskripsi_prestasi').val();
    var poin = $('#poin_prestasi').val();
    var kapres = $('#show_kapres').val();
    var id_kapres = $('#show_idkapres').val();

    if (dpres === '' || poin === '' || kapres === '') {
      Toast.fire({
        type: 'warning',
        title: 'Data tidak boleh kosong ...',
      })

    }else {
      $.ajax({
        url: BASE_URL+'api/maspres/add/'+token,
        type: 'POST',
        dataType: 'JSON',
        data: {
          deskripsi_prestasi:dpres,
          poin_prestasi:poin,
          id_kapres:id_kapres
        },
        beforeSend:function(){
          $('#btn_add').addClass('disabled').attr('disabled','disabled').html('<span>Tambah Prestasi<i class="fas fa-spinner fa-spin"></i></span>')
        },
        success:function(response){
          if (response.status === 200) {
            Swal.fire({
              type: 'success',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })
            location.hash='#/m_prestasi'
          }else {
            Swal.fire({
              type: 'error',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })
            $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Prestasi</span>')
          }
          $('#form_addmaspres')[0].reset();
          table.ajax.reload();
        },
        error:function(){
          Swal.fire({
           type: 'warning',
           title: 'Tidak dapat mengakses server ...',
           showConfirmButton: false,
           timer: 2000
          })
          $('#btn_add').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Tambah Prestasi</span>')
        }
      });

    }
  })

});
