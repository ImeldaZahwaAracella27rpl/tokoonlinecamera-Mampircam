<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","toko_kamera");

if (isset($_POST["action"])) {
$id_admin = $_POST["id_admin"];
$nama_admin = $_POST["nama_admin"];
$username = $_POST["username"];
$password = md5($_POST["password"]);
$action = $_POST["action"];

if ($action == "insert") {
    $sql = "insert into admin values('$id_admin','$nama_admin','$username','$password')";

    if (mysqli_query($koneksi,$sql)) {
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Insert data has been success"
      );
    }else {
      // jika eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=penjual");
  } else if ($action == "update") {
      // jika action-nya "update"
    $sql = "select * from admin where id_admin='$id_admin'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);


  // membuat perintah update
    $sql = "update admin set nama_admin='$nama_admin', username='$username', password='$password' where id_admin='$id_admin'";
    if (mysqli_query($koneksi,$sql)) {
    // jika query sukses
    $_SESSION["message"] = array(
      "type" => "success",
      "message" => "Update data has been success"
    );
  }else {
    // jika query gagal
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
}
  header("location:template.php?page=penjual");
  }


if (isset($_GET["hapus"])) {
  $nip = $_GET["id_admin"];
  $sql = "select * from admin where id_admin='$id_admin'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);
  $sql = "delete from admin where id_admin = '$id_admin'";
  if (mysqli_query($koneksi,$sql)) {
    // jika query sukses
    $_SESSION["message"] = array(
      "type" => "success",
      "message" => "Delete data has been success"
    );
  }else {
    // jika query gagal
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
  header("location:template.php?page=penjual");
}
  ?>
