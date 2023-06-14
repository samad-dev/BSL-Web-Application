<?php
include("../../config.php");
session_start();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $name = mysqli_real_escape_string($db, $_POST["name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $contact = mysqli_real_escape_string($db, $_POST["contact"]);
    $role = mysqli_real_escape_string($db, $_POST["role"]);
    $address = mysqli_real_escape_string($db, $_POST["address"]);

    $overspeed_limit = mysqli_real_escape_string($db, $_POST["overspeed_limit"]);
    $idle_duration = mysqli_real_escape_string($db, $_POST["idle_duration"]);
    $nr_duration = mysqli_real_escape_string($db, $_POST["nr_duration"]);
    $night_from = mysqli_real_escape_string($db, $_POST["night_from"]);
    $night_to = mysqli_real_escape_string($db, $_POST["night_to"]);
    $excess_driving = mysqli_real_escape_string($db, $_POST["excess_driving"]);
    $excess_driving_day = mysqli_real_escape_string($db, $_POST["excess_driving_day"]);


    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_POST["employee_id"] != '') {
        $query = "UPDATE `bsl`.`users`
        SET
        `name` = '$name',
        `login` = '$email',
        `description` = '$password',
        `address` = '$address',
        `telephone` = '$contact',
        `email` = '$email'
        WHERE `id`='" . $_POST["employee_id"] . "'";

        if (mysqli_query($db, $query)) {

            $update_alert = "UPDATE `bsl`.`user_alerts_define`
            SET
            `overspeed` = '$overspeed_limit',
            `idle` = '$idle_duration',
            `nr` = '$nr_duration',
            `night_from` = '$night_from',
            `night_to` = '$night_to',
            `excess_driving` = '$excess_driving',
            `daily_driving_limit` = '$excess_driving_day'
            WHERE `user_id` = '" . $_POST["employee_id"] . "';";

            if (mysqli_query($db, $update_alert)) {
                $output = 1;

            } else {
                $output = 0;

            }
        } else {
            $output = 0;
        }

    } else {
        if ($role == 'Admin') {
            $query = "INSERT INTO `users`
          (`name`,
          `privilege`,
          `login`,
          `description`,
          `address`,
          `telephone`,
          `email`)
          VALUES
          ('$name',
          '$role',
          '$email',
          '$password',
          '$address',
          '$contact',
          '$email');";
            $output = 'Data Inserted';
            if (mysqli_query($db, $query)) {
                $main_id = mysqli_insert_id($db);
                $user_define = "INSERT INTO `bsl`.`user_alerts_define`
                (`user_id`,
                `overspeed`,
                `idle`,
                `nr`,
                `night_from`,
                `night_to`,
                `excess_driving`,
                `daily_driving_limit`)
                VALUES
                ('$main_id',
                '$overspeed_limit',
                '$idle_duration',
                '$nr_duration',
                '$night_from',
                '$night_to','$excess_driving','$excess_driving_day');";
                if (mysqli_query($db, $user_define)) {
                    $output = 1;

                } else {
                    $output = 0;

                }

            } else {
                $output = 0;
            }
        } else if ($role == 'Distributor') {
            $query = "INSERT INTO `users`
          (`name`,
          `privilege`,
          `login`,
          `description`,
          `address`,
          `telephone`,
          `email`)
          VALUES
          ('$name',
          '$role',
          '$email',
          '$password',
          '$address',
          '$contact',
          '$email');";
            $output = 'Data Inserted';
            if (mysqli_query($db, $query)) {
                $main_id = mysqli_insert_id($db);
                $admin_id = mysqli_real_escape_string($db, $_POST["all_admin"]);

                $distributor_sql = "INSERT INTO `bsl`.`admin_distributers`
                (`admin_id`,
                `distributor_id`,
                `created_at`,
                `created_by`)
                VALUES
                ($admin_id,
                '$main_id',
                '$date',
                '$user_id');";
                if (mysqli_query($db, $distributor_sql)) {
                    $user_define = "INSERT INTO `bsl`.`user_alerts_define`
                    (`user_id`,
                    `overspeed`,
                    `idle`,
                    `nr`,
                    `night_from`,
                    `night_to`,`excess_driving`,`daily_driving_limit`)
                    VALUES
                    ('$main_id',
                    '$overspeed_limit',
                    '$idle_duration',
                    '$nr_duration',
                    '$night_from',
                    '$night_to','$excess_driving','$excess_driving_day');";
                    if (mysqli_query($db, $user_define)) {
                        $output = 1;

                    } else {
                        $output = 0;

                    }
                } else {
                    $output = 0;

                }

            } else {
                $output = 0;
            }
        } else if ($role == 'End-User') {
            $query = "INSERT INTO `users`
            (`name`,
            `privilege`,
            `login`,
            `description`,
            `address`,
            `telephone`,
            `email`)
            VALUES
            ('$name',
            '$role',
            '$email',
            '$password',
            '$address',
            '$contact',
            '$email');";
            $output = 'Data Inserted';
            if (mysqli_query($db, $query)) {
                $main_id = mysqli_insert_id($db);
                $dis_id = mysqli_real_escape_string($db, $_POST["all_end_user"]);

                $end_user_sql = "INSERT INTO `bsl`.`distributor_end_user`
                (`distributor_id`,
                `end_user_id`,
                `created_at`,
                `created_by`)
                VALUES
                ($dis_id,
                '$main_id',
                '$date',
                '$user_id');";
                if (mysqli_query($db, $end_user_sql)) {
                    $user_define = "INSERT INTO `bsl`.`user_alerts_define`
                    (`user_id`,
                    `overspeed`,
                    `idle`,
                    `nr`,
                    `night_from`,
                    `night_to`,`excess_driving`,`daily_driving_limit`)
                    VALUES
                    ('$main_id',
                    '$overspeed_limit',
                    '$idle_duration',
                    '$nr_duration',
                    '$night_from',
                    '$night_to','$excess_driving','$excess_driving_day');";
                    if (mysqli_query($db, $user_define)) {
                        $output = 1;

                    } else {
                        $output = 0;

                    }
                } else {
                    $output = 0;

                }

            } else {
                $output = 0;
            }
        }

    }

    echo $output;

}
?>