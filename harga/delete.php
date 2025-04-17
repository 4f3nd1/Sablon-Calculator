<?php
include '../includes/db.php';
session_start();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM harga WHERE id = ?");
  $stmt->execute([$id]);

  $_SESSION['message'] = 'Harga sablon berhasil dihapus';
  $_SESSION['message_type'] = 'danger';

  session_write_close();
}

header("Location: index.php");
exit();
