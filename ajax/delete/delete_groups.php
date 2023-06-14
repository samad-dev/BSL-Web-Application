<?php  
 include("../../config.php");

 $id=$_POST['employee_id'];
 
 
 $sql = "DELETE t1, t2 
 FROM geogence_group t1 
 JOIN geofence_group_sub t2 
 ON t1.id = t2.main_id 
 WHERE t1.id='".$_POST["employee_id"]."'";
//  echo $sql;
 if (mysqli_query($db, $sql)) {
     echo 1;
 } 
 else {
     echo 0;
 }
?> 
