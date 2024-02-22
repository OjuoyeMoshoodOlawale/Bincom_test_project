<?php
// Include db conn
include("db_config.php");

if(isset($_POST['lga'])){
    $selectedLGA = $_POST['lga'];
//////////////////////////////
?>
<table>
        <?php
        ?>
            <thead>
                <tr>
                    <th>Polling Unit ID</th>
                    <th>Polling Unit</th>
                    <?php
                    $party_abbr=array();;
                    $sql_party_abbr = "SELECT DISTINCT `party_abbreviation` FROM `announced_pu_results` order by polling_unit_uniqueid  "; 
                    $result_party_abbr = $conn->query($sql_party_abbr);
                    if ($result_party_abbr->num_rows > 0) {
                        // party abbrivation 
                        while($row = $result_party_abbr->fetch_assoc()) {
                            array_push($party_abbr,$row["party_abbreviation"]);
                            ?>
                            
                            <th><?=$row["party_abbreviation"]?></th>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query 
            $sql = "SELECT a.`polling_unit_uniqueid`,a.`party_abbreviation`,a.`party_score`,p.`polling_unit_name`, p.lga_id FROM  `announced_pu_results`as a right JOIN `polling_unit` as p on a.polling_unit_uniqueid=p.polling_unit_id where p.lga_id='$selectedLGA' group by a.polling_unit_uniqueid  order by a.polling_unit_uniqueid ";
            // Execute query
            $result = $conn->query($sql);  
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    ?>
                  <tr>
                    <td><?= $row["polling_unit_uniqueid"];?></td>
                    <td><?= $row["polling_unit_name"];?></td>
                    <?php 
                    // party result loop
                    $pol=$row["polling_unit_uniqueid"];
                    for($data=0;$data<count($party_abbr);$data++)
                    {
                        $party=$party_abbr[$data];
                        $pol_id=$pol;
                        $sql_no ="SELECT party_score AS party_score FROM `announced_pu_results`  WHERE `party_abbreviation`='$party' and `polling_unit_uniqueid`='$pol_id'";
                        //echo $sql_no.'; ';  
                        $no=0;
                        $result_no = $conn->query($sql_no);
                        if ($result_no->num_rows > 0) {
                            $row = $result_no->fetch_assoc();

    $no = $row["party_score"];
                        }

                         ?>
                         <td><?=$no?></td>
                         <?php
                    }

                    
                    
                    ?>

                </tr>
                    
                    <?php

                }
            } else {
                echo "0 results";
            }


            ?>

                            </tbody>
        </table>





<?php
//////////////////////////////
}
