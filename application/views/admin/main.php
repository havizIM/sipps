<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SIPPS | Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/image/logo.png' ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/vendors.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/vendors/css/tables/datatable/datatables.min.css' ?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/app.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/vendors/js/jquery-ui/jquery-ui.min.css' ?>">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/menu/menu-types/vertical-compact-menu.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/colors/palette-gradient.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/pages/timeline.css' ?>">
    <!-- END Page Level CSS-->
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/style.css' ?>">
    <!-- END Custom CSS-->

    <!-- Jqoery -->
    <script src="<?= base_url().'assets/app-assets/js/core/libraries/jquery/jquery.min.js' ?>" type="text/javascript"></script>
    <script type="text/javascript">

    function cek_auth(){
      var session = localStorage.getItem('sipps');
      var auth = JSON.parse(session);

      if (!session) {
        window.location.replace('<?= base_url().'auth' ?>')
      }else{
          if (auth.level !== 'admin') {
            window.location.replace('<?= base_url().'' ?>'+auth.level+'/')
          }
        }
      };
    cek_auth();
    </script>

    <style media="screen">

    </style>
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark bg-cyan navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="#">
              <img class="brand-logo" alt="modern admin logo" src="<?= base_url().'assets/image/logo.png' ?>">
              <h3 class="brand-text">SMA AL-HUDA</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700 nama"></span>
                  <b>[<span class="level"></span>]</b>
                </span>
                <span class="avatar">
                  <img src="<?= base_url().'assets/image/user2.png' ?>" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item"><i class="text-info fas fa-address-card"></i> <span class="nip"></span></a>
                <a class="dropdown-item"><i class="text-info fas fa-user"></i> <span class="nama"></span></a>
                <a class="dropdown-item"><i class="text-info fas fa-star"></i> <span class="level"></span></a>
                <a class="dropdown-item"><i class="text-info fas fa-calendar-alt"></i> <span class="tgl"></span></a>
                <div class="dropdown-divider"></div>
                <div class="row">
                  <div class="col-6 col-md-6">
                    <a class="dropdown-item text-success" id="btn_gpass"><i class="fas fa-exchange-alt "></i> Ganti Password</a>
                  </div>
                  <div class="col-6 col-md-6 text-right">
                    <a class="dropdown-item text-danger" id="btn_logout"><i class="fas fa-power-off"></i> Logout</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item"><a href="#/dashboard"><i class="la la-home text-info"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a></li>
        <li class="nav-item"><a href="#/user"><i class="la la-user text-success"></i><span class="menu-title" data-i18n="nav.templates.main">User</span></a></li>
        <li class="nav-item"><a href="#/siswa"><i class="la la-users pink"></i><span class="menu-title" data-i18n="nav.templates.main">Siswa</span></a></li>
        <li class="nav-item"><a href="#/kelas"><i class="la la-building text-warning"></i><span class="menu-title" data-i18n="nav.dash.main">Kelas</span></a></li>
        <li class=" nav-item"><a href="#"><i class="la la-server"></i><span class="menu-title" data-i18n="nav.templates.main">Data Master</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="#/m_prestasi">Master Prestasi</a></li>
            <li><a class="menu-item" href="#/m_pelanggaran">Master Pelanggaran</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- Load Content-->
  <div id="content">

  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer footer-static footer-light fixed-bottom navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block"> Made with <i class="ft-heart pink"></i> By Suhendar</span>
    </p>
  </footer>

<!-- Modal Change Password -->
<div class="modal fade text-left" id="modal_gpass" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ganti Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_gpass">
        <div class="modal-body">
          <div class="form-group">
            <label>Password Lama</label>
            <input type="password" class="form-control" id="pass_lama" name="password_lama">
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" class="form-control" id="pass_baru" name="password_baru">
          </div>
          <div class="form-group">
            <label>Ulangi Password</label>
            <input type="password" class="form-control" id="rtp_pass">
          </div>
          <div class="form-group" style="margin-bottom:0px;">
            <div class="text-md-right">
              <input type="checkbox" id="show_pass" class="chk-remember" style="width:20px; height:20px;">
              <label> Lihat sandi</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-md btn-info" id="btn_savepass">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- BEGIN VENDOR JS-->
  <script src="<?= base_url().'assets/app-assets/vendors/js/vendors.min.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/vendors/js/tables/datatable/datatables.min.js' ?>" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="<?= base_url().'assets/app-assets/js/core/app-menu.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/js/core/app.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/js/scripts/customizer.js ' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/js/scripts/moment/moment.js ' ?>" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- SWEET ALERT 2 -->
  <script src="<?= base_url().'assets/app-assets/vendors/js/sweetalert2/sweetalert2.js' ?>"></script>
  <!-- JQUERY UI -->
  <script src="<?= base_url().'assets/app-assets/vendors/js/jquery-ui/jquery-ui.min.js' ?>"></script>

  <script type="text/javascript">
  // Load Content
  function load_content(link) {
    $.get(`<?= base_url().'admin/'?>${link}`,function(response){

      $('#content').html(response);
    });
  };

    $(document).ready(function() {
      const Toast = Swal.mixin({
                      toast: true,
                      position:'bottom-end',
                      showConfirmButton: false,
                      timer: 2500
                    });

      var session   = localStorage.getItem('sipps');
      var auth      = JSON.parse(session);

      $('.nama').text(auth.nama);
      $('.level').text(auth.level);
      $('.nip').text(auth.nip)
      $('.tgl').text(auth.tgl_registrasi)



      // Ajax Logout
      $('#btn_logout').on('click',function(){
        var link = '<?= base_url().'api/auth/logout_user/' ?>'+auth.token
        // alert(link)
        Swal.fire({
          title: 'Yakin untuk Logout ?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya logout !'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: link,
              type: 'GET',
              dataType: 'JSON',
              // data: {},
              beforeSend:function(){},
              success:function(response){
                if (response.status === 200) {
                  localStorage.clear();
                  window.location.replace('<?= base_url().'auth' ?>')
                }else {
                  Toast.fire({
                    type: 'warning',
                    title: response.message,
                  })
                }
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
      })

      // Ajax Change Pass
      $('#form_gpass').on('submit',function(e){
        e.preventDefault();
        var link = '<?= base_url().'api/auth/password_user/' ?>'+auth.token
        var pass_lama = $('#pass_lama').val();
        var pass_baru = $('#pass_baru').val();
        var rtp_pass = $('#rtp_pass').val();
        // alert(pass_baru)

        if (pass_lama === '' || pass_baru === '' || rtp_pass === '') {
          Toast.fire({
            type: 'warning',
            title: 'Password tidak boleh kosong ...',
          })
        }else if (rtp_pass !== pass_baru) {
          Toast.fire({
            type: 'warning',
            title: 'Password tidak sama ...',
          })
        }else {
          $.ajax({
            url: link,
            type: 'POST',
            dataType: 'JSON',
            data: {
              password_lama : pass_lama,
              password_baru : pass_baru
            },
            beforeSend:function(){
              $('#btn_savepass').addClass('disabled').attr('disabled','disabled').html('<span>Simpan Perubahan <i class="fas fa-spinner fa-spin"></i></span>')

            },
            success:function(response){

              if (response.status === 200) {
                Toast.fire({
                  type: 'success',
                  title: response.message,
                })
                $('#modal_gpass').modal('hide');
              }else {
                Toast.fire({
                  type: 'error',
                  title: response.message,
                })
              }
              $('#btn_savepass').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
            },
            error:function(){
              Swal.fire({
               type: 'warning',
               title: 'Tidak dapat mengakses server ...',
               showConfirmButton: false,
               timer: 2000
              })
                $('#btn_savepass').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Simpan Perubahan</span>')
            }
          });
        }
      })

      // Modal Ganti Password
      $('#btn_gpass').on('click',function(){
        $('#modal_gpass').modal('show');
        $('#form_gpass')[0].reset();
      })

      // Show Password
      $('#show_pass').click(function(){
        if($(this).is(':checked')){
          $('#pass_baru,#pass_lama').attr('type','text');
        }else{
          $('#pass_baru,#pass_lama').attr('type','password');
        };
      });

      // Load with URL
      if (location.hash) {
        link = location.hash.substr(2);
        load_content(link);
      }else {
        location.hash ='#/dashboard';
      }

      // load with navigasi
      $(window).on('hashchange',function(){
        link = location.hash.substr(2);
        load_content(link);
      });
    });
  </script>
  </body>
</html>
