<?php
date_default_timezone_set("Asia/Karachi");
ini_set('max_execution_time', -1);
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 20; URL=$url1");
$username = "root";
$password = "Ptoptrack@(!!@";
$database = "attock";

// Opens a connection to a MySQL server
$connection = mysqli_connect('localhost', $username, $password, $database);
if (!$connection)
{
    die('Not connected : ' . mysqli_error());
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected)
{
    die('Can\'t use db : ' . mysqli_error());
}

//$sql_query = "SELECT ts.*,d.name,d.trackername,d.lat,d.lng,d.ignition,d.lasttime FROM attock.trip_sub ts  join attock.devices d on d.id = ts.vehicle_id where ts.status = 0;";
// SELECT * FROM attock.geo_in_check where in_time  >= curdate();
$all_users = "SELECT * FROM attock.users where privilege='admin' or privilege='Cartraige' and id=408";
$result_all_users = $connection->query($all_users) or die("Error :" . mysqli_error());

while ($user_row = $result_all_users->fetch_assoc())
{

    $user = $user_row['id'];
    $sql = "SELECT ck.*,ud.*,dc.latestPosition_id FROM attock.geo_in_check as ck 
    join attock.users_devices as ud on ud.devices_id=ck.veh_id
    join attock.devices as dc on dc.id=ud.devices_id
    where ck.in_time  >= curdate() and ud.users_id='$user' and ck.latitude!=0 and ck.longitude!=0";
    $result = $connection->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
            $sql2 = "SELECT * FROM driving_alerts where device_id =" . $row["veh_id"] . "  and in_time ='" . $row["in_time"] . "' and geo_id = '" . $row["geo_id"] . "'";
            $result2 = $connection->query($sql2);
            // echo $sql2."<br>";
            if (mysqli_num_rows($result2) == 0)
            {
                $geo_type = $row["geotype"];
                $speed = $row["speed"];

                if ($geo_type == 'black Spote' && $speed == 0)
                {
                    $checking_time = "SELECT * FROM attock.driving_alerts where type='black Spote In' and device_id='$veh_id' and created_by='" . $user_row['id'] . "' and created_at>=curdate() order by id desc limit 1;";
                    $result_checking_time = mysqli_query($connect, $checking_time);

                    $count_checking_time = mysqli_num_rows($result_checking_time);
                    if ($count_checking_time > 0)
                    {
                        $row_checking_time = mysqli_fetch_array($result_checking_time);

                        $last_alert_time = $row_checking_time['created_at'];
                        $cur_time = date("Y-m-d H:i:s");
                        $to_time = strtotime($cur_time);
                        $from_time = strtotime($last_alert_time);
                        $diff = round(abs($to_time - $from_time) / 60, 2);
                        if ($diff > 60)
                        {
                            $sql3 = "INSERT INTO `attock`.`driving_alerts`
                                (`pos_id`,
                                `type`,
                                `message`,
                                `description`,
                                `status`,
                                `created_at`,
                                `created_by`,
                                `device_id`,
                                `geo_id`,
                                `in_time`)                
                                VALUES ('" . $row['latestPosition_id'] . "',
                                'black Spote In',
                                    '" . $row['car_name'] . " Has gone  to " . $row['geotype'] . " at " . $row['location'] . " and Speed is " . $row['speed'] . " km/hr',
                                    '',
                                    '0',
                                    '" . date("Y-m-d H:i:s") . "','" . $user_row['id'] . "','" . $row['veh_id'] . "','" . $row['geo_id'] . "','" . $row['in_time'] . "')";

                            if ($connection->query($sql3) === true)
                            {
                                echo "New record created successfully";

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'http://151.106.17.246:8080/attock.attock_emailer/alert_emails.php?user_id=' . $user_row['id'] . '&type=black Spote In&message=' . $row['car_name'] . ' Has gone  to ' . $row['geotype'] . ' at ' . $row['location'] . ' and Speed is ' . $row['speed'] . ' km/hr',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'GET',
                                ));

                                $response = curl_exec($curl);

                                curl_close($curl);
                                echo $response;

                            }
                            else
                            {
                                echo "Error: " . $sql3 . "<br>" . $connection->error;
                            }

                        }
                    }
                    else
                    {
                        $sql3 = "INSERT INTO `attock`.`driving_alerts`
                            (`pos_id`,
                            `type`,
                            `message`,
                            `description`,
                            `status`,
                            `created_at`,
                            `created_by`,
                            `device_id`,
                            `geo_id`,
                            `in_time`)                
                            VALUES ('" . $row['latestPosition_id'] . "',
                            'black Spote In',
                                '" . $row['car_name'] . " Has gone  to " . $row['geotype'] . " at " . $row['location'] . " and Speed is " . $row['speed'] . " km/hr',
                                '',
                                '0',
                                '" . date("Y-m-d H:i:s") . "','" . $user_row['id'] . "','" . $row['veh_id'] . "','" . $row['geo_id'] . "','" . $row['in_time'] . "')";

                        if ($connection->query($sql3) === true)
                        {
                            echo "New record created successfully";

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'http://151.106.17.246:8080/attock.attock_emailer/alert_emails.php?user_id=' . $user_row['id'] . '&type=black Spote In&message=' . $row['car_name'] . ' Has gone  to ' . $row['geotype'] . ' at ' . $row['location'] . ' and Speed is ' . $row['speed'] . ' km/hr',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);
                            echo $response;

                        }
                        else
                        {
                            echo "Error: " . $sql3 . "<br>" . $connection->error;
                        }
                    }

                }
                elseif ($geo_type != 'black Spote')
                {
                    $checking_time = "SELECT * FROM attock.driving_alerts where type='Geofence In' and device_id='$veh_id' and created_by='" . $user_row['id'] . "' and created_at>=curdate() order by id desc limit 1;";
                    $result_checking_time = mysqli_query($connect, $checking_time);

                    $count_checking_time = mysqli_num_rows($result_checking_time);
                    if ($count_checking_time > 0)
                    {
                        $row_checking_time = mysqli_fetch_array($result_checking_time);

                        $last_alert_time = $row_checking_time['created_at'];
                        $cur_time = date("Y-m-d H:i:s");
                        $to_time = strtotime($cur_time);
                        $from_time = strtotime($last_alert_time);
                        $diff = round(abs($to_time - $from_time) / 60, 2);
                        if ($diff > 60)
                        {
                            $sql3 = "INSERT INTO `attock`.`driving_alerts`
                      (`pos_id`,
                      `type`,
                      `message`,
                      `description`,
                      `status`,
                      `created_at`,
                      `created_by`,
                      `device_id`,
                      `geo_id`,
                      `in_time`)                
                      VALUES ('" . $row['latestPosition_id'] . "',
                       'Geofence In',
                        '" . $row['car_name'] . " Has gone  to " . $row['geotype'] . " at " . $row['location'] . "',
                        '',
                        '0',
                        '" . date("Y-m-d H:i:s") . "','" . $user_row['id'] . "','" . $row['veh_id'] . "','" . $row['geo_id'] . "','" . $row['in_time'] . "')";

                            if ($connection->query($sql3) === true)
                            {
                                echo "New record created successfully";
                            }
                            else
                            {
                                echo "Error: " . $sql3 . "<br>" . $connection->error;
                            }
                        }
                    }
                    else
                    {
                        $sql3 = "INSERT INTO `attock`.`driving_alerts`
                      (`pos_id`,
                      `type`,
                      `message`,
                      `description`,
                      `status`,
                      `created_at`,
                      `created_by`,
                      `device_id`,
                      `geo_id`,
                      `in_time`)                
                      VALUES ('" . $row['latestPosition_id'] . "',
                       'Geofence In',
                        '" . $row['car_name'] . " Has gone  to " . $row['geotype'] . " at " . $row['location'] . "',
                        '',
                        '0',
                        '" . date("Y-m-d H:i:s") . "','" . $user_row['id'] . "','" . $row['veh_id'] . "','" . $row['geo_id'] . "','" . $row['in_time'] . "')";

                        if ($connection->query($sql3) === true)
                        {
                            echo "New record created successfully";
                        }
                        else
                        {
                            echo "Error: " . $sql3 . "<br>" . $connection->error;
                        }
                    }

                }

            }
        }
    }
    else
    {
        echo "0 results";
    }
}

$sql_a = "SELECT gc.*,g.location,g.type,d.name,g.geotype,d.latestPosition_id FROM attock.geo_check_audit gc join geofenceing g on gc.geo_id = g.id join devices d on d.id = gc.veh_id where out_time >= curdate();";
$result_a = $connection->query($sql_a);
echo $result_a->num_rows . "<br>";

if ($result_a->num_rows > 0)
{
    // output data of each row
    while ($row2 = $result_a->fetch_assoc())
    {

        $sql_v = "SELECT * FROM driving_alerts where device_id =" . $row2["veh_id"] . "   and in_time ='" . $row2["in_time"] . "' and geo_id = '" . $row2["geo_id"] . "'";
        // echo "GEO OUT ".$sql_v."<br>";
        $result_b = $connection->query($sql_v);
        $alert_type = "";
        $geo_type = $row2["geotype"];
        if ($geo_type != 'black Spote')
        {
            $alert_type = 'Geofence Out';
        }
        else
        {
            $alert_type = 'black Spote Out';

        }
        if (mysqli_num_rows($result_b) == 0)
        {
            $sql3 = "INSERT INTO `attock`.`driving_alerts`
                (
                `pos_id`,
                `type`,
                `message`,
                `description`,
                `status`,
                `created_at`,
                `created_by`,
                `device_id`,
                `geo_id`,
                `in_time`)                
                VALUES ('" . $row2['latestPosition_id'] . "',
                 '$alert_type',
                  '" . $row2['name'] . " Has gone Out from " . $row2['type'] . " at " . $row2['location'] . "',
                  '',
                  '0',
                  '" . date("Y-m-d H:i:s") . "','" . $user_row['id'] . "','" . $row2['veh_id'] . "','" . $row2['geo_id'] . "','" . $row2['in_time'] . "')";

            if ($connection->query($sql3) === true)
            {
                echo "New record created successfully";
            }
            else
            {
                echo "Error: " . $sql3 . "<br>" . $connection->error;
            }

        }
    }
}
else
{
    echo "0 results";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta>
    <title>GEO SERVICE</title>
</head>

<body style="background: #fff;">
    <br>
    <?php echo date("d-m-Y H:i:s", time()); ?>
</body>

</html>
