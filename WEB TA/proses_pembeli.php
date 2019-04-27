<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","toko_kamera");
if (isset($_POST["action"])) {
  $id_pembeli = $_POST["id_pembeli"];
  $nama_pembeli = $_POST["nama_pembeli"];
  $id_pembeli = $_POST["id_pembeli"];
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $alamat = $_POST["alamat"];
  $kontak = $_POST["kontak"];
  $action = $_POST["action"];

  if ($action == "insert") {
    $path = pathinfo($_FILES["gambar"]["name"]);
    $extensi = $path["extension"];
    $filename = $id_pembeli."-".rand(1,1000).".".$extensi;

    $sql = "insert into pembeli values('$id_pembeli','$nama_pembeli','$username','$password','$alamat','$kontak','$filename')";

    if (mysqli_query($koneksi,$sql)) {
      // jika eksekusi berhasil
      move_uploaded_file($_FILES["gambar"]["tmp_name"],"image_pembeli/$filename");
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
    header("location:template.php?page=pembeli");
  }else if($_POST["action"] == "update") {
    if (!empty($_FILES["gambar"]["name"])) {
      // jika gambar diedit
      $sql = "select * from pembeli where id_pembeli='$id_pembeli'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      // hapus file lama
      if (file_exists("image_pembeli/".$hasil["gambar"])) {
        unlink("image_pembeli/".$hasil["gambar"]);
      }

      // membuat nama file yg baru
      $path = pathinfo($_FILES["gambar"]["name"]);
      $extensi = $path["extension"];
      $filename = $kode_barang."-".rand(1,1000).".".$extensi;

      //membuat perintah update
      $sql = "update pembeli set nama_pb = '$nama_pb' ,username = '$username',password = '$password',alamat = '$alamat',kontak = '$kontak',image='$filename' where id_pembeli='$id_pembeli'";
      if (mysqli_query($koneksi,$sql)) {
        // jika query sukses
        move_uploaded_file($_FILES["gambar"]["tmp_name"],"image_pembeli/$filename");
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

    }else {
        // jika gambar tidak diedit
        $sql = "update pembeli set nama_pb = '$nama_pb' ,username = '$username',password = '$password',alamat = '$alamat',kontak = '$kontak' where id_pembeli='$id_pembeli'";
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
    header("location:template.php?page=pembeli");
  }
}


if (isset($_GET["hapus"])) {
  $id_pembeli = $_GET["id_pembeli"];
  $sql = "select * from pembeli where id_pembeli='$id_pembeli'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);
  if (file_exists("image_pembeli/".$hasil["gambar"])) {
    unlink("image_pembeli/".$hasil["gambar"]);
  }
  $sql = "delete from pembeli where id_pembeli='$id_pembeli'";
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
  header("location:template.php?page=pembeli");
}
 ?>
