<?php
//fetch.php  
include("../../config.php");
$users_arr = array();
if (isset($_POST["employee_id"])) {
    $query = "SELECT gg.id,gg.name, GROUP_CONCAT(geo.id ORDER BY gs.id ASC SEPARATOR ',') as geo_name FROM bsl.geofence_group_sub as gs 
    join geogence_group as gg on gg.id=gs.main_id 
    join geofenceing as geo on geo.id=gs.geo_id where gg.id='" . $_POST["employee_id"] . "'  GROUP BY gs.main_id;";
    $result = mysqli_query($db, $query);

    $row = mysqli_fetch_array($result);  
    echo json_encode($row);  
}
?>