
  function loadValueEdit(){

    var id_panggilan = location.hash.substr(17)

    // Show value edit
    $.ajax({
      url: BASE_URL+`api/panggilan/show/${token}?id_panggilan=${id_panggilan}`,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $.each(response.data,function(k,v){
          $('#show_idnis').val(v.nis);
          $('#keterangan').val(v.keterangan);
          $('#show_nis').val(v.nis+' - '+v.nama_siswa);

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
  }

  $(document).ready(function() {

    loadValueEdit()

    const Toast = Swal.mixin({
                    toast: true,
                    position:'bottom-end',
                    showConfirmButton: false,
                    timer: 2500
                  });

    var id_panggilan = location.hash.substr(17)
    var link_show    = BASE_URL+'api/siswa/show/'+token
    // Modal show Lookup
    $('#modal_lookup').on('click', function(){
      $('#lookup_nis').modal('show');
    });
    var table = $('#t_nis').DataTable({
      columnDefs: [{
          targets: [0,1,2,4],
          orderable: false
      },{
        targets: [0,3,4],
        searchable: false
      }],
      processing : true,
      ajax : link_show,
      columns : [
        {"data" : null, "render" : function(data, type, row){
          return `<button type="button" class="btn btn-info btn-sm" id="pilih" data-id="${row.nis}" data-nama="${row.nama_siswa}">Pilih</button>`;
        }},
        {"data" : "nis"},
        {"data" : "nama_siswa"},
        {"data" : "kelas"},
        {"data" : "sisa_poin"},
      ],
      order : [[3, 'desc']]
    });

    // Pilih Nis
    $('#t_nis tbody').on('click', '#pilih', function(){
      // alert('Coba');
      var nis = $(this).attr('data-id');
      var nama_siswa = $(this).attr('data-nama');

      $('#show_idnis').val(nis);
      $('#show_nis').val(`${nis} - ${nama_siswa}`);

      $('#lookup_nis').modal('hide');
    });

    // Edit Panggilan
    $('#form_editpang').on('submit',function(e){
      e.preventDefault();

      var link_edit = BASE_URL+`api/panggilan/edit/${token}?id_panggilan=${id_panggilan}`

      var nis = $('#show_idnis').val()
      var keterangan = $('#keterangan').val()

      if (nis === '' || keterangan === '') {
        Toast.fire({
            type: 'warning',
            title: 'Data tidak boleh kosong ...',
          })
      }else {
        $.ajax({
          url: link_edit,
          type: 'POST',
          dataType: 'JSON',
          data: new FormData(this),
          processData:false,
          contentType:false,
          beforeSend:function(){
            $('#btn_simpan').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan<i class="fas fa-spinner fa-spin"></i></span>')
          },
          success:function(response){
            if (response.status === 200) {
              Toast.fire({
                  type: 'success',
                  title: response.message,
                })
              location.hash='#/panggilan'
            }else {
              Toast.fire({
                  type: 'error',
                  title: response.message,
                })
              $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
            }
          },
          error:function(){
            Swal.fire({
             type: 'warning',
             title: 'Tidak dapat mengakses server ...',
             showConfirmButton: false,
             timer: 2000
            })
            $('#btn_simpan').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
          }
        });
      }
    })
  });
