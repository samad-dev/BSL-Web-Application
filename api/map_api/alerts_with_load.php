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
	if(isset($_GET['accesskey'])) {
		$access_key_received = $_GET['accesskey'];
		$user = $_GET['user'];
		$access_key = "12345";
		if($access_key_received == $access_key){
			// get all category data from category table
			// $sql_query = "SELECT da.*,pos.address,pos.vehicle_name,pos.speed,pos.latitude,pos.longitude,pos.time FROM bsl.driving_alerts  as da join bsl.positions as pos on pos.id=da.pos_id where da.created_at>=curdate() and da.status=0 and da.created_by=$user order by da.id desc;";
			$sql_query="SELECT * FROM bsl.driving_alerts where status = 0 and is_load=1 order by id desc limit 50 ";
			
			$result = $connect->query($sql_query) or die ("Error :".mysqli_error());
	 
			$users_arr = array();
			while($user_data = $result->fetch_assoc()) {
				$users_arr[] = $user_data;
			}
			
			// create json output
			$output = json_encode($users_arr);
			$update_query = "UPDATE `driving_alerts`
            SET
            `status` = '1'
            WHERE `status` = '0' and is_load=1";

            mysqli_query($connect,$update_query);

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