<?php  
include("../../config.php");
session_start();
 
 if(!empty($_POST))  
 {  
    $output = '';  
    $message = '';  
    $name = mysqli_real_escape_string($db, $_POST["name"]);  
    $email = ""; 
    $cnic = mysqli_real_escape_string($db, $_POST["cnic"]); 
    $contact = mysqli_real_escape_string($db, $_POST["contact"]); 
    $address = mysqli_real_escape_string($db, $_POST["address"]); 
    $vehi_id = mysqli_real_escape_string($db, $_POST["vehi_id"]); 
    $user_id = $_SESSION['user_id']; 

    $date = date('Y-m-d H:i:s');
        
      if($_POST["employee_id"] != '')  
      {  
           $query = "UPDATE `bsl`.`driver_detail`
           SET
           `name` = '$name',
           `email` = '$email',
           `cnic` = '$cnic',
           `mobile_no` = '$contact',
           `vehicle_id` = '$vehi_id',
           `file_no` = '$address'
           WHERE `id`='".$_POST["employee_id"]."'";  
           $output = 'Data Updated';  
      }  
      else  
      {  
           echo $query = "INSERT INTO `driver_detail`
           (`name`,
           `email`,
           `cnic`,
           `mobile_no`,
           `file_no`,
           `created_at`,
           `created_by`,
           `vehicle_id`)
           VALUES
           ('$name',
           '$email',
           '$cnic',
           '$contact',
           '$address',
           '$date',
           '$user_id',
           '$vehi_id');"; 
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