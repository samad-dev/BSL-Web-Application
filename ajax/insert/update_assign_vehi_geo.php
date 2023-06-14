<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $edit_geo = mysqli_real_escape_string($db, $_POST["edit_geo"]);
    $edit_overspeed_limit = mysqli_real_escape_string($db, $_POST["edit_overspeed_limit"]);
    $vehicle_id = mysqli_real_escape_string($db, $_POST["vehicle_id"]);
    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["row_id"] != '') {
        $row_id = mysqli_real_escape_string($db, $_POST["row_id"]);

       echo $query = "UPDATE `vehicle_geofence`
           SET
           `geo_id` = '$edit_geo',
           `speed_limit` = '$edit_overspeed_limit'
           WHERE `id` = '$row_id';";

        $output = 'Data Updated';
    } else {
        $query = "INSERT INTO `driver_detail`
           (`name`,
           `email`,
           `cnic`,
           `mobile_no`,
           `address`,
           `created_at`,
           `created_by`)
           VALUES
           ('$name',
           '$email',
           '$cnic',
           '$contact',
           '$address',
           '$date',
           '$user_id');";
        $output = 'Data Inserted';
    }
    if (mysqli_query($db, $query)) {
        $output = 1;

    } else {
        $output = 0;
    }
    echo $output;
}
?>