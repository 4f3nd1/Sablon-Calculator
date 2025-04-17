</div> <!-- Close container div -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    // Show loading animation
    $('.loading').fadeIn(200);

    // Cache all sablon data
    var sablonData = [];
    <?php
    $stmt = $pdo->query("SELECT * FROM sablon ORDER BY urutan ASC");
    while ($row = $stmt->fetch()) {
      echo "sablonData.push({id: {$row['id']}, nama_sablon: '{$row['nama_sablon']}', calculate_size: '{$row['calculate_size']}', min_charge: {$row['min_charge']}, harga: {$row['harga']}});\n";
    }
    ?>

    // Cache all ukuran data
    var ukuranData = [];
    <?php
    $stmt = $pdo->query("SELECT * FROM ukuran_sablon ORDER BY urutan ASC");
    while ($row = $stmt->fetch()) {
      echo "ukuranData.push({id: {$row['id']}, nama: '{$row['nama']}', total_size: {$row['total_size']}, lebar: {$row['lebar']}, tinggi: {$row['tinggi']}});\n";
    }
    ?>

    // Cache all harga data
    var hargaData = [];
    <?php
    $stmt = $pdo->query("SELECT * FROM harga");
    while ($row = $stmt->fetch()) {
      echo "hargaData.push({id_sablon: {$row['id_sablon']}, id_ukuran: {$row['id_ukuran']}, harga: {$row['harga']}});\n";
    }
    ?>

    // Hide loading animation when data is ready
    $('.loading').fadeOut(200);

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

      // Get center of button
      var x = e.pageX - posX - buttonWidth / 2;
      var y = e.pageY - posY - buttonHeight / 2;

      // Add ripple styles
      $('.ripple').css({
        width: buttonWidth,
        height: buttonHeight,
        top: y + 'px',
        left: x + 'px'
      }).addClass('rippleEffect');
    });

    // Handle click event for size buttons
    $('.btn-size').click(function() {
      var lebar = $(this).data('lebar');
      var tinggi = $(this).data('tinggi');
      $('#lebar').val(lebar);
      $('#tinggi').val(tinggi);

      // Add bounce animation to card
      // $('.card').css('transform', 'translateY(-5px)');
      // setTimeout(function() {
      //   $('.card').css('transform', 'translateY(0)');
      // }, 200);

      calculatePrices(lebar, tinggi);
    });

    // Handle change event for input fields
    $('#lebar, #tinggi').on('change keyup', function() {
      var lebar = parseFloat($('#lebar').val()) || 0;
      var tinggi = parseFloat($('#tinggi').val()) || 0;
      calculatePrices(lebar, tinggi);
    });

    // Main calculation function
    function calculatePrices(lebar, tinggi) {
      var total_size = lebar * tinggi;

      // Update prices for each sablon
      sablonData.forEach(function(sablon) {
        var ukuranCell = $('.ukuran_' + sablon.id);
        var hargaCell = $('.harga_' + sablon.id);

        var ukuranText = lebar * tinggi + " cm²";
        var hargaText = "0";

        if (sablon.calculate_size === 'Yes') {
          // Special calculation for calculate_size = 'Yes'
          var minChargeUnits = Math.floor(sablon.min_charge / sablon.harga);

          if (total_size <= minChargeUnits) {
            ukuranText = "Minimum";
            hargaText = formatRupiah(sablon.min_charge);
          } else {
            ukuranText = total_size + " cm²";
            hargaText = formatRupiah(total_size * sablon.harga);
          }

        } else {
          // For calculate_size = 'No', find matching ukuran and get fixed price
          var matchedUkuran = findClosestUkuran(total_size);

          if (matchedUkuran) {
            var harga = findHarga(sablon.id, matchedUkuran.id);

            if (harga) {
              hargaText = formatRupiah(harga.harga);
              ukuranText = matchedUkuran.nama;
            }
          }
        }

        // Add animation class
        ukuranCell.addClass('price-change');
        hargaCell.addClass('price-change');

        // Update text
        ukuranCell.text(ukuranText);
        hargaCell.text(hargaText);

        // Remove animation class after animation completes
        setTimeout(function() {
          ukuranCell.removeClass('price-change');
          hargaCell.removeClass('price-change');
        }, 500);
      });
    }

    // Find closest ukuran based on total_size
    function findClosestUkuran(total_size) {
      if (total_size <= 0) return null;

      // First try to find exact match
      var exactMatch = ukuranData.find(function(ukuran) {
        return ukuran.total_size === total_size;
      });

      if (exactMatch) return exactMatch;

      // If no exact match, find the smallest ukuran that can fit
      var possibleUkuran = ukuranData.filter(function(ukuran) {
        return ukuran.total_size >= total_size;
      }).sort(function(a, b) {
        return a.total_size - b.total_size;
      });

      return possibleUkuran[0] || null;
    }

    // Find harga for given sablon and ukuran
    function findHarga(id_sablon, id_ukuran) {
      return hargaData.find(function(harga) {
        return harga.id_sablon === id_sablon && harga.id_ukuran === id_ukuran;
      });
    }

    // Format number to Rupiah currency
    function formatRupiah(angka) {
      if (!angka) return "0";
      return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

  });
</script>
</body>

</html>