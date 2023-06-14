<?php
include ("../../config.php");
session_start();

if (!empty($_POST))
{
    $output = '';
    $message = '';
    $vehi_id = mysqli_real_escape_string($db, $_POST["vehi_id"]);
    $customer = mysqli_real_escape_string($db, $_POST["customer"]);
    $loading_site = mysqli_real_escape_string($db, $_POST["loading_site"]);
    $trip_start_date = mysqli_real_escape_string($db, $_POST["trip_start_date"]);
    $shipment_bilti = mysqli_real_escape_string($db, $_POST["shipment_bilti"]);
    $destination = mysqli_real_escape_string($db, $_POST["destination"]);
    $driver_d1 = mysqli_real_escape_string($db, $_POST["driver_d1"]);
    $cnic_d1 = mysqli_real_escape_string($db, $_POST["cnic_d1"]);
    $mobile_d1 = mysqli_real_escape_string($db, $_POST["mobile_d1"]);
    $duty_time_d1 = mysqli_real_escape_string($db, $_POST["duty_time_d1"]);
    $driver_d2 = mysqli_real_escape_string($db, $_POST["driver_d2"]);
    $cnic_d2 = mysqli_real_escape_string($db, $_POST["cnic_d2"]);
    $mobile_d2 = mysqli_real_escape_string($db, $_POST["mobile_d2"]);
    $duty_time_d2 = mysqli_real_escape_string($db, $_POST["duty_time_d2"]);
    $departure_from_terminal = mysqli_real_escape_string($db, $_POST["departure_from_terminal"]);
    $arrival_at_loading_site = mysqli_real_escape_string($db, $_POST["arrival_at_loading_site"]);
    $loading_start_time = mysqli_real_escape_string($db, $_POST["loading_start_time"]);
    $loading_complete_time = mysqli_real_escape_string($db, $_POST["loading_complete_time"]);
    $departure_at_loading_site = mysqli_real_escape_string($db, $_POST["departure_at_loading_site"]);
    $total_loading_time = mysqli_real_escape_string($db, $_POST["total_loading_time"]);
    $eta_destination = mysqli_real_escape_string($db, $_POST["eta_destination"]);
    $capacity = mysqli_real_escape_string($db, $_POST["capacity"]);
    $chamber1 = mysqli_real_escape_string($db, $_POST["chamber1"]);
    $dip1 = mysqli_real_escape_string($db, $_POST["dip1"]);
    $chamber2 = mysqli_real_escape_string($db, $_POST["chamber2"]);
    $dip2 = mysqli_real_escape_string($db, $_POST["dip2"]);
    $estimated_total_trip_time = mysqli_real_escape_string($db, $_POST["estimated_total_trip_time"]);


    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["employee_id"] != '')
    {
        $query = "UPDATE `product` SET`product_name` = '$name' ,`category_type` = '$b_name',`product_unit_of_measurement` = '$o_name' WHERE `id`='" . $_POST["employee_id"] . "'";
        $output = 'Data Updated';
    }
    else
    {

        
            $query = "INSERT INTO `bsl`.`jmp_trips`
            (`vehicle_id`,
            `customer`,
            `loading_site`,
            `trip_start_date`,
            `shipment_bilti`,
            `destination`,
            `driver_d1`,
            `cnic_d1`,
            `mobile_d1`,
            `duty_time_d1`,
            `driver_d2`,
            `cnic_d2`,
            `mobile_d2`,
            `duty_time_d2`,
            `departure_from_terminal`,
            `arrival_loading_site`,
            `loading_completion_time`,
            `departure_from_loading_site`,
            `total_loading_time`,
            `eta_destination`,
            `estimated_total_trip_time`,
            `created_at`,
            `created_by`,
            `capacity`,
            `chamber1`,
            `dip1`,
            `chamber2`,
            `dip2`
            )
            VALUES
            ('$vehi_id',
            '$customer',
            '$loading_site',
            '$trip_start_date',
            '$shipment_bilti',
            '$destination',
            '$driver_d1',
            '$cnic_d1',
            '$mobile_d1',
            '$duty_time_d1',
            '$driver_d2',
            '$cnic_d2',
            '$mobile_d2',
            '$duty_time_d2',
            '$departure_from_terminal',
            '$arrival_at_loading_site',
            '$loading_complete_time',
            '$departure_at_loading_site',
            '$total_loading_time',
            '$eta_destination',
            '$estimated_total_trip_time',
            '$date',
            '$user_id',
            '$capacity',
            '$chamber1',
            '$dip1',
            '$chamber2',
            '$dip2');";

            if (mysqli_query($db, $query))
            {
                $main_id = mysqli_insert_id($db);
               

                $output = 1;

            }
            else
            {
                $output = 0;
            }
    }

    echo $output;
}
?>
