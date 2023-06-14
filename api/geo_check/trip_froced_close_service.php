<?php
ini_set('max_execution_time', '0');
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 3600; URL=$url1");


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bsl');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
echo "<h1>Trip Force Close service .</h1><br>";
$vehicle_name;
$date_time = date('Y-m-d h:i:s',strtotime("-15 days"));
$cur_time = date('Y-m-d H:i:s');
$sql_1="SELECT * FROM attock.trip_sub where status='0' and consignee_id!='' ;";
// echo $sql_1 ."<br>";
$result_1 = mysqli_query($db,$sql_1);
$count_1 = mysqli_num_rows($result_1);
// echo $count;
if($count_1 > 0) {
    while( $row = mysqli_fetch_array($result_1) ){
        $consignee_id = $row['consignee_id'];
        $vehicle_id = $row['vehicle_id'];
        $st_id = $row['id'];
        $start_time = $row['start_time'];
        echo $start_time .'<br>';

        $datetime1 = new DateTime($start_time);
        $datetime2 = new DateTime($cur_time);

        // Calculate the interval between the two dates
        $interval = $datetime1->diff($datetime2);

        // Get the difference in minutes
        $minutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;

        // Output the result
        if($minutes>=5760){

            $forced_stop = "UPDATE attock.trip_sub SET status='2', commets='Up to four days' WHERE id='$st_id'";
            mysqli_query($db,$forced_stop);
            echo "The difference between the two dates is $minutes minutes. <br>";

        }
        else{
            echo "On going is $minutes minutes. <br>";

        }


        

    }
}








?>