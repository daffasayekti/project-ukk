<!DOCTYPE html>
<html>

<head>
  <title>Data Berita Ekonomi</title>
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
    <h1>Data Berita Ekonomi</h1>
    <h4><?= $periode; ?></h4>
  </center>

  <table class='table table-bordered'>
    <thead>
      <tr>
        <th>No.</th>
        <th>Judul Berita</th>
        <th>Penulis Berita</th>
        <th>Kategori Berita</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($beritaEkonomi as $value) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td style="text-align: left;"><?= $value['judul_berita']; ?></td>
          <td><?= $value['created_by']; ?></td>
          <td>Ekonomi</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>

</html>