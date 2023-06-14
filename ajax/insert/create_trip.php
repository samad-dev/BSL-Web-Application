<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $trip_type = mysqli_real_escape_string($db, $_POST["trip_type"]);
    $driver = mysqli_real_escape_string($db, $_POST["driver"]);
    $vehi_id = mysqli_real_escape_string($db, $_POST["vehi_id"]);
    $size_vehi = mysqli_real_escape_string($db, $_POST["size_vehi"]);
    $client = mysqli_real_escape_string($db, $_POST["client"]);
    $origin = mysqli_real_escape_string($db, $_POST["origin"]);
    $destination = mysqli_real_escape_string($db, $_POST["destination"]);
    $std = mysqli_real_escape_string($db, $_POST["std"]);
    $tip_start_time = mysqli_real_escape_string($db, $_POST["tip_start_time"]);

    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["employee_id"] != '') {
        
    } else {

        if ($trip_type == 'Dedicated') {
            $query = "INSERT INTO `bsl`.`trips`
            (`type`,
            `start_time`,
            `driver`,
            `vehicle`,
            `size`,
            `created_at`,
            `created_by`)
            VALUES
            ('$trip_type',
            '$tip_start_time',
            '$driver',
            '$vehi_id',
            '$size_vehi',
            '$date',
            '$user_id');";

            if (mysqli_query($db, $query)) {
                $main_id = mysqli_insert_id($db);
                $up_trip = "INSERT INTO `bsl`.`trips_child`
                (`main_id`,
                `client`,
                `origin`,
                `destination`,
                `eta_hour`,
                `departure_time`,
                `arrival_time`,
                `delivery_time`,
                `direction`,
                `craated_at`,
                `created_by`)
                VALUES
                ('$main_id',
                '$client',
                '$origin',
                '$destination',
                '$std',
                '',
                '',
                '',
                'Up',
                '$date',
                '$user_id');";
                mysqli_query($db, $up_trip);

                $down_trip = "INSERT INTO `bsl`.`trips_child`
                (`main_id`,
                `client`,
                `origin`,
                `destination`,
                `eta_hour`,
                `departure_time`,
                `arrival_time`,
                `delivery_time`,
                `direction`,
                `craated_at`,
                `created_by`)
                VALUES
                ('$main_id',
                '$client',
                '$destination',
                '$origin',
                '$std',
                '',
                '',
                '',
                'Down',
                '$date',
                '$user_id');";
                mysqli_query($db, $down_trip);

                $output = 1;

            } else {
                $output = 0;
            }

        } else {
            $query = "INSERT INTO `bsl`.`trips_non_dedicated`
            (`type`,
            `start_time`,
            `driver`,
            `vehicle`,
            `size`,
            `created_at`,
            `created_by`)
            VALUES
            ('$trip_type',
            '$tip_start_time',
            '$driver',
            '$vehi_id',
            '$size_vehi',
            '$date',
            '$user_id');";

            if (mysqli_query($db, $query)) {
                $main_id = mysqli_insert_id($db);
                $point_radius = mysqli_real_escape_string($db, $_POST["point_radius"]);
                $dst_name = mysqli_real_escape_string($db, $_POST["dst_name"]);


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
                ('$main_id',
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
            }
        }
    }

    echo $output;
}
?>