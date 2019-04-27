<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","toko_kamera");
if (isset($_GET["transaksi"])) {
  $kode_barang = $_GET["kode_barang"];
  $sql = "select * from barang where kode_barang='$kode_barang'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);
  if (!in_array($hasil, $_SESSION["session_beli"])) {
    array_push($_SESSION["session_beli"],$hasil);
  }
  var_dump($_SESSION['session_beli']);
  header("location:template_pembeli.php?page=list_beli");
}

if (isset($_GET["checkout"])) {
  $koneksi = mysqli_connect("localhost","root","","toko_kamera");
  // kita siapkan data untuk tabel transaksi
  $id_transaksi = rand(1,1000000);
  $tanggal = date("Y-m-d");
  $id_pembeli = $_SESSION["session_pembeli"]["id_pembeli"];
  $sql = "insert into transaksi values('$id_transaksi','$tanggal','$id_pembeli')";
  mysqli_query($koneksi,$sql);

  foreach ($_SESSION["session_beli"] as $hasil) {
    $sql = "insert into detail_transaksi values ('$id_transaksi','".$hasil["kode_barang"]."','1')";
    mysqli_query($koneksi,$sql);
    $sql_update = "update barang set stok=stok-1 where kode_barang='".$hasil["kode_barang"]."'";
    mysqli_query($koneksi,$sql_update);
  }
  $_SESSION["session_beli"] = array();
  header("location:template_pembeli.php?page=list_barang");
}
if (isset($_GET["hapus"])) {
  $kode_barang = $_GET["kode_barang"];
  $index = array_search($kode_barang,array_column($_SESSION["session_beli"],"kode_barang"));
  array_splice($_SESSION["session_beli"],$index,1);
  header("location:template_pembeli.php?page=list_beli");
}

?>
