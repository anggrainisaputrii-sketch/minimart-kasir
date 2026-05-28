<?php
include 'config.php';
// Cek darurat: kalau loginUrl kosong, kita isi manual di sini biar tombolnya jalan
if (!isset($loginUrl) || empty($loginUrl)) {
    $loginUrl = "https://accounts.google.com/o/oauth2/v2/auth?client_id=98153288906-4k82kqnaflhohlju7iu7stqbvperecpa.apps.googleusercontent.com&redirect_uri=http://localhost/kasir/callback.php&response_type=code&scope=email%20profile&access_type=online";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>login to minimart gemas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--custom login css -->
  <link rel="stylesheet" href="dist/css/custom-login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="cek-login.php" class="h1"><b>Minimart</b>Gemas</a>
    </div>
    <div class="card-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="cek-login.php" method="post">
        <!-- Bagian Username -->
        <div class="input-group mb-3">
            <input type="username" name="username" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <!-- Bagian Password -->
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
        </div>
    </form>

    <p class="mb-1">
        <a href="lupa-sandi.php">Saya lupa kata sandi saya</a>
    </p>
    
    <!-- Tombol Google ini diabaikan saja kalau mau manual -->
    <div class="social-auth-links text-center mt-2 mb-3">
        <a href="<?php echo $loginUrl; ?>" class="btn btn-block btn-danger">
            <i class="fab fa-google mr-2"></i> Sign in using Google
        </a>
    </div>
</div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
