<?php 
$todate=date("Y-m-d H:i:s", time());
$user_info = "SELECT * FROM bsl.users as us join user_alerts_define as uad on uad.user_id=us.id where us.id=$user";

// echo $sql;

		$result_user_info = mysqli_query($connect, $user_info);
		$user_info_row = mysqli_fetch_array($result_user_info);
		$user_overspeed = $user_info_row['overspeed'];
		$user_idle = $user_info_row['idle'];
		$user_nr = $user_info_row['nr'];


		$user_idle_time=date("Y-m-d H:i:s", strtotime($todate .' -'.$user_idle.' minutes'));
		$user_nr=date("Y-m-d H:i:s", strtotime($todate .' -'.$user_nr.' hour'));
?>