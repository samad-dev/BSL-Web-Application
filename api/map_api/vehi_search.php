<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
ini_set('max_execution_time', -1);
	date_default_timezone_set("Asia/Karachi");
	$username="root";
	$password="";
	$database="bsl";
	$connect=mysqli_connect('localhost', $username, $password,$database);
	if (!$connect)
	{
	  die('Not connected : ' . mysqli_error());
	}

	// Set the active MySQL database
	$db_selected = mysqli_select_db( $connect,$database);
	if (!$db_selected)
	{
	  die ('Can\'t use db : ' . mysqli_error());
	}
	// include_once('../includes/connect_database.php'); 
	// include_once('../includes/variables.php');
	if(isset($_GET['accesskey'])) {
		$access_key_received = $_GET['accesskey'];
		$str = $_GET['str'];
		$sel = $_GET['sel'];
		$user = $_GET['user'];
		$access_key = "12345";
		include("user_values.php");
		if($access_key_received == $access_key){
			// get all category data from category table
			if($sel == 1)
			{
				$sql_query = "SELECT * FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed=0 and pos.ignition = '0' and ud.users_id = $user and pos.time >=curdate() and  name like '%$str%'  order by time desc limit 50 ;";
			}
			if($sel == 2)
			{
				$sql_query = "SELECT * FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed > 0 and pos.speed < '$user_overspeed' and ud.users_id = $user and pos.ignition ='1' and pos.time >=curdate()  and  name like '%$str%'  order by time desc limit 50 ;";
			}
			if($sel == 3)
			{
				$sql_query = "SELECT * FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed = 0 and pos.ignition ='1' and ud.users_id = $user and pos.time >='$user_idle_time' and name like '%$str%' order by time desc limit 50 ;";
			}
			if($sel == 4)
			{
				$sql_query = "SELECT * FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where  pos.time <='$user_nr'  and ud.users_id = $user  and name like '%$str%' order by time desc limit 50 ;";
			}
			if($sel == 5)
			{
				$sql_query = "SELECT * FROM `devices` as pos join users_devices ud on pos.id = ud.devices_id where pos.speed>='$user_overspeed' and pos.ignition = '1' and ud.users_id = $user and pos.time >=CURDATE() and name like '%$str%' limit 50 ;";
			}
			if($sel == 6)
			{
				$sql_query = "SELECT * FROM devices as pos join users_devices ud on pos.id = ud.devices_id  where ud.users_id = $user and name like '%$str%' limit 50 ;";
			}
			
			
			$result = $connect->query($sql_query) or die ("Error :".mysqli_error());
	 
			$users = array();
			while($user = $result->fetch_assoc()) {
				$users[] = $user;
			}
			
			// create json output
			$output = json_encode($users);
		}else{
			die('accesskey is incorrect.');
		}
	} else {
		die('accesskey is required.');
	}
 
	//Output the output.
	echo $output;

	// include_once('../includes/close_database.php'); 
?>