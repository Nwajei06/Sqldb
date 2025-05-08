<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <?php
    include 'db.php';

    if (isset($_POST['polling_unit_uniqueid']) && !empty($_POST['polling_unit_uniqueid'])) {
        $pu_id = $conn->real_escape_string($_POST['polling_unit_uniqueid']);

        $query = "SELECT party_abbreviation, party_score FROM announced_pu_results WHERE polling_unit_uniqueid = '$pu_id'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            echo "<h2 class='mb-4 text-primary'>Polling Unit Results</h2>";
            echo "<table class='table table-bordered table-striped'>
                    <thead class='table-dark'>
                        <tr>
                            <th>Party</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['party_abbreviation']}</td>
                        <td>{$row['party_score']}</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>No election results found for this polling unit.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: No polling unit was selected.</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
