<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<div class="row justify-content-center">
  <div class="card p-3" style="width: 550px;">

    <div id="calculator-section" class="mb-0">
      <div class="container-fluid">
        <div class="row d-flex justify-content-between mb-2">
          <?php
          $stmt = $pdo->query("SELECT * FROM ukuran_sablon ORDER BY urutan ASC");
          while ($row = $stmt->fetch()) {
          ?>
            <div class="btn btn-primary mb-2 btn-size" data-id="<?= $row['id'] ?>" data-lebar="<?= $row['lebar'] ?>" data-tinggi="<?= $row['tinggi'] ?>" style="width: 120px;"> <?= $row['nama'] ?></div>
          <?php
          }
          ?>
        </div>
      </div>
      <hr>
      <div class="row d-flex justify-content-between mb-3 mx-0">
        <div class="px-0" style="width: 120px; align-self: center;"><strong>Lebar :</strong></div>
        <div class="lebar px-0" style="width: 120px;">
          <input type="number" class="form-control" id="lebar" placeholder="Lebar (cm)" value="0">
        </div>
        <div class="px-0" style="width: 120px; align-self: center;"><strong>Tinggi :</strong></div>
        <div class="tinggi px-0" style="width: 120px;">
          <input type="number" class="form-control" id="tinggi" placeholder="Tinggi (cm)" value="0">
        </div>
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-light">
            <tr>
              <th style="width: 250px;">Jenis Sablon</th>
              <th>Ukuran</th>
              <th style="width: 115px;">Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM sablon ORDER BY urutan ASC");
            while ($row = $stmt->fetch()) {
            ?>
              <tr>
                <td><?= $row['nama_sablon'] ?>
                  <!-- <?php if ($row['calculate_size'] == 'Yes'): ?>
                    <span class="badge bg-warning">Per cm²</span>
                  <?php else: ?>
                    <span class="badge bg-info">Harga Tetap</span>
                  <?php endif; ?> -->
                </td>
                <td class="ukuran_<?= $row['id'] ?>">0 cm²</td>
                <td class="harga_<?= $row['id'] ?>">Rp 0</td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
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

    // Handle click event for size buttons
    $('.btn-size').click(function() {
      var lebar = $(this).data('lebar');
      var tinggi = $(this).data('tinggi');
      $('#lebar').val(lebar);
      $('#tinggi').val(tinggi);
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
        var hargaText = "Rp 0";

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

        ukuranCell.text(ukuranText);
        hargaCell.text(hargaText);
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
      if (!angka) return "Rp 0";
      return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Initialize with default values
    calculatePrices(0, 0);
  });
</script>

<?php include '../includes/footer.php'; ?>