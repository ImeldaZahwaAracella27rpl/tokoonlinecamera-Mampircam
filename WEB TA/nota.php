<div class="card col-sm-12">
  <div class="card-header">
    <h3>Nota Transaksi</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","toko_kamera");
    // data transaksi
    $kode_transaksi = $_GET["kode_transaksi"];
    $sql = "select t.id_transaksi, p.nama_pembeli, t.tanggal
    from transaksi t inner join pembeli p
    on t.id_pembeli = p.id_pembeli
    where t.id_transaksi='$kode_transaksi'";

    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    // data barang
    $sql2 = "select b.*, dt.jumlah, dt.harga_beli
    from barang b inner join detail_transaksi dt
    on b.kode_barang = dt.kode_barang
    where dt.id_transaksi='$kode_transaksi'";
    $result2 = mysqli_query($koneksi,$sql2);

    ?>

    <h4>ID. Transaksi: <?php echo $hasil["id_transaksi"]; ?></h4>
    <h4>Nama Pemesan: <?php echo $hasil["nama_pembeli"]; ?></h4>
    <h4>Tgl. Transaksi: <?php echo $hasil["tanggal"]; ?></h4>

    <table class="table">
      <thead>
        <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah Item</th>
        <th>Harga</th>
        <th>Total</th>
      </tr>
      </thead>
      <tbody>
        <?php $total = 0; foreach ($result2 as $b): ?>
          <tr>
            <td><?php echo $b["kode_barang"]; ?></td>
            <td><?php echo $b["nama_barang"]; ?></td>
            <td><?php echo $b["jumlah"]; ?></td>
            <td><?php echo $b["harga"]; ?></td>
            <td><?php echo $b["harga"]; ?></td>
          </tr>
        <?php
       endforeach;
       ?>
      </tbody>
    </table>
  </div>
</div>
