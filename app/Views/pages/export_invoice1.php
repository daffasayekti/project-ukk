<!DOCTYPE html>
<html>

<head>
  <title>Laporan Invoice Order-ID #<?= $data_invoice['order_id']; ?></title>
  <style type="text/css">
    body {
      font-family: Calibri, Helvetica, Arial, sans-serif;
    }

    table,
    td,
    th {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td,
    th {
      padding: 2px;
    }

    th {
      background-color: #0d6efd;
      color: white;
    }
  </style>

</head>

<body>
  <table cellspacing="0" border="0" cellpadding="0">
    <tr>
      <td>
        <h1 class="text-end" style="color: #0d6efd;">World Time</h1>
      </td>
      <td>
        <h3 class="text-end">#<?= $data_invoice['order_id'] ?></h3>
      </td>
    </tr>
  </table>

  <div style="margin: 2rem 0">
    <div>Detail Pesanan</div>
    <div>ID Transaksi : <strong><?= $data_invoice['transaksi_id']; ?></strong></div>
    <div>Nama Pemesan : <strong><?= $data_invoice['nama_pelanggan']; ?></strong></div>
    <div>Metode Pembayaran : <strong>Midtrans</strong></div>
  </div>

  <div style="margin-bottom: 3rem">
    <div>Total Pesanan:</div>
    <h2 style="margin-top: 0">Rp. <?= number_format($data_invoice['total_pembayaran'], 0, ',', '.') ?>
    </h2>
  </div>

  <div>
    <div>
      <table class="main" border="1" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Jenis Langganan</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div>
                1
              </div>
            </td>
            <td>
              <div>
                <strong>Layanan <?= $data_invoice['nama_produk']; ?></strong>
              </div>
            </td>
            <td class="text-end">
              <span><?= $data_invoice['jenis_langganan']; ?></span>
            </td>
            <td class="text-end">
              <span>Rp. <?= number_format($data_invoice['total_pembayaran'], 0, ',', '.') ?></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>