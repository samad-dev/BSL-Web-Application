<?php
    session_start();
    include("../../config.php");
    if(isset($_POST)){
        $vehicle = $_POST['vehicle'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        if($vehicle!="" && $from!="" && $to!=""){
            $users_arr = array();
            $sql="SELECT * FROM positions where time>='$from 00:00:00' and time<='$to 23:59:59' and device_id=$vehicle";
            $result = mysqli_query($db,$sql);
            
            while( $row = mysqli_fetch_array($result) ){
                // $userid = $row['id'];
                $name = $row['vehicle_name'];
                $lat = $row['latitude'];
                $lng = $row['longitude'];
                $speed = $row['speed'];
                $time = $row['time'];
                $power = $row['power'];
                $location = $row['address'];
            
                $users_arr[] = array($name,$lat,$lng,$speed,$time,$power,$location);
                // $users_arr[] = array('name' =>$name,'lat' =>$lat,'lng' =>$lng,'speed' =>$speed,'time' =>$time);

            }
            // print_r($users_arr);

            // echo 'True '.$data;
            
                echo json_encode($users_arr);
                
        }else{
            echo 'False';
        }
    }
?>