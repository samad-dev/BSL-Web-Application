<?php  
include("../../config.php");
session_start();
 
 if(!empty($_POST))  
 {  
    $output = '';  
    $message = '';  
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $type = mysqli_real_escape_string($db,$_POST['type']);
    $lati = mysqli_real_escape_string($db,$_POST['lati']); 
    $radi = mysqli_real_escape_string($db,$_POST['radius']);  
    $code1 = ""; 
    $address = mysqli_real_escape_string($db,$_POST['name']); 
    
    $type = mysqli_real_escape_string($db,$_POST['type']); 
    $geotype = mysqli_real_escape_string($db,$_POST['geotype']);

    
    $user_id = $_SESSION['user_id']; 

    $date = date('Y-m-d H:i:s');
        
      if($_POST["employee_id"] != '')  
      {  
           $query = "UPDATE `bsl`.`geofenceing`
           SET
           `consignee_name` = '$name',
           `location` = '$name',
           `Coordinates` = '$lati',
           `radius` = '$radi',
           `type` = '$type',
           `geotype` = '$geotype'
           WHERE `id`='".$_POST["employee_id"]."'";  
           $output = 'Data Updated';  
      }  
      else  
      {  
           $query = "INSERT INTO geofenceing
           (code,
            consignee_name,
            location,
            Coordinates,
            radius,
            userid,
            type,
            geotype,
            created_at,
            created_by)
            VALUES
           ('$code1',
            '$name',
            '$address',
            '$lati',
            '$radi',
            '$user_id',
            '$type',
            '$geotype',
            '$date',
            '$user_id');"; 
           $output = 'Data Inserted';  
      }  
      if(mysqli_query($db, $query))  
      {  
        $output = 1;
           
      }
      else{
        $output = 0;
      }
      echo $output;  
 }  
 ?>