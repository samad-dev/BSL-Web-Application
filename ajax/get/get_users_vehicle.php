<?php
session_start();
include("../../config.php");



if (!empty($_POST['user_id']))
{

    $user_id = $_POST['user_id'];
    // $multi_group_id = implode(",", $group_id);

    if ($user_id != "")
    {
        $users_arr = array();
        $sql = "SELECT * FROM bsl.users_devices where users_id='$user_id';";
        // echo $sql;
        $result = mysqli_query($db, $sql);

        while ($row = mysqli_fetch_array($result))
        {

            $users_arr[] = $row;
        }
        // print_r($users_arr);
        // echo 'True '.$data;
        echo json_encode($users_arr);

    }
    else
    {
        echo 'False';
    }
}
else{
    
    echo 'False';
}


?>
