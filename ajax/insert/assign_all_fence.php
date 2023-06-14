<?php
//fetch.php
session_start();
include("../../config.php");
set_time_limit(0);
$consignee_name_arr = array();
$depot_count_arr = array();
$date = date('Y-m-d H:i:s');
$back_consignee_name_arr = array();
$blackSpot_count_arr = array();

$query = "SELECT * FROM devices ";
// echo $query;
$results = mysqli_query($db, $query);

foreach ($results as $city) {
    $vehi_id = $city['id'];

    $query1 = "SELECT * FROM bsl.geofenceing where geotype!=4;";
    // echo $query;
    $results1 = mysqli_query($db, $query1);

    foreach ($results1 as $city1) {
        $geo_id = $city1['id'];

        $sql1 = "INSERT INTO `bsl`.`vehicle_geofence`
                (`vehicle_id`,
                `geo_id`,
                `user_id`,
                `speed_limit`,
                `created_at`,
                `created_by`)
                VALUES
                ('$vehi_id',
                '$geo_id',
                '1',
                '55',
                '$date',
                '1');";

        if (mysqli_query($db, $sql1)) {
            $output = 1;

        } else {
            $output = 0;
        }

    }
}

?>