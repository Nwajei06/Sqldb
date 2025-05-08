<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'db.php'; ?>

<h2>Select Local Government Area</h2>
<form method="POST" action="results.php">
    <select name="lga_id" required>
        <option value="">-- Select LGA --</option>
        <?php
        $lga_query = $conn->query("SELECT * FROM lga WHERE state_id = 25");
        while ($row = $lga_query->fetch_assoc()) {
            echo "<option value='{$row['lga_id']}'>{$row['lga_name']}</option>";
        }
        ?>
    </select>
    <br><br>
    <button type="submit">Next</button>
</form>
</body>
</html> -->


