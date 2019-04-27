<script type="text/javascript">
function Add(){
  // set input action menjadi "insert"
  document.getElementById('action').value = "insert";

  // kosongkan inputan form-nya
  document.getElementById("kode_barang").value = "";
  document.getElementById("nama_barang").value = "";
  document.getElementById("harga").value = "";
  document.getElementById("deskripsi").value = "";
}

function Edit(index){
  //set input action menjadi "update"
  document.getElementById('action').value = "update";

  //set form-nya berdasarkan data table yang dipilih
  var table = document.getElementById("table_barang");
  //tampung data dari table
  var kode_barang = table.rows[index].cells[0].innerHTML;
  var nama = table.rows[index].cells[1].innerHTML;
  var harga = table.rows[index].cells[2].innerHTML;
  var stok = table.rows[index].cells[3].innerHTML;
  var deskripsi = table.rows[index].cells[4].innerHTML;

  // keluarkan pada form
  document.getElementById("kode_barang").value = kode_barang;
  document.getElementById("nama_barang").value = nama;
  document.getElementById("harga").value = harga;
  document.getElementById("stok").value = stok;
  document.getElementById("deskripsi").value = deskripsi;
}
</script>
<div class="card col-sm-12">
  <div class="card-header">
    <h4>Daftar Barang</h4>
  </div>

  <div class="card-body">
    <?php if (isset($_SESSION["message"])):?>
    <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
      <?php echo $_SESSION["message"]["message"]; ?>
      <?php unset($_SESSION["message"]); ?>
    </div>
    <?php endif; ?>
    <?php
    //membuat koneksi ke SQLiteDatabase
    $koneksi = mysqli_connect("localhost","root","","toko_kamera");
    // Localhost = host name
    // root = username untuk akses database
    //"" = password untuk akses database
    // perpustakaan = nama database-nya
    $sql = "select * from barang";
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
       <table class="table" id="table_barang">
         <thead>
           <tr>
             <th>Kode Barang</th>
             <th>Nama Barang</th>
             <th>Harga</th>
             <th>Stok</th>
             <th>Deskripsi</th>
             <th>Gambar</th>
             <th>Opsi</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($result as $hasil): ?>
             <tr>
               <td><?php echo $hasil["kode_barang"]; ?></td>
               <td><?php echo $hasil["nama_barang"]; ?></td>
               <td><?php echo $hasil["harga"]; ?></td>
               <td><?php echo $hasil["stok"]; ?></td>
               <td><?php echo $hasil["deskripsi"]; ?></td>
               <td>
                 <img src="<?php echo "image_barang/".$hasil["gambar_barang"]; ?>"
                 class="img" width="90">
               </td>
               <td>
                 <button type="button" class="btn btn-info"
                 data-toggle="modal" data-target="#modal"
                 onclick="Edit(this.parentElement.parentElement.rowIndex);">
                 Edit
               </button>

               <a href="proses_barang.php?hapus=barang&kode_barang=<?php echo $hasil["kode_barang"]; ?>"
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
    data-toggle="modal" data-target="#modal" onclick="Add()">
    Tambah
    </button>
</div>
</div>
</div>

<!-- membuat model / pop up -->
<div class="modal fade" id="modal">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <form action="proses_barang.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h4>Data Barang</h4>
      </div>

      <div class="modal-body">
        <input type="hidden" name="action" id="action">
        <!-- untuk menyimpan aksi yang akan dilakukan
        entah itu insert / update -->
        Kode Barang
        <input type="text" name="kode_barang" id="kode_barang" class="form-control">
        Nama
        <input type="text" name="nama_barang" id="nama_barang" class="form-control">
        Harga
        <input type="text" name="harga" id="harga" class="form-control">
        Stok
        <input type="number" name="stok" id="stok" class="form-control">
        Deskripsi
        <input type="text" name="deskripsi" id="deskripsi" class="form-control">
        Gambar
        <input type="file" name="gambar_barang" id="gambar_barang" class="form-control">
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
