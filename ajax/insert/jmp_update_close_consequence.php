<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $arrival_delivery_site = mysqli_real_escape_string($db, $_POST["arrival_delivery_site"]);
    $entry_at_deleivery_site = mysqli_real_escape_string($db, $_POST["entry_at_deleivery_site"]);
    $exit_at_deleivery_site = mysqli_real_escape_string($db, $_POST["exit_at_deleivery_site"]);
    $total_at_deleivery_site = mysqli_real_escape_string($db, $_POST["total_at_deleivery_site"]);
    $close_row_id = mysqli_real_escape_string($db, $_POST["close_row_id"]);
    $modal_type = mysqli_real_escape_string($db, $_POST["modal_type"]);
    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["modal_type"] == 'Closing') {
        $query = "UPDATE `bsl`.`jmp_trips`
        SET
        `arrival_del_site` = '$arrival_delivery_site',
        `entry_del_site` = '$entry_at_deleivery_site',
        `exit_del_site` = '$exit_at_deleivery_site',
        `total_del_site` = '$total_at_deleivery_site'
        WHERE `id` = '$close_row_id';";
        $output = 'Data Updated';
    } else {
        $query = "UPDATE `bsl`.`jmp_trips`
        SET
        `con_applied_sp` = '$arrival_delivery_site',
        `con_applied_hb` = '$entry_at_deleivery_site',
        `con_applied_ed` = '$exit_at_deleivery_site',
        `total_applied_ed` = '$total_at_deleivery_site'
        WHERE `id` = '$close_row_id';";
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