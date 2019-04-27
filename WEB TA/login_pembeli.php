<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="icon camera.png">
    <!-- Load bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Load jquery and bootstrap js -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </head>
  <style type="text/css">
  body {
    background-image:url(back3.jpg);
  }
  </style>
  <body>
    <div class="container my-5">
      <div class="row justify-content-center align-items-center">
        <div class="card">
          <div class="card-header">
            <img src="logo.png" align="left">
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION["message"])):?>
          <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
            <?php echo $_SESSION["message"]["message"]; ?>
            <?php unset($_SESSION["message"]); ?>
          </div>

          <?php endif; ?>
          <form action="proses_login_pembeli.php" method="post">
            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button type="submit" class="btn btn-warning btn-block">
              Sign in
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
