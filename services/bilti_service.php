<?php
date_default_timezone_set("Asia/Karachi");
ini_set('max_execution_time', -1);
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 200; URL=$url1");

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bsl');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
echo "<h1>Bilti service .</h1><br>";
$vehicle_name;
$date_time = date('Y-m-d h:i:s', strtotime("+15 days"));
$cur_time = date('Y-m-d H:i:s');

$sql_main = "SELECT * FROM `devices`";

$result_main = mysqli_query($db, $sql_main);
$count_main = mysqli_num_rows($result_main);
if ($count_main > 0) {
    while ($row_main = mysqli_fetch_array($result_main)) {
        $name  = str_replace("-", "%20", $row_main['name']);
        // echo '</br>';


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://119.160.107.120:8787/ords/buraq/rowapi1/'.$name.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($response != null) {
                $json_arr = json_decode($response, true);
                $i = 0;
                
                foreach ($json_arr['items'] as $item) {
                        $bilty_no = $item['bilty_no'];
                        $bilty_date = $item['bilty_date'];
                        $entry_date = $item['entry_date'];
                        $reference_bilty_no = $item['reference_bilty_no'];
                        $ref_challan_no = $item['ref_challan_no'];
                        $customer_name = $item['customer_name'];
                        $dedicated = $item['dedicated'];
                        $vehicle_size = $item['vehicle_size'];
                        $product_name = $item['product_name'];
                        $owner_name = $item['owner_name'];
                        $up_local = $item['up_local'];
                        $paid_topday = $item['paid_topday'];
                        $distributor_name = $item['distributor_name'];
                        $shipping_khi = $item['shipping_khi'];
                        $shipping_lhr = $item['shipping_lhr'];
                        $da_no = $item['da_no'];
                        $shipment_no = $item['shipment_no'];
                        $seal_no = $item['seal_no'];
                        $container1 = $item['container1'];
                        $container2 = $item['container2'];
                        $total_km = $item['total_km'];
                        $total_hrs = $item['total_hrs'];
                        $remarks = $item['remarks'];
                        $odo_mtr_start = $item['odo_mtr_start'];
                        $gen_meter_start = $item['gen_meter_start'];
                        $cooling_temp = $item['cooling_temp'];
                        $gate_in = $item['gate_in'];
                        $loading_start = $item['loading_start'];
                        $loading_end = $item['loading_end'];
                        $gate_out = $item['gate_out'];
                        $poh_gate_in = $item['poh_gate_in'];
                        $unloading_start = $item['unloading_start'];
                        $unloading_end = $item['unloading_end'];
                        $poh_gate_out = $item['poh_gate_out'];
                        $detention_days = $item['detention_days'];
                        $location_from = $item['location_from'];
                        $location_to = $item['location_to'];
                        $filling_temp = $item['filling_temp'];
                        $filling_gravity = $item['filling_gravity'];
                        $decanted_temp = $item['decanted_temp'];
                        $decanted_gravity = $item['decanted_gravity'];
                        $tracker_gen_hrs = $item['tracker_gen_hrs'];
                        $trip_no = $item['trip_no'];
                        $trolley_no = $item['trolley_no'];
                        $trip_start_date = $item['trip_start_date'];
                        $driver_name = $item['driver_name'];
                        $driver2_name = $item['driver2_name'];
                        $driver3_name = $item['driver3_name'];
                        $odo_meter_start = $item['odo_meter_start'];
                        $trip_days = $item['trip_days'];
                        $genset_meter_start = $item['genset_meter_start'];
                        $vehicle_no = $item['vehicle_no'];
                        $vehicle_category = $item['vehicle_category'];
                        $vehicle_type = $item['vehicle_type'];
                        $vehicle_make = $item['vehicle_make'];
                        $vehicle_total_tyre = $item['vehicle_total_tyre'];
                        $vehicle_axel = $item['vehicle_axel'];
                        $vehilce_spare_tyre = $item['vehilce_spare_tyre'];
                        $primary_no_tyre = $item['primary_no_tyre'];

                        $query = "INSERT INTO bilti_records (bilty_no, bilty_date, entry_date, reference_bilty_no, ref_challan_no, customer_name, dedicated, vehicle_size, product_name, owner_name, up_local, paid_topday, distributor_name, shipping_khi, shipping_lhr, da_no, shipment_no, seal_no, container1, container2, total_km, total_hrs, remarks, odo_mtr_start, gen_meter_start, cooling_temp, gate_in, loading_start, loading_end, gate_out, poh_gate_in, unloading_start, unloading_end, poh_gate_out, detention_days, location_from, location_to, filling_temp, filling_gravity, decanted_temp, decanted_gravity, tracker_gen_hrs, trip_no, trolley_no, trip_start_date, driver_name, driver2_name, driver3_name, odo_meter_start, trip_days, genset_meter_start, vehicle_no, vehicle_category, vehicle_type, vehicle_make, vehicle_total_tyre, vehicle_axel, vehilce_spare_tyre, primary_no_tyre) 
          VALUES ('$bilty_no', '$bilty_date', '$entry_date', '$reference_bilty_no', '$ref_challan_no', '$customer_name', '$dedicated', '$vehicle_size', '$product_name', '$owner_name', '$up_local', '$paid_topday', '$distributor_name', '$shipping_khi', '$shipping_lhr', '$da_no', '$shipment_no', '$seal_no', '$container1', '$container2', '$total_km', '$total_hrs', '$remarks', '$odo_mtr_start', '$gen_meter_start', '$cooling_temp', '$gate_in', '$loading_start', '$loading_end', '$gate_out', '$poh_gate_in', '$unloading_start', '$unloading_end', '$poh_gate_out', '$detention_days', '$location_from', '$location_to', '$filling_temp', '$filling_gravity', '$decanted_temp', '$decanted_gravity', '$tracker_gen_hrs', '$trip_no', '$trolley_no', '$trip_start_date', '$driver_name', '$driver2_name', '$driver3_name', '$odo_meter_start', '$trip_days', '$genset_meter_start', '$vehicle_no', '$vehicle_category', '$vehicle_type', '$vehicle_make', '$vehicle_total_tyre', '$vehicle_axel', '$vehilce_spare_tyre', '$primary_no_tyre')";

 echo $query;
$result = mysqli_query($db, $query);

// Check for errors
if (!$result) {
    echo 'Error: ' . mysqli_error($db);
}
                }
                
            }
        }

    }
} else {
    echo 'No Vehicle Found';
}


echo '<br>' . date('Y-m-d H:i:s');
