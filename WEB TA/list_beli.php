<div class="card col-sm-12">
  <div class="card-header">
    <h4>Barang yang akan dibeli</h4>
  </div>
    <div class="card-body">
      <form action="db_beli.php?checkout=true" method="post"
        onsubmit="return confirm('Apakah Anda yakin dengan pesanan ini?')">


      <table class="table">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jumlah Item</th>
            <th>Harga</th>
            <th>Picture</th>

            <th>
              Option
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION["session_beli"] as $hasil): ?>
            <tr>
              <td><?php echo $hasil["kode_barang"]; ?></td>
              <td><?php echo $hasil["nama"]; ?></td>

              <td>
                <input type="number" name="jumlah<?php echo $hasil["kode_barang"]; ?>" min="1">
              </td>
              <td><?php echo $hasil["harga"]; ?></td>
              <td><img src="image_barang/<?php echo $hasil["gambar_barang"]; ?>" width="100" height="100" class="img"></td>
              <td>
                <a href="db_transaksi.php?hapus=true&kode_barang=<?php echo $hasil["kode_barang"]; ?>">
                  <button type="button" class="btn btn-danger">Hapus</button>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
        <button type="submit" class="btn btn-block btn-primary">
          Checkout
        </button>
        </form>
  </div>
</div>
