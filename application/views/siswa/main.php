
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

  <title>SMA Al-Huda | Siswa</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/image/logo.png' ?>">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/vendors.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/vendors/css/ui/prism.min.css' ?>">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/app.css' ?>">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/menu/menu-types/horizontal-menu.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/app-assets/css/core/colors/palette-gradient.css' ?>">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/style.css' ?>">
  <!-- END Custom CSS-->

  <!-- Jqoery -->
  <script src="<?= base_url().'assets/app-assets/js/core/libraries/jquery/jquery.min.js' ?>" type="text/javascript"></script>
  <script type="text/javascript">

  function cek_auth(){
    var session = localStorage.getItem('ext_sipps');
    var auth = JSON.parse(session);

    if (!session) {
      window.location.replace('<?= base_url().'auth/login_ext' ?>')
    }
  };
  cek_auth();
  </script>

</head>

<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-border navbar-brand-center">
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
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>

          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700">John Doe</span>
                </span>
                <span class="avatar avatar-online">
                  <img src="<?= base_url().'assets/image/user1.png' ?>" alt="avatar"><i></i></span>
              </a>
            </li>
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="la la-gear la-spin text-danger" style="font-size:25px;"></i></a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item text-danger" id="btn_logout"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow"
  role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item">
          <a class="nav-link" href="#/dashboard"><i class="la la-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/profil"><i class="la la-user"></i>
            <span>Profil</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
        <div id="content">

        </div>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer footer-static footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
        target="_blank">PIXINVENT </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
  </footer>

  <!-- BEGIN VENDOR JS-->
  <script src="<?= base_url().'assets/app-assets/vendors/js/vendors.min.js' ?>" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="<?= base_url().'assets/app-assets/vendors/js/ui/jquery.sticky.js' ?>"></script>
  <script type="text/javascript" src="<?= base_url().'assets/app-assets/vendors/js/charts/jquery.sparkline.min.js' ?>"></script>
  <script type="text/javascript" src="<?= base_url().'assets/app-assets/vendors/js/ui/prism.min.js' ?>"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="<?= base_url().'assets/app-assets/js/core/app-menu.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/js/core/app.js' ?>" type="text/javascript"></script>
  <script src="<?= base_url().'assets/app-assets/js/scripts/customizer.js' ?>" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- SWEET ALERT 2 -->
  <script src="<?= base_url().'assets/app-assets/vendors/js/sweetalert2/sweetalert2.js' ?>"></script>

  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="<?= base_url().'assets/app-assets/js/scripts/ui/breadcrumbs-with-stats.js' ?>"></script>
  <!-- END PAGE LEVEL JS-->


  <script type="text/javascript">

  // Load Content
  function load_content(link) {
    $.get(`<?= base_url().'main/'?>${link}`,function(response){
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

      var session   = localStorage.getItem('ext_sipps');
      var auth      = JSON.parse(session);

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

      // Ajax Logout
      $('#btn_logout').on('click',function(){
        var link = '<?= base_url().'api/auth/logout_wali/' ?>'+auth.token
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
                  window.location.replace('<?= base_url().'auth/login_ext' ?>')
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

    });
  </script>
</body>
</html>
