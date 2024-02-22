<?php
// MySQL database credentials
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "bincom_test"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Close connection
//$conn->close();
?>
