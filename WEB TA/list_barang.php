<?php
$koneksi = mysqli_connect("localhost","root","","toko_kamera");
$sql = "select * from barang";
$result = mysqli_query($koneksi,$sql);
 ?>

 <div class="row">
   <?php foreach ($result as $hasil): ?>
     <div class="card col-sm-4">
       <div class="card-body">
         <img src="image_barang/<?php echo $hasil["gambar_barang"]; ?>" class="img" width="100%" height="300">
       </div>
       <div class="card-footer">
         <center>
         <h4 class="text-center"><?php echo $hasil["nama_barang"]; ?></h4>
         <h5 class="text-danger"><?php echo $hasil["harga"]; ?></h5>
         <h6 class="text-center">Stok: <?php echo $hasil["stok"]; ?></h5>
         <h6 class="text-primary">DESKRIPSI</h6>
          <h6 class="text-black"><?php echo $hasil["deskripsi"]; ?></h6>


       </center>
         <a href="db_beli.php?transaksi=true&kode_barang=<?php echo $hasil["kode_barang"]; ?>">
           <button type="button" class="btn btn-success btn-block">
             BELI
           </button>
         </a>

       </div>
     </div>
   <?php endforeach; ?>
 </div>
