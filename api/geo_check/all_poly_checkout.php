<?php
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 2000; URL=$url1");
error_reporting(0);

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bsl');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
echo "<h1>Polygone Check OUT service .</h1><br>";

$vehicle_name;
$sql = "SELECT * FROM attock.geo_in_check where log='0'";
$result = mysqli_query($db, $sql);
$count = mysqli_num_rows($result);
// echo $count;
if ($count > 0)
{
    while ($row = mysqli_fetch_array($result))
    {
        $v_lat = $row["latitude"];
        $v_lng = $row["longitude"];
        $v_num = $row["car_name"];
        $v_id = $row["veh_id"];
        $geo_id = $row["geo_id"];
        $Coordinates = $row["Coordinates"];
        $in_time = $row["in_time"];
        $check_in_id = $row["id"];
        $c_name = $row["consignee_name"];

        $sql_pos = "SELECT latitude,longitude,device_id,vehicle_id as car_name,time FROM attock.positions where device_id=$v_id and time >= '$in_time' order by id desc;";
        // echo $sql_pos .'</br>';
        $result_pos = mysqli_query($db, $sql_pos);
        $count_pos = mysqli_num_rows($result_pos);
        echo '----------------------------</br>';
        if ($count_pos > 0)
        {
            while ($row = mysqli_fetch_array($result_pos))
            {
                $latitude = $row['latitude'];
                $longitude = $row['longitude'];
                $car_name = $row['car_name'];
                $device_id = $row['device_id'];
                $time_pos = $row['time'];

                $myString = $Coordinates;
                $myArray = explode(';', $myString);
                // print_r($myArray);
                $vertices_x = array();
                // x-coordinates of the vertices of the polygon
                $vertices_y = array();
                //     y-coordinates of the vertices of the polygon
                foreach ($myArray as $value)
                {
                    // print $value;
                    // echo '</br>';
                    $mychars = explode(',', $value);
                    // echo 'Lati => ' . $mychars[0] . ' longi ' . $mychars[1];
                    // echo '<br/>';
                    $c_lat = floatval($mychars[0]);
                    $c_lng = floatval($mychars[1]);
                    $vertices_x[] = $c_lat;
                    $vertices_y[] = $c_lng;
                }
                // print_r($vertices_y);
                $points_polygon = count($vertices_x); // number vertices
                // $longitude_x = $_GET["longitude"]; // x-coordinate of the point to test
                // $latitude_y = $_GET["latitude"]; // y-coordinate of the point to test
                //// For testing.  This point lies inside the test polygon.
                $longitude_x = $v_lat;
                $latitude_y = $v_lng;

                if (is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y))
                {
                    echo "Already in polygon!</br>";

                    echo '<br/>';
                    echo 'Consignee name = ' . $c_name;
                    echo '<br/>';
                    echo '<br/>';
                    echo 'name = ' . $v_num . ' id = ' . $v_id;
                    echo '<br/>';
                    echo 'Lat Lng => ' . $v_lat . ' ' . $v_lng;
                    echo '<br/>';

                    echo 'In time =>' . $in_time;
                    echo '<br/>';

                    echo '<br/>';
                    echo 'Not Out';
                    echo '<br/>';
                    echo '------------------------------------------------------------------------';
                    echo '<br/>';

                }
                else
                {
                    echo "Is not in polygon";
                    $out_time = $time_pos;

                    echo '<br/>';
                    echo '<h1>'.$c_name .' '.$car_name.'</h1>';
                    echo '<br/>';

                    echo 'IN TIME =>' . $in_time;
                    echo '<br/>';

                    echo '<br/>';

                    echo 'Out TIME =>' . $out_time;
                    echo '<br/>';

                    $to_time = strtotime($in_time);
                    $from_time = strtotime($out_time);
                    $hours = round(abs($to_time - $from_time) / 60, 2);
                    update($v_id, $geo_id, $out_time, $in_time, $hours, $check_in_id);
                    break;
                    
                }
            }
        }

    }

}
else
{
    echo '<h1>No Records Found </h1>';
}

function update($v_id, $geo_id, $out_time, $in_time, $diff_hours, $check_in_id)
{

    $dbss = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    $sql_update = "UPDATE attock.geo_check set out_time='$out_time' , log=1,in_duration='$diff_hours' where veh_id='$v_id' and geo_id='$geo_id' and id='$check_in_id'";
    if (mysqli_query($dbss, $sql_update))
    {
        echo "Log update successfully !";

        $sql_insert = "INSERT INTO attock.geo_check_audit (`veh_id`,`geo_id`,`in_time`,`out_time`,`in_duration`) VALUES ('$v_id','$geo_id','$in_time',' $out_time','$diff_hours');";
        if (mysqli_query($dbss, $sql_insert))
        {
            echo "New record created successfully !";
        }
        else
        {
            echo "Error: " . $sql_insert . "
               " . mysqli_error($dbss);
        }
    }
    else
    {
        echo "Error: " . $sql_update . "" . mysqli_error($dbss);
    }

}

function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
{
    $i = $j = $c = 0;
    for ($i = 0, $j = $points_polygon - 1;$i < $points_polygon;$j = $i++)
    {
        if ((($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]))) $c = !$c;
    }
    return $c;
}

?>
