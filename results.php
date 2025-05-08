<?php include 'db.php'; ?>

<h2>Select Local Government Area</h2>

<form method="POST" action="display.php">
    <label>Local Government:</label>
    <select name="lga_id" required>
        <option value="">-- Select LGA --</option>
        <?php
        // Fetch all LGAs from the database
        $lga_query = $conn->query("SELECT * FROM lga WHERE state_id = 25"); // Adjust state_id if needed
        while ($row = $lga_query->fetch_assoc()) {
            echo "<option value='{$row['lga_id']}'>{$row['lga_name']}</option>";
        }
        ?>
    </select>

    <br><br>
    <label>Ward:</label>
    <select name="ward_id" required>
        <option value="">-- Select Ward --</option>
        <?php
        // Optional: You can dynamically load wards via JavaScript later
        $ward_query = $conn->query("SELECT * FROM ward");
        while ($w = $ward_query->fetch_assoc()) {
            echo "<option value='{$w['ward_id']}'>{$w['ward_name']}</option>";
        }
        ?>
    </select>

    <br><br>
    <label>Polling Unit:</label>
    <select name="polling_unit_uniqueid" required>
        <option value="">-- Select Polling Unit --</option>
        <?php
        // Load all polling units initially — or filter via JS later
        $pu_query = $conn->query("SELECT * FROM polling_unit");
        while ($p = $pu_query->fetch_assoc()) {
            echo "<option value='{$p['uniqueid']}'>{$p['polling_unit_name']}</option>";
        }
        ?>
    </select>

    <br><br>
    <button type="submit">Show Results</button>
</form>
