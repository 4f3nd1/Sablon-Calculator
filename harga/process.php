<?php
include '../includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];

  if ($action === 'create') {
    $stmt = $pdo->prepare("INSERT INTO harga (id_sablon, id_ukuran, harga) VALUES (?, ?, ?)");
    $stmt->execute([
      $_POST['id_sablon'],
      $_POST['id_ukuran'],
      $_POST['harga']
    ]);

    $_SESSION['message'] = 'Harga sablon berhasil ditambahkan';
    $_SESSION['message_type'] = 'success';
  } elseif ($action === 'update') {
    $stmt = $pdo->prepare("UPDATE harga SET id_sablon = ?, id_ukuran = ?, harga = ? WHERE id = ?");
    $stmt->execute([
      $_POST['id_sablon'],
      $_POST['id_ukuran'],
      $_POST['harga'],
      $_POST['id']
    ]);

    $_SESSION['message'] = 'Harga sablon berhasil diperbarui';
    $_SESSION['message_type'] = 'success';
  }

  session_write_close();
  header("Location: index.php");
  exit();
}
