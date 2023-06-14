<?php
    session_start();
    include("../../config.php");
    if(isset($_POST)){
       
            $users_arr = array();
            $products_arr=array();
            
            $sql="SELECT consignee_name,location,Coordinates FROM `geofenceing`";
            $result = mysqli_query($db,$sql);
            
            while( $row = mysqli_fetch_array($result) ){
                // $userid = $row['id'];
                $name = $row['consignee_name'];
                $location = $row['consignee_name'];
                $coordinates = $row['Coordinates'];
            
                $product_item = array("consignee_name" => $name,
            "coordinates" => $coordinates,
            "location" => $location,
            );
                // $users_arr[] = array('name' =>$name,'lat' =>$lat,'lng' =>$lng,'speed' =>$speed,'time' =>$time);
                array_push($products_arr, $product_item);
            }
            // print_r($users_arr);

            // echo 'True '.$data;
            
                echo json_encode($products_arr);
                
       
    }
?>