<?php
include '../includes/header.php';
include '../includes/db.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM harga WHERE id = ?");
$stmt->execute([$id]);
$harga = $stmt->fetch();

if (!$harga) {
  header("Location: index.php");
  exit();
}
?>

<div class="row">
  <div class="col-4">
    <h3 class="mb-4">Edit Harga Sablon</h3>

    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= $harga['id'] ?>">

      <div class="mb-3">
        <label for="id_sablon" class="form-label">Jenis Sablon</label>
        <select class="form-select" id="id_sablon" name="id_sablon" required>
          <?php
          $stmt_sablon = $pdo->query("SELECT * FROM sablon WHERE calculate_size = 'No' ORDER BY urutan");
          while ($row = $stmt_sablon->fetch()) {
            $selected = $row['id'] == $harga['id_sablon'] ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['nama_sablon']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="id_ukuran" class="form-label">Ukuran Sablon</label>
        <select class="form-select" id="id_ukuran" name="id_ukuran" required>
          <?php
          $stmt_ukuran = $pdo->query("SELECT * FROM ukuran_sablon ORDER BY urutan");
          while ($row = $stmt_ukuran->fetch()) {
            $selected = $row['id'] == $harga['id_ukuran'] ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['nama']} ({$row['lebar']}x{$row['tinggi']}cm)</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label">Harga (Rp)</label>
        <input type="number" class="form-control" id="harga" name="harga" value="<?= $harga['harga'] ?>" required>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

<?php include '../includes/footer.php'; ?>