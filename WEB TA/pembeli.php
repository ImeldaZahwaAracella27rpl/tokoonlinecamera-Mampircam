<script type="text/javascript">
function Add(){
  // set input action menjadi "insert"
  document.getElementById('action').value = "insert";

  //kosongkan inputan form-nya
  document.getElementById("id_pembeli").value = "";
  document.getElementById("nama_pembeli").value = "";
  document.getElementById("username").value = "";
  document.getElementById("password").value = "";
  document.getElementById("alamat").value = "";
  document.getElementById("kontak").value = "";
}

function  Edit(index){
  // set input action menjadi "update"
  document.getElementById('action').value = "update";

  //set form-nya berdasarkan data table yang dipilih
  var table = document.getElementById("table_pembeli");
  // tampung dari table
  var id_pembeli = table.rows[index].cells[0].innerHTML;
  var nama_pb = table.rows[index].cells[1].innerHTML;
  var username = table.rows[index].cells[2].innerHTML;
  var password = table.rows[index].cells[3].innerHTML;
  var alamat = table.rows[index].cells[4].innerHTML;
  var kontak = table.rows[index].cells[5].innerHTML;

  document.getElementById("id_pembeli").value = id_pembeli;
  document.getElementById("nama_pembeli").value = nama_pembeli;
  document.getElementById("username").value = username;
  document.getElementById("password").value = password;
  document.getElementById("alamat").value = alamat;
  document.getElementById("kontak").value = kontak;
}
</script>
  <div class="card col-sm-12">
    <div class="card-header">
      <h4>Daftar Pembeli</h4>
    </div>

    <div class="card-body">
      <?php if (isset($_SESSION["message"])):?>
      <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
        <?php echo $_SESSION["message"]["message"]; ?>
        <?php unset($_SESSION["message"]); ?>
      </div>
      <?php endif; ?>
      <?php
      // membuat koneksi ke SQLiteDatabase
      $koneksi = mysqli_connect("localhost","root","","toko_kamera");
      $sql = "select * from pembeli";
      $result = mysqli_query($koneksi,$sql);
      // digunakan untuk eksekusi sintak sql
      $count = mysqli_num_rows($result);
      // digunakan untuk menampilkan jumlah data
       ?>

       <?php if ($count == 0): ?>
         <!-- jika data dari database kosong, maka akan muncul pesan informasi -->
        <div class="alert alert-info">
          Data belum tersedia
        </div>

      <?php else: ?>
        <!-- jika datanya ada, maka akan ditampilkan pada tabel -->
        <table class="table" id="table_pembeli">
          <thead>
            <tr>
              <th>ID Pembeli</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Password</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Image</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($result as $hasil): ?>
              <tr>
                <td><?php echo $hasil["id_pembeli"] ?></td>
                <td><?php echo $hasil["nama_pembeli"] ?></td>
                <td><?php echo $hasil["username"] ?></td>
                <td><?php echo $hasil["password"] ?></td>
                <td><?php echo $hasil["alamat"] ?></td>
                <td><?php echo $hasil["kontak"] ?></td>
                <td>
                  <img src="<?php echo "image_pembeli/".$hasil["gambar"]; ?>"
                  class="img" width="100">
                </td>
                <td>
                  <button type="button" class="btn btn-info"
                  data-toggle ="modal" data-target="#modal"
                  onclick="Edit(this.parentElement.parentElement.rowIndex);">
                  Edit
                  </button>

                  <a href="proses_pembeli.php?hapus=pembeli&id_pembeli=<?php echo $hasil["id_pembeli"]; ?>"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <button type="button" class="btn btn-danger">
                      Hapus
                    </button>
                    </a>

                  </td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                  </table>
                  <?php endif; ?>
                  </div>
                  <div class="card-footer">
                  <button type="button" class="btn btn-success"
                  data-toggle ="modal" data-target="#modal" onclick="Add()">
                  Tambah
                  </button>
                  </div>
                  </div>
                  </div>

                  <!-- membuat model / pop up -->
                  <div class="modal fade" id="modal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      <form action="proses_pembeli.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                          <h4>Data Pembeli</h4>
                        </div>

                        <div class="modal-body">
                          <input type="hidden" name="action" id="action">
                          <!-- untuk menyimpan aksi yang akan dilakukan
                          entah itu insert / update -->
                          ID Pembeli
                          <input type="text" name="id_pembeli" id="id_pembeli" class="form-control">
                          Nama
                          <input type="text" name="nama_pembeli" id="nama" class="form-control">
                          Username
                          <input type="text" name="username" id="username" class="form-control">
                          Password
                          <input type="password" name="password" id="password" class="form-control">
                          Alamat
                          <input type="text" name="alamat" id="alamat" class="form-control">
                          Kontak
                          <input type="text" name="kontak" id="kontak" class="form-control">
                          Image
                          <input type="file" name="gambar" id="gambar" class="form-control">
                        </div>

                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">
                            Simpan
                          </button>
                        </div>
                      </form>

                      </div>
                    </div>
                  </div>
