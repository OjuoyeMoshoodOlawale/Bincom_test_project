<!DOCTYPE html>
<?php
include("db_config.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGA Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Polling Unit Results</a></li>
            <li><a href="lga.php">LGA Results</a></li>
            <li><a href="create.php">Add New Results</a></li>

        </ul>
    </nav>
    
    <div class="container">
        <h1>Store Results for All Parties</h1>

        <form action="store_results.php" method="POST">
            <label for="polling_unit_id">Polling Unit:</label><br>
            <select id="polling_unit_id" name="polling_unit_id">
            <option value="">(Select Polling Unit)</option>
            <?php
            // SQL query to fetch data from the polling_unit
                $sql = "SELECT * FROM polling_unit"; 
                // Execute query
                $result = $conn->query($sql);

                // Check if not null
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?><option value="<?=$row["polling_unit_id"]?>"><?=$row["polling_unit_name"]?></option><?php
                    }
                }
            ?>
    </select><br><br>
            
            <label for="party_abbreviation">Party Abbreviation:</label><br>
            <select id="party_abbreviation" name="party_abbreviation">
            <?php
            // SQL query to fetch data from party table
                $sql = "SELECT * FROM party"; // 
                // Execute query
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?><option value="<?=$row["partyname"]?>"><?=$row["partyname"]?></option><?php
                    }
                }
            ?>
            </select>            
            <label for="party_score">Party Score:</label><br>
            <input type="number" id="party_score" name="party_score"><br><br>            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
