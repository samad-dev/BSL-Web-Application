<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
ini_set('max_execution_time', -1);
date_default_timezone_set("Asia/Karachi");
$username = "root";
$password="";
$database = "bsl";
$connect = mysqli_connect('localhost', $username, $password, $database);
if (!$connect) {
	die('Not connected : ' . mysqli_error());
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connect, $database);
if (!$db_selected) {
	die('Can\'t use db : ' . mysqli_error());
}
if (isset($_GET['accesskey'])) {
	$access_key_received = $_GET['accesskey'];
	$user = $_GET['user'];
	$access_key = "12345";
	$todate=date("Y-m-d H:i:s", time());
    $prev_date=date("Y-m-d H:i:s", strtotime($todate .' -1 day'));
	if ($access_key_received == $access_key) {
		// get all category data from category table

		include("user_values.php");

		$que1 = "SELECT count(*) as stop FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed=0 and pos.ignition = '0' and ud.users_id = $user and pos.time >='$prev_date'";
		$que2 = "SELECT count(*) as idle FROM devices as pos join users_devices ud on pos.id = ud.devices_id where pos.speed = 0 and pos.ignition ='1' and ud.users_id = $user and pos.time >='$user_idle_time'";
		$que3 = "SELECT count(*) as inactive FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where  pos.time <='$user_nr'  and ud.users_id = $user";
		$que4 = "SELECT count(*) as running FROM bsl.users_devices as ud 
		join bsl.devices as dc on dc.id=ud.devices_id where  dc.speed>0 and  dc.speed < '$user_overspeed' and dc.time >='$prev_date' and ud.users_id='$user'";
		$que5 = "SELECT COUNT(*) as total FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id  where ud.users_id = $user";
		$que6 = "SELECT count(*) as no_data FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed>='$user_overspeed' and pos.ignition = '1' and ud.users_id = $user and pos.time >='$prev_date'";
		$alert_unseen = "SELECT count(*) as unseen_alert FROM bsl.driving_alerts where is_load!=1 and created_by=$user and status=0";
		$alert_unseen_load = "SELECT count(*) as unseen_alert FROM bsl.driving_alerts where is_load=1 and created_by=$user and status=0";
		// $trip_count = "SELECT dc.* FROM bsl.trip_sub as ts 
		// join bsl.trip_main as tm on tm.id=ts.main_id 
		// join bsl.devices  as dc on dc.id=tm.lorry_no where ts.status=0  and tm.user_id = $user group by ts.main_id order by dc.time desc";

		// $result_trip_count = mysqli_query($connect,$trip_count);
		// $row_trip_count = mysqli_fetch_array($result_trip_count,MYSQLI_ASSOC);
		//   $active = $row['active'];

		// $count_trip_count = mysqli_num_rows($result_trip_count);

		$result1 = $connect->query($que1) or die("Error :" . mysqli_error());
		$result2 = $connect->query($que2) or die("Error :" . mysqli_error());
		$result3 = $connect->query($que3) or die("Error :" . mysqli_error());
		$result4 = $connect->query($que4) or die("Error :" . mysqli_error());
		$result5 = $connect->query($que5) or die("Error :" . mysqli_error());
		$result6 = $connect->query($que6) or die("Error :" . mysqli_error());
		$result_alert_unseen = $connect->query($alert_unseen) or die("Error :" . mysqli_error());
		$result_alert_unseen_load = $connect->query($alert_unseen_load) or die("Error :" . mysqli_error());
		$row1 = mysqli_fetch_array($result1);
		$row2 = mysqli_fetch_array($result2);
		$row3 = mysqli_fetch_array($result3);
		$row4 = mysqli_fetch_array($result4);
		$row5 = mysqli_fetch_array($result5);
		$row6 = mysqli_fetch_array($result6);
		$row_result_alert_unseen = mysqli_fetch_array($result_alert_unseen);
		$row_result_alert_unseen_load = mysqli_fetch_array($result_alert_unseen_load);

		$stop = $row1[0];
		$idle = $row2[0];
		$inactive = $row3[0];
		$running = $row4[0];
		$total = $row5[0];
		$nodata = $row6[0];
		$unseen = $row_result_alert_unseen[0];
		$unseen_load = $row_result_alert_unseen_load[0];

		


		$post_data = array('stop' => $stop,
						'idle' => $idle,
						'inactive' => $inactive,
						'running' => $running,
						'total' => $total,
						'nodata' => $nodata,
						'unseen' => $unseen,
						'unseen_load' => $unseen_load,
						// 'trip_vehi' => $count_trip_count
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
} else {
	die('accesskey is required.');
}

//Output the output.
echo $post_data;

// include_once('../includes/close_database.php');
?>