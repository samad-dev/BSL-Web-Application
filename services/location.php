
<?php
$lat ='30.1026233';
$lng ='71.4896116';
$fileman_location = "http://119.160.107.173:3002/location_name/$lat/$lng";
$data_location = file_get_contents($fileman_location);
$array_location = json_decode($data_location,true);

foreach($array_location as $row_location){
echo $location = $row_location["location"];
}
?>