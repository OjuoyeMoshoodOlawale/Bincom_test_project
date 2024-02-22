<?php
include("db_config.php");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // get data
            $polling_unit_uniqueid = $_POST["polling_unit_id"];
            $party_abbreviation = $_POST["party_abbreviation"];
            $party_score = $_POST["party_score"];
            
            $entered_by_user = "User"; 
            $date_entered = date("Y-m-d H:i:s"); 
            $user_ip_address = $_SERVER["REMOTE_ADDR"]; 
            
            // Prepare and bind SQL statement
            $sql = "INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssisss", $polling_unit_uniqueid, $party_abbreviation, $party_score, $entered_by_user, $date_entered, $user_ip_address);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "Record inserted successfully. <a href='create.php'>Back <a/>";
            } else {
                echo "Error: " . $conn->error;
            }
            
            // Close statement
            $stmt->close();
        }
        
        ?>