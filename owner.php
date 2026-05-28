<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    //aktivasi sesion php 
	session_start();
	
	//filter login
	if($_SESSION['username']==""){
	  header("location:login.php");
	}
	if ($_SESSION['hak_akses']!='owner'){
		header("location:login.php");
	}
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OWNER</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <link rel="stylesheet" href="dist/css/custom.css">
<script src="plugins/chart.js/Chart.min.js"></script>
</head>
<body class="hold-transition sidebar-mini role-owner">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="owner.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="owner.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">OWNER</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
		  <?php
		  echo $_SESSION['username'];
		  ?>
		  </a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="owner.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="owner.php?page=laporan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>laporan minimart</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="owner.php?page=laporan-bulanan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grafik Bulanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="owner.php?page=laporan-mingguan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grafik Mingguan</p>
                </a>
              </li>
            </ul>
          </li>
		  
		  <li class="nav-item">
			<a href="?page=laporan-keuntungan" class="nav-link">
			  <i class="far fa-circle nav-icon text-success"></i>
			  <p>Keuntungan (Profit)</p>
			</a>
		  </li>
		  
		  <li class="nav-header">User</li>
		  <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Log out</p>
            </a>
          </li>
        </ul>
      </nav>
      </div>
    </aside>

  <div class="content-wrapper">
	<?php 
	  if (isset($_GET['page']) && $_GET['page'] != '') {
		  
		  // KUNCINYA DI SINI: Kita bungkus pake container-fluid dan col-12 biar halaman include-an bisa full ke kiri dan kanan
		  echo '<div class="content"><div class="container-fluid"><div class="row"><div class="col-12">';
		  
		  include "halaman.php";
		  
		  echo '</div></div></div></div>';

	  } else {
		  // TAMPILAN DEFAULT: Kotak kuning (tetap pake col-lg-6 gak apa-apa biar gak kegedean)
	?>
		<div class="content-header">
		  <div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
				<h1 class="m-0">owner</h1>
			  </div>
			  <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				  <li class="breadcrumb-item"><a href="#">Home</a></li>
				  <li class="breadcrumb-item active">owner</li>
				</ol>
			  </div>
			</div>
		  </div>
		</div>
		<div class="content">
		  <div class="container-fluid">
			<div class="row">
			  <div class="col-lg-6">
				 <div class="card card-widget widget-user-2">
				  <div class="widget-user-header bg-owner">
					<div class="widget-user-image">
					  <img class="img-circle elevation-2" src="dist/img/user7-128x128.jpg" alt="User Avatar">
					</div>
					<h3 class="widget-user-username"><?php echo $_SESSION['username']; ?></h3>
					<h5 class="widget-user-desc"><?php echo $_SESSION['hak_akses']; ?></h5>
				  </div>
				  <div class="card-footer p-0">
					<ul class="nav flex-column">
					  <li class="nav-item">
						<a href="#" class="nav-link">Projects <span class="float-right badge bg-primary">31</span></a>
					  </li>
					  <li class="nav-item">
						<a href="#" class="nav-link">Tasks <span class="float-right badge bg-info">5</span></a>
					  </li>
					  <li class="nav-item">
						<a href="#" class="nav-link">Completed Projects <span class="float-right badge bg-success">12</span></a>
					  </li>
					  <li class="nav-item">
						<a href="#" class="nav-link">Followers <span class="float-right badge bg-danger">842</span></a>
					  </li>
					</ul>
				  </div>
				</div>
			  </div>
			  <div class="col-lg-6"></div>
			</div>
		  </div>
		</div>
		<?php 
	  } // Penutup blok ELSE
	?>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <footer class="main-footer">
    <strong>Copyright &copy; 2026 Minimart Gemas <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
</html>