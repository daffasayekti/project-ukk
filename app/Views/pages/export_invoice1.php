<!DOCTYPE html>
<html>

<head>
  <title>Laporan Invoice Order-ID #<?= $data_invoice['order_id']; ?></title>
  <style>
    body {
      font-family: Calibri, Helvetica, Arial, sans-serif;
    }
  </style>
</head>

<body>
  <div style="padding: 1rem; border: 1px solid #333;">

    <h1 style="text-align: center"> WORLD TIME </h1>

    <hr>
    <hr>
    <h2>Laporan Invoice</h2>
    <table>
      <tr>
        <td style="width: 50%">
          <table>
            <tr>
              <td style="padding: 0.25rem">No. Transaksi</td>
              <td style="padding: 0.25rem">:</td>
              <td style="padding: 0.25rem"><?= $data_invoice['transaksi_id']; ?></td>
            </tr>
            <tr>
              <td style="padding: 0.25rem">Nama Pelanggan</td>
              <td style="padding: 0.25rem">:</td>
              <td style="padding: 0.25rem"><?= $data_invoice['nama_pelanggan']; ?></td>
            </tr>
            <tr>
              <td style="padding: 0.25rem">Email</td>
              <td style="padding: 0.25rem">:</td>
              <td style="padding: 0.25rem"><?= $data_invoice['email']; ?></td>
            </tr>
          </table>
        </td>
        <td style="width: 50%; padding-left: 2rem; vertical-align: top">
          <table>
            <tr>
              <td style="padding: 0.25rem">Status Pembayaran</td>
              <td style="padding: 0.25rem">:</td>
              <td style="padding: 0.25rem"><?= $data_invoice['status_pembayaran']; ?></td>
            </tr>
            <tr>
              <td style="padding: 0.25rem">Tanggal Pembayaran</td>
              <td style="padding: 0.25rem">:</td>
              <td style="padding: 0.25rem">
                <?= tgl_indo_sekarang($data_invoice['tanggal_pembayaran']); ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <table border="1" cellspacing="0" style="width: 100%; margin: 2rem 0;">
      <tr>
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Jenis Langganan</th>
        <th>Metode Pembayaran</th>
        <th>Harga</th>
      </tr>
      <tr>
        <td style="padding: 0.5rem; text-align:center">1</td>
        <td style="padding: 0.5rem; text-align:center">
          <div>Layanan <?= $data_invoice['nama_produk']; ?></div>
        </td>
        <td style="padding: 0.5rem; text-align:center">
          <div><?= $data_invoice['jenis_langganan']; ?></div>
        </td>
        <td style="padding: 0.5rem; text-align: center">E-Wallet</td>
        <td style="padding: 0.5rem; text-align: center">Rp. <?= number_format($data_invoice['total_pembayaran'], 0, ",", "."); ?></td>
      </tr>
    </table>

    <table style="padding-bottom: 5rem; margin-top: 3rem">
      <tr>
        <td style="width: 80%">
          <span style="margin-left: 3rem; border: 1px solid #333; padding: 0.5rem; background: #cececed7">
            Subtotal : Rp. <?= number_format($data_invoice['total_pembayaran'], 0, ",", "."); ?></span>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>