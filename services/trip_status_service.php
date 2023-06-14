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

$sql_main = "SELECT * FROM bsl.trips where trip_status=0 and type='Dedicated'";
// echo $sql_1 ."<br>";
$result_main = mysqli_query($db, $sql_main);
$count_main = mysqli_num_rows($result_main);
// echo $count_1;
if ($count_main > 0) {
    while ($row_main = mysqli_fetch_array($result_main)) {
        $trip_p_id = $row_main['id'];
        $trip_start_time = $row_main['start_time'];
        $sql_1 = "SELECT tc.id as trip_sub_id,tc.*,ts.*,geo.Coordinates as origin_co,geo.type as origin_type,dgeo.Coordinates as des_co,dgeo.type as des_type FROM bsl.trips_child as tc 
        join trips as ts on ts.id=tc.main_id 
        join geofenceing as geo on  geo.id=tc.origin 
        join geofenceing as dgeo on  dgeo.id=tc.destination
        where ts.id='$trip_p_id' and tc.direction='Up' and ts.trip_status=0 and ts.start_time!=''";
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
                $direction = $row['direction'];
                $eta_hour = $row['eta_hour'];
                $trip_sub_id = $row['trip_sub_id'];
                $origin_co = $row['origin_co'];
                $origin_type = $row['origin_type'];
                $des_co = $row['des_co'];
                $des_type = $row['des_type'];

                if ($direction == 'Up') {
                    echo $trip_sub_id . ' Up <br>';
                    $curr_date = date("Y-m-d H:i:s");

                    $date_time = $trip_start_time;
                    $formatted_date_time = date("Y-m-d H:i:s", strtotime($date_time));
                    $formatted_date_time = str_replace("T", " ", $formatted_date_time);
                    echo $formatted_date_time . '<br>';
                    if ($status == 0 && $direction == 'Up') {

                        $curl = curl_init();

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
                                        if (circle_checkin($lat, $lng, $origin_co) == true) {
                                            // $out_time = date('Y-m-d H:i:s');
                                            $time = $row_resq911["time"];

                                            trip_start($eta_hour, $time, $trip_sub_id, $db);
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

                    } else if ($status == 1 && $direction == 'Up') {
                        $departure_time = $row['departure_time'];
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

                                    if ($des_type == 'circle') {
                                        if (arrival_checkin($lat, $lng, $des_co) == true) {
                                            // $out_time = date('Y-m-d H:i:s');
                                            $time = $row_resq911["time"];

                                            trip_arrival($time, $trip_sub_id, $db);
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



                    } else if ($status == 2 && $direction == 'Up') {

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

                                    if ($des_type == 'circle') {
                                        if (delivery_checkin($lat, $lng, $des_co) == true) {
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

                        // $geo_check = "SELECT * FROM bsl.geo_check where geo_id='$destination' and veh_id='$vehicle' order by id desc limit 1";

                        // $result_geo_check = mysqli_query($db, $geo_check);
                        // $count_geo_check = mysqli_num_rows($result_geo_check);
                        // echo $count_geo_check;
                        // if ($count_geo_check > 0) {
                        //     while ($row = mysqli_fetch_array($result_geo_check)) {
                        //         $log = $row['log'];
                        //         $in_time = $row['in_time'];
                        //         $out_time = $row['out_time'];

                        //         if ($log == 1 && $out_time != '') {

                        //             echo $update_arival = "UPDATE `bsl`.`trips_child`
                        //             SET
                        //             `status` = '3',
                        //             `current_status` = 'Completed',
                        //             `delivery_time` = '$out_time'
                        //             WHERE `id` = '$trip_sub_id';";

                        //             mysqli_query($db, $update_arival);

                        //         } else {
                        //             echo 'Waiting for Completion';
                        //         }
                        //     }

                        // }

                    } else if ($status == 3 && $direction == 'Up') {
                        $down_start_time = $row['delivery_time'];
                        // echo $down_start_time . '<br>';

                        $sql_1 = "SELECT tc.id as trip_sub_id,tc.*,ts.*,geo.Coordinates as down_co,geo.type down_trip FROM bsl.trips_child as tc 
                        join trips as ts on ts.id=tc.main_id 
                        join geofenceing as geo on geo.id=tc.destination
                        where tc.direction='Down' and ts.trip_status=0 and ts.id='$trip_main_id'";
                        // echo $sql_1 ."<br>";
                        $result_1 = mysqli_query($db, $sql_1);
                        $count_1 = mysqli_num_rows($result_1);
                        // echo $count_1;
                        if ($count_1 > 0) {
                            while ($row = mysqli_fetch_array($result_1)) {
                                $origin_down = $row['origin'];
                                $destination_down = $row['destination'];
                                $status_down = $row['status'];
                                $direction_dowm = $row['direction'];
                                $eta_hour_dowm = $row['eta_hour'];
                                $departure_time_down = $row['departure_time'];
                                $down_id = $row['trip_sub_id'];
                                $down_co = $row['down_co'];
                                $down_trip = $row['down_trip'];

                                if ($status_down == 0 && $direction_dowm == 'Down') {
                                    $current_datetime = new DateTime($down_start_time); // create a DateTime object for the current date and time
                                    $current_datetime->modify('+' . $eta_hour_dowm . ' hours'); // add 52 hours to the current date and time
                                    $eta_time_dowm = $current_datetime->format('Y-m-d H:i:s'); // format the datetime as a string
                                    $update_arival = "UPDATE `bsl`.`trips_child`
                                    SET
                                    `status` = '1',
                                    `current_status` = 'Waiting For Arrival',
                                    `departure_time` = '$down_start_time',
                                    `eta` = '$eta_time_dowm'
                                    WHERE `main_id` = '$trip_main_id' and direction = 'Down';";

                                    mysqli_query($db, $update_arival);

                                } else if ($status_down == 1 && $direction_dowm == 'Down') {


                                    $curl = curl_init();

                                    curl_setopt_array(
                                        $curl,
                                        array(
                                            CURLOPT_URL => 'http://119.160.107.173:3002/movement_n/' . str_replace(' ', '%20', $departure_time_down) . '/' . str_replace(' ', '%20', $curr_date) . '/' . $vehicle . '',
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

                                                if ($down_trip == 'circle') {
                                                    if (down_trip_checkin($lat, $lng, $down_co) == true) {
                                                        // $out_time = date('Y-m-d H:i:s');
                                                        $time = $row_resq911["time"];
                                                        down_trip_delivery($time, $trip_main_id, $down_id, $db);
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

                                    // $geo_check = "SELECT * FROM bsl.geo_check where geo_id='$destination_down' and veh_id='$vehicle' and in_time>='$departure_time_down' order by id desc limit 1";

                                    // $result_geo_check = mysqli_query($db, $geo_check);
                                    // $count_geo_check = mysqli_num_rows($result_geo_check);
                                    // echo $count_geo_check;
                                    // if ($count_geo_check > 0) {
                                    //     while ($row = mysqli_fetch_array($result_geo_check)) {
                                    //         $log = $row['log'];
                                    //         $in_time = $row['in_time'];
                                    //         $out_time = $row['out_time'];

                                    //         if ($log == 0 && $out_time == '') {

                                    //             $update_arival = "UPDATE `bsl`.`trips_child`
                                    //             SET
                                    //             `status` = '3',
                                    //             `current_status` = 'Completed',
                                    //             `arrival_time` = '$in_time'
                                    //             WHERE `main_id` = '$trip_main_id' and id = '$down_id';";

                                    //             if (mysqli_query($db, $update_arival)) {
                                    //                 $update_main_trip = "UPDATE `bsl`.`trips`
                                    //                 SET
                                    //                 `trip_status` = '1',
                                    //                 `complete_time` = '$in_time'
                                    //                 WHERE `id` = '$trip_main_id';";
                                    //                 mysqli_query($db, $update_main_trip);
                                    //             }

                                    //         }

                                    //     }

                                    // } else {
                                    //     echo 'Waiting For Arrival.';
                                    // }
                                }

                            }
                        }

                    }
                }
            }
        } else {

            echo 'Not Found';
        }
    }
} else {

    echo 'No Trip Found';
}

function circle_checkin($v_lat, $v_lng, $co)
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

        echo $eta_hour . '<br>';
        $current_datetime = new DateTime($out_time); // create a DateTime object for the current date and time
        $current_datetime->modify('+' . $eta_hour . ' hours'); // add 52 hours to the current date and time
        $eta_time = $current_datetime->format('Y-m-d H:i:s'); // format the datetime as a string
        echo $out_time . '<br>';
        echo $eta_time . '<br>';
        $update_departure = "UPDATE `bsl`.`trips_child`
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

function arrival_checkin($v_lat, $v_lng, $co)
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

        $update_arival = "UPDATE `bsl`.`trips_child`
                                        SET
                                        `status` = '2',
                                        `current_status` = 'Waiting For Delivery',
                                        `arrival_time` = '$in_time'
                                        WHERE `id` = '$trip_sub_id';";

        mysqli_query($db, $update_arival);
    }
}

function delivery_checkin($v_lat, $v_lng, $co)
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

        $update_arival = "UPDATE `bsl`.`trips_child`
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

        echo 'IN TIME =>' . $in_time;
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

function down_trip_delivery($in_time, $trip_main_id, $down_id, $db)
{
    if ($in_time != "") {

        $update_arival = "UPDATE `bsl`.`trips_child`
        SET
        `status` = '3',
        `current_status` = 'Completed',
        `arrival_time` = '$in_time'
        WHERE `main_id` = '$trip_main_id' and id = '$down_id';";

        if (mysqli_query($db, $update_arival)) {
            $update_main_trip = "UPDATE `bsl`.`trips`
            SET
            `trip_status` = '1',
            `complete_time` = '$in_time'
            WHERE `id` = '$trip_main_id';";
            mysqli_query($db, $update_main_trip);
        }

    }
}
echo '<br>' . date('Y-m-d H:i:s');
?>