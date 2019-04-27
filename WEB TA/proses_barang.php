<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","toko_kamera");
if (isset($_POST["action"])) {
  $kode_barang = $_POST["kode_barang"];
  $nama_barang = $_POST["nama_barang"];
  $harga = $_POST["harga"];
  $stok = $_POST["stok"];
  $deskripsi = $_POST["deskripsi"];
  $action = $_POST["action"];

  if ($_POST["action"] == "insert") {
    $path = pathinfo($_FILES["gambar_barang"]["name"]);
    $extensi = $path["extension"];
    $filename = $kode_barang."-".rand(1,1000).".".$extensi;

    $sql = "insert into barang values('$kode_barang','$nama_barang','$harga','$stok','$deskripsi','$filename')";

    if (mysqli_query($koneksi,$sql)) {
      // jika eksekusi berhasil
      move_uploaded_file($_FILES["gambar_barang"]["tmp_name"],"image_barang/$filename");
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
    header("location:template.php?page=barang");
  }else if($_POST["action"] == "update") {
    if (!empty($_FILES["gambar_barang"]["name"])) {
      // jika gambar diedit
      $sql = "select * from barang where kode_barang='$kode_barang'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      // hapus file lama
      if (file_exists("image_barang/".$hasil["gambar_barang"])) {
        unlink("image_barang/".$hasil["gambar_barang"]);
      }

      // membuat nama file yg baru
      $path = pathinfo($_FILES["gambar_barang"]["name"]);
      $extensi = $path["extension"];
      $filename = $kode_barang."-".rand(1,1000).".".$extensi;

      //membuat perintah update
      $sql = "update barang set nama_barang = '$nama_barang',harga = '$harga',stok = '$stok',deskripsi='$deskripsi',gambar_barang = '$filename' where kode_barang='$kode_barang'";
      if (mysqli_query($koneksi,$sql)) {
        // jika query sukses
        move_uploaded_file($_FILES["gambar_barang"]["tmp_name"],"image_barang/$filename");
        $_SESSION["message"] == array(
          "type" => "success",
          "message" => "Update data has been success"
        );
      }else {
        // jika query gagal
        $_SESSION["message"] == array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }

    }else {
        // jika gambar tidak diedit
        $sql = "update barang set nama_barang = '$nama_barang',harga = '$harga',stok = '$stok',deskripsi='$deskripsi' where kode_barang='$kode_barang'";
        if (mysqli_query($koneksi,$sql)) {
          // jika query sukses
          $_SESSION["message"] == array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          // jika query gagal
          $_SESSION["message"] == array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
      }
    }
    header("location:template.php?page=barang");
  }
}


if (isset($_GET["hapus"])) {
  $kode_barang = $_GET["kode_barang"];
  $sql = "select * from barang where kode_barang='$kode_barang'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);
  if (file_exists("image_barang/".$hasil["gambar_barang"])) {
    unlink("image_barang/".$hasil["gambar_barang"]);
  }
  $sql = "delete from barang where kode_barang='$kode_barang'";
  if (mysqli_query($koneksi,$sql)) {
    // jika query sukses
    $_SESSION["message"] == array(
      "type" => "success",
      "message" => "Delete data has been success"
    );
  }else {
    // jika query gagal
    $_SESSION["message"] == array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
  header("location:template.php?page=barang");
}
 ?>
