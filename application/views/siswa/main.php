
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
</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover"
data-menu="horizontal-menu" data-col="2-columns">
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
            <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Profil</a>
              <ul class="mega-dropdown-menu dropdown-menu row">
                <li class="col-md-2">
                  <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-picture-o"></i>Foto Profil</h6>
                  <div id="mega-menu-carousel-example">
                    <div>
                      <img class="rounded img-fluid mb-1" src="<?= base_url().'assets/image/user1.png' ?>" alt="User">
                      <p class="news-content">
                        <span class="font-small-2">Murid</span>
                      </p>
                    </div>
                  </div>
                </li>
                <li class="col-md-3">
                  <h6 class="dropdown-menu-header text-uppercase"><i class="la la-paste"></i> Profil</h6>
                  <ul class="drilldown-menu">
                    <li class="menu-list">
                      <ul>
                        <li class="row mb-2">
                          <label class="col-sm-4 form-control-label">Nama</label>
                          <label class="col-sm-8 form-control-label">: Yugi Setiawan</label>
                        </li>
                        <li class="row">
                          <label class="col-sm-4 form-control-label">Tempat Lahir</label>
                          <label class="col-sm-8 form-control-label">: Cilacap</label>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>

              </ul>
            </li>
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
                <a class="dropdown-item text-success" href="#" ><i class="ft-repeat"></i> Ganti Password</a>
                <a class="dropdown-item text-danger" id="btn_logout"><i class="ft-power"></i> Logout</a>
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
        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link" href="index.html" data-toggle="dropdown"><i class="la la-home"></i>
            <span>Dashboard</span>
          </a>
          <ul class="dropdown-menu">
            <li data-menu=""><a class="dropdown-item" href="dashboard-ecommerce.html" data-toggle="dropdown">eCommerce</a>
            </li>
            <li data-menu=""><a class="dropdown-item" href="dashboard-crypto.html" data-toggle="dropdown">Crypto</a>
            </li>
            <li data-menu=""><a class="dropdown-item" href="dashboard-sales.html" data-toggle="dropdown">Sales</a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">Light Layout</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Page Layouts</a>
                </li>
                <li class="breadcrumb-item active">Light Layout
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Description -->
        <section id="description" class="card">
          <div class="card-header">
            <h4 class="card-title">Description</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="card-text">
                <p>The light layout has a light color navbar, navigation menu and footer.
                  In this page you can experience it. If you want to create a light
                  version template you can use this layout.</p>
              </div>
            </div>
          </div>
        </section>
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
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="<?= base_url().'assets/app-assets/js/scripts/ui/breadcrumbs-with-stats.js' ?>"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>
