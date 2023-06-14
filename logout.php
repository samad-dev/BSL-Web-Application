<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
unset($_SESSION["privilege"]);
header("Location:index.php");
?>