<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>SMA Al-Huda</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/image/logo.png' ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/vendors.css' ?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/app.css' ?>">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/menu/menu-types/vertical-menu.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/colors/palette-gradient.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/pages/login-register.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/plugins/animate/animate.min.css' ?>">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/style.css' ?>">

    <!-- JQUERY -->
    <script src="<?= base_url().'assets/app-assets/js/core/libraries/jquery/jquery.min.js' ?>" type="text/javascript"></script>
    <script type="text/javascript">

      function cek_auth(){
        var session = localStorage.getItem('ext_sipps');
        var auth = JSON.parse(session);

        if (session) {
          window.location.replace('<?= base_url().'main/' ?>')
        };
      };

      cek_auth();
    </script>
  </head>
  <body>

    <body class="vertical-layout vertical-menu 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="index.html">
              <img class="brand-logo" alt="modern admin logo" src="<?= base_url().'assets/image/logo.png' ?>">
              <h3 class="brand-text">SMA Al-Huda</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container">
        <div class="collapse navbar-collapse justify-content-end" id="navbar-mobile">
          <ul class="nav navbar-nav">
            <li class="nav-item"><a class="nav-link mr-2 nav-link-label" href="index.html"><i class="ficon ft-facebook text-info"></i></a></li>
            <li class="nav-item"><a class="nav-link mr-2 nav-link-label" href="index.html"><i class="ficon ft-twitter" style="color:#68b8eb;"></i></a></li>
            <li class="nav-item"><a class="nav-link mr-2 nav-link-label" href="index.html"><i class="ficon ft-instagram text-danger"></i></a></li>

          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
        <section class="flexbox-container animated flipInY" id="login">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0" style="margin-top:5%;">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-content" style="margin-top:50px;">
                  <p class="card-subtitle line-on-side text-muted text-center font-small-20 mx-2 my-2">
                    <span>Login Wali Murid</span>
                  </p>
                  <div class="card-body pt-0">
                    <form id="form_login">
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control input-lg" id="nis" name="nis" placeholder="Nomor Induk Siswa">
                        <div class="form-control-position">
                          <i class="la la-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group">
                        <div class="text-md-right">
                          <input type="checkbox" id="show_pass" style="width:20px; height:20px;">
                          <label> Lihat sandi</label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-info btn-lg btn-block" id="btn_login"><i class="ft-unlock"></i> Masuk</button>
                    </form>
                  </div>
                  <div class="card-body pb-0">
                    <p class="text-center">Lupa password ? <button type="button" id="btn_rpass" class="btn btn-danger btn-sm ">Reset Password</button></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <!-- Reset Password -->
        <section class="flexbox-container animated flipInY" id="res_pass">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0" style="margin-top:5%;">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-content" style="margin-top:50px;">
                  <p class="card-subtitle line-on-side text-muted text-center font-small-20 mx-2 my-2">
                    <span>Lupa Password</span>
                  </p>
                  <div class="card-body pt-0">
                    <form id="form_respass">
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control input-lg" id="email" name="email" placeholder="Email">
                        <div class="form-control-position">
                          <i class="la ft-mail"></i>
                        </div>
                      </fieldset>

                      <button type="submit" class="btn btn-danger btn-lg btn-block" id="btn_respass">Reset Password</button>
                    </form>
                  </div>
                  <div class="card-body pb-0">
                    <p class="text-center"><button type="button" class="btn btn-info btn-sm" id="btn_back">Kembali</button></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer fixed-bottom footer-dark navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Made with <i class="ft-heart pink"></i> by Suhendar</span>
    </p>
  </footer>


    <!-- BEGIN VENDOR JS-->
    <script src="<?= base_url().'assets/app-assets/vendors/js/vendors.min.js' ?>" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?= base_url().'assets/app-assets/vendors/js/ui/headroom.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url().'assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js' ?>" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="<?= base_url().'assets/app-assets/js/core/app-menu.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url().'assets/app-assets/js/core/app.js' ?>" type="text/javascript"></script>
    <!-- <script src="<?= base_url().'assets/app-assets/js/scripts/customizer.js' ?>" type="text/javascript"></script> -->
    <script src="<?= base_url().'assets/app-assets/js/scripts/forms/form-login-register.js' ?>" type="text/javascript"></script>

    <!-- END MODERN JS-->

    <!-- SWEET ALERT 2 -->
    <script src="<?= base_url().'assets/app-assets/vendors/js/sweetalert2/sweetalert2.js' ?>"></script>

    <script type="text/javascript">
      $(document).ready(function() {

        const Toast = Swal.mixin({
                        toast: true,
                        position:'top-end',
                        showConfirmButton: false,
                        timer: 2000
                      });

        $('#form_login').on('submit',function(e){
          e.preventDefault();

          var nis         = $('#nis').val();
          var password    = $('#password').val();
          var link_login  = '<?= base_url().'api/auth/login_wali/' ?>'

          if (nis === '' || password === '') {
            Toast.fire({
              type: 'warning',
              title: 'Nis / Password Tidak boleh kosong',
            })
          }else {
            $.ajax({
              url: link_login,
              type: 'POST',
              dataType: 'JSON',
              data: $(this).serialize(),
              beforeSend:function(){
                $('#btn_login').addClass('disabled').attr('disabled','disabled').html('<span><i class="fas fa-spinner fa-spin" style="font-size:20px;"></i> Masuk</span>')
              },
              success:function(response){
                if (response.status === 200) {
                  var link = '<?= base_url().'main/' ?>'

                  localStorage.setItem("ext_sipps",JSON.stringify(response.data));
                  window.location.replace(link)
                }else {
                  Toast.fire({
                    type: 'error',
                    title: response.message,
                  })
                  $('#btn_login').removeClass('disabled').removeAttr('disabled','disabled').html('<span><i class="ft-unlock"></i> Masuk</span>')
                }

              },
              error:function(){
                Swal.fire({
                 type: 'warning',
                 title: 'Tidak dapat mengakses server ...',
                 showConfirmButton: false,
                 timer: 2000
                })
                $('#btn_login').removeClass('disabled').removeAttr('disabled','disabled').html('<span><i class="ft-unlock"></i> Masuk</span>')
              }
            });

          }
        })


        // Ajax Form Reset password
        $('#form_respass').on('submit',function(e){
          e.preventDefault();

          var email = $('#email').val()
          var link_res = '<?= base_url().'api/auth/lupa_password/' ?>'

          if (email === '') {
            Toast.fire({
              type: 'warning',
              title: 'Email Tidak boleh kosong',
            })
          }else {
            $.ajax({
              url: link_res,
              type: 'POST',
              dataType: 'JSON',
              data: $(this).serialize(),
              beforeSend:function(){
                $('#btn_respass').addClass('disabled').attr('disabled','disabled').html('<span><i class="fas fa-spinner fa-spin" style="font-size:20px;"></i> Reset Password</span>')
              },
              success:function(response){
                if (response.status === 200) {
                  Toast.fire({
                    type: 'success',
                    title: response.message,
                  })
                  $('#res_pass').hide()
                  $('#login').show()
                }else {
                  Toast.fire({
                    type: 'error',
                    title: response.message,
                  })
                }
                $('#btn_login').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Reset Password</span>')
              },
              error:function(){
                Swal.fire({
                 type: 'warning',
                 title: 'Tidak dapat mengakses server ...',
                 showConfirmButton: false,
                 timer: 2000
                })
                $('#btn_login').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Reset Password</span>')
              }
            });

          }

        })



        // Show Password
        $('#show_pass').click(function(){
          if($(this).is(':checked')){
            $('#password').attr('type','text');
          }else{
            $('#password').attr('type','password');
          };
        });
        // End Show Password

        $('#btn_rpass').click(function(){
          $('#login').hide()
          $('#res_pass').show()
          $('#form_respass')[0].reset()
        })

        $('#btn_back').click(function(){
          $('#login').show()
          $('#res_pass').hide()
        })

        $('#res_pass').hide()
      });
    </script>
  </body>
</html>
