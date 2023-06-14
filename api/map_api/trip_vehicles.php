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
		$user = $_GET['user'];
		// $offset = $_GET['offset'];
		$access_key = "12345";
		
		if($access_key_received == $access_key){
			// get all category data from category table
			 $sql_query = "SELECT dc.* FROM bsl.trip_sub as ts 
            join bsl.trip_main as tm on tm.id=ts.main_id 
            join bsl.devices  as dc on dc.id=tm.lorry_no where ts.status=0 and tm.user_id = $user group by ts.main_id order by dc.time desc;";
			
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