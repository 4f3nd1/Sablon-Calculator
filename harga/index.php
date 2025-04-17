<?php include '../includes/db.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harga Sablon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <!-- Tambahkan Montserrat dari Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="../LogoFD.svg" type="image/x-icon">
  <style>
    /* Terapkan Montserrat ke seluruh elemen */
    body {
      font-family: 'Montserrat', sans-serif;
      font-size: 0.9rem;
      background-color: #f8f9fa;
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
    .btn {
      transform: scale(1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn:active {
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

    /* Table row hover effect */
    .table-hover tbody tr {
      transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(13, 110, 253, 0.05);
      transform: translateX(5px);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="../">Sablon Calculator</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../sablon/">Jenis Sablon</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../ukuran/">Ukuran Sablon</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../harga/">Harga Sablon</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">

    <?php
    if (isset($_SESSION['message'])) {
      echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
      unset($_SESSION['message']);
    }
    ?>

    <!-- Harga Section -->
    <div id="harga-section" class="mb-5">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Harga</h3>
        <a href="create.php" class="btn btn-success">
          <i class="bi bi-plus-circle"></i> Tambah Harga
        </a>
      </div>

      <div class="table">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Jenis Sablon</th>
              <th>Ukuran</th>
              <th>Dimensi</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stmt = $pdo->query("
                    SELECT h.*, s.nama_sablon, u.nama, u.lebar, u.tinggi 
                    FROM harga h
                    JOIN sablon s ON h.id_sablon = s.id
                    JOIN ukuran_sablon u ON h.id_ukuran = u.id
                    ORDER BY s.urutan, u.urutan
                ");
            while ($row = $stmt->fetch()) {
              echo "<tr>";
              echo "<td>{$row['id']}</td>";
              echo "<td>{$row['nama_sablon']}</td>";
              echo "<td>{$row['nama']}</td>";
              echo "<td>{$row['lebar']}x{$row['tinggi']} cm</td>";
              echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
              echo "<td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
                            <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'><i class='bi bi-trash'></i></a>
                          </td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div> <!-- Close container div -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      // Show loading animation
      $('.loading').fadeIn(200);

      // Hide loading animation after 2 seconds
      setTimeout(function() {
        $('.loading').fadeOut(200);
      }, 2000);

      // Add ripple effect to buttons
      $('.btn').on('click', function(e) {
        // Remove any old ripples
        $('.ripple').remove();

        // Get click position
        var posX = $(this).offset().left,
          posY = $(this).offset().top,
          buttonWidth = $(this).width(),
          buttonHeight = $(this).height();

        // Add the ripple
        $(this).prepend('<span class="ripple"></span>');

        // Make it round and position it
        if (buttonWidth >= buttonHeight) {
          buttonHeight = buttonWidth;
        } else {
          buttonWidth = buttonHeight;
        }

        // Position the ripple
        var posX = e.pageX - $(this).offset().left - buttonWidth / 2;
        var posY = e.pageY - $(this).offset().top - buttonHeight / 2;

        // Add the ripple effect
        $('.ripple').css({
          width: buttonWidth,
          height: buttonHeight,
          top: posY + 'px',
          left: posX + 'px'
        });
      });
    });
  </script>
</body>

</html>