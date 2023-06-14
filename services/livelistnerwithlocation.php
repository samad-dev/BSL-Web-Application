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

function clean($string) {
   $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
}


//resqstart
$fileman_resq911 = "http://119.160.107.173:3002/latest";
$data_resq911 = file_get_contents($fileman_resq911);
$array_resq911 = json_decode($data_resq911,true);

foreach($array_resq911 as $row_resq911){

	$datetresq = $row_resq911["GpsTime"];
	 $time_server_twsitara = str_replace("T"," ",$datetresq);
	$timefinal = substr($time_server_twsitara, 0, -5);
	
	$datebbresq=date_create($datetresq);
	$datetimeres = date_format($datebbresq,"Y-m-d H:i:s");
	 $ObjectId 					= $row_resq911["ObjectId"];
	 $Number 					= $row_resq911["Number"];
	 $VectorAngle					= $row_resq911["VectorAngle"];
	 $VectorSpeed 				= $row_resq911["VectorSpeed"];
	 $Altitude 				= $row_resq911["Altitude"];
	 $lat 			= $row_resq911["Y"];
	 $lng 			= $row_resq911["X"];
	 $MessageId 				= $row_resq911['MessageId'];
	$sql = "SELECT * FROM devices WHERE id = '$ObjectId'";
	$sql_select = mysqli_query( $connection,$sql);
	$data_Select= mysqli_fetch_assoc($sql_select);
	$dbname = $data_Select['name'];
	$fileman_location = "http://119.160.107.173:3002/location_name/$lat/$lng";
$data_location = file_get_contents($fileman_location);
$array_location = json_decode($data_location,true);

foreach($array_location as $row_location){
$location = $row_location["location"];
}
	mysqli_error($connection);
	if($VectorSpeed >'0'){
			$ignition ='1';
		}else{
			$ignition ='0';
		}
	if(mysqli_num_rows($sql_select) > 0){
		if($Number == $dbname){
			
			$update_devices = "UPDATE devices SET time = '$timefinal', lat = '$lat' , lng = '$lng', angle = '$VectorAngle' , ignition = '$ignition', speed ='$VectorSpeed' , odometer = '' , lasttime = '$timefinal', latestPosition_id = '$MessageId', location ='$location'  where id ='$ObjectId'";
			$exe_Selectnew = mysqli_query( $connection,$update_devices);
			echo mysqli_error($connection);
			if($exe_Selectnew == True){
		echo "Vehicle Updated ".$Number." ".$lat ;
		echo "<br>";
	}else{
		
	}
		}else{
			$update_devices = "UPDATE devices SET name = '$Number', time = '$timefinal', lat = '$lat' , lng = '$lng', angle = '$VectorAngle' , ignition = '$ignition', speed ='$VectorSpeed' , odometer = '' , lasttime = '$timefinal', latestPosition_id='$MessageId', location = '$location'  where id ='$ObjectId'";
			$exe_Selectnew = mysqli_query( $connection,$update_devices);
			echo mysqli_error($connection);
			if($exe_Selectnew == True){
		echo "Vehicle Updated with ".$Number." - ".$lat;
		echo "<br>";
	}else{
		
	}
		}
		
		
	
	}else{
		$sql_insert_dev = mysqli_query($connection,"INSERT INTO  devices 
	(id,time, lat, lng, angle, ignition, speed, odometer, lasttime, latestPosition_id, name, location)  
	VALUES 
	('$ObjectId','$timefinal','$lat','$lng','$VectorAngle','$ignition','$VectorSpeed','','$timefinal','$MessageId','$Number', '$location')") or die(mysqli_error($connection));
	if($sql_insert_dev == True){
		echo "New vehicle Inserted";
		echo "<br>";
		$sql_user_one = mysqli_query($connection,"INSERT INTO  users_devices (users_id, devices_id, subacc_id, show_authority)   
			VALUES ('1' , '$ObjectId' , '0' , '1')") or die(mysqli_error($connection));
	}else{
		
	}
	}



}



?>





     <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $i;?>%">
    <span class="sr-only"> <?php  ?></span>
  </div>
</div>
</div>
<?php
	
mysqli_close($connection);
?>
 <!DOCTYPE html>
 <html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta http-equiv="refresh" content="20">
 	<title>BSL Live  Data</title>
	<style>
	.progress {
    height: 3px !important;
    margin-bottom: 1px !important;
}
	</style>
 </head>
 <body style="background: #fff;">
 <div class="col-md-8">

<div class="col-md-12">
 	<br>
 	<?php echo "Successfully done"."<br>"; echo date("d-m-Y H:i:s", time()); ?>
	</div>
 </body>
 </html>