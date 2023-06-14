<?php
include ("../../config.php");
session_start();

if (!empty($_GET))
{
    $output = '';
    $message = '';
    $vehi_id =  explode(',', $_GET['vehi_id']);
    $geo_id =  explode(',', $_GET['geo_id']);
    $overspeed_limit = $_GET['overspeed_limit'];


     $vehi_count = count($vehi_id);
    $geo_count = count($geo_id);

    $user_id = $_SESSION['user_id'];

    $date = date('Y-m-d H:i:s');

    if ($_GET["employee_id"] != '')
    {
        $query = "UPDATE `product` SET`product_name` = '$name' ,`category_type` = '$b_name',`product_unit_of_measurement` = '$o_name' WHERE `id`='" . $_GET["employee_id"] . "'";
        $output = 'Data Updated';
    }
    else
    {

        for ($j = 0;$j < $vehi_count;$j++)
        {
            $vehicle_id = $vehi_id[$j];

            foreach ($geo_id as $assign)
            {

                $sql1 = "INSERT INTO `bsl`.`vehicle_geofence`
                (`vehicle_id`,
                `geo_id`,
                `user_id`,
                `speed_limit`,
                `created_at`,
                `created_by`)
                VALUES
                ('$vehicle_id',
                '$assign',
                '$user_id',
                '$overspeed_limit',
                '$date',
                '$user_id');";

                if (mysqli_query($db, $sql1))
                {
                    $output = 1;

                }
                else
                {
                    $output = 0;
                }
            }

        

        }
        

    }

    echo $output;
}
?>