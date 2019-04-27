<div class="card col-sm-12">
  <div class="card-header">
    <h3>Daftar Transaksi</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","toko_kamera");
    $sql = "select transaksi.*,pembeli.nama_pembeli
    from transaksi inner join pembeli
    on transaksi.id_pembeli = pembeli.id_pembeli";
    $result = mysqli_query($koneksi,$sql);
     ?>

     <ul class="list-group">
       <?php foreach ($result as $hasil): ?>
         <li class="list-group-item">
           <h5>Pembeli: <?php echo $hasil["nama_pembeli"]; ?>/<?php echo $hasil["id_transaksi"]; ?></h5>
           <h5>Daftar Transaksi</h5>
           <?php
           $sql2 = "select barang.*
           from detail_transaksi inner join barang
           on detail_transaksi.kode_barang = barang.kode_barang
           where detail_transaksi.id_transaksi = '".$hasil["id_transaksi"]."'";
           $result2 = mysqli_query($koneksi,$sql2);
            ?>
            <ul>
              <?php foreach ($result2 as $hasil2): ?>
                <li><?php echo $hasil2["kode_barang"]."/".$hasil2["nama_barang"]; ?></li>
              <?php endforeach; ?>
            </ul>
         </li>
       <?php endforeach; ?>
     </ul>
  </div>
</div>
