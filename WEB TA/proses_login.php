<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

//koneksi database
$koneksi = mysqli_connect("localhost","root","","toko_kamera");
$sql = "select * from admin where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => "Username/Password Salah"
  );
  header("location:login.php");
} else {
  // buat variable session_start
  $_SESSION["session_admin"] = mysqli_fetch_array($result);
  header("location:template.php");
}

if (isset($_GET["logout"])) {
  // hapus sessionn-nya
  session_destroy();
  header("location:login.php");
}

?>
