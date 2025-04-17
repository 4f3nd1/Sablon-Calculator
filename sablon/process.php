<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];

  if ($action === 'create') {
    // Create new sablon
    $stmt = $pdo->prepare("INSERT INTO sablon (nama_sablon, calculate_size, min_charge, harga, urutan) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
      $_POST['nama_sablon'],
      $_POST['calculate_size'],
      $_POST['min_charge'],
      $_POST['harga'],
      $_POST['urutan']
    ]);

    $_SESSION['message'] = 'Sablon created successfully';
  } elseif ($action === 'update') {
    // Update existing sablon
    $stmt = $pdo->prepare("UPDATE sablon SET nama_sablon = ?, calculate_size = ?, min_charge = ?, harga = ?, urutan = ? WHERE id = ?");
    $stmt->execute([
      $_POST['nama_sablon'],
      $_POST['calculate_size'],
      $_POST['min_charge'],
      $_POST['harga'],
      $_POST['urutan'],
      $_POST['id']
    ]);

    $_SESSION['message'] = 'Sablon updated successfully';
  }

  header("Location: index.php");
  exit();
}
