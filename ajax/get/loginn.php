<?php
include("../../config.php");
session_start();


// username and password sent from form 

$myusername = mysqli_real_escape_string($db, $_POST['username']);
$mypassword = mysqli_real_escape_string($db, $_POST['password']);
// $mypassword = hash('sha256', $mypassword); 
// $mypassword = md5($mypassword);
$sql = "SELECT * FROM users WHERE login = '$myusername' and description = '$mypassword'";

// echo $sql;

$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
 
$count = mysqli_num_rows($result);
// echo $count;

// If result matched $myusername and $mypassword, table row must be 1 row
if($count>0){
    $_SESSION['email'] = $row['login'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['privilege'] = $row['privilege'];
    $status = $row['status'];
    if($status!='1'){
      $data[] = array(
        'user_id' => '',
        'result' => 2,
        'user_name' => $row['name'],
        'privilege' => $row['privilege']
      ); 
    }
    else{
      $data[] = array(
        'user_id' => $row['id'],
        'result' => 1,
        'user_name' => $row['name'],
        'privilege' => $row['privilege']
      ); 

    }
}
else{
   $data[] = array(
    'user_id' => '',
    'result' => 0
  ); 
  
}
echo json_encode($data); 
?>