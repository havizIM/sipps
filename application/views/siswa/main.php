<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SIPPS | SISWA</title>
    <!-- Required Js -->
    <script src="<?= base_url().'assets/js/jquery/jquery.min.js' ?>"></script>
    <script type="text/javascript">
    function cek_auth(){
      var session = localStorage.getItem('sipps');
      var auth = JSON.parse(session);

      if (!session) {
        window.location.replace('<?= base_url().'auth' ?>')
        else {
          if (auth.level !== 'siswa') {
            window.location.replace('<?= base_url().'' ?>'+auth.level+'/')
          }
        }
      };
    };
    cek_auth();
    </script>
  </head>
  <body>

    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
              <a href="#" class="b-brand">
                 <img src="<?= base_url().'assets/image/logo.png' ?>" alt="SMA Al-Huda" style="width:45px; height:45px;">
                 <span class="b-title">WaliMurid</span>
              </a>
                <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
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
               <span class="b-title">WaliMurid</span>
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
                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fas fa-cog" style="font-size:20px;"></i></a>
                <div class="dropdown-menu dropdown-menu-right notification">
                  <div class="noti-head">
                      <h6 class="d-inline m-b-0">Notifications</h6>
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
    <button type="button" name="button" id="btn_logout">Logout</button>

    <script type="text/javascript">
    $(document).ready(function() {

      var session = localStorage.getItem('sipps');
      var auth = JSON.parse(session);



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
    });

    </script>
  </body>
</html>
