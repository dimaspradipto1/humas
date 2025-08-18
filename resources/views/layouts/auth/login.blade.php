<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>sistem humas dan publikasi</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description"
      content="siAkad Cloud solusi terbaik Perguruan Tinggi. Langsung Bisa Digunakan, Tidak Ribet dan Pelaporan Beres.">
    <meta name="keywords" content="">
    <meta name="author" content="siAkad Cloud">
    <!-- font Awesome -->
    <link href="https://assets.siakadcloud.com/assets/v1/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="https://assets.siakadcloud.com/assets/v1/css/customs/login-v2.css?240723" rel="stylesheet"
      type="text/css" />
    <link rel="icon" type="img/png" href="https://assets.siakadcloud.com/public/uis-favicon.png" sizes="16x16" />


    <style type="text/css">
      html,
      body {
        background: #f2f2f2 url('https://assets.siakadcloud.com/assets/v1/img/pattern/pat_04.png') repeat;
      }

      .password {
        position: relative;
      }

      .showbtn {
        cursor: pointer;
        overflow: hidden;
        right: 15px;
        position: absolute;
        top: 10px;
        cursor: pointer;
      }

      .login-page .form-box .form-login img.logo {
        max-width: 90%;
      }

      .login-page .form-box {
        border-radius: 10px;
        box-shadow: 0 0 35px 0 rgb(154 161 171 / 20%);
      }

      .btn {
        border-radius: .3rem;
      }

      .btn-login {
        font-size: 14px;
      }

      .login a {
        font-size: 14px;
      }

      .title-login-email {
        display: flex;
        position: relative;
        padding: 1.25rem 0;
        margin-top: 10px;
        margin-bottom: 10px;
      }

      .title-line {
        display: flex;
        width: 100%;
        border-top: 1px solid #E0E3E7;
      }

      .title-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 14px;
        line-height: 1.25rem;
        font-weight: 500;
        color: #99A1AE;
        background-color: #ffffff;
        width: 165px;
        text-align: center;
      }

      .form-group {
        font-size: 14px;
      }

      .form-group strong {
        font-weight: 500;
      }

      p {
        font-size: 14px;
      }

      .input-line {
        font-size: 13px;
      }

      @media (max-width: 768px) {


        .div_loading {
          position: fixed;
          top: 0;
          left: 0;
          z-index: 999;
          width: 100vw;
          height: 100vh;
          background: rgba(0, 0, 0, 0.2);
          display: flex;
          align-items: center;
          justify-content: center;
        }
    </style>
    
  </head>
  
  <body class="login-page">
    @include('sweetalert::alert')
    
    <div class="container">
      <div class="row">
        <div class="form-box col-md-4 col-sm-10 col-xs-12">

          
          <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 form-login" align="center">
            <img src="https://assets.siakadcloud.com/uploads/uis/logoaplikasi/156.jpg" class="logo"
              style="margin-bottom: 30px;">
            <b>
              <span class="text-center" style="font-size:20px; font-weight: 600; display: block">Masuk dan
                Verifikasi</span>
            </b>
            <p style="margin-bottom: 15px;">
              Baru! Nikmati kemudahan mengakses semua layanan Humas dan Publikasi Universitas Ibnu Sina dengan satu akun melalui sistem autentikasi tunggal
            </p>
            <form action="{{ route('loginproses') }}" method="POST">
              @csrf

              <div class="alert alert-danger alert-dismissable temp-error-xhr" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="error-msg"></span>
              </div>

              <div class="login">
                {{--  <a href="#" class="btn btn-default btn-block" style="font-weight: 600;">
                  <img src="https://quantum.sevima.com/assets/images/logo-google.svg" alt=""> Masuk dengan
                  Google
                </a>  --}}
                
                <div class="title-login-email">
                  <span class="title-line"></span>
                  {{--  <p class="title-text">atau lanjutkan dengan</p>  --}}
                </div>

                <div class="form-group" style="text-align: left">
                  <span><strong>Email</strong></span><span style="color:red">*</span>

                  <input type="text" name="login" value="{{ old('login') }}" id="email" class="form-control input-line"
                    placeholder="Masukkan email yang terdaftar" required="true" autocomplete="off" />
                </div>

                <div class="form-group" style="text-align: left; margin-bottom: -5px;">
                  <span><strong>Password</strong></span><span style="color:red">*</span>
                  <div class="password">

                    <input type="password" id="password" name="password" class="form-control input-line"
                      placeholder="Masukkan password" required="true" autocomplete="off" />
                    <span id="iconshow" name="iconshow" onClick="showPass()" class=" showbtn fa fa-eye-slash"></span>
                  </div>
                </div>

                {{--  <a style="font-size: 13px; padding: 0px 0px 25px 0px;text-decoration-line: underline;font-weight: 600;"
                  href="{{ route('forgotpassword') }}" class="text-center pull-right">Lupa kata sandi?</a>  --}}
                <div class="form-group" style="margin-top: 20pt;" align="center">
                  <button type="submit" data-type="login"
                    class="btn btn-flat btn-primary btn-block btn-login">Masuk</button>
                </div>

            </form>
            {{-- <div style="margin-top: 30px; font-size: 14px">
              <div class="form-group" align="center" style="margin-top: 10px;">
                <p>Belum punya akun? <a href="#" style="font-weight: 600;">Daftar Sekarang</a></p>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery 2.0.2 -->
    <script src="https://assets.siakadcloud.com/assets/v1/js/external/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://assets.siakadcloud.com/assets/v1/js/bootstrap.min.js" type="text/javascript"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91361426-5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('set', {
        'user_id': 'Universitas Ibnu Sina :  - '
      });
      gtag('config', 'UA-91361426-5', {
        'custom_map': {
          'dimension1': 'PerguruanTinggi',
          'dimension2': 'Pengguna',
          'dimension3': 'HakAkses',
          'dimension4': 'UnitKerja',
          'metric1': 'Pageviews'
        }
      });

      gtag('event', 'push_custom_var', {
        'PerguruanTinggi': 'Universitas Ibnu Sina',
        'Pengguna': 'Universitas Ibnu Sina :  - ',
        'HakAkses': '',
        'UnitKerja': ' - ',
        'Pageviews': 1
      });
    </script>

    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-analytics.js"></script>
    <script>
      if (firebaseConfig == undefined) {
        var firebaseConfig = {
          apiKey: "AIzaSyBE85GSM4dBUZ8m9aoJZVpSOQltwQZttDc",
          authDomain: "siakad-cloud-2.firebaseapp.com",
          databaseURL: "https://siakad-cloud-2.firebaseio.com",
          projectId: "siakad-cloud-2",
          storageBucket: "siakad-cloud-2.appspot.com",
          messagingSenderId: "735352312839",
          appId: "1:735352312839:web:9aa5508b27862f29a146a2",
          measurementId: "G-9GSZKDCXHL"
        };
        firebase.initializeApp(firebaseConfig);
      }
    </script>
    <script>
      firebase.analytics();
    </script>

    <script type="text/javascript">
      function showPass() {
        if (document.getElementById("password").type == 'password') {
          document.getElementById("password").type = 'text';
          document.getElementById("iconshow").classList.remove('fa-eye-slash');
          document.getElementById("iconshow").classList.add('fa-eye');
        } else {
          document.getElementById("password").type = 'password';
          document.getElementById("iconshow").classList.remove('fa-eye');
          document.getElementById("iconshow").classList.add('fa-eye-slash');
        }
      }

      $('[data-type="login"]').click(function() {
        var formlogin = $(this).parents().find('form');
        formlogin.submit();
      });

      // cek login
      $(function() {
        $('#email').keypress(function(e) {
          // Enter pressed?
          if (e.which == 10 || e.which == 13) {
            $('[data-type="login"]').trigger('click');
          }
        });
        $('#password').keypress(function(e) {
          // Enter pressed?
          if (e.which == 10 || e.which == 13) {
            $('[data-type="login"]').trigger('click');
          }
        });
      });
    </script>

    <script type="text/javascript">
      (function(c, l, a, r, i, t, y) {
        c[a] = c[a] || function() {
          (c[a].q = c[a].q || []).push(arguments)
        };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
      })(window, document, "clarity", "script", "ofu5vu16qk");
    </script>


    <script type="module" src="https://navigation.sevima.com/build/assets/navigation.js"></script>
    <script>
      $(document).ready(function() {
        window.addEventListener("navigation:load", ({
          detail
        }) => {
          detail?.flush();
        })
      });
    </script>
  </body>

</html>
