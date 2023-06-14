<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $casp = mysqli_real_escape_string($db, $_POST["casp"]);
    $cbsp = mysqli_real_escape_string($db, $_POST["cbsp"]);
    $cdsp = mysqli_real_escape_string($db, $_POST["cdsp"]);
    $cahb = mysqli_real_escape_string($db, $_POST["cahb"]);
    $cbhb = mysqli_real_escape_string($db, $_POST["cbhb"]);
    $cdhb = mysqli_real_escape_string($db, $_POST["cdhb"]);
    $caed = mysqli_real_escape_string($db, $_POST["caed"]);
    $cbed = mysqli_real_escape_string($db, $_POST["cbed"]);
    $cded = mysqli_real_escape_string($db, $_POST["cded"]);
    $close_row_id = mysqli_real_escape_string($db, $_POST["close_row_id"]);
    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    $query = "UPDATE `bsl`.`jmp_trips`
        SET
        `con_applied_sp` = '$casp',
        `con_applied_hb` = '$cahb',
        `con_applied_ed` = '$caed',
        `applied_by_sp` = '$cbsp',
        `applied_by_ed` = '$cbhb',
        `applied_by_hb` = '$cbed',
        `applied_on_sp` = '$cdsp',
        `applied_on_ed` = '$cded',
        `applied_on_hb` = '$cdhb'
        WHERE `id` = '$close_row_id';";
    $output = 'Data Inserted';

    if (mysqli_query($db, $query)) {
        $output = 1;

    } else {
        echo $query;
        $output = 0;
    }
    echo $output;
}
?>