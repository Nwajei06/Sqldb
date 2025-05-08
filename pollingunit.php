<?php include 'db.php'; ?>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Polling unit data
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

    echo "<p style='color:green;'><strong>Success:</strong> New polling unit and results saved.</p>";
}
?>

<h2>Add New Polling Unit and Results</h2>

<form method="POST">
    <label>Polling Unit Name:</label><br>
    <input type="text" name="polling_unit_name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Ward ID:</label><br>
    <input type="number" name="ward_id" required><br><br>

    <label>Entered By:</label><br>
    <input type="text" name="entered_by" required><br><br>

    <h3>Party Results</h3>
    <?php
    $party_query = $conn->query("SELECT partyid, partyname FROM party");
    while ($party = $party_query->fetch_assoc()):
    ?>
        <label><?= $party['partyid'] ?> (<?= $party['partyname'] ?>):</label>
        <input type="number" name="scores[<?= $party['partyid'] ?>]" value="0" required><br>
    <?php endwhile; ?>

    <br>
    <button type="submit">Save Polling Unit & Results</button>
</form>
