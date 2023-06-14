<?php
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 20; URL=$url1");
// error_reporting(0);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bsl');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
echo "<h1>Fence Check IN service .</h1><br>";

$vehicle_name;
$sql_user = "SELECT * FROM users";
$result_sql_user = mysqli_query($db, $sql_user);
$count_sql_user = mysqli_num_rows($result_sql_user);

if ($count_sql_user > 0)
{
    while ($row_user = mysqli_fetch_array($result_sql_user))
    {
        // $userid = $row['id'];
        $user_id = $row_user['id'];
        $username = $row_user['name'];
        echo $username;
        echo '<br> ------------------------------------------------------------------------------------------- <br>';

        // $sql = "SELECT * FROM bsl.geo_in_check as ck 
        //             join vehicle_geofence as vg on vg.geo_id=ck.geo_id
        //             join users_devices as ud on ud.devices_id=ck.veh_id
        //             where ck.speed>=vg.speed_limit and ud.users_id='$user_id';";
                    $sql = "SELECT * FROM bsl.vehicle_geofence as vg 
                    join users_devices as ud on ud.devices_id=vg.vehicle_id 
                    join geo_in_check as ck on ck.geo_id=vg.geo_id AND ck.veh_id=vg.vehicle_id
                    where ud.users_id='$user_id' and  ck.speed>=vg.speed_limit";
        $result = mysqli_query($db, $sql);
        $count = mysqli_num_rows($result);
        // echo $count;
        if ($count > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                // $userid = $row['id'];
                $latitude = $row['latitude'];
                $longitude = $row['longitude'];
                $car_name = $row['car_name'];
                $device_id = $row['vehicle_id'];
                $veh_id = $row['veh_id'];
                $geo_id = $row['geo_id'];
                $running_speed = $row['speed'];
                $speed_limit = $row['speed_limit'];
                $in_time = $row['in_time'];
                $latestPosition_id = $row['latestPosition_id'];
                $consignee_name = $row['consignee_name'];
                $reporting_time = $row['reporting_time'];

                echo '<br/>';
                echo 'car name = ' . $car_name . ' id = ' . $geo_id;
                echo '<br/>';
                // echo 'Lat Lng => ' .$v_lat. ' ' .$v_lng ;
                // echo '<br/>';
                // echo '---------------------------------------------------';
                // echo '<br/>';
                // get_geo($v_lat, $v_lng, $v_num,$v_id);
                insert($veh_id, $geo_id, $in_time, $latitude, $longitude, $running_speed, $speed_limit, $latestPosition_id, $user_id, $car_name, $consignee_name, $reporting_time);

            }

        }
        else
        {
            echo '<h1>No Records Found to send Msg</h1>';
        }
    }
}

function insert($veh_id, $geo_id, $in_time, $latitude, $longitude, $running_speed, $speed_limit, $latestPosition_id, $user_id, $car_name, $consignee_name, $reporting_time)
{
    $date = date('Y-m-d H:i:s');

    $dbss = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    echo $car_name . ' ' .$consignee_name.'<br>';
    $checking_time = "SELECT * FROM driving_alerts where type='Violate Speed Limit' and device_id='$veh_id' and geo_id='$geo_id'  and created_by='$user_id' and created_at>=curdate() order by id desc limit 1;";
    //  echo $checking_time .'<br>';
    $result_checking_time = mysqli_query($dbss, $checking_time);

    $count_checking_time = mysqli_num_rows($result_checking_time);
    if ($count_checking_time > 0)
    {
        $row_checking_time = mysqli_fetch_array($result_checking_time);

        $last_alert_time = $row_checking_time['created_at'];
        $cur_time = date("Y-m-d H:i:s");
        $to_time = strtotime($cur_time);
        $from_time = strtotime($last_alert_time);
        $diff = round(abs($to_time - $from_time) / 60, 2);
        //    echo $diff . '<br>';
        if ($diff > 60)
        {
            $message = "" . $car_name . " enter in Fence " . $consignee_name . ". Fence Speed Limit is " . $speed_limit . " and Running on Speed " . $running_speed . " Km/Hr on " . $reporting_time . " with Load";
            $insert_rtd = "INSERT INTO `bsl`.`driving_alerts`
								(`pos_id`,
								`type`,
								`is_load`,
								`geo_id`,
                                `message`,
								`device_id`,
								`created_at`,
								`created_by`,
                                `v_lat`,
                                `v_lng`,
                                `v_name`,
                                `v_time`,
                                `v_speed`,
                                `allow_speed`)
								VALUES
								('$latestPosition_id',
								'Violate Speed Limit',
								'1',
								'$geo_id',
								'$message',
								'$veh_id',
								'$date',
								'$user_id',
								'$latitude',
								'$longitude',
								'$car_name',
								'$reporting_time',
								'$running_speed',
								'$speed_limit');";
            if (mysqli_query($dbss, $insert_rtd))
            {
                $alert_msg = $message;

            }
            else{
                echo 'already Insert <br>';
            }
        }
    }
    else
    {
        $message = "" . $car_name . " enter in Fence " . $consignee_name . ". Fence Speed Limit is " . $speed_limit . " and Running on Speed " . $running_speed . " Km/Hr on " . $reporting_time . " with Load";

        $insert_rtd = "INSERT INTO `bsl`.`driving_alerts`
        (`pos_id`,
        `type`,
        `is_load`,
        `geo_id`,
        `message`,
        `device_id`,
        `created_at`,
        `created_by`,
        `v_lat`,
        `v_lng`,
        `v_name`,
        `v_time`,
        `v_speed`,
        `allow_speed`)
        VALUES
        ('$latestPosition_id',
        'Violate Speed Limit',
        '1',
        '$geo_id',
        '$message',
        '$veh_id',
        '$date',
        '$user_id',
        '$latitude',
        '$longitude',
        '$car_name',
        '$reporting_time',
        '$running_speed',
        '$speed_limit');";
        mysqli_query($dbss, $insert_rtd);
    }

}
echo date('Y-m-d H:i:s');  

?>
