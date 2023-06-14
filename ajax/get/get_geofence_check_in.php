<?php
//fetch.php
session_start();
include("../../config.php");
set_time_limit(0);
$consignee_name_arr = array();
$depot_count_arr = array();

$back_consignee_name_arr = array();
$blackSpot_count_arr = array();

$query = "SELECT * FROM geofenceing";
// echo $query;
$results = mysqli_query($db, $query);

foreach ($results as $city)
{
    $id = $city['id'];
    $consignee_name = $city['consignee_name'];

    $query1 = "SELECT count(*) as counting FROM geo_in_check where geo_id='$id' ;";
    // echo $query;
    $results1 = mysqli_query($db, $query1);

    foreach ($results1 as $city1)
    {
        $a = $city1['counting'];
        // echo "hamza".$a;
        array_push($depot_count_arr, intval($a));
        array_push($consignee_name_arr, $consignee_name . ' - ' . $a);

    }
}
$query_black = "SELECT * FROM geofenceing where geotype='black Spote'";
// echo $query;
$results_black = mysqli_query($db, $query_black);

foreach ($results_black as $city_black)
{
    $black_id = $city_black['id'];
    $black_consignee_name = $city_black['consignee_name'];
    // echo $id ;
    $query1_black = "SELECT count(*) as counting FROM geo_in_check where geo_id='$black_id' ;";
    // echo $query;
    $results1_black = mysqli_query($db, $query1_black);

    foreach ($results1_black as $city1_black)
    {
        $a = $city1_black['counting'];
        // echo "hamza".$a;
        array_push($blackSpot_count_arr, intval($a));
        array_push($back_consignee_name_arr, $black_consignee_name . ' - ' . $a);

    }
}

$dataarray = array(
    'consignee_name' => json_encode($consignee_name_arr) ,
    'depot_count' => json_encode($depot_count_arr) ,
    'back_consignee_name' => json_encode($back_consignee_name_arr) ,
    'blackSpot_count' => json_encode($blackSpot_count_arr)
);

echo json_encode($dataarray);

?>
