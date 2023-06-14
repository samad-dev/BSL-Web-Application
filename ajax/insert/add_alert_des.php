<?php  
include("../../config.php");
session_start();
$user_id=$_SESSION['user_id'];
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $cname = mysqli_real_escape_string($db, $_POST["cname"]);  
    
      if($_POST["alert_idd"] != '')  
      {  
           $query = "UPDATE driving_alerts   
           SET description='$cname'
            WHERE id='".$_POST["alert_idd"]."'";  
            $output = 'Data Updated  ';  
        }  
        else  
        {  
           
      }  
      if(mysqli_query($db, $query))  
      {  
          //  $output .= '<div class="alert alert-light-warning border-0 mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>'.$message.' !</strong></div>';  
          //  $output .= 1;  
         
           
      }  
      else{
          $output .= 'Error'.mysqli_error($db);  

      }
      echo $output;  
 }  
 ?>
