<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

// koneksi database
$koneksi = mysqli_connect("localhost","root","","toko_kamera");
$sql = "select * from pembeli where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => "Username/Password Salah"
  );
  // jika benar datanya = 0 berarti username/password salah
  header("location:login_pembeli.php");
} else {
  // buat variable session
  $_SESSION["session_pembeli"] = mysqli_fetch_array($result);
  $_SESSION["session_beli"] = array();
  // ini untuk menampung data buku yg dipinjam
  // ala ala cart (keranjang belanja)
  header("location:template_pembeli.php");
}

if (isset($_GET["logout"])) {
  // hapus session-nya
  session_destroy();
  header("location:login_pembeli.php");
}

 ?>
