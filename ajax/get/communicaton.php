<?php
session_start();
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_DATABASE', 'Attock ');
// $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
include("../../config.php");
if (isset($_POST))
{

    $mile = 0;
    $pre_mile = 0;
    $next_mile = 0;
    $final_mile = 0;

    $first_start = '';
    $last_stop = '';
    $start_time;
    $vehicle_name='';
    $pre_time = 0;
    $final_time = 0;
    $total_stop_time = 0;

    $idel_first_start = '';
    $idel_last_stop = '';
    $idel_start_time;
    $idel_vehicle_name;
    $idel_pre_time = 0;
    $idel_final_time = 0;
    $idel_total_stop_time = 0;

    $start_speed;
    $next_speed = 0;
    $pre_speed = 0;
    $total_event;
    $min_ = 0;
    $max_ = 0;
    $Averagespeed=0;
    $calculated_odo_ = 0;
    $location;
    $time_;
    $lati;
    $lngi;
    
    $vehicle = $_POST['check'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    // $vehicle = $_GET['check'];
    // $from = $_GET['from'];
    // $to = $_GET['to'];

    if ($vehicle != "" && $from != "" && $to != "")
    {

        $users_arr_date = array();

        $date = displayDates($from, $to);
        //  print_r($date);
        foreach ($date as $value)
        {
            // echo "----------------------------------------------------------------------";
            // echo "<br>";
            // echo "$value <br>";
            // echo "<br>";

            // $users_arr = array();
            // $sql="SELECT * FROM `positions` where time>='$from' and time<='$to' and device_id=$vehicle";
            $sql = "SELECT DATE_FORMAT(time,'%H:%i:%s') time,speed,power,odometer as imileage,vehicle_name as vehicle_id FROM positions where device_id='$vehicle' and time>'$value 00:00:00' and time<'$value 04:59:59'  order by time asc";

            // echo $sql;
            $result = mysqli_query($db, $sql);
            $number = mysqli_num_rows($result);
            if ($number > 0)
            {

                $j = 1;

                $i = 0;
                $k = 0;
                $l = 0;

                while ($row = mysqli_fetch_array($result))
                {

                    $speed = $row['speed'];
                    $time = $row['time'];
                    $power = $row['power'];
                    $imileage = $row['imileage'];
                    $vehicle_id = $row['vehicle_id'];
                    $vehicle_name=$vehicle_id;
                    $start_speed = $speed;
                    $start_time = $time;

                    // -------------------------------------------------------------------------------------------------------------------------------
                    if ($start_speed > '0' && $power == '1')
                    {

                        if ($i == 0)
                        {
                            $pre_time = $time;
                        }
                        // echo $time . ' => ' . $speed . '<br>';
                        $d1 = strtotime($start_time);
                        $d2 = strtotime($pre_time);

                        $totalSecondsDiff = abs($d1 - $d2); //42600225
                        // echo $start_time . ' - ' . $pre_time . '<br>';
                        $totalMinutesDiff = $totalSecondsDiff / 60;
                        // echo 'Diff => ' . $totalMinutesDiff . '<br>';
                        $final_time = $final_time + $totalMinutesDiff;
                        // echo 'cal => ' . $final_time . '<br>';
                        

                        $pre_speed = $start_speed;
                        $pre_time = $start_time;
                        $i++;
                        $pre_speed = $start_speed;
                        $pre_time = $start_time;
                    }
                    else
                    {
                        // $pre_speed = $time;
                        $pre_time = $start_time;
                    }
                    // ---------------------------------------------------------------------------------------------------------------------------------
                    if ($start_speed == '0' && $power == '1')
                    {
                        $idel_start_time = $time;

                        if ($k == 0)
                        {
                            $idel_pre_time = $time;
                        }
                        // echo $time . ' => ' . $speed . '<br>';
                        $idel_d1 = strtotime($idel_start_time);
                        $idel_d2 = strtotime($idel_pre_time);

                        $idel_totalSecondsDiff = abs($idel_d1 - $idel_d2); //42600225
                        // echo $idel_start_time . ' - ' . $idel_pre_time . '<br>';
                        $idel_totalMinutesDiff = $idel_totalSecondsDiff / 60;
                        // echo 'Diff => ' . $idel_totalMinutesDiff . '<br>';
                        $idel_final_time = $idel_final_time + $idel_totalMinutesDiff;
                        // echo 'cal => ' . $idel_final_time . '<br>';
                        $idel_pre_time = $idel_start_time;
                        $k++;

                    }
                    else
                    {
                        // $pre_speed = $time;
                        $idel_pre_time = $pre_time;
                    }

                   
                    if ($j == $number)
                    {
                        $last_stop = $time;
                    }
                    else if ($j == 1)
                    {
                        $first_start = $time;

                    }

                    $j++;
                    

                }

                $sql__2 = "SELECT MAX(pos.speed) as maxx,MIN(pos.speed) as minn, AVG(speed) AS Averagespeed FROM positions as pos where pos.speed>'0' and pos.device_id='$vehicle' and pos.time>'$value 00:00:00' and pos.time<'$value 23:59:59' order by pos.time asc;";
                $result__2 = mysqli_query($db, $sql__2);
               
                    while ($row = mysqli_fetch_array($result__2))
                    {
                        $maxx = $row['maxx'];
                        $minn = $row['minn'];
                        $Averagespeed = floatval($row['Averagespeed']);

                        if($maxx==null && $maxx==null){
                            $min_ =0;
                            $max_ =0;
                        }
                        else{
                            $min_ = $minn;
                            $max_ = $maxx;
                        }
    
                       
    
                    }

                



                $sql__3 = "SELECT(SELECT odometer as imileage FROM positions where device_id='$vehicle' and time>'$value 00:00:00' and time<'$value 23:59:59'  order by time asc limit 1)  AS first,(SELECT odometer as imileage FROM positions where device_id='$vehicle' and time>'$value 00:00:00' and time<'$value 23:59:59'  order by time desc limit 1)  AS last;";
                $result__3 = mysqli_query($db, $sql__3);

                while ($row = mysqli_fetch_array($result__3))
                {
                    $first_odo = floatval($row['first']);
                    $last_odo = floatval($row['last']);
                    

                    $calculated_odo_ = $last_odo- $first_odo;

                }

                // echo 'Date => ' . $value . '<br>';
                // echo 'Vehicle => ' . $vehicle_name . '<br>';
                // echo 'Start Time => ' . $first_start . '<br>';
                // echo 'End Time => ' . $last_stop . '<br>';
                // echo 'Minimun Speed => ' . $min_ . '<br>';
                // echo 'Maximum Speed => ' . $max_ . '<br>';
                // echo 'Distance => ' . $calculated_odo_ . '<br>';

                $c_d1 = strtotime($first_start);
                $c_d2 = strtotime($last_stop);

                $c_totalSecondsDiff = abs($c_d2 - $c_d1); //42600225
                // echo $start_time . ' - ' . $pre_time . '<br>';
                $c_totalMinutesDiff = $c_totalSecondsDiff / 60;
                // echo 'Total time => ' . $c_totalMinutesDiff . '<br>';
                $total_stop_time = ($c_totalMinutesDiff - $final_time - $idel_final_time);
                // echo 'Idel Duration => ' . convert_time($idel_final_time * 60) . '<br>';
                // echo 'Stop Duration => ' . convert_time($total_stop_time * 60) . '<br>';
                // echo 'Moving Duration => ' . convert_time($final_time * 60) . '<br>';

                    $users_arr_date[] = array(
                        'date'=>$value,
                        'vehicle_name'=>$vehicle_name,
                        'start_time'=>$first_start,
                        'end_time'=>$last_stop,
                        'min_speed'=>$min_,
                        'max_speed'=>$max_,
                        'Averagespeed'=>$Averagespeed,
                        'distance'=>$calculated_odo_,
                        'idel_duration'=>convert_time($idel_final_time * 60),
                        'Stop_duration'=>convert_time($total_stop_time * 60),
                        'moving_duration'=>convert_time($final_time * 60),
                        
                    );

                    
                // echo json_encode($users_arr);
                // $users_arr_date[] = array($users_arr);
                

                $final_time = 0;
                $idel_final_time = 0;
                $final_mile = 0;
                // $l=0;
            }
            else
            {
                // echo 'No Data <br>';
                $vehicle_name = $_POST['vehicle_name'];

                $users_arr_date[] = array(
                    'date'=>$value,
                    'vehicle_name'=>$vehicle_name,
                    'start_time'=>0,
                    'end_time'=>0,
                    'min_speed'=>0,
                    'max_speed'=>0,
                    'Averagespeed'=>0,
                    'distance'=>0,
                    'idel_duration'=>0,
                    'Stop_duration'=>0,
                    'moving_duration'=>0,
                    
                );

            }

        }

        echo json_encode($users_arr_date);
        

        
    }
    else
    {
        echo 'False';
    }
}

function displayDates($date1, $date2, $format = 'Y-m-d')
{
    $dates = array();
    $current = strtotime($date1);
    $date2 = strtotime($date2);
    $stepVal = '+1 day';
    while ($current <= $date2)
    {
        $dates[] = date($format, $current);
        $current = strtotime($stepVal, $current);
    }
    return $dates;
}

function convert_time($mili)
{

    $init = $mili;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;

    // echo "$hours:$minutes:$seconds";
    $con = $hours . 'h' . $minutes . 'm' . $seconds . 's';
    return $con;

}
?>
