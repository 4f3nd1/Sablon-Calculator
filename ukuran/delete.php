<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM ukuran_sablon WHERE id = ?");
  $stmt->execute([$id]);

  $_SESSION['message'] = 'Ukuran Sablon deleted successfully';
}

header("Location: index.php");
exit();
