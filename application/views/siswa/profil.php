
<style media="screen">
  .text-center{
    background-image: url(<?= base_url().'assets/image/user_bg2.jpg' ?>);
    background-size: cover;
  }
  h4,h6{
    color:white;
    font-size: 20px;
  }
</style>

<div class="col-xl-12 col-md-12 col-12">
  <div class="card border-teal border-lighten-2">
    <div class="text-center">
      <div class="card-body">
        <div class="foto"></div>
      </div>
      <div class="card-body">
        <h4 class="card-title nama_wali"></h4>
        <h6 class="card-subtitle id_user"></h6>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-primary mr-1"><i class="ft-edit"></i> Edit Profil</button>
        <button type="button" class="btn btn-success mr-1"><i class="ft-repeat"></i> Ganti Password</button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <div class="list-group list-group-flush">
          <a  class="list-group-item"><i class="ft-user-check"></i> <span class="nama_wali"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="email"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="telepon"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="alamat"></span> </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="list-group list-group-flush">
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="nama_siswa"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="nis"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="kelas"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="thn_ajaran"></span> </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="list-group list-group-flush">
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="jkel"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="tmp_lahir"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="tgl_lahir"></span> </a>
          <a  class="list-group-item "><i class="ft-user-check"></i> <span class="tgl_regist"></span> </a>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  $(document).ready(function() {
    var session     = localStorage.getItem('ext_sipps');
    var auth        = JSON.parse(session);
    var token       = auth.token;
    var link_show   = `<?= base_url().'api/auth/profile_wali/' ?>${token}`
    // console.log(link_show);
      $.ajax({
        url: link_show,
        type: 'GET',
        dataType: 'JSON',
        success:function(response){
          $.each(response.data,function(k,v) {
            $('.nama_wali').text(v.nama_wali)
            $('.id_user').text(v.id_user)
            $('.email').text(v.email)
            $('.telepon').text(v.telepon)
            $('.alamat').text(v.alamat)
            $('.tgl_regist').text(v.tgl_registrasi)
            $('.nis').text(v.nis)
            $('.nama_siswa').text(v.nama_siswa)
            $('.jkel').text(v.jenis_kelamin)
            $('.tmp_lahir').text(v.tempat_lahir)
            $('.tgl_lahir').text(v.tgl_lahir)
            $('.kelas').text(v.kelas)
            $('.thn_ajaran').text(v.tahun_ajaran)
            $('.foto').html(`<img src="<?= base_url().'doc/siswa/' ?>${v.foto}" class="rounded-circle height-150" alt="Card image">`)
          });
          // console.log(response.data);
        },
        error:function(){}
      });
  });
</script>
