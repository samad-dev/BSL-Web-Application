<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
   
    $trip_id = mysqli_real_escape_string($db, $_POST["trip_id"]);
    $client = mysqli_real_escape_string($db, $_POST["client"]);
    $origin = mysqli_real_escape_string($db, $_POST["origin"]);
    $destination = mysqli_real_escape_string($db, $_POST["destination"]);
    $std = mysqli_real_escape_string($db, $_POST["std"]);
    $tip_start_time = mysqli_real_escape_string($db, $_POST["tip_start_time"]);
    $point_radius = mysqli_real_escape_string($db, $_POST["point_radius"]);
    $dst_name = mysqli_real_escape_string($db, $_POST["dst_name"]);

    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["employee_id"] != '') {
       
    } else {

        $up_trip = "INSERT INTO `bsl`.`trips_child_non_dedicated`
                (`main_id`,
                `trip_start_time`,
                `client`,
                `origin`,
                `destination`,
                `destination_name`,
                `radius`,
                `eta_hour`,
                `departure_time`,
                `arrival_time`,
                `delivery_time`,
                `direction`,
                `craated_at`,
                `created_by`)
                VALUES
                ('$trip_id',
                '$tip_start_time',
                '$client',
                '$origin',
                '$destination',
                '$dst_name',
                '$point_radius',
                '$std',
                '',
                '',
                '',
                '',
                '$date',
                '$user_id');";
            if (mysqli_query($db, $up_trip)) {
                $output = 1;
            }
            else{
                $output = 0;
            }
    }

    echo $output;
}
?>