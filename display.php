<?php
include 'db.php';

if (isset($_POST['polling_unit_uniqueid']) && !empty($_POST['polling_unit_uniqueid'])) {
    $pu_id = $conn->real_escape_string($_POST['polling_unit_uniqueid']);

    // echo "<p><strong>Polling Unit ID:</strong> " . $pu_id . "</p>";

    $query = "SELECT party_abbreviation, party_score FROM announced_pu_results WHERE polling_unit_uniqueid = '$pu_id'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<h2>Polling Unit Results</h2>";
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>Party</th>
                    <th>Score</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['party_abbreviation']}</td>
                    <td>{$row['party_score']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<h2>No election results found for this polling unit.</h2>";
    }
} else {
    echo "<h2 style='color: red;'>Error: No polling unit was selected.</h2>";
}
?>
