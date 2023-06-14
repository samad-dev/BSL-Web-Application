<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $vehi_id = $_POST['vehi_id'];

    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["employee_id"] != '') {
        $row_id = $_POST["employee_id"];
        $query = "UPDATE `bsl`.`geogence_group`
        SET
        `name` = '$name'
        WHERE `id`='" . $_POST["employee_id"] . "'";

        if (mysqli_query($db, $query) == true) {

            if ($row_id != "") {

                $delete_query = "DELETE FROM `bsl`.`geofence_group_sub`
                WHERE main_id = '" . $_POST["employee_id"] . "';";

                if (mysqli_query($db, $delete_query) == true) {

                    foreach ($vehi_id as $assign) {
    
                        $sql1 = "INSERT INTO  geofence_group_sub (`main_id`,`geo_id`,`created_at`,`created_by`)
                            VALUES ('$row_id','$assign','$date','$user_id')";
    
                        if (mysqli_query($db, $sql1)) {
                            $output = 1;
    
                        } else {
                            $output = 0;
                        }
                    }
                }


            } else {

                $output = 0;
            }



        } else {
            $output = 0;
        }
    } else {

        $query = "INSERT INTO `geogence_group`
           (`name`,
           `created_at`,
           `created_by`)
           VALUES
           ('$name',
           '$date',
           '$user_id');";

        if (mysqli_query($db, $query) == true) {
            $main_id = mysqli_insert_id($db);
            if ($main_id != "") {
                foreach ($vehi_id as $assign) {

                    $sql1 = "INSERT INTO  geofence_group_sub (`main_id`,`geo_id`,`created_at`,`created_by`)
                        VALUES ('$main_id','$assign','$date','$user_id')";

                    if (mysqli_query($db, $sql1)) {
                        $output = 1;

                    } else {
                        $output = 0;
                    }
                }

            } else {

                $output = 0;
            }



        } else {
            $output = 0;
        }

    }

    echo $output;
}
?>