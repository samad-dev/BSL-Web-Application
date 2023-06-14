<?php
    session_start();
    include("../../config.php");
    if(isset($_POST)){
        $trip_id = $_POST['trip_id'];
        if($trip_id!="" ){
            $users_arr = array();
            $sql="SELECT tc.id as trip_sub_id,ts.*,tc.*,us.name as client_name,origin_geo.consignee_name as origin_name,tc.destination_name as destination_name,dc.name as vehicle_name,dc.location,dd.name as driver_name FROM bsl.trips_child_non_dedicated as tc 
            join trips_non_dedicated as ts on ts.id=tc.main_id
            join users as us on us.id=tc.client
            join geofenceing origin_geo on origin_geo.id=tc.origin
            join driver_detail as dd on dd.id=ts.driver
            join devices dc on dc.id=ts.vehicle where ts.id=$trip_id";
            $result = mysqli_query($db,$sql);
            
            while( $row = mysqli_fetch_array($result) ){
                // $userid = $row['id'];
               
            
                $users_arr[] = $row;
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