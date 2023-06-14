

<?php
    session_start();
    ini_set('memory_limit', '-1');

    include("../../config.php");
    if(isset($_POST)){
        $check = $_POST['check'];
        // $check = implode($check,',');

        if($check==='all'){
            $from = $_POST['from'];
            $to = $_POST['to'];
            if($from!=""){
                $users_arr = array();
                $sql="SELECT pos.id,pos.vehicle_id,pos.latitude,pos.longitude,pos.power,pos.speed,pos.time,pos.vlocation FROM positions as pos where  time>='$from' and time<='$to' order by time asc;";

                

                $result = mysqli_query($db,$sql);
                
                while( $row = mysqli_fetch_array($result) ){
                    // $userid = $row['id'];
                    $name = $row['vehicle_id'];
                    $lat = $row['latitude'];
                    $lng = $row['longitude'];
                    $power = $row['power'];
                    $speed = $row['speed'];
                    $time = $row['time'];
                    $location = $row['vlocation'];
                
                    $users_arr[] = array('name'=>$name,'lat'=>$lat,'lng'=>$lng,'power'=>$power,'speed'=>$speed,'time'=>$time,'location'=>$location);
                }
                // print_r($users_arr);

                // echo 'True '.$data;
                
                    echo json_encode($users_arr);
                    
            }else{
                echo 'False';
            }
        }
        else{

        

            // $check = implode($check,',');
            $from = $_POST['from'];
            $to = $_POST['to'];
            if($from!=""){
                $users_arr = array();
                
                $sql = "SELECT pos.id,pos.vehicle_name,pos.latitude,pos.longitude,pos.power,pos.speed,pos.time,pos.address FROM positions as pos where device_id IN ($check) and time>='$from' and time<='$to' order by time asc;";
                $result = mysqli_query($db,$sql);
                
                while( $row = mysqli_fetch_array($result) ){
                    // $userid = $row['id'];
                    $name = $row['vehicle_name'];
                    $lat = $row['latitude'];
                    $lng = $row['longitude'];
                    $power = $row['power'];
                    $speed = $row['speed'];
                    $time = $row['time'];
                    $location = $row['address'];
                
                    $users_arr[] = array('name'=>$name,'lat'=>$lat,'lng'=>$lng,'power'=>$power,'speed'=>$speed,'time'=>$time,'location'=>$location);
                }
                // print_r($users_arr);

                // echo 'True '.$data;
                
                    echo json_encode($users_arr);
                    
            }else{
                echo 'False';
            }
        }
    }
?>