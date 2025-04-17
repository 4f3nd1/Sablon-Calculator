<?php
include '../includes/db.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM sablon WHERE id = ?");
$stmt->execute([$id]);
$sablon = $stmt->fetch();

if (!$sablon) {
  header("Location: index.php");
  exit();
}

include '../includes/header.php';
?>
<div class="row">
  <div class="col-4">
    <h3 class="mb-4">Edit Sablon</h3>

    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id" value="<?= $sablon['id'] ?>">

      <div class="mb-3">
        <label for="nama_sablon" class="form-label">Nama Sablon</label>
        <input type="text" class="form-control" id="nama_sablon" name="nama_sablon" value="<?= htmlspecialchars($sablon['nama_sablon']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="calculate_size" class="form-label">Hitungan /cm²</label>
        <select class="form-select" id="calculate_size" name="calculate_size" required>
          <option value="Yes" <?= $sablon['calculate_size'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
          <option value="No" <?= $sablon['calculate_size'] == 'No' ? 'selected' : '' ?>>No</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="min_charge" class="form-label" hidden>Min Charge</label>
        <input type="number" class="form-control" id="min_charge" name="min_charge" value="<?= $sablon['min_charge'] ?>" required hidden>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label" hidden>Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="<?= $sablon['harga'] ?>" required hidden>
      </div>

      <div class="mb-3">
        <label for="urutan" class="form-label">Urutan</label>
        <input type="number" class="form-control" id="urutan" name="urutan" value="<?= $sablon['urutan'] ?>" required>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

</div> <!-- Close container div -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {

    // Add ripple effect to buttons
    $('.btn-size').on('click', function(e) {
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
      $(this).find('.ripple').css({
        width: buttonWidth,
        height: buttonHeight,
        top: posY + 'px',
        left: posX + 'px'
      });
    });

    $('#calculate_size').on('change', function() {
      var selectedValue = $(this).val();
      if (selectedValue === 'Yes') {
        $('#min_charge').removeAttr('hidden');
        $('#harga').removeAttr('hidden');
        $('#label_mincharge').removeAttr('hidden');
        $('#label_harga').removeAttr('hidden');
      } else {
        $('#min_charge').attr('hidden', true);
        $('#harga').attr('hidden', true);
        $('#label_mincharge').attr('hidden', true);
        $('#label_harga').attr('hidden', true);
      }
    });

    // Trigger change event to set initial state
    $('#calculate_size').trigger('change');
  });
</script>
</body>

</html>