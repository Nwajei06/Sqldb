<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Local Election Results</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4 text-primary">Select Local Government Area</h2>

  <form method="POST" action="display.php" class="p-4 bg-white rounded shadow-sm">
    <?php include 'db.php'; ?>

    <div class="mb-3">
      <label for="lga" class="form-label">Local Government</label>
      <select name="lga_id" id="lga" class="form-select" required>
        <option value="">-- Select LGA --</option>
        <?php
        $lga_query = $conn->query("SELECT * FROM lga WHERE state_id = 25");
        while ($row = $lga_query->fetch_assoc()) {
          echo "<option value='{$row['lga_id']}'>{$row['lga_name']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="ward" class="form-label">Ward</label>
      <select name="ward_id" id="ward" class="form-select" required>
        <option value="">-- Select Ward --</option>
        <?php
        $ward_query = $conn->query("SELECT * FROM ward");
        while ($w = $ward_query->fetch_assoc()) {
          echo "<option value='{$w['ward_id']}'>{$w['ward_name']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="polling_unit" class="form-label">Polling Unit</label>
      <select name="polling_unit_uniqueid" id="polling_unit" class="form-select" required>
        <option value="">-- Select Polling Unit --</option>
        <?php
        $pu_query = $conn->query("SELECT * FROM polling_unit");
        while ($p = $pu_query->fetch_assoc()) {
          echo "<option value='{$p['uniqueid']}'>{$p['polling_unit_name']}</option>";
        }
        ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Show Results</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
