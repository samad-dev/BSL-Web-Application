<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Night Vioaltion Report  | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Violation Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$result = mysqli_query($db,"SELECT distinct(us.name) as username FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id;");
$resultdevice = mysqli_query($db,"SELECT * FROM devices;");
$resultuser = mysqli_query($db,"SELECT * FROM users where privilege='Cartraige';");


?>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php include 'header.php'?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php'?>
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
                                <h4 class="mb-sm-0 font-size-18">Night Vioaltion Report  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Night Vioalation Report  </a>
                                        </li>
                                        <li class="breadcrumb-item active">Night Violation Report  </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-search"></i></button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Vehicle</th>
                                        <th>Total Driving Time In Night</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (isset($_GET['vehicle'])) {
                                        $result = mysqli_query($db, "SELECT dc.name as vehi_name,dc.id,us.name as username,ua.night_from,ua.night_to FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where us.name = '" . $_GET['vehicle'] . "'");
                                        $from = $_GET['from'];
                                        $from = $from+" 00:00:00";
                                        $to = $_GET['to'];
                                        $to = $to+" 00:00:00";
                                        while ($row = mysqli_fetch_array($result)) {
                                            $curl = curl_init();

                                            curl_setopt_array(
                                                $curl,
                                                array(
                                                    CURLOPT_URL => 'http://119.160.107.173:3002/night/432/2023-02-01',
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
                                            if ($response != null) 
                                            {
                                                ?>
                                                <tr>
                                                    <td>

                                                        <?php echo $response[0]['name']; ?>
                                                    </td>
                                                    <td>Speed Vioaltion</td>
                                                    <td>
                                                        <?php echo $response[0]['speedv']; ?>
                                                    </td>
                                                </tr>

                                                <?php

                                            }
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


            <?php include 'footer.php'?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Night Vioalation Report</h5>
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
                                        <?php foreach($result as $key => $value){ ?>
                                        <option value="<?= $value['username'];?>"><?= $value['username']; ?></option>
                                        <?php } 
                                                ?>
                                    </select>
                                </div>




                                <div class="col-md-12">
                                    <label class="form-label">From Date</label>
                                    <input type="date" class="form-control " id="from" name="from" required>
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
    <?php include 'script_tag.php'?>
</body>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
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
    // var len_vehi = v_id.length;


    if (vehi_id != "" && from != "") {
            window.location.href = "night.php?vehicle=" + vehi_id + "&from=" + from1 + "&to=" + to;

        } else {
            alert("Please Select Value")
        }

}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>