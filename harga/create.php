<?php
include '../includes/header.php';
include '../includes/db.php';
?>

<div class="row">
  <div class="col-4">
    <h3 class="mb-4">+ Harga Sablon</h3>

    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="create">

      <div class="mb-3">
        <label for="id_sablon" class="form-label">Jenis Sablon</label>
        <select class="form-select" id="id_sablon" name="id_sablon" required>
          <option value="">Pilih Jenis Sablon</option>
          <?php
          $stmt = $pdo->query("SELECT * FROM sablon WHERE calculate_size = 'No' ORDER BY urutan");
          while ($row = $stmt->fetch()) {
            echo "<option value='{$row['id']}'>{$row['nama_sablon']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="id_ukuran" class="form-label">Ukuran Sablon</label>
        <select class="form-select" id="id_ukuran" name="id_ukuran" required>
          <option value="">Pilih Ukuran</option>
          <?php
          $stmt = $pdo->query("SELECT * FROM ukuran_sablon ORDER BY urutan");
          while ($row = $stmt->fetch()) {
            echo "<option value='{$row['id']}'>{$row['nama']} ({$row['lebar']}x{$row['tinggi']}cm)</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label">Harga (Rp)</label>
        <input type="number" class="form-control" id="harga" name="harga" required>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

<?php include '../includes/footer.php'; ?>