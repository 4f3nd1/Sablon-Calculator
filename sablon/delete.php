<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM sablon WHERE id = ?");
  $stmt->execute([$id]);

  $_SESSION['message'] = 'Sablon deleted successfully';
}

header("Location: index.php");
exit();
