<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sablon Management</title>
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
            <a class="nav-link" href="../harga/">Harga Sablon</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-4">