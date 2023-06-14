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

$possql = "SELECT msgid FROM positions order by id desc limit 1";
	$possql_select = mysqli_query( $connection,$possql);
	$data_pos= mysqli_fetch_assoc($possql_select);
	$poslast = $data_pos['msgid'];
//resqstart
$fileman_resq911 = "http://119.160.107.173:3002/message/".$poslast;
// $fileman_resq911 = "http://119.160.107.173:3002/message/2324386351";
$data_resq911 = file_get_contents($fileman_resq911);
$array_resq911 = json_decode($data_resq911,true);
$i = 0;
foreach($array_resq911 as $row_resq911){

	$datetresq = $row_resq911["GpsTime"];
	 $time_server_twsitara = str_replace("T"," ",$datetresq);
	$timefinal = substr($time_server_twsitara, 0, -5);
	
	$datebbresq=date_create($datetresq);
	$datetimeres = date_format($datebbresq,"Y-m-d H:i:s");
	 $ObjectId 					= $row_resq911["ObjectId"];
	 $VectorAngle					= $row_resq911["VectorAngle"];
	 $VectorSpeed 				= $row_resq911["VectorSpeed"];
	 $Altitude 				= $row_resq911["Altitude"];
	 $lat 			= $row_resq911["Y"];
	 $lng 			= $row_resq911["X"];
	 $MessageId 				= $row_resq911['MessageId'];
	
		$sql_insert_dev = mysqli_query($connection,"INSERT INTO  positions 
	(course, latitude, longitude, speed, time, device_id, msgid, objectid)  
	VALUES 
	('$VectorAngle','$lat','$lng','$VectorSpeed','$timefinal','$ObjectId','$MessageId','$ObjectId')") or die(mysqli_error($connection));
	if($sql_insert_dev == True){
		echo $i." New record Inserted ".$lat;
		echo "<br>";
	}

$i++;
}
//resqend


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
 	<meta http-equiv="refresh" content="5">
 	<title>BSL Positions Data</title>
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