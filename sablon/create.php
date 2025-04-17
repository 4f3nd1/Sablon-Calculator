<?php include '../includes/header.php'; ?>

<div class="row">
  <div class="col-4">
    <h3 class="mb-4">+ Sablon</h3>

    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="create">

      <div class="mb-3">
        <label for="nama_sablon" class="form-label">Nama Sablon</label>
        <input type="text" class="form-control" id="nama_sablon" name="nama_sablon" required>
      </div>

      <div class="mb-3">
        <label for="calculate_size" class="form-label">Hitungan /cm²</label>
        <select class="form-select" id="calculate_size" name="calculate_size" required>
          <option value="">Pilih ...</option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="min_charge" class="form-label" id="label_mincharge" hidden>Min Charge</label>
        <input type="number" class="form-control" id="min_charge" name="min_charge" value="0" hidden required>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label" id="label_harga" hidden>Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="0" hidden required>
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
  });
</script>
</body>

</html>