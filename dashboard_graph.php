<?php
// session_start();
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Dashboard | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<style>
.text-muted {
    width: max-content;
}

.card-body,
:root .card {
    border-radius: 10px !important;
}

.text-muted {
    color: #FFF !important;
}
</style>
<script>
var graph_values = [];
var graph_voilation = [];
</script>

<?php
$todate = date("Y-m-d H:i:s", time());
$prev_date = date("Y-m-d H:i:s", strtotime($todate . ' -1 day'));
include("config.php");
$id = $_GET['id'];
$from = $_GET['from'];
$to = $_GET['to'];


$user_info = "SELECT * FROM bsl.users as us join user_alerts_define as uad on uad.user_id=us.id where us.id=$id";

// echo $sql;

$result_user_info = mysqli_query($db, $user_info);
$user_info_row = mysqli_fetch_array($result_user_info);
$user_overspeed = $user_info_row['overspeed'];
$user_idle = $user_info_row['idle'];
$user_nr = $user_info_row['nr'];


$user_idle_time = date("Y-m-d H:i:s", strtotime($todate . ' -' . $user_idle . ' minutes'));
$user_nr = date("Y-m-d H:i:s", strtotime($todate . ' -' . $user_nr . ' hour'));



$all_devices = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude FROM users_devices as ud 
join devices as dc on dc.id=ud.devices_id where ud.users_id='$id'");
$count_all_devices = mysqli_num_rows($all_devices);

$moving_devices = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude FROM  users_devices as ud 
join  devices as dc on dc.id=ud.devices_id where  dc.speed>0 and  dc.speed < '$user_overspeed' and dc.time >='$prev_date' and ud.users_id='$id'");
$count_moving_devices = mysqli_num_rows($moving_devices);

$stop_devices = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude FROM  users_devices as ud 
join  devices as dc on dc.id=ud.devices_id where dc.speed=0 and dc.ignition = '0' and dc.time >='$prev_date' and ud.users_id='$id';");
$count_stop_devices = mysqli_num_rows($stop_devices);

$idle_devices = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude FROM  users_devices as ud 
join  devices as dc on dc.id=ud.devices_id where dc.speed = 0 and dc.ignition ='1' and dc.time >='$user_idle_time' and ud.users_id='$id'");
$count_idle_devices = mysqli_num_rows($idle_devices);

$nr_devices = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude FROM  users_devices as ud 
join  devices as dc on dc.id=ud.devices_id where dc.time <='$user_nr' and ud.users_id='$id'");
$count_nr_devices = mysqli_num_rows($nr_devices);

$overspeed_devices = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude FROM  users_devices as ud 
join  devices as dc on dc.id=ud.devices_id where dc.speed>='$user_overspeed' and dc.time >='$prev_date' and ud.users_id='$id'");
$count_overspeed_devices = mysqli_num_rows($overspeed_devices);

$harsh_break = mysqli_query($db, "SELECT et.*,dc.name FROM bsl.users_devices as ud join event as et on et.object=ud.devices_id join devices as dc on dc.id=ud.devices_id where ud.users_id='$id' and et.value=2 and et.time>='$from' and et.time<='$to';");
$count_harsh_break = mysqli_num_rows($harsh_break);
$harsh_acc = mysqli_query($db, "SELECT et.*,dc.name FROM bsl.users_devices as ud join event as et on et.object=ud.devices_id join devices as dc on dc.id=ud.devices_id where ud.users_id='$id' and et.value=1 and et.time>='$from' and et.time<='$to';");
$count_harsh_acc = mysqli_num_rows($harsh_acc);
$harsh_corner = mysqli_query($db, "SELECT et.*,dc.name FROM bsl.users_devices as ud join event as et on et.object=ud.devices_id join devices as dc on dc.id=ud.devices_id where ud.users_id='$id' and et.value=3 and et.time>='$from' and et.time<='$to';");
$count_harsh_corner = mysqli_num_rows($harsh_corner);
$geo_check_in = mysqli_query($db, "SELECT dc.name,dc.tracker as vehicle_make,dc.time,dc.speed,dc.location as vlocation ,dc.lat as latitude,dc.lng as longitude,vg.speed_limit,geo.consignee_name FROM bsl.geo_in_check as gc 
join devices as dc on dc.id=gc.veh_id
join users_devices as ud on ud.devices_id=gc.veh_id 
join vehicle_geofence as vg on vg.vehicle_id=gc.veh_id 
join geofenceing as geo on geo.id=vg.geo_id
where dc.time >='$prev_date' and ud.users_id='$id' and vg.geo_id=gc.geo_id and vg.vehicle_id=gc.veh_id");
$count_geo_check_in = mysqli_num_rows($geo_check_in);

$night_voilation = mysqli_query($db, "SELECT da.*,dc.name FROM bsl.driving_alerts as da join devices as dc on dc.id=da.device_id where da.type='Night time violations' and da.created_at>='$from' and da.created_at<='$to' and da.created_by='$id';");
$count_night_voilation = mysqli_num_rows($night_voilation);

$all_overspeed = mysqli_query($db, "SELECT da.*,dc.name FROM bsl.driving_alerts as da join devices as dc on dc.id=da.device_id where da.type='Overspeed' and da.created_at>='$from' and da.created_at<='$to' and da.created_by='$id';");
$count_all_overspeed = mysqli_num_rows($all_overspeed);

$black_spot = mysqli_query($db, "SELECT da.*,dc.name FROM bsl.driving_alerts as da join devices as dc on dc.id=da.device_id where da.type='black_spot' and da.created_at>='$from' and da.created_at<='$to' and da.created_by='$id';");
$count_black_spot = mysqli_num_rows($black_spot);


echo "<script>";
echo "graph_values.push(" . round(($count_moving_devices/$count_all_devices)*100,2)  . ");";
echo "graph_values.push(" . round(($count_stop_devices/$count_all_devices)*100,2)  . ");";
echo "graph_values.push(" . round(($count_idle_devices/$count_all_devices)*100,2)  . ");";
echo "graph_values.push(" . round(($count_nr_devices/$count_all_devices)*100,2)  . ");";
echo "graph_values.push(" . round(($count_overspeed_devices/$count_all_devices)*100,2)  . ");";
echo "</script>";

echo "<script>";
echo "graph_voilation.push(" . $count_harsh_break  . ");";
echo "graph_voilation.push(" . $count_harsh_acc  . ");";
echo "graph_voilation.push(" . $count_harsh_corner  . ");";
echo "graph_voilation.push(" . $count_night_voilation  . ");";
echo "graph_voilation.push(" . $count_all_overspeed  . ");";
echo "graph_voilation.push(" . $count_black_spot  . ");";
echo "</script>";

?>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php include 'header.php' ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php' ?>
        <!-- Left Sidebar End -->
        <?php
       

        ?>



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">From</label>
                            <input type="date" class="form-control " id="from" name="from" required
                                value='<?php echo $_GET['from'] ?>'>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">To</label>
                            <input type="date" class="form-control " id="to" name="to" required
                                value='<?php echo $_GET['to'] ?>'>
                        </div>
                        <div class="col-md-2">
                            <button class="btn marron_bg mt-4" type="button" onclick='forward_date()'>Get Data</button>
                        </div>

                        <script>
                        function forward_date() {
                            var from = $('#from').val();
                            var to = $('#to').val();
                            if (from != "" && to != "") {
                                window.location = "dashboard.php?id=<?php echo $id;?>&from=" + from + "&to=" + to + "";
                            } else {
                                alert('Please Select Date')
                            }
                        }
                        </script>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h3 class="mb-sm-0 font-size-18">
                                    <?php echo $user_info_row['name']; ?> Dashboard
                                </h3>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='all_vehi_card' style="background-color: #738599;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Total
                                                Vehicles</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_all_devices; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>

                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='moving_vehi_card' style="background-color: #3a75b3;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Vehicles Currently
                                                Moving</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_moving_devices; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col-->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='stop_vehi_card' style="background-color: #ea7372;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block ">Vehicles Currently
                                                Stopped</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_stop_devices; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='idle_vehi_card' style="background-color: #e6b730;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Idle State</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_idle_devices; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='nr_vehi_card' style="background-color: #c24e9d;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">No Vehicles
                                                Activity Record</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_nr_devices; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='speed_vehi_card' style="background-color: #e63130;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Currently Speed
                                                Violation</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_overspeed_devices; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='harsh_breaking' style="background-color: #668b67;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Harsh Breaking</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_harsh_break; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='harsh_acce' style="background-color: #935c5c;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Harsh Acceleration</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_harsh_acc; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='harsh_corner' style="background-color: #90935c;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Harsh Cornering</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_harsh_corner; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='geofence_in' style="background-color: #5c0072;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Geofence In Vehicles</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_geo_check_in; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='night_voilation' style="background-color: #000;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Night Voilation</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_night_voilation; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='total_speed' style="background-color: #f00;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Total Speed Voilation</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_all_overspeed; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body" data-id='black_spot' style="background-color: #000;">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Black Spot</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light"
                                                    data-target="<?php echo $count_black_spot; ?>">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <!-- <div class="col-xl-3 col-md-6">
                            <div class="card card-h-100">
                                <div class="card-body" data-id='black_vehi_card'>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block">Black Spot</span>
                                            <h3 class="mb-3">
                                                <span class="counter-value text-light" data-target="1000">0</span>
                                            </h3>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- end row-->


                </div>
                <!-- container-fluid -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 device_listing" id='all_vehi_card' style="overflow: auto;">
                            <h3>All Devices</h3>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>
                                        <th>Tracker</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($all_devices)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>

                                        <td class="car_upper" style="background:#738599 !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vehicle_make"]; ?>
                                        </td>






                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='moving_vehi_card' style="overflow: auto;">
                            <h3>Moving Devices</h3>
                            <table id="example1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>
                                        <th>Tracker</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($moving_devices)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#3a75b3  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vehicle_make"]; ?>
                                        </td>






                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='stop_vehi_card' style="overflow: auto;">
                            <h3>Stop Devices</h3>
                            <table id="example2" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($stop_devices)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#ea7372  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>

                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>





                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='idle_vehi_card' style="overflow: auto;">
                            <h3>Idle Devices</h3>
                            <table id="example3" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($idle_devices)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td style="background:#e6b730  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>

                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>





                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='nr_vehi_card' style="overflow: auto;">
                            <h3>NR Devices</h3>
                            <table id="example4" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($nr_devices)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#c24e9d  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>

                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>





                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='speed_vehi_card' style="overflow: auto;">
                            <h3>Overspeed Devices</h3>
                            <table id="example5" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($overspeed_devices)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#e63130  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>

                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>





                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='harsh_breaking' style="overflow: auto;">
                            <h3>Harsh Breaking</h3>
                            <table id="example6" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th class="text-center">Track</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($harsh_break)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#668b67  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["msgid"]; ?>&geo=&type='Harsh Breaking'"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>




                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='harsh_acce' style="overflow: auto;">
                            <h3>Harsh Acceleration</h3>
                            <table id="example7" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th class="text-center">Track</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($harsh_acc)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#935c5c  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>

                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["msgid"]; ?>&geo=&type='Harsh Acceleration'"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>



                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='harsh_corner' style="overflow: auto;">
                            <h3>Harsh Cornering</h3>
                            <table id="example8" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Reporting Time</th>
                                        <th class="text-center">Track</th>





                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($harsh_corner)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td class="car_upper" style="background:#90935c  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["msgid"]; ?>&geo=&type='Harsh Cornering'"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>





                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 device_listing d-none" id='geofence_in' style="overflow: auto;">
                            <h3>Geofence In </h3>
                            <table id="example9" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Reg No</th>
                                        <th>Fence Name</th>
                                        <th>Reporting Time</th>
                                        <th>Location</th>
                                        <th>Coordinates</th>
                                        <th>Speed</th>
                                        <th>Speed Limit in fence</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($geo_check_in)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td style="background:#5c0072  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["consignee_name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["time"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["vlocation"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["latitude"] . ' , ' . $row["longitude"]; ?>
                                        </td>

                                        <td>
                                            <?php echo $row["speed"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["speed_limit"]; ?>
                                        </td>






                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='night_voilation' style="overflow: auto;">
                            <h3>Night Voilations </h3>
                            <table id="example10" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Alert Type</th>
                                        <th class="text-center">Alert</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Track</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($night_voilation)) {
                                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $i ?>
                                        </td>
                                        <td style="background:#000  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row["type"]; ?>
                                        </td>
                                        <td class="text-center" style="width:30%">
                                            <?php echo $row["message"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row["created_at"]; ?>
                                        </td>
                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["pos_id"]; ?>&geo=<?php echo $row["geo_id"]; ?>&type=<?php echo $row["type"]; ?>"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>









                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='total_speed' style="overflow: auto;">
                            <h3>Total Speed Voilation </h3>
                            <table id="example11" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Alert Type</th>
                                        <th class="text-center">Alert</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Track</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($all_overspeed)) {
                                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $i ?>
                                        </td>
                                        <td style="background:#f00  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row["type"]; ?>
                                        </td>
                                        <td class="text-center" style="width:30%">
                                            <?php echo $row["message"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row["created_at"]; ?>
                                        </td>
                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["pos_id"]; ?>&geo=<?php echo $row["geo_id"]; ?>&type=<?php echo $row["type"]; ?>"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>









                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 device_listing d-none" id='black_spot' style="overflow: auto;">
                            <h3>Black Spot </h3>
                            <table id="example12" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Alert Type</th>
                                        <th class="text-center">Alert</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Track</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($black_spot)) {
                                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $i ?>
                                        </td>
                                        <td style="background:#000  !important ;  color: #fff;">
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row["type"]; ?>
                                        </td>
                                        <td class="text-center" style="width:30%">
                                            <?php echo $row["message"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row["created_at"]; ?>
                                        </td>
                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["pos_id"]; ?>&geo=<?php echo $row["geo_id"]; ?>&type=<?php echo $row["type"]; ?>"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>









                                    </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Check In Vehicles</h4>
                                </div>
                                <div class="loader_load d-none" style="text-align: center;">
                                    <img src="images/loader_load.gif" alt="Loading..." style="height: 130px;" />
                                </div>
                                <div class="card-body">

                                    <div id="radial-chart"
                                        data-colors='["#2ab57d", "#5156be", "#fd625e", "#4ba6ef", "#ffbf53"]'
                                        class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">All Vehicles</h4>
                                </div>
                                <div class="loader_load d-none" style="text-align: center;">
                                    <img src="images/loader_load.gif" alt="Loading..." style="height: 130px;" />
                                </div>
                                <div class="card-body">

                                    <div id="radial-chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">All Violation</h4>
                                </div>
                                <div class="loader_load d-none" style="text-align: center;">
                                    <img src="images/loader_load.gif" alt="Loading..." style="height: 130px;" />
                                </div>
                                <div class="card-body">

                                    <div id="radial-chart_2" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->


            <?php include 'footer.php' ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script> -->

    <!-- apexcharts init -->
    <!-- <script src="assets/js/pages/apexcharts.init.js"></script> -->
</body>


<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example2').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example3').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example4').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example5').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example6').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example7').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example8').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example9').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example10').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example11').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('#example12').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });
    $('.card-body').click(function(event) {
        var id = $(this).data("id");
        $('.device_listing').addClass('d-none');
        $('#' + id + '').removeClass('d-none');
        console.log('id = ' + id);
    });

    // $('.loader_load').removeClass('d-none');
    // $.ajax({
    //     url: "ajax/get//get_geofence_check_in.php",
    //     method: "GET",
    //     data: {
    //         employee_id: "geo"
    //     },
    //     dataType: "json",
    //     success: function (data) {

    //         console.log(data)


    //         var pieColors = getChartColorsArray("#pie_chart"),
    //             options = {
    //                 chart: {
    //                     height: 420,
    //                     type: "pie"
    //                 },
    //                 series: JSON.parse(data.depot_count),
    //                 labels: JSON.parse(data.consignee_name),
    //                 colors: pieColors,
    //                 legend: {
    //                     show: !0,
    //                     position: "bottom",
    //                     horizontalAlign: "center",
    //                     verticalAlign: "middle",
    //                     floating: !1,
    //                     fontSize: "14px",
    //                     offsetX: 0
    //                 },
    //                 responsive: [{
    //                     breakpoint: 600,
    //                     options: {
    //                         chart: {
    //                             height: 240
    //                         },
    //                         legend: {
    //                             show: !1
    //                         }
    //                     }
    //                 }]
    //             };
    //         (chart = new ApexCharts(document.querySelector("#pie_chart"), options)).render();




    //     },
    //     complete: function (data) {
    //         $('.loader_load').addClass('d-none');
    //     }

    // });


    var radialChart = {
        chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total Vehicles',
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return "<?php echo $count_all_devices;?>"
                        }
                    }
                }
            }
        },
        series: graph_values,
        labels: ['Moving', 'Stopped', 'Idle', 'NR', 'Overspeed'],
        colors: ['#3a75b3', '#ea7372', '#e6b730', '#c24e9d', '#e63130'],
    }

    var chart = new ApexCharts(
        document.querySelector("#radial-chart"),
        radialChart
    );

    chart.render();


console.log(graph_voilation)
    var donutChart = {
        chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: false,
            }
        },
        series: graph_voilation,
        labels: ['Harsh Breaking', 'Harsh Acceleration', 'Harsh Cornering', 'Night Voilation', 'Total Speed Voilation', 'Black Spot'],
        colors: ['#668b67', '#935c5c', '#90935c', '#000', '#000'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    }
    var donut = new ApexCharts(
        document.querySelector("#radial-chart_2"),
        donutChart
    );

    donut.render();
});
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>