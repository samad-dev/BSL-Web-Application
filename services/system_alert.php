<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
ini_set('max_execution_time', -1);
date_default_timezone_set("Asia/Karachi");
ini_set('max_execution_time', -1);
$username = "root";
$password = "";
$database = "bsl";
$connect = mysqli_connect('localhost', $username, $password, $database);
// if (!$connect) {
//     die('Not connected : ' . mysqli_error());
// }

// Set the active MySQL database
$db_selected = mysqli_select_db($connect, $database);
if (!$db_selected) {
    die('Can\'t use db : ' . mysqli_error($connect));
}
if (isset($_GET['accesskey'])) {
    $access_key_received = $_GET['accesskey'];
    // $user = $user_row['id'];
    // SELECT * FROM users where privilege='admin' or privilege='Cartraige'
    $all_users = "SELECT *,us.id as user_id FROM bsl.users as us join bsl.user_alerts_define as uad on uad.user_id=us.id";
    $result_all_users = $connect->query($all_users) or die("Error :" . mysqli_error($connect));

    
    while ($user_row = $result_all_users->fetch_assoc()) {
        echo "-----------------------------".$user_row['name']."-------------------------------------------<br>";

        $user = $user_row['user_id'];
        $user_overspeed = $user_row['overspeed'];
        $user_idle = $user_row['idle'];
        $user_nr = $user_row['nr'];
        $user_night_from = $user_row['night_from'];
        $user_night_to = $user_row['night_to'];
        $access_key = "12345";
        $todate = date("Y-m-d H:i:s", time());
        $prev_date = date("Y-m-d H:i:s", strtotime($todate . ' -1 day'));

        $user_idle_time = date("Y-m-d H:i:s", strtotime($todate . ' -' . $user_idle . ' minutes'));
        $user_nr = date("Y-m-d H:i:s", strtotime($todate . ' -' . $user_nr . ' hour'));

        if ($access_key_received == $access_key) {
            // get all category data from category table
            $que1 = "SELECT count(*) as stop FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed=0 and pos.ignition = '0' and ud.users_id = $user and pos.time >='$prev_date'";
            $que2 = "SELECT count(*) as idle FROM devices as pos join users_devices ud on pos.id = ud.devices_id where pos.speed = 0 and pos.ignition ='1' and ud.users_id = $user and pos.time >='$user_idle_time'";
            $que3 = "SELECT count(*) as inactive FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where  pos.time <='$user_nr'  and ud.users_id = $user";
            $que4 = "SELECT count(*) as running FROM bsl.users_devices as ud 
            join bsl.devices as dc on dc.id=ud.devices_id where  dc.speed>0 and  dc.speed < '$user_overspeed' and dc.time >='$prev_date' and ud.users_id='$user'";
            $que5 = "SELECT COUNT(*) as total FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id  where ud.users_id = $user";
            $que6 = "SELECT count(*) as no_data FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed>='$user_overspeed' and pos.ignition = '1' and ud.users_id = $user and pos.time >='$prev_date'";
            $alert_unseen = "SELECT count(*) as unseen_alert FROM bsl.driving_alerts where is_load!=1 and created_by=$user and status=0";

            $result1 = $connect->query($que1) or die("Error :" . mysqli_error($connect));
            $result2 = $connect->query($que2) or die("Error :" . mysqli_error($connect));
            $result3 = $connect->query($que3) or die("Error :" . mysqli_error($connect));
            $result4 = $connect->query($que4) or die("Error :" . mysqli_error($connect));
            $result5 = $connect->query($que5) or die("Error :" . mysqli_error($connect));
            $result6 = $connect->query($que6) or die("Error :" . mysqli_error($connect));
            $result_alert_unseen = $connect->query($alert_unseen) or die("Error :" . mysqli_error($connect));
            $row1 = mysqli_fetch_array($result1);
            $row2 = mysqli_fetch_array($result2);
            $row3 = mysqli_fetch_array($result3);
            $row4 = mysqli_fetch_array($result4);
            $row5 = mysqli_fetch_array($result5);
            $row6 = mysqli_fetch_array($result6);
            $row_result_alert_unseen = mysqli_fetch_array($result_alert_unseen);

            $stop = $row1[0];
            $idle = $row2[0];
            $inactive = $row3[0];
            $running = $row4[0];
            $total = $row5[0];
            $nodata = $row6[0];
            $unseen = $row_result_alert_unseen[0];

            if ($nodata > 0) {

                $sql_overspeed = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc 
							join users_devices ud on dc.id = ud.devices_id 
							where dc.speed>=$user_overspeed and dc.ignition = '1' and ud.users_id = $user and dc.time >='$prev_date'";

                $result = $connect->query($sql_overspeed) or die("Error :" . mysqli_error($connect));

                $users = array();
                while ($user = $result->fetch_assoc()) {
                    //  echo $user['vehicle_name'].'<br>';
                    $pos_id = $user['pos_id'];
                    $vehicle_name = $user['vehicle_name'];
                    $address = $user['address'];
                    $speed = $user['speed'];
                    $time = $user['time'];
                    $vehicle_id = $user['vehicle_id'];
                    $date = date('Y-m-d H:i:s');
                    $message = "" . $vehicle_name . " has exceeded Overspeed limit " . $speed . " KM/hr on " . $time . " at " . $address . "";
                    $insert_alert = "INSERT INTO `bsl`.`driving_alerts`
					(`pos_id`,
					`type`,
					`message`,
                    `device_id`,
					`created_at`,
					`created_by`)
					VALUES
					('$pos_id',
					'Overspeed',
					'$message',
                    '$vehicle_id',
					'$date',
					'" . $user_row['id'] . "');";
                    mysqli_query($connect, $insert_alert);

                }

                $load_overspeed = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc 
							join users_devices ud on dc.id = ud.devices_id 
							join trip_main as tm on tm.lorry_no = ud.devices_id 
							where dc.speed>=$user_overspeed and dc.ignition = '1' and ud.users_id = '" . $user_row['id'] . "' and dc.time >='$prev_date'";

                $result_o_load = mysqli_query($connect, $load_overspeed);
                //   $active = $row['active'];
                $count_o_load = mysqli_num_rows($result_o_load);
                if ($count_o_load > 0) {
                    while ($user = $result_o_load->fetch_assoc()) {
                        //  echo $user['vehicle_name'].'<br>';
                        $pos_id = $user['pos_id'];
                        $vehicle_name = $user['vehicle_name'];
                        $address = $user['address'];
                        $speed = $user['speed'];
                        $time = $user['time'];
                        $vehicle_id = $user['vehicle_id'];
                        $date = date('Y-m-d H:i:s');
                        $message = "" . $vehicle_name . " has exceeded Overspeed limit " . $speed . " KM/hr on " . $time . " at " . $address . " with Load";
                        $checking_time = "SELECT * FROM driving_alerts where type='Overspeed with Load Vehicle' and device_id='$vehicle_id'  and created_by='" . $user_row['id'] . "' and created_at>=curdate() order by id desc limit 1;";
                        $result_checking_time = mysqli_query($connect, $checking_time);

                        $count_checking_time = mysqli_num_rows($result_checking_time);
                        if ($count_checking_time > 0) {
                            $row_checking_time = mysqli_fetch_array($result_checking_time);

                            $last_alert_time = $row_checking_time['created_at'];
                            $cur_time = date("Y-m-d H:i:s");
                            $to_time = strtotime($cur_time);
                            $from_time = strtotime($last_alert_time);
                            $diff = round(abs($to_time - $from_time) / 60, 2);
                            if ($diff > 60) {
                                $insert_alert = "INSERT INTO `bsl`.`driving_alerts`
									(`pos_id`,
									`type`,
									`is_load`,
									`message`,
									`device_id`,
									`created_at`,
									`created_by`)
									VALUES
									('$pos_id',
									'Overspeed with Load Vehicle',
									'1',
									'$message',
									'$vehicle_id',
									'$date',
									'" . $user_row['id'] . "');";
                                if (mysqli_query($connect, $insert_alert)) {
                                    $alert_msg = $message;



                                }
                            }

                        } else {
                            $insert_alert = "INSERT INTO `bsl`.`driving_alerts`
									(`pos_id`,
									`type`,
									`is_load`,
									`message`,
									`device_id`,
									`created_at`,
									`created_by`)
									VALUES
									('$pos_id',
									'Overspeed with Load Vehicle',
									'1',
									'$message',
									'$vehicle_id',
									'$date',
									'" . $user_row['id'] . "');";
                            if (mysqli_query($connect, $insert_alert)) {
                                $alert_msg = $message;



                            }
                        }

                    }
                }

            }

            if ($idle > 0) {
                $sql_idle = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc 
							join users_devices ud on dc.id = ud.devices_id 
							join trip_main as tm on tm.lorry_no = ud.devices_id where dc.speed=0 and dc.ignition = '1' and ud.users_id = '" . $user_row['id'] . "' and dc.time >='$user_idle_time'";
                $result_idle = $connect->query($sql_idle) or die("Error :" . mysqli_error($connect));
                while ($user = $result_idle->fetch_assoc()) {
                    //  echo $user['vehicle_name'].'<br>';
                    $pos_id = $user['pos_id'];
                    $vehicle_name = $user['vehicle_name'];
                    $address = $user['address'];
                    $speed = $user['speed'];
                    $time = $user['time'];
                    $date = date('Y-m-d H:i:s');
                    $message = "" . $vehicle_name . " become idle on " . $time . " at " . $address . "";
                    $insert_idle = "INSERT INTO `bsl`.`driving_alerts`
            		(`pos_id`,
            		`type`,
            		`message`,
            		`created_at`,
            		`created_by`)
            		VALUES
            		('$pos_id',
            		'Idle',
            		'$message',
            		'$date',
            		'" . $user_row['id'] . "');";
                    mysqli_query($connect, $insert_idle);
                }
                // $back_20m=date("Y-m-d H:i:s", strtotime("-20 minutes"));
                // 	$load_idle = "SELECT (SELECT id FROM positions where device_id=dc.id order by time desc limit 1) as pos_id,
                // (SELECT vehicle_name FROM positions where device_id=dc.id order by time desc limit 1) as vehicle_name ,
                // (SELECT address FROM positions where device_id=dc.id order by time desc limit 1) as address,
                // (SELECT speed FROM positions where device_id=dc.id order by time desc limit 1) as speed,
                // (SELECT time FROM positions where device_id=dc.id order by time desc limit 1) as time
                // FROM `devices` as dc
                // 			join users_devices ud on dc.id = ud.devices_id
                // 			join trip_main as tm on tm.lorry_no = ud.devices_id
                // 			where dc.speed=0 and dc.ignition = '1' and ud.users_id = '".$user_row['id']."' and dc.time >='$back_20m'";
                // $result_o_idle = mysqli_query($connect,$load_idle);
                // //   $active = $row['active'];
                // $count_o_idle= mysqli_num_rows($result_o_idle);
                // if($count_o_idle>0){
                // 	while($user = $result_o_idle->fetch_assoc()) {
                // 		//  echo $user['vehicle_name'].'<br>';
                // 		$pos_id = $user['pos_id'];
                // 		$vehicle_name = $user['vehicle_name'];
                // 		$address = $user['address'];
                // 		$speed = $user['speed'];
                // 		$time = $user['time'];
                // 		$date = date('Y-m-d H:i:s');
                // 		$message = "".$vehicle_name." become idle on ".$time." at ".$address." with Load.";
                // 		$insert_alert = "INSERT INTO `bsl`.`driving_alerts`
                // 		(`pos_id`,
                // 		`type`,
                // 		`message`,
                // 		`created_at`,
                // 		`created_by`)
                // 		VALUES
                // 		('$pos_id',
                // 		'Idle with Load Vehicle',
                // 		'$message',
                // 		'$date',
                // 		'".$user_row['id']."');";
                // 		mysqli_query($connect,$insert_alert);
                // 	}
                // }


            }
            if ($inactive > 0) {
                $sql_inactive = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc join users_devices ud on dc.id = ud.devices_id where dc.time <='$user_nr' and ud.users_id = '" . $user_row['id'] . "'";

                $result_inactive = $connect->query($sql_inactive) or die("Error :" . mysqli_error($connect));

                while ($user = $result_inactive->fetch_assoc()) {
                    //  echo $user['vehicle_name'].'<br>';
                    $pos_id = $user['pos_id'];
                    $vehicle_name = $user['vehicle_name'];
                    $address = $user['address'];
                    $speed = $user['speed'];
                    $time = $user['time'];
                    $vehicle_id = $user['vehicle_id'];
                    $date = date('Y-m-d H:i:s');
                    $message = "" . $vehicle_name . " become NR on " . $time . " at " . $address . "";
                    $insert_inactive = "INSERT INTO `bsl`.`driving_alerts`
					(`pos_id`,
					`type`,
					`message`,
                    `device_id`,
					`created_at`,
					`created_by`)
					VALUES
					('$pos_id',
					'NR',
					'$message',
					'$vehicle_id',
					'$date',
					'" . $user_row['id'] . "');";
                    mysqli_query($connect, $insert_inactive);

                }
                $one_pre = date("Y-m-d H:i:s", strtotime($todate . ' -1 hour'));

                $sql_one_hour_back = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc join users_devices ud on dc.id = ud.devices_id 
				join trip_main as tm on tm.lorry_no=ud.devices_id where ud.users_id='" . $user_row['id'] . "' group by tm.lorry_no having time<='$one_pre'";

                $result_one_hour_back = $connect->query($sql_one_hour_back) or die("Error :" . mysqli_error($connect));

                while ($user = $result_one_hour_back->fetch_assoc()) {
                    //  echo $user['vehicle_name'].'<br>';
                    $pos_id = $user['pos_id'];
                    $vehicle_name = $user['vehicle_name'];
                    $address = $user['address'];
                    $speed = $user['speed'];
                    $time = $user['time'];
                    $vehicle_id = $user['vehicle_id'];
                    $date = date('Y-m-d H:i:s');
                    $message = "" . $vehicle_name . " become NR With Load on " . $time . " at " . $address . "";
                    $insert_one_inactive = "INSERT INTO `bsl`.`driving_alerts`
					(`pos_id`,
					`type`,
					`message`,
					`device_id`,
					`is_load`,
					`created_at`,
					`created_by`)
					VALUES
					('$pos_id',
					'NR With Load',
					'$message',
					'$vehicle_id',
					'1',
					'$date',
					'" . $user_row['id'] . "');";
                    if (mysqli_query($connect, $insert_one_inactive)) {
                        $alert_msg = $message;

                    }

                }

                $load_nr = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc 
							join users_devices ud on dc.id = ud.devices_id 
							join trip_main as tm on tm.lorry_no = ud.devices_id 
							where dc.time <='$user_nr' and ud.users_id = '" . $user_row['id'] . "'";

                $result_o_nr = mysqli_query($connect, $load_nr);
                //   $active = $row['active'];
                $count_o_nr = mysqli_num_rows($result_o_nr);
                if ($count_o_nr > 0) {
                    while ($user = $result_o_nr->fetch_assoc()) {
                        //  echo $user['vehicle_name'].'<br>';
                        $pos_id = $user['pos_id'];
                        $vehicle_name = $user['vehicle_name'];
                        $address = $user['address'];
                        $speed = $user['speed'];
                        $time = $user['time'];
                        $date = date('Y-m-d H:i:s');
                        $vehicle_id = $user['vehicle_id'];

                        $message = "" . $vehicle_name . " become NR on " . $time . " at " . $address . " with Load";

                        $insert_alert = "INSERT INTO `bsl`.`driving_alerts`
						(`pos_id`,
						`type`,
						`is_load`,
						`message`,
						`device_id`,
						`created_at`,
						`created_by`)
						VALUES
						('$pos_id',
						'NR with Load Vehicle',
						'1',
						'$message',
						'$vehicle_id',
						'$date',
						'" . $user_row['id'] . "');";
                        mysqli_query($connect, $insert_alert);

                    }
                }

            }

            $current_time = date('d M Y H:i:s');
            $current_hour = date('H', strtotime($current_time));
            $current_hour_from = date('H', strtotime($user_night_from));
            $current_hour_to = date('H', strtotime($user_night_to));

            if ($current_hour >= $current_hour_from && $current_hour <= $current_hour_to) {

                $night_time = date('Y-m-d');
                $nigth_voilation = "SELECT dc.latestPosition_id as pos_id,dc.name as vehicle_name,dc.location as address,dc.speed,dc.time,dc.id as vehicle_id
				FROM `devices` as dc 
				join users_devices ud on dc.id = ud.devices_id 
				where dc.speed>0 and dc.ignition = '1' and dc.time>'" . $night_time . " " . $user_night_from . ":00' and dc.time<'" . $night_time . " " . $user_night_to . ":00' and ud.users_id = '" . $user_row['id'] . "';";

                $result_nigth_voilation = mysqli_query($connect, $nigth_voilation);
                //   $active = $row['active'];
                $count_nigth_voilation = mysqli_num_rows($result_nigth_voilation);
                if ($count_nigth_voilation > 0) {
                    while ($user_night = $result_nigth_voilation->fetch_assoc()) {
                        //  echo $user['vehicle_name'].'<br>';
                        if ($user_night['pos_id'] != null) {
                            $pos_id = $user_night['pos_id'];
                            $vehicle_name = $user_night['vehicle_name'];
                            $address = $user_night['address'];
                            $speed = $user_night['speed'];
                            $time = $user_night['time'];
                            $vehicle_id = $user_night['vehicle_id'];
                            $date = date('Y-m-d H:i:s');
                            $message = "" . $vehicle_name . " Violate Night time violations ";
                            $checking_time = "SELECT * FROM driving_alerts where type='Night time violations' and device_id='$vehicle_id' and created_by='" . $user_row['id'] . "' and created_at>=curdate() order by id desc limit 1;";
                            $result_checking_time = mysqli_query($connect, $checking_time);

                            $count_checking_time = mysqli_num_rows($result_checking_time);

                            if ($count_checking_time > 0) {
                                $row_checking_time = mysqli_fetch_array($result_checking_time);

                                $last_alert_time = $row_checking_time['created_at'];
                                $cur_time = date("Y-m-d H:i:s");
                                $to_time = strtotime($cur_time);
                                $from_time = strtotime($last_alert_time);
                                $diff = round(abs($to_time - $from_time) / 60, 2);
                                if ($diff > 180) {
                                    $insert_alert = "INSERT INTO `bsl`.`driving_alerts`
									(`pos_id`,
									`type`,
									`message`,
									`device_id`,
									`created_at`,
									`created_by`)
									VALUES
									('$pos_id',
									'Night time violations',
									'$message',
									'$vehicle_id',
									'$date',
									'" . $user_row['id'] . "');";
                                    if (mysqli_query($connect, $insert_alert)) {
                                        $alert_msg = $message;

                                    }

                                }

                            } else {
                                $insert_alert = "INSERT INTO `bsl`.`driving_alerts`
									(`pos_id`,
									`type`,
									`message`,
									`device_id`,
									`created_at`,
									`created_by`)
									VALUES
									('$pos_id',
									'Night time violations',
									'$message',
									'$vehicle_id',
									'$date',
									'" . $user_row['id'] . "');";
                                if (mysqli_query($connect, $insert_alert)) {
                                    $alert_msg = $message;

                                }
                            }

                        }

                    }
                }
            }

            $sql_rtd = "SELECT dc.latestPosition_id as pos_id,ck.* FROM trip_main as tm 
			join devices as dc on dc.id=tm.lorry_no
            join users_devices ud on dc.id = ud.devices_id 
							join geo_in_check as ck on ck.veh_id=tm.lorry_no where HOUR(TIMEDIFF(NOW(), ck.in_time))>2 and in_time>=curdate() and ud.users_id='" . $user_row['id'] . "'";

            $result_rtd = $connect->query($sql_rtd) or die("Error :" . mysqli_error($connect));

            while ($user = $result_rtd->fetch_assoc()) {
                //  echo $user['vehicle_name'].'<br>';
                $pos_id = $user['pos_id'];
                $vehicle_name = $user['car_name'];
                $address = $user['location'];
                $time = $user['in_time'];
                $veh_id = $user['veh_id'];
                $date = date('Y-m-d H:i:s');
                $message = "" . $vehicle_name . " enter in Fence " . $address . " on " . $time . " with Load";

                $checking_time = "SELECT * FROM driving_alerts where type='RTD' and device_id='$veh_id'  and created_by='" . $user_row['id'] . "' and created_at>=curdate() order by id desc limit 1;";
                //  echo $checking_time .'<br>';
                $result_checking_time = mysqli_query($connect, $checking_time);

                $count_checking_time = mysqli_num_rows($result_checking_time);
                if ($count_checking_time > 0) {
                    $row_checking_time = mysqli_fetch_array($result_checking_time);

                    $last_alert_time = $row_checking_time['created_at'];
                    $cur_time = date("Y-m-d H:i:s");
                    $to_time = strtotime($cur_time);
                    $from_time = strtotime($last_alert_time);
                    $diff = round(abs($to_time - $from_time) / 60, 2);
                    //    echo $diff . '<br>';
                    if ($diff > 60) {
                        $insert_rtd = "INSERT INTO `bsl`.`driving_alerts`
								(`pos_id`,
								`type`,
								`is_load`,
								`message`,
								`device_id`,
								`created_at`,
								`created_by`)
								VALUES
								('$pos_id',
								'RTD',
								'1',
								'$message',
								'$veh_id',
								'$date',
								'" . $user_row['id'] . "');";
                        if (mysqli_query($connect, $insert_rtd)) {
                            $alert_msg = $message;



                        }
                    }
                } else {
                    $insert_rtd = "INSERT INTO `bsl`.`driving_alerts`
							(`pos_id`,
							`type`,
							`is_load`,
							`message`,
							`device_id`,
							`created_at`,
							`created_by`)
							VALUES
							('$pos_id',
							'RTD',
							'1',
							'$message',
							'$veh_id',
							'$date',
							'" . $user_row['id'] . "');";
                    mysqli_query($connect, $insert_rtd);
                }

            }

            $sql_black = "SELECT ck.*, HOUR(TIMEDIFF(NOW(), ck.in_time)) as h2 FROM geo_in_check as ck
            join users_devices as ud on ud.devices_id=ck.veh_id 
            join geofence_type as gt on gt.id=ck.geotype 
            where HOUR(TIMEDIFF(NOW(), ck.in_time))>=1 and gt.type='Black spote' and ud.users_id='" . $user_row['id'] . "'";

            $result_black = $connect->query($sql_black) or die("Error :" . mysqli_error($connect));

            while ($user = $result_black->fetch_assoc()) {
                //  echo $user['vehicle_name'].'<br>';
                $pos_id = $user['latestPosition_id'];
                $vehicle_name = $user['car_name'];
                $address = $user['location'];
                $time = $user['in_time'];
                $veh_id = $user['veh_id'];
                $geo_id = $user['geo_id'];
                $date = date('Y-m-d H:i:s');
                $message = "" . $vehicle_name . " enter in Un-Authorized Stop " . $address . " on " . $time . " with Load";

                $checking_time = "SELECT * FROM driving_alerts where type='Un-Authorized Stop' and device_id='$veh_id' and geo_id='$geo_id' and in_time='$time'  and created_by='" . $user_row['id'] . "' and created_at>=curdate() order by id desc limit 1;";
                //  echo $checking_time .'<br>';
                $result_checking_time = mysqli_query($connect, $checking_time);

                $count_checking_time = mysqli_num_rows($result_checking_time);
                if ($count_checking_time > 0) {
                    $row_checking_time = mysqli_fetch_array($result_checking_time);

                    $last_alert_time = $row_checking_time['created_at'];
                    $cur_time = date("Y-m-d H:i:s");
                    $to_time = strtotime($cur_time);
                    $from_time = strtotime($last_alert_time);
                    $diff = round(abs($to_time - $from_time) / 60, 2);
                    //    echo $diff . '<br>';
                    if ($diff > 60) {
                        $insert_black = "INSERT INTO `bsl`.`driving_alerts`
								(`pos_id`,
								`type`,
								`is_load`,
								`message`,
								`device_id`,
								`geo_id`,
								`in_time`,
								`created_at`,
								`created_by`)
								VALUES
								('$pos_id',
								'Un-Authorized Stop',
								'1',
								'$message',
								'$veh_id',
								'$geo_id',
								'$time',
								'$date',
								'" . $user_row['id'] . "');";
                        if (mysqli_query($connect, $insert_black)) {
                            $alert_msg = $message;



                        }
                    }
                } else {
                    $insert_black = "INSERT INTO `bsl`.`driving_alerts`
                    (`pos_id`,
                    `type`,
                    `is_load`,
                    `message`,
                    `device_id`,
                    `geo_id`,
                    `in_time`,
                    `created_at`,
                    `created_by`)
                    VALUES
                    ('$pos_id',
                    'Un-Authorized Stop',
                    '1',
                    '$message',
                    '$veh_id',
                    '$geo_id',
                    '$time',
                    '$date',
                    '" . $user_row['id'] . "');";
                    mysqli_query($connect, $insert_black);
                }

            }

            $post_data = array(
                'stop' => $stop,
                'idle' => $idle,
                'inactive' => $inactive,
                'running' => $running,
                'total' => $total,
                'nodata' => $nodata,
                'unseen' => $unseen
            );
            // $users = array();
            // while ($user = $result->fetch_assoc()) {
            // 	$users[] = $user;
            // }
            // create json output
            $post_data = json_encode($post_data);
        } else {
            die('accesskey is incorrect.');
        }
    }

} else {
    die('accesskey is required.');
}

//Output the output.
echo $post_data;

// include_once('../includes/close_database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="30">
    <title>System Alert SERVICE</title>
</head>

<body style="background: #fff;">
    <br>
    <?php echo date("d-m-Y H:i:s", time()); ?>
</body>

</html>