<?php
session_start();
ini_set('max_execution_time', -1);
?>

<?php
if($_SESSION["user_id"]) {
?>
    <!-- <input type="hidden"> -->
<?php
}else {
    echo "<h1>Please login first .</h1>";
    header("location: index.php");
}

?>

