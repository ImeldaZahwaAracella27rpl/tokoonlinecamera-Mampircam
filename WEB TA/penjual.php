<script type="text/javascript">
function Add(){
  // set input action menjadi "insert"
  document.getElementById('action').value = "insert";


  // kosongkan inputan form-nya
  document.getElementById("id_admin").value = "";
  document.getElementById("nama_admin").value = "";
  document.getElementById("username").value = "";
  document.getElementById("password").value = "";
}

function Edit(index){
  // set input action menjadi "update"
  document.getElementById('action').value = "update";

  //set form-nya berdasarkan data table yang dipilih
  var table = document.getElementById("table_admin");
  //tampung data dari table
  var id_admin = table.rows[index].cells[0].innerHTML;
  var nama_admin = table.rows[index].cells[1].innerHTML;
  var username = table.rows[index].cells[2].innerHTML;
  var password = table.rows[index].cells[3].innerHTML;

  // keluarkan pada form
  document.getElementById("id_admin").value = id_admin;
  document.getElementById("nama_admin").value = nama_admin;
  document.getElementById("username").value = username;
  document.getElementById("password").value = password;
  }
  </script>
  <div class="card col-sm-12">
    <div class="card-header">
      <h4>Daftar Penjual</h4>
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
      $sql = "select * from admin";
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
         <table class="table" id="table_admin">
         <thead>
         <tr>
           <th>ID Admin</th>
           <th>Nama</th>
           <th>Username</th>
           <th>Password</th>
           <th>Opsi</th>
           </tr>
           </thead>
           <tbody>

             <?php foreach ($result as $hasil): ?>
               <tr>
                 <td><?php echo $hasil["id_admin"] ?></td>
                 <td><?php echo $hasil["nama_admin"] ?></td>
                 <td><?php echo $hasil["username"] ?></td>
                 <td><?php echo $hasil["password"] ?></td>
                 <td>
                   <button type="button" class="btn btn-info"
                   data-toggle="modal" data-target="#modal"
                   onclick="Edit(this.parentElement.parentElement.rowIndex);">
                   Edit
                   </button>

                   <a href="proses_penjual.php?hapus=admin&id_admin=<?php echo $hasil["id_admin"]; ?>"
                     onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
               <form action="proses_penjual.php" method="post" enctype="multipart/form-data">
                 <div class="modal-header">
                   <h4>Data Penjual</h4>
                 </div>

                 <div class="modal-body">
                   <input type="hidden" name="action" id="action">
                   <!-- untuk menyimpan aksi yang akan dilakukan
                   entah itu insert / update -->
                   ID Admin
                   <input type="text" name="id_admin" id="id_admin" class="form-control">
                   Nama
                   <input type="text" name="nama_admin" id="nama_admin" class="form-control">
                   Username
                   <input type="text" name="username" id="username" class="form-control">
                   Password
                   <input type="password" name="password" id="password" class="form-control">
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
