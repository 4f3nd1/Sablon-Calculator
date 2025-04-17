<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];

  if ($action === 'create') {
    // Create new ukuran
    $stmt = $pdo->prepare("INSERT INTO ukuran_sablon (nama, lebar, tinggi, total_size, urutan) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
      $_POST['nama'],
      $_POST['lebar'],
      $_POST['tinggi'],
      $_POST['total_size'],
      $_POST['urutan']
    ]);

    $_SESSION['message'] = 'Ukuran Sablon created successfully';
  } elseif ($action === 'update') {
    // Update existing ukuran
    $stmt = $pdo->prepare("UPDATE ukuran_sablon SET nama = ?, lebar = ?, tinggi = ?, total_size = ?, urutan = ? WHERE id = ?");
    $stmt->execute([
      $_POST['nama'],
      $_POST['lebar'],
      $_POST['tinggi'],
      $_POST['total_size'],
      $_POST['urutan'],
      $_POST['id']
    ]);

    $_SESSION['message'] = 'Ukuran Sablon updated successfully';
  }

  header("Location: index.php");
  exit();
}
