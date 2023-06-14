<?php
session_start();
include("../../config.php");



if (!empty($_POST['vehi_id']))
{

    $vehi_id = $_POST['vehi_id'];
    // $multi_group_id = implode(",", $vehi_id);

    if ($vehi_id != "")
    {
        $users_arr = array();
        $sql = "SELECT geo.* FROM bsl.vehicle_geofence as vg join geofenceing as geo on geo.id=vg.geo_id where vg.vehicle_id='$vehi_id' and geo.type='circle';";
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
