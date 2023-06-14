<?php  
include("../../config.php");
session_start();
 
 if(!empty($_POST))  
 {  
    $output = '';  
    $message = '';  
    $cart_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $vehi_id = $_POST['vehi_id'];

    
    $user_id = $_SESSION['user_id']; 

    $date = date('Y-m-d H:i:s');
        
      if($_POST["employee_id"] != '')  
      {  
           $query = "UPDATE `product` SET`product_name` = '$name' ,`category_type` = '$b_name',`product_unit_of_measurement` = '$o_name' WHERE `id`='".$_POST["employee_id"]."'";  
           $output = 'Data Updated';  
      }  
      else  
      {   
        
        foreach ($vehi_id as $assign) {
    
            
            $sql1 = "INSERT INTO  users_devices (`users_id`,`devices_id`)
            VALUES ('$cart_id','$assign')";
    
            if(mysqli_query($db, $sql1))  
            {  
            $output = 1;
                
            }
            else{
            $output = 0;
            }
        }
            
          
      }  
      
      echo $output;  
 }  
 ?>