<?php  
 //fetch.php  
 include("../../config.php");

 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM bsl.users as us join user_alerts_define as ud on ud.user_id=us.id where us.id='".$_POST["employee_id"]."'";  
      $result = mysqli_query($db, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>