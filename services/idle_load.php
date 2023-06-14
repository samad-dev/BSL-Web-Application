<?php
date_default_timezone_set("Asia/Karachi");
	ini_set('max_execution_time', -1);
	$username="root";
	$password="";
	$database="bsl";

	// Opens a connection to a MySQL server
	$connection=mysqli_connect('localhost', $username, $password,$database);
	if (!$connection)
	{
	  die('Not connected : ' . mysqli_error());
	}

	// Set the active MySQL database
	$db_selected = mysqli_select_db( $connection,$database);
	if (!$db_selected)
	{
	  die ('Can\'t use db : ' . mysqli_error());
	}

    //$sql_query = "SELECT ts.*,d.name,d.trackername,d.lat,d.lng,d.ignition,d.lasttime FROM trip_sub ts  join devices d on d.id = ts.vehicle_id where ts.status = 0;";
    $all_users = "SELECT * FROM bsl.users as us join bsl.user_alerts_define as uad on uad.user_id=us.id";
    $result_all_users = $connection->query($all_users) or die("Error :" . mysqli_error());

    while ($user_row = $result_all_users->fetch_assoc())
    {

        $user = $user_row['id'];
        $user_idle = $user_row['idle'];
        $user_idle_time=date("Y-m-d H:i:s", strtotime($todate .' -'.$user_idle.' minutes'));

        $sql = "SELECT ts.*,d.name,d.trackername,d.lat,d.lng,d.ignition,d.lasttime,d.location,uds.devices_id FROM trip_sub ts  
        join trip_main tm on tm.id = ts.main_id 
        join devices d on d.id = tm.lorry_no 
        join users_devices as uds on uds.devices_id=tm.lorry_no where uds.users_id='$user'
        group by tm.lorry_no having ts.status = 0";
        $result = $connection->query($sql);
    
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $sql2 = "SELECT * FROM positions where device_id =" . $row["id"]. "  and time >=date_sub('" . $row["lasttime"]. " ',interval 20 minute) limit 1;";
            $result2 = $connection->query($sql2);
            while($row2 = $result2->fetch_assoc()) {
            
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. "-" . $row["lat"].  "," . $row["lng"]."-Position:" . $row2["latitude"].  "," . $row2["longitude"]. " - Time: " . $row["lasttime"]. "-" . $row2["time"].  "<br>";
                $distance  = distance($row["lat"],$row2["latitude"], $row["lng"], $row2["longitude"],'K');
                echo $distance;
                echo "<br>";
                if($distance < 0.5)
                {
                    $sql3 = "INSERT INTO `attock`.`driving_alerts`
                    (
                    `pos_id`,
                    `type`,
                    `is_load`,
                    `message`,
                    `description`,
                    `status`,
                    `created_at`,
                    `created_by`)                
                    VALUES ('".$row2['id']."',
                     'Idle on Load',
                     '1',
                      '".$row['name']." Has become Idle with Load at ".$row['location']."',
                      '',
                      '0',
                      '".date("Y-m-d H:i:s")."','" . $user_row['id'] . "')";
    
                    if ($connection->query($sql3) === TRUE) {
                    echo "New record created successfully";
                    $alert_msg = $row['name']." Has become Idle with Load at ".$row['location'];
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://151.106.17.246:8080/attock_emailer/alert_emails.php?user_id='. $user_row['id'] .'&type='.urlencode('Idle on Load').'&message='.urlencode($alert_msg),
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
                    } else {
                    echo "Error: " . $sql3 . "<br>" . $connection->error;
                    }
                }
            }
        }
        } else {
        echo "0 results";
        }
    }



    function distance($lat1, $lat2,$lon1,  $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
      
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
      }




?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="30">
    <title>Idle Load</title>
</head>

<body style="background: #fff;">
    <br>
    <?php echo date("d-m-Y H:i:s", time()); ?>
</body>

</html>