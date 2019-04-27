<?php session_start(); ?>
<?php if(isset($_SESSION["session_admin"])): ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <title>MAMPIRCAM</title>
      <meta charset="utf-8">
      <meta name="viewport"content="width=device-width, initial-scale=1.0">
      <title>Bootstrap Navbar</title>
      <!-- Load bootstrap css -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <!-- Load jquery and bootstrap js -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <style media="screen">
      div.menu img{
        width: 145px;
        height: auto;
        margin-left: 8x;
        margin-top: 3px;
      }
      </style>
    </head>

    <body>
      <nav class="navbar navbar-expand-md bg-primary navbar-dark sticky-top">

        <!--
        navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran Medium
        bg-danger -> navbar akan mempunyai background warna merah
        navbar-dark -> tulisan menu pada navbar akan lebih gelap -->
        <div class="menu">
          <img src="logo2.png" align="left">
        </div>

        <!-- pemanggilan icon menu saat menu bar disembunyikan -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data_target="#menu">
          <span class="navbar navbar-toggler-icon"></span>
        </button>

        <!-- daftar menu pada navbar -->
        <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav">
            <li class="nav-item"><a href="template.php?page=pembeli" class="nav-link text-white">Pembeli</a></li>
            <li class="nav-item"><a href="template.php?page=penjual" class="nav-link text-white">Penjual</a></li>
            <li class="nav-item"><a href="template.php?page=barang" class="nav-link text-white">Barang</a></li>
            <li class="nav-item"><a href="template.php?page=daftar_transaksi" class="nav-link text-white">Transaksi</a></li>
            <li class="nav-item"><a href="proses_login.php?logout=true" class="nav-link text-danger">Logout</a></li>
          </ul>
        </div>
        <h4 class="text-warning">Welcome :)</h4>
      </nav>
      <div class="container my-2">
        <?php if(isset($_GET["page"])): ?>
          <?php if((@include $_GET["page"].".php") === true): ?>
            <?php include $_GET["page"].".php"; ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </body>
  </html>
<?php else: ?>
  <?php echo "Anda belum login!"; ?>
  <br>
  <a href="login.php">
    Login disini
  </a>
<?php endif; ?>
