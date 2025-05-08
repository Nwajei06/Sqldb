<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add New Polling Unit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4 text-success">Add New Polling Unit and Results</h2>

  <?php
  include 'db.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $conn->real_escape_string($_POST['polling_unit_name']);
      $desc = $conn->real_escape_string($_POST['description']);
      $ward_id = (int) $_POST['ward_id'];
      $entered_by = $conn->real_escape_string($_POST['entered_by']);
      $date_entered = date('Y-m-d H:i:s');
      $ip_address = $_SERVER['REMOTE_ADDR'];

      // Insert new polling unit
      $conn->query("INSERT INTO polling_unit (polling_unit_name, polling_unit_description, ward_id, entered_by_user, date_entered, user_ip_address)
                    VALUES ('$name', '$desc', $ward_id, '$entered_by', '$date_entered', '$ip_address')");

      $new_pu_id = $conn->insert_id;

      // Insert each party result
      foreach ($_POST['scores'] as $party => $score) {
          $score = (int) $score;
          $party = $conn->real_escape_string($party);

          $conn->query("INSERT INTO announced_pu_results (
              polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address
          ) VALUES (
              $new_pu_id, '$party', $score, '$entered_by', '$date_entered', '$ip_address'
          )");
      }

      echo "<div class='alert alert-success'>New polling unit and results saved successfully.</div>";
  }
  ?>

  <form method="POST" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label class="form-label">Polling Unit Name</label>
      <input type="text" name="polling_unit_name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="2"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Ward ID</label>
      <input type="number" name="ward_id" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Entered By</label>
      <input type="text" name="entered_by" class="form-control" required>
    </div>

    <h4 class="mt-4">Party Results</h4>
    <?php
    $party_query = $conn->query("SELECT partyid, partyname FROM party");
    while ($party = $party_query->fetch_assoc()):
    ?>
      <div class="mb-2">
        <label class="form-label"><?= $party['partyid'] ?> (<?= $party['partyname'] ?>):</label>
        <input type="number" name="scores[<?= $party['partyid'] ?>]" class="form-control" value="0" required>
      </div>
    <?php endwhile; ?>

    <button type="submit" class="btn btn-success mt-3">Save Polling Unit & Results</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
