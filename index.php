<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sablon Calculator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <!-- Tambahkan Montserrat dari Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="LogoFD.svg" type="image/x-icon">
  <style>
    /* Terapkan Montserrat ke seluruh elemen */
    body {
      font-family: 'Montserrat', sans-serif;
      font-size: 0.9rem;
      vertical-align: middle;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    /* Pastikan heading juga menggunakan Montserrat */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
    }

    /* Navbar juga menggunakan Montserrat */
    .navbar-brand,
    .nav-link {
      font-family: 'Montserrat', sans-serif;
    }

    /* Tombol juga menggunakan Montserrat */
    .btn {
      font-family: 'Montserrat', sans-serif;
      font-size: 0.9rem;
      font-weight: 400;
      transition: all 0.3s ease;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Button hover effects */
    .btn-size {
      transform: scale(1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-size:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-size:active {
      transform: scale(0.98);
    }

    /* Card animation */
    .card {
      transition: all 0.3s ease;
      transform: translateY(0);
    }

    .card:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Input focus effect */
    .form-control:focus {
      border-color: #86b7fe;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    /* Price change animation */
    .price-change {
      animation: pulse 0.5s ease;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }

      100% {
        transform: scale(1);
      }
    }

    /* Table row hover effect */
    .table-hover tbody tr {
      transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(13, 110, 253, 0.05);
      transform: translateX(5px);
    }

    /* Settings button animation */
    .btn-settings {
      transition: all 0.3s ease;
    }

    .btn-settings:hover {
      transform: rotate(90deg);
    }

    /* Title animation */
    .title-animation {
      position: relative;
      display: inline-block;
      /* animation: colorChange 5s infinite alternate, floatTitle 3s ease-in-out infinite; */
      animation: colorChange 5s infinite alternate;
      background: linear-gradient(90deg, #3498db, #2ecc71, #e74c3c, #f39c12);
      background-size: 300% 300%;
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      text-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    @keyframes colorChange {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    @keyframes floatTitle {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-5px);
      }
    }
  </style>
</head>

<body>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="card p-3 shadow border-0" style="width: 520px;">
        <div class="row d-flex justify-content-between">
          <div class="col-auto">
            <h5 class="text-center mb-3 title-animation">SABLON CALCULATOR</h5>
          </div>
          <div class="col-auto">
            <a class="btn btn-sm btn-settings" href="sablon/"><i class="bi bi-gear"></i></a>
          </div>
        </div>
        <div id="calculator-section" class="mb-0">
          <div class="container-fluid">
            <div class="row d-flex justify-content-between mb-0">
              <?php
              $stmt = $pdo->query("SELECT * FROM ukuran_sablon ORDER BY urutan ASC");
              while ($row = $stmt->fetch()) {
              ?>
                <div class="btn btn-primary btn-sm mb-2 btn-size" data-id="<?= $row['id'] ?>" data-lebar="<?= $row['lebar'] ?>" data-tinggi="<?= $row['tinggi'] ?>" style="width: 90px;"> <?= $row['nama'] ?></div>
              <?php
              }
              ?>
            </div>
          </div>
          <hr class="my-2">
          <div class="row d-flex justify-content-between mb-0 mx-0">
            <div class="px-0 text-center" style="width: 120px; align-self: center;"><strong>Lebar :</strong></div>
            <div class="lebar px-0" style="width: 120px;">
              <input type="number" class="form-control" id="lebar" placeholder="Lebar (cm)" value="0">
            </div>
            <div class="px-0 text-center" style="width: 120px; align-self: center;"><strong>Tinggi :</strong></div>
            <div class="tinggi px-0" style="width: 120px;">
              <input type="number" class="form-control" id="tinggi" placeholder="Tinggi (cm)" value="0">
            </div>
          </div>
          <hr class="my-2">
          <div class=" mt-3">
            <table class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 250px;">Jenis Sablon</th>
                  <th class="text-center">Ukuran</th>
                  <th class="text-end" style="width: 115px;">Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM sablon ORDER BY urutan ASC");
                while ($row = $stmt->fetch()) {
                ?>
                  <tr>
                    <td><?= $row['nama_sablon'] ?></td>
                    <td class="ukuran_<?= $row['id'] ?> text-center">-</td>
                    <td class="harga_<?= $row['id'] ?> text-end">-</td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>