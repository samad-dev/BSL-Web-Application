<?php
include("sessioninput.php");
set_time_limit(0);
error_reporting(0);

?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Trip Stops Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Violation Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$result = mysqli_query($db, "SELECT ud.*,dc.name as vehi_name,us.name as username FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id;");
// $resultdevice = mysqli_query($db, "SELECT * FROM devices;");
$resultuser = mysqli_query($db, "SELECT * FROM users where privilege='Cartraige';");

$user_id = $_SESSION['user_id'];
$pre_role = $_SESSION['privilege'];


$resultdevice = mysqli_query($db, "SELECT dc.* FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id';");



?>


<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php include 'header.php' ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php' ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Trip Stops Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trip Stops Report</a>
                                        </li>
                                        <li class="breadcrumb-item active">Trip Stops Report</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                    class="fas fa-search"></i></button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>

                                        <th>Location</th>
                                        <th>Zone</th>
                                        <th>Stopped</th>
                                        <th>Stop Duration</th>
                                        <th>Driving Duration</th>
                                        <th>Distance</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['from'])) {


                                        $curl = curl_init();
                                        $from = $_GET['from'];
                                        $to = $_GET['to'];
                                        // echo 'http://119.160.107.173:3002/stop/'.$_GET['vehicle'].'/'.$from.'/'. $to.'';
                                        curl_setopt_array(
                                            $curl,
                                            array(
                                                CURLOPT_URL => 'http://119.160.107.173:3002/stop/' . $_GET['vehicle'] . '/' . str_replace(' ', '%20', $from) . '/' . str_replace(' ', '%20', $to) . '',
                                                CURLOPT_RETURNTRANSFER => true,
                                                CURLOPT_ENCODING => '',
                                                CURLOPT_MAXREDIRS => 10,
                                                CURLOPT_TIMEOUT => 0,
                                                CURLOPT_FOLLOWLOCATION => true,
                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                CURLOPT_CUSTOMREQUEST => 'GET',
                                            )
                                        );

                                        $response = curl_exec($curl);

                                        curl_close($curl);
                                        $response = json_decode($response, true);
                                        $array_size = count($response);
                                        $a = 0;
                                        $total_distance = 0;
                                        $total_driving_duration = 0;
                                        $total_stop_duration = 0;
                                        $i = 0;
                                        $stop_due1 = 0;
                                        for ($i; $i < $array_size; $i++) {
                                            $total_distance += $response[$i]['Distance'];

                                            // Convert the driving duration to seconds and add it to the total
                                            $driving_duration_parts = explode(':', $response[$i]['TripDuration']);
                                            $total_driving_duration += ($driving_duration_parts[0] * 3600) + ($driving_duration_parts[1] * 60);



                                            $fr = $response[$i]['Start Time'];
                                            $tr = $response[$i]['End Time'];
                                            $datetime_string = $response[$i]['End Time'];
                                            $datetime = new DateTime($datetime_string);
                                            $formatted_datetime = $datetime->format('Y-m-d H:i:s');
                                            $start_datetime = new DateTime($formatted_datetime);


                                            $datetime1 = new DateTime($from);
                                            $datetime2 = new DateTime($response[$i]['Start Time']);



                                            if ($i == 0 && $datetime1->format('Y-m-d H:i:s') != $datetime2->format('Y-m-d H:i:s')) {
                                                $curl = curl_init();
                                                curl_setopt_array(
                                                    $curl,
                                                    array(
                                                        CURLOPT_URL => 'http://119.160.107.173:3002/violation/' . $response[$i]['ObjectId'] . '/' . str_replace(' ', '%20', $datetime1->format('Y-m-d H:i:s')) . '/' . str_replace(' ', '%20', $datetime2->format('Y-m-d H:i:s')) . '/10',
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_ENCODING => '',
                                                        CURLOPT_MAXREDIRS => 10,
                                                        CURLOPT_TIMEOUT => 0,
                                                        CURLOPT_FOLLOWLOCATION => true,
                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                                    )
                                                );

                                                $response2 = curl_exec($curl);
                                                curl_close($curl);
                                                // echo $response1;
                                                $response2 = json_decode($response2, true);
                                                if ($response2 != null) {
                                                            
                                                            $stop_due1 = $response2[0]['Stationary_Hours'];
                                                            // echo $stop_due1;
                                                            echo '<tr>
                                            <td>0</td>
                                           
                                            <td></td>
                                            <td></td>
                                            <td>' . $datetime1->format('d-m-Y H:i:s') . '</td>
                                            <td>' . $stop_due1 . '</td>
                                            <td></td>
                                            <td> </td>
                                            <td></td>
                                            
                                        </tr>';
                                                }
                                            }



                                            if (isset($response[$i + 1]['Start Time'])) {

                                                $diff = abs(strtotime($tr) - strtotime($response[$i + 1]['Start Time']));
                                                // $diff = $tr->diff($fr);
                                                $years = floor($diff / (365 * 60 * 60 * 24));
                                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                                $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

                                                $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);

                                                $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));

                                                $stop_due = $hours . ':' . $minuts;

                                            } else {
                                                $curl = curl_init();
                                                // echo 'http://119.160.107.173:3002/violation/'.$response[$i]['ObjectId'].'/'.$formatted_datetime.'/'.str_replace(' ', '%20', $to).'/10';
                                                curl_setopt_array(
                                                    $curl,
                                                    array(
                                                        CURLOPT_URL => 'http://119.160.107.173:3002/violation/' . $response[$i]['ObjectId'] . '/' . str_replace(' ', '%20', $formatted_datetime) . '/' . str_replace(' ', '%20', $to) . '/10',
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_ENCODING => '',
                                                        CURLOPT_MAXREDIRS => 10,
                                                        CURLOPT_TIMEOUT => 0,
                                                        CURLOPT_FOLLOWLOCATION => true,
                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                                    )
                                                );

                                                $response1 = curl_exec($curl);
                                                curl_close($curl);
                                                // echo $response1;
                                                $response1 = json_decode($response1, true);
                                                if ($response1 != null) {
                                                }
                                                // echo $response1[0]['Stationary_Hours'];
                                                $stop_due = $response1[0]['Stationary_Hours'];
                                            }


                                            // Convert the stop duration to seconds and add it to the total
                                            $stop_duration_parts = explode(':', $stop_due);
                                            $total_stop_duration += ($stop_duration_parts[0] * 3600) + ($stop_duration_parts[1] * 60);

                                            echo '<tr>
                                            <td>' . ($i + 1) . '</td>
                                           
                                            <td>' . $response[$i]['End Location'] . '</td>
                                            <td></td>
                                            <td>' . $datetime->format('d-m-Y H:i:s') . '</td>
                                            <td>' . $stop_due . '</td>
                                            <td>' . $response[$i]['TripDuration'] . '</td>
                                            <td>' . $response[$i]['Distance'] . '</td>
                                            <td></td>
                                            
                                        </tr>';
                                            if ($i == $array_size - 1) {
                                                $driving_duration_parts = explode(':', $response1[0]['Driven_Hours']);
                                                $total_driving_duration += ($driving_duration_parts[0] * 3600) + ($driving_duration_parts[1] * 60);
                                                
                                                $curl = curl_init();
                                                // echo 'http://119.160.107.173:3002/mileage2/' . $response[$i]['ObjectId'] . '/' . str_replace(' ', '%20', $formatted_datetime) . '/' . str_replace(' ', '%20', $to) . '';
                                                curl_setopt_array(
                                                    $curl,
                                                    array(
                                                        CURLOPT_URL => 'http://119.160.107.173:3002/mileage2/' . $response[$i]['ObjectId'] . '/' . str_replace(' ', '%20', $formatted_datetime) . '/' . str_replace(' ', '%20', $to) . '',
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_ENCODING => '',
                                                        CURLOPT_MAXREDIRS => 10,
                                                        CURLOPT_TIMEOUT => 0,
                                                        CURLOPT_FOLLOWLOCATION => true,
                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                                    )
                                                );

                                                $response3 = curl_exec($curl);
                                                curl_close($curl);
                                                // echo $response1;
                                                $response3 = json_decode($response3, true);
                                                if ($response3 != null) {
                                                    $total_distance += $response3[0]['distance'];
                                                }
                                                echo '<tr>
                                            <td>' . ($i + 2) . '</td>
                                            
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>' . $response1[0]['Driven_Hours'] . '</td>
                                            <td>' . $response1[0]['total_distance'] . '</td>
                                            <td></td>
                                            
                                        </tr>';
                                            }
                                        }
                                        $stop_duration_parts1 = explode(':', $stop_due1);
                                        $total_stop_duration2 = ($stop_duration_parts1[0] * 3600) + ($stop_duration_parts1[1] * 60);
                                        $tt =  $total_stop_duration2+$total_stop_duration;
                                        $hours = floor($tt / 3600); // calculate the number of hours
                                        $minutes = gmdate("i", $tt); // calculate the number of minutes using the gmdate() function
                                        $hours2 = floor($total_driving_duration / 3600); // calculate the number of hours
                                        $minutes2 = gmdate("i", $total_driving_duration);
                                        
                                        echo '<tr>
                                            <th>' . ($i + 2) . '</th>
                                            
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th><b>' . $hours .':'.$minutes.'</b></th>
                                            <th><b>' . $hours2 .':'.$minutes2 . '</b></th>
                                            <th><b>' . round($total_distance,1) . '</b></th>
                                            <th></th>
                                            
                                        </tr>';
                                        // echo "Total distance: " . $total_distance . "<br>";
                                        // echo "Total driving duration: " . gmdate('H:i:s', $total_driving_duration) . "<br>";
                                        // echo "Total stop duration: " . gmdate('H:i:s', $total_stop_duration) . "<br>";
                                    }
                                    ?>



                                </tbody>

                            </table>
                        </div>
                    </div><!-- end row-->





                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <?php include 'footer.php' ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Trip Stops Report</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">

                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Asset</label>

                                    <select class="form-control" data-trigger name="vehi_id" id="vehi_id"
                                        placeholder="Search Asset" required>
                                        <option value="">Select Asset</option>
                                        <?php foreach ($resultdevice as $key => $value) { ?>
                                        <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>




                                <div class="col-md-12">
                                    <label class="form-label">From Date</label>
                                    <input type="datetime-local" class="form-control " id="from" name="from" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">To Date</label>
                                    <input type="datetime-local" class="form-control " id="to" name="to" required>
                                </div>

                            </div>




                            <div class="mb-3 text-center">
                                <button type="button" class="btn marron_bg" id="drawing"
                                    onclick="get_history()">Get</button>

                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
</body>

<script>
var table;
$(document).ready(function() {
    var from = "<?php echo $_GET['from']; ?>";
    var to = "<?php echo $_GET['to']; ?>";
    var ve = "<?php echo $_GET['name']; ?>";
    table = $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'csvHtml5',
                messageTop:"From: "+from+" | To: "+to+" | Vehicle Number:"+ve,
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'excelHtml5',
                messageTop:"From: "+from+" | To: "+to+" | Vehicle Number:"+ve,
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'copyHtml5',
                messageTop:"From: "+from+" | To: "+to+" | Vehicle Number:"+ve,
                exportOptions: {
                    columns: ':visible'
                },

            },
            {
                extend: 'pdfHtml5',
                messageTop:"From: "+from+" | To: "+to+" | Vehicle Number:"+ve,
                exportOptions: {
                    columns: ':visible'
                },

            },
            'colvis'
        ]
    });

});

function get_history() {

    var v_id = [];

    // $('#vehi_id :selected').each(function(key) {
    //     v_id[key] = $(this).val();


    // })
    var vehi_id = $('#vehi_id').val();
    var vehi_name = $('#vehi_id').text();
    var from1 = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    const format1 = "YYYY-MM-DD HH:mm:ss";
    var from = moment(from1).format(format1);
    var to = moment(to).format(format1);
    // var len_vehi = v_id.length;

    if (vehi_id != "" && from1 != "") {
        window.location.href = "trip_stops_report.php?vehicle=" + vehi_id + "&from=" + from + "&to=" + to+ "&name=" + vehi_name;

    } else {
        alert("Please Select Value")
    }

}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>