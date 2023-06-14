<?php
date_default_timezone_set("Asia/Karachi");
ini_set('max_execution_time', -1);
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 20; URL=$url1");

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bsl');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
echo "<h1>Trip Status service .</h1><br>";
$vehicle_name;
$date_time = date('Y-m-d h:i:s', strtotime("+15 days"));
$cur_time = date('Y-m-d H:i:s');

$sql_main = "SELECT * FROM bsl.trips_non_dedicated where trip_status=0 and type='Non Dedicated'";
// echo $sql_1 ."<br>";
$result_main = mysqli_query($db, $sql_main);
$count_main = mysqli_num_rows($result_main);
// echo $count_1;
if ($count_main > 0) {
    while ($row_main = mysqli_fetch_array($result_main)) {
        $trip_p_id = $row_main['id'];
        
        $sql_1 = "SELECT tc.id as trip_sub_id,tc.*,ts.*,dc.lat,dc.lng,geo.Coordinates,geo.type FROM bsl.trips_child_non_dedicated as tc 
        join trips_non_dedicated as ts on ts.id=tc.main_id 
        join devices as dc on dc.id=ts.vehicle 
        join geofenceing as geo on geo.id=tc.origin 
        where ts.id='$trip_p_id' and ts.trip_status=0 order by tc.craated_at asc";
        // echo $sql_1 ."<br>";
        $result_1 = mysqli_query($db, $sql_1);
        $count_1 = mysqli_num_rows($result_1);
        // echo $count_1;

        if ($count_1 > 0) {
            while ($row = mysqli_fetch_array($result_1)) {
                $origin = $row['origin'];
                $vehicle = $row['vehicle'];
                $trip_main_id = $row['main_id'];
                $destination = $row['destination'];
                $status = $row['status'];
                $eta_hour = $row['eta_hour'];
                $trip_sub_id = $row['trip_sub_id'];
                $v_lat = $row['lat'];
                $v_lng = $row['lng'];
                $radius = $row['radius'];
                $Coordinates = $row['Coordinates'];
                $origin_type = $row['type'];
                $trip_start_time = $row['trip_start_time'];

                // echo $trip_sub_id . ' <br>';
                $curr_date = date("Y-m-d H:i:s");
                if ($status == 0) {


                    $date_time = $trip_start_time;
                    $formatted_date_time = date("Y-m-d H:i:s", strtotime($date_time));
                    $formatted_date_time = str_replace("T", " ", $formatted_date_time);
                   echo $trip_start_time . '<br>';
                   echo $formatted_date_time . '<br>';
                    $curl = curl_init();
                    // echo 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $formatted_date_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '<br>';
                    curl_setopt_array(
                        $curl,
                        array(
                            CURLOPT_URL => 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $formatted_date_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                        )
                    );

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        // $response = json_decode($response, true);
                        if ($response != null) {
                            $json_arr = json_decode($response, true);
                            $i = 0;
                            foreach ($json_arr as $row_resq911) {


                                $lat = $row_resq911["Y"];
                                $lng = $row_resq911["X"];

                                if ($origin_type == 'circle') {
                                    if (circle_checkin($lat, $lng, $Coordinates, $radius) == true) {
                                        // $out_time = date('Y-m-d H:i:s');
                                        $time = $row_resq911["time"];

                                        trip_start($eta_hour, $time, $trip_sub_id, $db);
                                        break;
                                    } else {

                                    }

                                } else {

                                    // echo 'Hamza' ;
                                }


                                // echo $lat . '<br>';
                                $i++;
                            }


                        }
                    }

                    // $geo_check = "SELECT * FROM bsl.geo_check where geo_id='$origin' and veh_id='$vehicle' and out_time>='$trip_start_time' order by id desc limit 1";
                    // // echo $geo_check ."<br>";

                    // $result_geo_check = mysqli_query($db, $geo_check);
                    // $count_geo_check = mysqli_num_rows($result_geo_check);
                    // // echo $count;

                    // if ($count_geo_check > 0) {
                    //     while ($row = mysqli_fetch_array($result_geo_check)) {
                    //         $log = $row['log'];
                    //         $in_time = $row['in_time'];
                    //         $out_time = $row['out_time'];

                    //         if ($log == 1 && $out_time != '') {

                    //             echo $eta_hour . '<br>';
                    //             $current_datetime = new DateTime($out_time); // create a DateTime object for the current date and time
                    //             $current_datetime->modify('+' . $eta_hour . ' hours'); // add 52 hours to the current date and time
                    //             $eta_time = $current_datetime->format('Y-m-d H:i:s'); // format the datetime as a string
                    //             echo $out_time . '<br>';
                    //             echo $eta_time . '<br>';
                    //             $update_departure = "UPDATE `bsl`.`trips_child_non_dedicated`
                    //                 SET
                    //                 `status` = '1',
                    //                 `current_status` = 'Started',
                    //                 `departure_time` = '$out_time',
                    //                 `eta` = '$eta_time'
                    //                 WHERE `id` = '$trip_sub_id';";

                    //             mysqli_query($db, $update_departure);

                    //         } else {
                    //             echo 'Waiting for departure <br>';
                    //         }
                    //     }

                    // } else {
                    //     echo 'No Up check In departure <br>';
                    // }
                } else if ($status == 1) {

                    $departure_time = $row['departure_time'];
                    // echo 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $departure_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '';
                    $curl = curl_init();

                    curl_setopt_array(
                        $curl,
                        array(
                            CURLOPT_URL => 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $departure_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                        )
                    );

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        // $response = json_decode($response, true);
                        if ($response != null) {
                            $json_arr = json_decode($response, true);
                            $i = 0;
                            foreach ($json_arr as $row_resq911) {


                                $lat = $row_resq911["Y"];
                                $lng = $row_resq911["X"];
                                if ($destination != "") {

                                    if (arrival_checkin($lat, $lng, $destination, $radius) == true) {
                                        // $out_time = date('Y-m-d H:i:s');
                                        $time = $row_resq911["time"];

                                        trip_arrival($time, $trip_sub_id, $db);
                                        break;
                                    } else {
                                        // echo 'Hamza' ;
                                    }
                                }





                                // echo $lat . '<br>';
                                $i++;
                            }


                        }
                    }

                    // $mychars = explode(',', $destination);
                    // // echo 'Lati => ' .$mychars[0] . ' longi ' . $mychars[1] ;
                    // // echo '<br/>';

                    // $c_lat = floatval($mychars[0]);
                    // $c_lng = floatval($mychars[1]);
                    // $km = $radius;
                    // // console.log("Hamza" + co+" sss "+v_num)
                    // $ky = 40000 / 360;
                    // $kx = cos(pi() * $c_lat / 180.0) * $ky;
                    // $dx = abs($c_lng - $v_lng) * $kx;
                    // $dy = abs($c_lat - $v_lat) * $ky;
                    // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
                    // echo '<br/>';
                    // // echo $km;



                    // if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == true) {
                    //     // echo ($v_lat + "," + $v_lng + "," + $v_id + "     " + $c_lat + "," + $c_lng + "," + $v_num + "," + $id + "," + $c_name + "," + $location);
                    //     $in_time = date('Y-m-d H:i:s');
                    //     echo '<br/>';

                    //     echo 'IN TIME =>' . $in_time;
                    //     echo '<br/>';
                    //     echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
                    //     echo '<br/>';

                    //     $update_arival = "UPDATE `bsl`.`trips_child_non_dedicated`
                    //         SET
                    //         `status` = '2',
                    //         `current_status` = 'Waiting For Delivery',
                    //         `arrival_time` = '$in_time'
                    //         WHERE `id` = '$trip_sub_id';";

                    //     mysqli_query($db, $update_arival);
                    // } else {

                    //     echo '<br/>';
                    //     echo 'Not IN';
                    //     echo '<br/>';
                    // }

                } else if ($status == 2) {


                    $arrival_time = $row['arrival_time'];
                    $curl = curl_init();

                    curl_setopt_array(
                        $curl,
                        array(
                            CURLOPT_URL => 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $arrival_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                        )
                    );

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        // $response = json_decode($response, true);
                        if ($response != null) {
                            $json_arr = json_decode($response, true);
                            $i = 0;
                            foreach ($json_arr as $row_resq911) {


                                $lat = $row_resq911["Y"];
                                $lng = $row_resq911["X"];

                                if ($destination != '') {
                                    if (delivery_checkin($lat, $lng, $destination, $radius) == true) {
                                        // $out_time = date('Y-m-d H:i:s');
                                        $time = $row_resq911["time"];

                                        trip_delivery($time, $trip_sub_id, $db);
                                        break;
                                    } else {
                                        // echo 'Hamza' ;
                                    }

                                } else {

                                }


                                // echo $lat . '<br>';
                                $i++;
                            }


                        }
                    }

                    // $chars = explode(',', $destination);

                    // $c_lat = $chars[0];
                    // $c_lng = $chars[1];

                    // $km = $radius;
                    // // $km = 50;
                    // $ky = 40000 / 360;
                    // $kx = cos(pi() * $c_lat / 180.0) * $ky;
                    // $dx = abs($c_lng - $v_lng) * $kx;
                    // $dy = abs($c_lat - $v_lat) * $ky;

                    // if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == false) {
                    //     $out_time = date('Y-m-d H:i:s');


                    //     echo '<br/>';

                    //     echo 'IN TIME =>' . $in_time;
                    //     echo '<br/>';

                    //     echo '<br/>';

                    //     echo 'Out TIME =>' . $out_time;
                    //     echo '<br/>';

                    //     $to_time = strtotime($in_time);
                    //     $from_time = strtotime($out_time);
                    //     $hours = round(abs($to_time - $from_time) / 60, 2);

                    //     $update_arival = "UPDATE `bsl`.`trips_child_non_dedicated`
                    //                 SET
                    //                 `status` = '3',
                    //                 `current_status` = 'Completed',
                    //                 `delivery_time` = '$out_time'
                    //                 WHERE `id` = '$trip_sub_id';";

                    //     if (mysqli_query($db, $update_arival)) {
                    //         $update_main_trip = "UPDATE `bsl`.`trips_non_dedicated`
                    //                 SET
                    //                 `trip_status` = '1',
                    //                 `complete_time` = '$out_time'
                    //                 WHERE `id` = '$trip_main_id';";
                    //         mysqli_query($db, $update_main_trip);
                    //     }

                    // } else {

                    //     echo '<br/>';
                    //     echo 'Not Out';
                    //     echo '<br/>';
                    //     echo '------------------------------------------------------------------------';
                    //     echo '<br/>';


                    // }



                }

            }
        } else {
         $sql_2 = "SELECT tc.id as trip_sub_id,tc.*,ts.*,dc.lat,dc.lng,geo.Coordinates,geo.type FROM bsl.trips_child_non_dedicated as tc 
    join trips_non_dedicated as ts on ts.id=tc.main_id 
    join devices as dc on dc.id=ts.vehicle 
    join geofenceing as geo on tc.origin
    where ts.id='$trip_p_id' and ts.trip_status=0 order by tc.craated_at asc limit 1";
            // echo $sql_1 ."<br>";
            $result_2 = mysqli_query($db, $sql_2);
            $count_2 = mysqli_num_rows($result_2);
            // echo $count_1;
            if ($count_2 > 0) {
                while ($row = mysqli_fetch_array($result_2)) {

                    $delivery_time = $row['delivery_time'];
                    $origin = $row['origin'];
                    $vehicle = $row['vehicle'];
                    $trip_main_id = $row['main_id'];
                    $destination = $row['destination'];
                    $status = $row['status'];
                    $eta_hour = $row['eta_hour'];
                    $trip_sub_id = $row['trip_sub_id'];
                    $v_lat = $row['lat'];
                    $v_lng = $row['lng'];
                    $radius = $row['radius'];
                    $Coordinates = $row['Coordinates'];
                    $origin_type = $row['type'];

                    echo $trip_sub_id . ' <br>';
                    $curr_date = date("Y-m-d H:i:s");
                    $curl = curl_init();
                    // echo 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $delivery_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '';
                    curl_setopt_array(
                        $curl,
                        array(
                            CURLOPT_URL => 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $delivery_time) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                        )
                    );

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        // $response = json_decode($response, true);
                        if ($response != null) {
                            $json_arr = json_decode($response, true);
                            $i = 0;
                            foreach ($json_arr as $row_resq911) {


                                $lat = $row_resq911["Y"];
                                $lng = $row_resq911["X"];

                                if ($origin_type == 'circle') {
                                    if (down_trip_checkin($lat, $lng, $Coordinates) == true) {
                                        // $out_time = date('Y-m-d H:i:s');
                                        $time = $row_resq911["time"];
                                        down_trip_delivery($time, $trip_main_id, $db);
                                        break;
                                    } else {
                                        // echo 'Hamza' ;
                                    }

                                } else {

                                }


                                // echo $lat . '<br>';
                                $i++;
                            }


                        }
                    }

                }
            }


            echo 'Not Found <br>';


        }
    }
} else {

    echo 'No Trip Found <br>';
}

function circle_checkin($v_lat, $v_lng, $co, $radius)
{
    $mychars = explode(',', $co);
    // echo 'Lati => ' .$mychars[0] . ' longi ' . $mychars[1] ;
    // echo '<br/>';

    $c_lat = floatval($mychars[0]);
    $c_lng = floatval($mychars[1]);
    $km = $radius;
    // console.log("Hamza" + co+" sss "+v_num)
    $ky = 40000 / 360;
    $kx = cos(pi() * $c_lat / 180.0) * $ky;
    $dx = abs($c_lng - $v_lng) * $kx;
    $dy = abs($c_lat - $v_lat) * $ky;
    // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
    // echo '<br/>';
    // echo $km;



    if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == true) {
        // echo ($v_lat + "," + $v_lng + "," + $v_id + "     " + $c_lat + "," + $c_lng + "," + $v_num + "," + $id + "," + $c_name + "," + $location);
        $in_time = date('Y-m-d H:i:s');
        // echo '<br/>';

        // echo 'IN TIME =>' . $in_time;
        // echo '<br/>';
        // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
        // echo '<br/>';
        return false;

    } else {
        // $out_time = date('Y-m-d H:i:s');
        // echo $out_time . ' <br/>';
        // echo 'Not IN';
        // echo '<br/>';
        return true;
    }
}

function trip_start($eta_hour, $out_time, $trip_sub_id, $db)
{
    if ($out_time != '') {

        // echo $eta_hour . '<br>';
        $current_datetime = new DateTime($out_time); // create a DateTime object for the current date and time
        $current_datetime->modify('+' . $eta_hour . ' hours'); // add 52 hours to the current date and time
        $eta_time = $current_datetime->format('Y-m-d H:i:s'); // format the datetime as a string
        echo $out_time . '<br>';
        echo $eta_time . '<br>';
        $update_departure = "UPDATE `bsl`.`trips_child_non_dedicated`
        SET
        `status` = '1',
        `current_status` = 'Started',
        `departure_time` = '$out_time',
        `eta` = '$eta_time'
        WHERE `id` = '$trip_sub_id';";

        mysqli_query($db, $update_departure);

    } else {
        echo 'Waiting for departure';
    }

}

function arrival_checkin($v_lat, $v_lng, $co, $radius)
{
    $mychars = explode(',', $co);
    // echo 'Lati => ' .$mychars[0] . ' longi ' . $mychars[1] ;
    // echo '<br/>';

    $c_lat = floatval($mychars[0]);
    $c_lng = floatval($mychars[1]);
    $km = $radius;
    // console.log("Hamza" + co+" sss "+v_num)
    $ky = 40000 / 360;
    $kx = cos(pi() * $c_lat / 180.0) * $ky;
    $dx = abs($c_lng - $v_lng) * $kx;
    $dy = abs($c_lat - $v_lat) * $ky;
    // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
    // echo '<br/>';
    // echo $km;



    if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == true) {
        // echo ($v_lat + "," + $v_lng + "," + $v_id + "     " + $c_lat + "," + $c_lng + "," + $v_num + "," + $id + "," + $c_name + "," + $location);
        // $in_time = date('Y-m-d H:i:s');
        // echo '<br/>';

        // echo 'IN TIME =>' . $in_time;
        // echo '<br/>';
        // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
        // echo '<br/>';
        return true;

    } else {
        // $out_time = date('Y-m-d H:i:s');
        // echo $out_time.' <br/>';
        // echo 'Not IN';
        // echo '<br/>';
        return false;
    }
}

function trip_arrival($in_time, $trip_sub_id, $db)
{
    if ($in_time != "") {

        $update_arival = "UPDATE `bsl`.`trips_child_non_dedicated`
        SET
        `status` = '2',
        `current_status` = 'Waiting For Delivery',
        `arrival_time` = '$in_time'
        WHERE `id` = '$trip_sub_id';";

        mysqli_query($db, $update_arival);
    }
}

function delivery_checkin($v_lat, $v_lng, $co, $radius)
{
    $mychars = explode(',', $co);
    // echo 'Lati => ' .$mychars[0] . ' longi ' . $mychars[1] ;
    // echo '<br/>';

    $c_lat = floatval($mychars[0]);
    $c_lng = floatval($mychars[1]);
    $km = $radius;
    // console.log("Hamza" + co+" sss "+v_num)
    $ky = 40000 / 360;
    $kx = cos(pi() * $c_lat / 180.0) * $ky;
    $dx = abs($c_lng - $v_lng) * $kx;
    $dy = abs($c_lat - $v_lat) * $ky;
    // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
    // echo '<br/>';
    // echo $km;



    if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == true) {
        // echo ($v_lat + "," + $v_lng + "," + $v_id + "     " + $c_lat + "," + $c_lng + "," + $v_num + "," + $id + "," + $c_name + "," + $location);
        $in_time = date('Y-m-d H:i:s');
        // echo '<br/>';

        // echo 'IN TIME =>' . $in_time;
        // echo '<br/>';
        // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
        // echo '<br/>';
        return false;

    } else {
        // $out_time = date('Y-m-d H:i:s');
        // echo $out_time . ' <br/>';
        // echo 'Not IN';
        // echo '<br/>';
        return true;
    }
}


function trip_delivery($in_time, $trip_sub_id, $db)
{
    if ($in_time != "") {

        $update_arival = "UPDATE `bsl`.`trips_child_non_dedicated`
                        SET
                        `status` = '3',
                        `current_status` = 'Completed',
                        `delivery_time` = '$in_time'
                        WHERE `id` = '$trip_sub_id'";

        mysqli_query($db, $update_arival);
    }
}

function down_trip_checkin($v_lat, $v_lng, $co)
{
    $mychars = explode(',', $co);
    // echo 'Lati => ' .$mychars[0] . ' longi ' . $mychars[1] ;
    // echo '<br/>';

    $c_lat = floatval($mychars[0]);
    $c_lng = floatval($mychars[1]);
    $km = 1;
    // console.log("Hamza" + co+" sss "+v_num)
    $ky = 40000 / 360;
    $kx = cos(pi() * $c_lat / 180.0) * $ky;
    $dx = abs($c_lng - $v_lng) * $kx;
    $dy = abs($c_lat - $v_lat) * $ky;
    // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
    // echo '<br/>';
    // echo $km;



    if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == true) {
        // echo ($v_lat + "," + $v_lng + "," + $v_id + "     " + $c_lat + "," + $c_lng + "," + $v_num + "," + $id + "," + $c_name + "," + $location);
        $in_time = date('Y-m-d H:i:s');
        // echo '<br/>';

        // echo 'IN TIME =>' . $in_time;
        // echo '<br/>';
        // echo sqrt(($dx * $dx) + ($dy * $dy)) . '<=' . $km;
        // echo '<br/>';
        return true;

    } else {
        // $out_time = date('Y-m-d H:i:s');
        // echo $out_time . ' <br/>';
        // echo 'Not IN';
        // echo '<br/>';
        return false;
    }
}

function down_trip_delivery($in_time, $trip_main_id, $db)
{
    if ($in_time != "") {


        $update_main_trip = "UPDATE `bsl`.`trips_non_dedicated`
            SET
            `trip_status` = '1',
            `complete_time` = '$in_time'
            WHERE `id` = '$trip_main_id';";
        mysqli_query($db, $update_main_trip);


    }
}
echo date('Y-m-d H:i:s');
?>