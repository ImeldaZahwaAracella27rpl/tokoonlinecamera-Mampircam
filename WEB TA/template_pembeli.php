<?php session_start(); ?>
<?php if (isset($_SESSION["session_pembeli"])): ?>


  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <title>M A M P I R C A M</title>
      <link rel="icon" href="icon camera.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <nav class="navbar navbar-expand-md bg-warning navbar-dark sticky-top">
        <!--
          navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran Medium
          bg-danger -> navbar akan mempunyai background warna merah
          navbar-dark -> tulisan menu pada navbar akan lebih gelap-->
        <div class="menu">
          <img src="logo2.png" align="left">
        </div>

            <!-- pemanggilan icon menu saat menu bar disembunyikan -->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
              <span class="navbar navbar-toggler-icon"></span>
            </button>

            <!-- daftar menu pada navbar -->
            <div class="collapse navbar-collapse" id="menu">
              <ul class="navbar-nav">
                <li class="nav-item"><a href="template_pembeli.php?page=coba" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="template_pembeli.php?page=list_barang" class="nav-link text-white">Barang</a></li>
                <li class="nav-item"><a href="template_pembeli.php?page=list_beli" class="nav-link text-white">Keranjang Belanja</a></li>
                <li class="nav-item "><a href="proses_login_pembeli.php?logout=true" class="nav-link text-danger">Logout</a></li>
                  </ul>
                </div>
                <!-- <h5 class="text-white">Hello, <?php echo $_SESSION["session_pembeli"]["nama_pembeli"]; ?></h5> -->
                <a href="template_pembeli.php?page=list_beli">
                  <b class="text-info">Beli: <?php echo count($_SESSION["session_beli"]); ?></b>
                </a>
              </nav>

              <div class="container my-2">
              <?php if (isset($_GET["page"])): ?>
                <?php if ((@include $_GET["page"].".php") === true): ?>
                  <?php include $_GET["page"].".php"; ?>
                <?php endif; ?>
              <?php endif; ?>
              </div>
              </body>
              </html>
            <?php else: ?>
              <?php echo "Anda belum login!"; ?>
              <br>
              <a href="login_pembeli.php">
                Login disini
              </a>
            <?php endif; ?>
