<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SIPPS | Admin</title>

    <!-- Favicon icon -->
    <!-- <link rel="icon" href="<?= base_url().'assets/images/favicon.ico' ?>" type="image/x-icon"> -->
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="<?= base_url().'assets/fonts/fontawesome/css/fontawesome-all.min.css' ?>">
    <!-- animation css -->
    <link rel="stylesheet" href="<?= base_url().'assets/plugins/animation/css/animate.min.css' ?>">
    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url().'assets/css/style.css' ?>">

    <!-- Required Js -->
    <script src="<?= base_url().'assets/js/jquery/jquery.min.js' ?>"></script>
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
    .pcoded-header .dropdown .dropdown-toggle {
      line-height: 70px;
      display: inline-block;
      padding-right: 20px;
    }
    .swal2-container {
      z-index: 2000 !important;
    }

    </style>
  </head>
  <body>
    <!-- [ Pre-loader ] start -->
    <!-- <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div> -->
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
              <a href="#" class="b-brand">
                 <img src="<?= base_url().'assets/image/logo.png' ?>" alt="SMA Al-Huda" style="width:45px; height:45px;">
                 <span class="b-title">Admin</span>
              </a>
                <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label style="font-size:15px;">Menu</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#"><span></span></a>
            <a href="#" class="b-brand">
               <img src="<?= base_url().'assets/image/logo.png' ?>" alt="SMA Al-Huda" style="width:45px; height:45px;">
               <span class="b-title">Admin</span>
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
              <li><a href="#" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li>
              <div class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fas fa-user-cog" style="font-size:20px;"></i></a>
                <div class="dropdown-menu dropdown-menu-right notification">
                  <div class="noti-head">
                    <h6>Option</h6>
                    <button type="button" class="btn btn-block btn-info btn-md" id="btn_profil" name="button">Profile</button>
                    <button type="button" class="btn btn-block btn-success btn-md md-trigger" data-modal="modal-16" id="btn_gpass" name="button">Ganti Password</button>
                    <button type="button" class="btn btn-block btn-danger btn-md" id="btn_logout" name="button">LogOut</button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
    </header>
    <!-- [ Header ] end -->
    <!-- [ Main Content ] start -->
    <section class="pcoded-main-container">
      <div class="pcoded-wrapper">
        <div class="pcoded-content">
          <div class="pcoded-inner-content">

            <div class="main-body">
              <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div id="content">

                </div>
                <!-- [ Main Content ] end -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Main Content ] end -->

    <!-- [ MODAL CHANGE PASS ] start -->
    <div class="modal fade" id="modal_gpass">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Ganti Password</h5>
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
            <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" class="show_pass">
                    <label for="checkbox-fill-a1" class="cr">Lihat Password </label>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="btn_savepass" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
    </div>
    <!-- [ Modal Change Pass ] end -->
    <!-- SweetAlert -->
    <script src="<?= base_url().'assets/plugins/sweetalert2/sweetalert2.js' ?>"></script>
    <!-- Required Js -->
    <script src="<?=base_url().'assets/js/vendor-all.min.js' ?>"></script>
    <script src="<?=base_url().'assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script src="<?=base_url().'assets/js/pcoded.min.js' ?>"></script>

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

      // Ajax Logout
      $('#btn_logout').on('click',function(){
        var link = '<?= base_url().'api/auth/logout_user/' ?>'+auth.token
        // alert(link)
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
              alert(response.message)
            }
          },
          error:function(){
            alert('Gagal Mengakses Server')
          }
        });
      })

      // Ajax Change Pass
      $('#form_gpass').on('submit',function(e){
        e.preventDefault();
        var link = '<?= base_url().'api/auth/password_user/' ?>'+auth.token
        var pass_lama = $('#pass_lama').val();
        var pass_baru = $('#pass_baru').val();
        // alert(pass_baru)

        if (pass_lama === '' || pass_baru === '') {
          Toast.fire({
            type: 'warning',
            title: 'Password tidak boleh kosong ...',
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
            beforeSend:function(){},
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
              $('#form_gpass')[0].reset();
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

      // Modal Show Gpass
      $('#btn_gpass').on('click',function(){
        $('#modal_gpass').modal('show');
      })
      // End Modal Show Gpass
      // Show Password
      $('.show_pass').click(function(){
        if($(this).is(':checked')){
          $('#pass_lama,#pass_baru').attr('type','text');
        }else{
          $('#pass_lama,#pass_baru').attr('type','password');
        };
      });
      // End Show Password
    });
    </script>
  </body>
</html>
