<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Transit Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & History Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$resultdevice = mysqli_query($db, "SELECT * FROM devices;");
$result = mysqli_query($db, "SELECT *,SUBTIME(eta_hour, transit_time1) as delay,SUBTIME(et2, transit_time2) as delay2 from transit_report;");
$resultuser = mysqli_query($db, "SELECT * FROM users;");
if (isset($_GET['vehicle'])) {
    $result = mysqli_query($db, "SELECT *,SUBTIME(eta_hour, transit_time1) as delay,SUBTIME(et2, transit_time2) as delay2 from transit_report where vehicle in(" . $_GET['vehicle'] . ") and created_at >='" . $_GET['from'] . "' and created_at <='" . $_GET['to'] . "'; ");
    echo "SELECT *,SUBTIME(eta_hour, transit_time1) as delay,SUBTIME(et2, transit_time2) as delay2 from transit_report where vehicle in(" . $_GET['vehicle'] . ") and created_at >='" . $_GET['from'] . "' and created_at <='" . $_GET['to'] . "';";
}
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
                                <h4 class="mb-sm-0 font-size-18">Transit Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Transit Report</a>
                                        </li>
                                        <li class="breadcrumb-item active">Transit Report</li>
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
                                        <th colspan="17" class="border border-dark text-center">UP Trip</th>
                                        <th colspan="8" class="border border-dark text-center">Down Trip</th>
                                    </tr>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Vehicle</th>
                                        <th>Size</th>
                                        <th>Client</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Std TT</th>
                                        <th>Current Status</th>
                                        <th>Current Location</th>
                                        <th>Departure</th>
                                        <th>ETA</th>
                                        <th>Arrival</th>
                                        <th>Delivery</th>
                                        <th>Transit Time</th>
                                        <th>Delay</th>
                                        <th>Offloading Time</th>
                                        <th>Remarks</th>
                                        <th>Std TT</th>
                                        <th>Status</th>
                                        <th>Departure Date</th>
                                        <th>ETA</th>
                                        <th>Arrival</th>
                                        <th>Current Location</th>
                                        <th>Transit Time</th>
                                        <th>Delay</th>
                                        <th>Remarks</th>
                                        <th>Track Trip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // loop through each row using a for loop
                                        for ($i = 0; $i < $result->num_rows; $i++) {
                                            // move the result pointer to the i-th row
                                            $result->data_seek($i);
                                            // fetch the row data as an associative array
                                            $row = $result->fetch_assoc();
                                            // output the row data
                                            // echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Email: " . $row['origin_p'] . "<br>";
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['size'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['client_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['origin_p'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['dest_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['eta_hour'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['current_status'] ?>
                                                </td>
                                                <?php

                                                $curl = curl_init();

                                                curl_setopt_array(
                                                    $curl,
                                                    array(
                                                        CURLOPT_URL => 'http://119.160.107.173:3002/location_name/' . $row['lat'] . '/' . $row['lng'] . '',
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
                                                $response = json_decode($response);
                                                ?>
                                                <td>
                                                    <?php echo $response[0]->location; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['departure_time'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['eta'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['arrival_time'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['delivery_time'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['transit_time1'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['delay'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['offloading_time'] ?>
                                                </td>
                                                <td>
                                                    <?php echo ''; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['eta_hour'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['status2'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['departure2'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['eta2'] ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $row['arrival2'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $response[0]->location; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['transit_time2'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['delay2'] ?>
                                                </td>
                                                <td>
                                                    <?php echo ''; ?>
                                                </td>
                                                <td class="text-center"><a href="dedicated_track_trip.php?id=<?php echo $row['id'] ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></a></td>

                                            </tr>
                                            <?php
                                        }
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
            <h5 id="offcanvasRightLabel" id='title_edit'>Add History Report</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">

                                <div class="form-group col-md-12" id="user_div">
                                    <label for="inputAddress">Users</label><br>

                                    <select class="form-control all_select" name="user_id" id="user_id"
                                        style="width: 364px;height: 32px !important;"
                                        onchange="get_user_vehicles(this.value)">
                                        <option value="">Select User</option>
                                        <?php foreach ($resultuser as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>




                                <div class="col-md-12">
                                    <label class="form-label">From</label>
                                    <input type="datetime-local" class="form-control " id="from" name="from" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">To</label>
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
    var vehicles;
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
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
            {
                extend: 'pdfHtml5',
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

        var from1 = document.getElementById("from").value;
        var to1 = document.getElementById("to").value;
        var vehi_id = $('#vehi_id').val();
        var vehi_name = $('#vehi_id').text();
        const format1 = "YYYY-MM-DD";


        from = moment(from1).format(format1);
        to = moment(to1).format(format1);
        console.log(from)
        console.log(to)


        // var len_vehi = v_id.length;
        if (vehicles != "" && from != "" && to != "") {
            window.location.href = "transit.php?vehicle=" + vehicles + "&from=" + from + "&to=" + to;
        }

    }

    function get_user_vehicles(val) {
        if (val != "") {
            $.ajax({
                url: 'ajax/get/get_users_vehicle.php',
                type: 'POST',
                data: {
                    user_id: val
                },
                success: function (data) {
                    data = JSON.parse(data)
                    // console.log(data);



                    var len = data.length;
                    if (len > 0) {
                        // $('#' + region_id + '').off('change');
                        // $('#' + count_id + '').off('change');
                        var re = [];
                        var cu = [];
                        for (var i = 0; i < len; i++) {
                            var vehi_id = data[i]['devices_id'];
                            cu.push(vehi_id);

                        }
                        vehicles = cu.toString();
                        console.log(vehicles);
                        // $('#vehi_id').val(cu).change();

                    } else {
                        alert("No Vehicles Found");
                    }
                }
            });

        }
    }
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>