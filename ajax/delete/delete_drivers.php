<?php  
 include("../../config.php");

 $id=$_POST['employee_id'];
 
 
 $sql = "DELETE FROM driver_detail WHERE id='".$_POST["employee_id"]."'";
//  echo $sql;
 if (mysqli_query($db, $sql)) {
     echo 1;
 } 
 else {
     echo 0;
 }
?> 