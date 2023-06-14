<?php
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 20; URL=$url1");
error_reporting(0);

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bsl');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
echo "<h1>Polygone Check IN service .</h1><br>";

$vehicle_name;
$sql_user = "SELECT * FROM users";
$result_sql_user = mysqli_query($db, $sql_user);
$count_sql_user = mysqli_num_rows($result_sql_user);

if ($count_sql_user > 0)
{
    while ($row_user = mysqli_fetch_array($result_sql_user))
    {
        // $userid = $row['id'];
        $user_id = $row_user['id'];
        $username = $row_user['name'];
        echo $username;
        echo '<br> ------------------------------------------------------------------------------------------- <br>';
        $sql = "SELECT dc.lat as latitude,dc.lng as longitude,dc.name as car_name, dc.id as device_id FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id'";
        $result = mysqli_query($db, $sql);
        $count = mysqli_num_rows($result);
        // echo $count;
        if ($count > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                // $userid = $row['id'];
                $latitude = $row['latitude'];
                $longitude = $row['longitude'];
                $car_name = $row['car_name'];
                $device_id = $row['device_id'];
        
                $v_lat = $row['latitude'];
                $v_lng = $row['longitude'];
                $v_num = $row['car_name'];
                $v_id = $row['device_id'];
        
                echo '<br/>';
                echo 'car name = ' . $v_num . ' id = ' . $v_id;
                echo '<br/>';
                // echo 'Lat Lng => ' .$v_lat. ' ' .$v_lng ;
                // echo '<br/>';
                // echo '---------------------------------------------------';
                // echo '<br/>';
        
                get_geo($v_lat, $v_lng, $v_num, $v_id);
        
            }
        
        }
        else
        {
            echo '<h1>No Records Found to send Msg</h1>';
        }
    }
}

function get_geo($v_lat, $v_lng, $v_num, $v_id)
{

    $dbs = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    $sql_geo = "SELECT geo.id,geo.consignee_name,geo.location,geo.Coordinates,geo.type FROM bsl.vehicle_geofence as v_geo join geofenceing geo on geo.id=v_geo.geo_id where geo.type='polygon' and v_geo.vehicle_id='$v_id';";
    $result_geo = mysqli_query($dbs, $sql_geo);
    $count_geo = mysqli_num_rows($result_geo);
    // echo $count;
    if ($count_geo > 0)
    {
        while ($row = mysqli_fetch_array($result_geo))
        {

            $co = $row['Coordinates'];
            $c_name = $row['consignee_name'];
            $location = $row['location'];
            $id = $row['id'];

            echo '<br/>';
            echo 'name = ' . $c_name . ' id = ' . $id;
            echo '<br/>';

            // $myString = $co;
            $myString =  rtrim($co, ';');
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
                $c_lat = floatval($mychars[1]);
                $c_lng = floatval($mychars[0]);
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
                echo "Is in polygon!</br>";

                $in_time = date('Y-m-d H:i:s');
                echo '<br/>';

                echo 'IN TIME =>' . $in_time;
                echo '<br/>';
                insert($v_id, $id, $in_time);

            }
            else
            {
                echo "Is not in polygon";
            }

        }

    }

}

function insert($v_id, $geo_id, $in_time)
{

    $dbss = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    $sql_check_geo = "select * FROM geo_check where veh_id= '$v_id'  and geo_id= '$geo_id' and log='0'";
    $result_check_geo = mysqli_query($dbss, $sql_check_geo);
    $count_geo_check = mysqli_num_rows($result_check_geo);
    // echo $count;
    if ($count_geo_check > 0)
    {
        echo '<br/>';
        echo 'Already IN';
        echo '<br/>';

    }
    else
    {
        $sql_insert = "INSERT INTO `geo_check`(`veh_id`,`geo_id`,`in_time`,`log`,`depot_status`) VALUES ('$v_id','$geo_id','$in_time','0','0')";
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
echo date('Y-m-d H:i:s');  
?>
