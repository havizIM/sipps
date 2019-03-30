<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="CodedThemes" />
    <title>SIPPS | Login</title>

    <!-- fontawesome icon -->
    <link rel="stylesheet" href="<?= base_url().'assets/fonts/fontawesome/css/fontawesome-all.min.css' ?>">
    <!-- animation css -->
    <link rel="stylesheet" href="<?= base_url().'assets/plugins/animation/css/animate.min.css' ?>">
    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url().'assets/css/style.css' ?>">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan" rel="stylesheet">

    <style media="screen">

    .aut-bg-img {
      background-image: url('<?= base_url().'assets/image/bg26.jpg' ?>');
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
    }

    #gradient{
      background: #fe8c00;  /* fallback for old browsers */
      background: -webkit-linear-gradient(to left, #f83600, #fe8c00);  /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to left, #f83600, #fe8c00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      }
    </style>
  </head>
  <body>

    <div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch">
        <div class="row align-items-center w-100 align-items-stretch">
            <div class="d-none d-lg-flex col-lg-8 aut-bg-img align-items-center d-flex justify-content" style="background-color: #fe8800;">
                <div class="col-md-8 mb-0" style="bottom : 2%;">
                  <h2 class="text-white">Selamat Datang ...</h2>
                  <img class="content-center" src="<?= base_url().'assets/image/logo.png' ?>" alt="" style="width:300px; height:300px;">
                  <h5 class="text-white">Jl.Pejompongan Dalam no 2A,RT 004/005,Bendungan hilir,Tanah abang,Jakarta pusat,10210</h5><br>
                </div>
            </div>
            <div class="col-lg-4 align-items-stret align-items-center d-flex justify-content-center" id="gradient">
                <div class=" auth-content text-center bg-white mt-5 mb-5" style="border-radius:20px;">
                    <div class="mb-4">
                        <i class="feather icon-user auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login</h3>
                    <form id="form_login">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nip" id="nip" name="nip">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                    </div>
                    <div class="form-group text-left">
                        <div class="checkbox checkbox-fill d-inline">
                            <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" class="show_pass">
                            <label for="checkbox-fill-a1" class="cr">Show Password</label>
                        </div>
                    </div>
                    <button type="submit" id="btn_login" class="btn btn-primary shadow-2 mb-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Required Js -->
    <script src="<?= base_url().'assets/js/jquery/jquery.min.js' ?>"></script>
    <!-- <script src="<?= base_url().'assets/js/vendor-all.min.js' ?>"></script> -->
    <script src="<?= base_url().'assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>
    <!-- <script src="<?= base_url().'assets/js/pcoded.min.js' ?>"></script> -->
    <!-- SweetAlert -->
    <script src="<?= base_url().'assets/plugins/sweetalert2/sweetalert2.js' ?>"></script>

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

          var nip = $('#nip').val();
          var password = $('#password').val();

          if (nip === '' || password === '') {
            Toast.fire({
              type: 'warning',
              title: 'Nim / Password Tidak boleh kosong',
            })
          }else {
            $.ajax({
              url: '<?= base_url().'api/auth/login_user/' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: $('#form_login').serialize(),
              beforeSend:function(){},
              success:function(response){
                if (response.status === 200) {
                  console.log(response.data);
                  localStorage.setItem("session_sipps",JSON.stringify(response.data));
                }else {
                  Toast.fire({
                    type: 'error',
                    title: 'Nim / Password Salah ...',
                  })
                }
              },
              error:function(){
                alert('Gagal Mengakses Server !!!')
              }
            });

          }
        })

        $('.show_pass').click(function(){
          if($(this).is(':checked')){
            $('#password').attr('type','text');
          }else{
            $('#password').attr('type','password');
          };
        });
      });
    </script>
  </body>
</html>
