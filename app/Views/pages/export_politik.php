<!DOCTYPE html>
<html>

<head>
  <title>Data Berita Politik</title>
  <style type="text/css">
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
      background-color: #6777ef;
      color: white;
    }
  </style>

</head>

<body>
  <center>
    <h1>Data Berita Politik</h1>
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
      foreach ($beritaPolitik as $value) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td style="text-align: left;"><?= $value['judul_berita']; ?></td>
          <td><?= $value['created_by']; ?></td>
          <td>Politik</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>

</html>