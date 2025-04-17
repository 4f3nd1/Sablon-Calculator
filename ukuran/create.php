<?php include '../includes/header.php'; ?>
<div class="row">
  <div class="col-4">
    <h3 class="mb-4">+ Ukuran Sablon</h3>

    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="create">

      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>

      <div class="mb-3">
        <label for="lebar" class="form-label">Lebar</label>
        <input type="number" class="form-control" id="lebar" name="lebar" required>
      </div>

      <div class="mb-3">
        <label for="tinggi" class="form-label">Tinggi</label>
        <input type="number" class="form-control" id="tinggi" name="tinggi" required>
      </div>

      <div class="mb-3">
        <label for="total_size" class="form-label">Luas</label>
        <div class="card px-2 py-2" id="total_size_text" style="font-size: 16px;">0 cm²</div>
        <input type="text" class="form-control" id="total_size" name="total_size" hidden required>
      </div>

      <div class="mb-3">
        <label for="urutan" class="form-label">Urutan</label>
        <input type="number" class="form-control" id="urutan" name="urutan" required>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>

  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    $('#lebar, #tinggi').on('change keyup', function() {
      var lebar = parseFloat($('#lebar').val()) || 0;
      var tinggi = parseFloat($('#tinggi').val()) || 0;
      var total_size = lebar * tinggi;
      $('#total_size').val(total_size);
      $('#total_size_text').text(total_size + " cm²");
    });

  });
</script>

</body>

</html>