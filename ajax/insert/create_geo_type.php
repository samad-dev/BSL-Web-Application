<?php  
include("../../config.php");
session_start();
 
 if(!empty($_POST))  
 {  
    $output = '';  
    $message = '';  
    $name = mysqli_real_escape_string($db, $_POST["name"]);  
   
    $user_id = $_SESSION['user_id']; 

    $date = date('Y-m-d H:i:s');
        
      if($_POST["employee_id"] != '')  
      {  
           $query = "UPDATE `bsl`.`geofence_type`
           SET
           `type` = '$name'
           WHERE `id`='".$_POST["employee_id"]."'";  
           $output = 'Data Updated';  
      }  
      else  
      {  
           $query = "INSERT INTO `geofence_type`
           (`type`,
           `created_at`,
           `created_by`)
           VALUES
           ('$name',
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