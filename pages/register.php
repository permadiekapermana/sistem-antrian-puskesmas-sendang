<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Page | Desa Kemlaka Gede</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  <link rel="shortcut icon" href="images/logo-desa.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <!-- <div class="register-logo">
    <a href="../index2.html"><b>Admin</b>LTE</a>
  </div> -->

  <div class="register-box-body">
  <div class="form-group" align="center">
    <img class="login-box-msg" width="40%" src="images/logo-desa.png" alt="">
    <p class="login-box-msg">Buat akun</p>
  </div>

    <form action="aksi_register.php" method="POST">
    <div class="form-group has-feedback">
        <label>&nbspNIK</label>
        <input type="text" class="form-control" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" required>
      </div>
      <div class="form-group has-feedback">
        <label>&nbspUsername</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
      </div>
      <div class="form-group has-feedback">
        <label>&nbspPassword</label>
        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!-- <input type="checkbox"> I agree to the <a href="#">terms</a> -->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> -->

    <a href="login.php" class="text-center">Sudah punya akun ?</a> <br><br>
    <div class="social-auth-links text-center">      
      <label>@2020 - Desa Kemlaka Gede</label> <br>
      <a href="#" > Ahmad Muchyidin</a>
    </div>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
