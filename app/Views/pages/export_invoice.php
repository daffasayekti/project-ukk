<!DOCTYPE html>
<html>

<head>
  <title>Data Invoice</title>
  <style type="text/css">
    body {
      font-family: Calibri, Helvetica, Arial, sans-serif;
    }

    table,
    td,
    th {
      border: 1px solid #333;
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
  <center>
    <h1>Data Invoice</h1>
    <h4><?= $periode; ?></h4>
  </center>

  <table class='table table-bordered'>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Nama Pemesan</th>
        <th>Nama Produk</th>
        <th>Status Pembayaran</th>
        <th>Total Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data_invoice as $value) : ?>
        <tr>
          <td><?= $value['order_id']; ?></td>
          <td><?= $value['nama_pelanggan']; ?></td>
          <td>Layanan <?= $value['nama_produk']; ?></td>
          <td><?= $value['status_pembayaran']; ?></td>
          <td>Rp. <?= number_format($value['total_pembayaran'], 0, ",", "."); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>

</html>