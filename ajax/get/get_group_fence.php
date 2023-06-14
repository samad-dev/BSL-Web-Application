<?php
session_start();
include("../../config.php");



if (!empty($_POST['group_id']))
{

    $group_id = $_POST['group_id'];
    // $multi_group_id = implode(",", $group_id);

    if ($group_id != "")
    {
        $users_arr = array();
        $sql = "SELECT geo.id,geo.consignee_name FROM geofence_group_sub as gs 
        join geogence_group as gg on gg.id=gs.main_id 
        join geofenceing as geo on geo.id=gs.geo_id
        where gg.id='$group_id';";
        // echo $sql;
        $result = mysqli_query($db, $sql);

        while ($row = mysqli_fetch_array($result))
        {

            $users_arr[] = $row;
        }
        // print_r($users_arr);
        // echo 'True '.$data;
        echo json_encode($users_arr);

    }
    else
    {
        echo 'False';
    }
}
else{
    
    echo 'False';
}


?>
