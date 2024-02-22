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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <h1>LGA Results</h1>
    <label for="lga_id">LGA Unit:</label><br>
            <select id="lga_id" name="lga_id">
            <option value="">(Select Applicable LGA )</option>
            <?php
            
                $sql = "SELECT * FROM lga"; 

                // Execute query
                $result = $conn->query($sql);

                // Check if there are rows in the result set
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?><option value="<?=$row["lga_id"]?>"><?=$row["lga_name"]?></option><?php
                    }
                }
            ?>
    </select>
<div id="res">

 </div>
        

<script>
    $(document).ready(function(){
        $('#lga_id').on('change', function(){
            var selectedLGA = $(this).val();
            $.ajax({
                url: 'fetch_lga_data.php',
                type: 'POST',
                data: {lga: selectedLGA},
                dataType: 'html',
                success: function(response){
                    // Alert the response received from the server
                    $("#res").html(response);
                },
                error: function(xhr, status, error){
                    alert(xhr.responseText);
                }
            });
        });
    });
</script>






    </div>
</body>
</html>
