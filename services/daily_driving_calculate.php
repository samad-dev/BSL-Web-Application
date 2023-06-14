<?php
date_default_timezone_set("Asia/Karachi");
ini_set('max_execution_time', -1);
$username = "root";
$password = "";
$database = "bsl";

// Opens a connection to a MySQL server
$connection = mysqli_connect('localhost', $username, $password, $database);
if (!$connection) {
    die('Not connected : ' . mysqli_error($connection));
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected) {
    die('Can\'t use db : ' . mysqli_error($connection));
}
$current_time = date('H:i'); // Get the current time in the 24-hour format (e.g. "23:30")
if ($current_time === '00:00' && $current_time === '00:01' && $current_time === '00:03' && $current_time === '00:04' && $current_time === '00:05') {
    // Your code to run at 12 AM goes here
    //$sql_query = "SELECT ts.*,d.name,d.trackername,d.lat,d.lng,d.ignition,d.lasttime FROM trip_sub ts  join devices d on d.id = ts.vehicle_id where ts.status = 0;";
    $all_users = "SELECT * FROM bsl.users as us join bsl.user_alerts_define as uad on uad.user_id=us.id";
    $result_all_users = $connection->query($all_users) or die("Error :" . mysqli_error($connection));

    while ($user_row = $result_all_users->fetch_assoc()) {

        $user = $user_row['id'];
        $username = $user_row['name'];
        $excess_driving = $user_row['daily_driving_limit'];
        $todate = date("Y-m-d H:i:s", time());
        $cur_date = date("Y-m-d H:i:s");
        $cur_date = date("Y-m-d H:i:s");
        $prev_date = date("Y-m-d H:i:s", strtotime($todate . '-' . $excess_driving . ' hour'));

        $now_date = date('Y-m-d', strtotime('-1 day'));
        $from = $now_date . ' 00:00:00';
        $to = $now_date . ' 23:59:59';
        echo '=====================' . $username . "=======================<br>";

        $sql = "SELECT * FROM bsl.users_devices where users_id=$user;";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $device_id = $row["devices_id"];


                $curl = curl_init();

                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_URL => 'http://119.160.107.173:3002/violation/' . $device_id . '/' . str_replace(' ', '%20', $from) . '/' . str_replace(' ', '%20', $to) . '/60',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    )
                );

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    // $response = json_decode($response, true);
                    if ($response != null) {
                        $json_arr = json_decode($response, true);
                        // print_r($json_arr);
                        // for ($i = 0; $i < count($json_arr); $i++) {

                        $time = $json_arr[0]['Driven_Hours'];
                        $vehicle_name = $json_arr[0]['name'];
                        echo $time . '<br>';
                        $parts = explode(":", $time);
                        $hours = (int) $parts[0];
                        $minutes = (int) $parts[1];
                        $total_minutes = ($hours * 60) + $minutes;

                        // echo $total_minutes . '<br>';
                        $excess_driving = $excess_driving * 60;
                        if ($total_minutes > ($excess_driving)) {
                            echo $json_arr[0]['name'] . '<br>';
                            echo $json_arr[0]['Driven_Hours'] . '<br>';
                            $duration = $total_minutes - $excess_driving;
                            echo 'Excess Driving ' . ($total_minutes - $excess_driving) . '<br>';
                            $excess_time = date("Y-m-d H:i:s");
                            $message = "" . $vehicle_name . " has exceeded Driving limit by " . $duration . " minutes of allow driving time.";

                            echo $insert_alert = "INSERT INTO `bsl`.`axcess_driving_alerts`
                          (`vehicle_id`,
                          `type`,
                          `vehicle_name`,
                          `message`,
                          `driving_limit`,
                          `excess_driving`,
                          `duration`,
                          `created_at`,
                          `created_by`)
                          VALUES
                          ('$device_id',
                          '1',
                          '$vehicle_name',
                          '$message',
                          '$excess_driving',
                          '$total_minutes',
                          '$duration',
                          '$excess_time',
                          '$user');";

                            mysqli_query($connection, $insert_alert);

                        }
                        // }
                    }
                }
            }
        } else {
            echo "0 results <br>";
        }
    }
} else {
    echo 'Time Left ' . $current_time;
}







?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="60">
    <title>Daily Driving</title>
</head>

<body style="background: #fff;">
    <br>
    <?php echo date("d-m-Y H:i:s"); ?>
</body>

</html>