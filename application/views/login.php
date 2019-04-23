<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>SIPPS | Login</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/image/logo.png' ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/vendors.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/vendors/css/forms/icheck/icheck.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/vendors/css/forms/icheck/custom.css' ?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/app.css' ?>">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/menu/menu-types/vertical-content-menu.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/colors/palette-gradient.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/pages/login-register.css' ?>">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/style.css' ?>">
    <!-- END Custom CSS-->

      <!-- Jqoery -->
      <script src="<?= base_url().'assets/app-assets/js/core/libraries/jquery/jquery.min.js' ?>" type="text/javascript"></script>
      <script type="text/javascript">

        function cek_auth(){
          var session = localStorage.getItem('sipps');
          var auth = JSON.parse(session);

          if (session) {
            window.location.replace('<?= base_url().'' ?>'+auth.level+'/')
          };
        };

        cek_auth();
      </script>

      <style media="screen">
        body{
          background-image: url('<?= base_url().'assets/image/bg20.jpg' ?>');
          background-repeat: no-repeat;
          background-size: cover;
        }
      </style>
  </head>
  <body class="vertical-layout vertical-content-menu 1-column menu-expanded fixed-navbar"data-open="click" data-menu="vertical-content-menu" data-col="1-column">
    <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="<?= base_url().'assets/image/logo.png' ?>" alt="branding logo" style="width:100px; height:100px;">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>SMA Al-Huda , Cengkareng</span>
                  </h6>
                </div>
                <div class="card-content" >
                  <div class="card-body">
                    <form class="form-horizontal" id="form_login">
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control input-lg" id="nip" name="nip" placeholder="NIP">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
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
                          <input type="checkbox" id="show_pass" class="chk-remember" style="width:20px; height:20px;">
                          <label> Lihat sandi</label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-danger btn-block btn-lg" id="btn_login"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>


  <!-- BEGIN VENDOR JS-->
  <script src="<?= base_url().'assets/app-assets/vendors/js/vendors.min.js' ?>" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?= base_url().'assets/app-assets/vendors/js/ui/headroom.min.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/vendors/js/forms/icheck/icheck.min.js' ?>" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="<?= base_url().'assets/app-assets/js/core/app-menu.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/js/core/app.js' ?>" type="text/javascript"></script>
  <!-- <script src="<?= base_url().'assets/app-assets/js/scripts/customizer.js' ?>" type="text/javascript"></script> -->
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

        var nip         = $('#nip').val();
        var password    = $('#password').val();
        var link_login  = '<?= base_url().'api/auth/login_user/' ?>'

        if (nip === '' || password === '') {
          Toast.fire({
            type: 'warning',
            title: 'Nim / Password Tidak boleh kosong',
          })
        }else {
          $.ajax({
            url: link_login,
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_login').serialize(),
            beforeSend:function(){
              $('#btn_login').addClass('disabled').attr('disabled','disabled').html('<span><i class="fas fa-spinner fa-spin" style="font-size:20px;"></i> Login</span>')
            },
            success:function(response){
              if (response.status === 200) {
                var link = '<?= base_url().'' ?>'+response.data.level

                localStorage.setItem("sipps",JSON.stringify(response.data));
                window.location.replace(link)
              }else {
                Toast.fire({
                  type: 'error',
                  title: response.message,
                })
                $('#btn_login').removeClass('disabled').removeAttr('disabled','disabled').html('<span><i class="ft-unlock"></i> Login</span>')
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
      // Show Password
      $('#show_pass').click(function(){
        if($(this).is(':checked')){
          $('#password').attr('type','text');
        }else{
          $('#password').attr('type','password');
        };
      });
      // End Show Password
    });
  </script>
  </body>
</html>
