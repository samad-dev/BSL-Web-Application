<?php
include("sessioninput.php");
set_time_limit(0);

?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>BOWZER Location Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Violation Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$user_id = $_SESSION['user_id']; 
$pre_role = $_SESSION['privilege']; 

$result2 = mysqli_query($db,"SELECT distinct(us.name) as username FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id;");
$resultdevice = mysqli_query($db, "SELECT * FROM devices;");
// $resultuser = mysqli_query($db, "SELECT * FROM users where privilege='Cartraige';");

if($pre_role!='Admin'){
    $resultuser = mysqli_query($db, "SELECT * FROM users where privilege='End-User' and id=$user_id;");
    
}else{
    $resultuser = mysqli_query($db, "SELECT * FROM users where privilege='End-User';");
    
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
                                <h4 class="mb-sm-0 font-size-18">BOWZER Location Report </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">BOWZER Location Report </a>
                                        </li>
                                        <li class="breadcrumb-item active">BOWZER Location Report </li>
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
                                        <th>Vehicle No.</th>
                                        <th>Current Locaition (9:00 AM)</th>
                                        <th>Current Locaition (12:00 PM)</th>
                                        <th>Current Locaition (16:00 PM)</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(isset($_GET['vehicle']))
                                {
                                $result = mysqli_query($db, "SELECT dc.name as vehi_name,dc.id,us.name as username,ua.overspeed FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where us.name like '%".$_GET['vehicle']."%'");
                                 $from = $_GET['from'];
                                 echo $from;
                                 $starting_date = date('Y-m-01');

                                 // Get the ending date of the current month
                                 $ending_date = date('Y-m-t');
                                // $starting_date = $from.'-01';
                                // // echo $start_date;
                                // // Get the ending date of the current month
                                // $ending_date = date('Y-m-t');
                                    $i=0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            
                                            // echo 'http://119.160.107.173:3002/violation/'.$row["id"].'/'.str_replace(' ', '%20', $from).'/'.str_replace(' ', '%20', $to).'/'.$row["overspeed"].'';

                                            $curl = curl_init();

                                            curl_setopt_array(
                                                $curl,
                                                array(
                                                    CURLOPT_URL => 'http://119.160.107.173:3002/hour_report/'.$row["id"].'/'.$from.'',
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
                                            // echo $response;
                                            $response = json_decode($response, true);
                                            if($response != null)
                                            {
                                                // $que = "SELECT count(*) as count1 FROM bsl.driving_alerts where type = 'Night time violations' and device_id = ".$row['id']." and created_at>='".$starting_date." 00:00:00' and created_at<='".$ending_date." 23:59:00';";
                                                // $res = mysqli_query($db, $que);
                                                // // echo $que;
                                                // $resu = mysqli_fetch_array($res, MYSQLI_ASSOC);
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $response[0]['ObjectId'];?></td>
                                                    <?php 
                                                    $curl = curl_init();
                                                    // echo 'http://119.160.107.173:3002/location_name/'.$response[0]['9AM_Y'].'/'.$response[0]['9AM_X'].'';
                                                    curl_setopt_array(
                                                        $curl,
                                                        array(
                                                            CURLOPT_URL => 'http://119.160.107.173:3002/location_name/'.$response[0]['9AM_Y'].'/'.$response[0]['9AM_X'].'',
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
                                                    $response1 = json_decode($response1, true);
                                                    ?>
                                                    <td><?php echo $response1[0]['location'];?></td>
                                                    <?php 
                                                    $curl = curl_init();

                                                    curl_setopt_array(
                                                        $curl,
                                                        array(
                                                            CURLOPT_URL => 'http://119.160.107.173:3002/location_name/'.$response[0]['12PM_Y'].'/'.$response[0]['12PM_X'].'',
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
                                                    $response2 = json_decode($response2, true);
                                                    ?>
                                                    <td><?php echo $response2[0]['location'];?></td>
                                                    <?php 
                                                    $curl = curl_init();
                                                    
                                                    curl_setopt_array(
                                                        $curl,
                                                        array(
                                                            CURLOPT_URL => 'http://119.160.107.173:3002/location_name/'.$response[0]['4PM_Y'].'/'.$response[0]['4PM_X'].'',
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
                                                    $response3 = json_decode($response3, true);
                                                    ?>
                                                    <td><?php echo $response3[0]['location'];?></td>
                                                    <td><?php echo '';?></td>
                                                    
                                                </tr>
                                                <?php

                                            
                                            }
                                        }
                                    }

                                    if(isset($_GET['asset']))
                                {
                                    // echo "SELECT  distinct dc.name as vehi_name,dc.id,ua.overspeed FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where dc.id IN (" . $_GET['asset'] . ")";
                                $result = mysqli_query($db, "SELECT  distinct dc.name as vehi_name,dc.id FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where dc.id IN (" . $_GET['asset'] . ")");
                                 $from = $_GET['from'];
                                 echo $from;
                                 $starting_date = date('Y-m-01');

                                 // Get the ending date of the current month
                                 $ending_date = date('Y-m-t');
                                // $starting_date = $from.'-01';
                                // // echo $start_date;
                                // // Get the ending date of the current month
                                // $ending_date = date('Y-m-t');
                                    $i=0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            
                                            // echo 'http://119.160.107.173:3002/violation/'.$row["id"].'/'.str_replace(' ', '%20', $from).'/'.str_replace(' ', '%20', $to).'/'.$row["overspeed"].'';
                                            $curl = curl_init();

                                            curl_setopt_array(
                                                $curl,
                                                array(
                                                    CURLOPT_URL => 'http://119.160.107.173:3002/hour_report/'.$row["id"].'/'.$from.'',
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
                                            // echo $response;
                                            // echo $response;
                                            $response = json_decode($response, true);
                                            if($response != null)
                                            {
                                                // $que = "SELECT count(*) as count1 FROM bsl.driving_alerts where type = 'Night time violations' and device_id = ".$row['id']." and created_at>='".$starting_date." 00:00:00' and created_at<='".$ending_date." 23:59:00';";
                                                // $res = mysqli_query($db, $que);
                                                // // echo $que;
                                                // $resu = mysqli_fetch_array($res, MYSQLI_ASSOC);
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $response[0]['ObjectId'];?></td>
                                                    <?php 
                                                    $curl = curl_init();
                                                    // echo 'http://119.160.107.173:3002/location_name/'.$response[0]['9AM_Y'].'/'.$response[0]['9AM_X'].'';
                                                    curl_setopt_array(
                                                        $curl,
                                                        array(
                                                            CURLOPT_URL => 'http://119.160.107.173:3002/location_name/'.$response[0]['9AM_Y'].'/'.$response[0]['9AM_X'].'',
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
                                                    $response1 = json_decode($response1, true);
                                                    ?>
                                                    <td><?php echo $response1[0]['location'];?></td>
                                                    <?php 
                                                    $curl = curl_init();

                                                    curl_setopt_array(
                                                        $curl,
                                                        array(
                                                            CURLOPT_URL => 'http://119.160.107.173:3002/location_name/'.$response[0]['12PM_Y'].'/'.$response[0]['12PM_X'].'',
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
                                                    $response2 = json_decode($response2, true);
                                                    ?>
                                                    <td><?php echo $response2[0]['location'];?></td>
                                                    <?php 
                                                    $curl = curl_init();
                                                    // echo 'http://119.160.107.173:3002/location_name/'.$response[0]['4PM_X'].'/'.$response[0]['4PM_Y'].'';
                                                    curl_setopt_array(
                                                        $curl,
                                                        array(
                                                            CURLOPT_URL => 'http://119.160.107.173:3002/location_name/'.$response[0]['4PM_Y'].'/'.$response[0]['4PM_X'].'',
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
                                                    $response3 = json_decode($response3, true);
                                                    ?>
                                                    <td><?php echo $response3[0]['location'];?></td>
                                                    <td><?php echo '';?></td>
                                                    
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


            <?php include 'footer.php' ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Bowzer Report</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">
                            <div class="form-group col-md-12">
                                    <label for="inputAddress">Select By Vehicles</label>&nbsp

                                    <input type="checkbox" class="form-check-input" id="check"
                                        onclick="ShowHideDiv(this)">
                                </div>
                                <div class="form-group col-md-12" id="user">
                                    <label for="inputAddress">Users</label>

                                    <select class="form-control" data-trigger name="vehi_id" id="vehi_id"
                                        placeholder="Search Asset" required>
                                        <option value="">Select Users</option>
                                        <?php foreach ($resultuser as $key => $value) { ?>
                                            <option value="<?= $value['name']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12" id="asset" style="display:none">
                                    <label for="inputAddress">Select Asset</label>

                                    <select multiple class="form-control" data-trigger name="asset_id" id="asset_id"
                                        placeholder="Search Asset" required>
                                        <option value="">Select Asset</option>
                                        <?php foreach ($resultdevice as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>






                                <div class="col-md-12">
                                    <label class="form-label">SelectDate</label>
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
    <?php include 'script_tag.php' ?>
</body>

<script>
    function ShowHideDiv(chkPassport) {
        var asset = document.getElementById("asset");
        var dvPassport2 = document.getElementById("user");
        if (chkPassport.checked) {
            asset.style.display = "block";
            dvPassport2.style.display = "none";
        }
        else {
            asset.style.display = "none";
            dvPassport2.style.display = "block";
        }

    }
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
        var to = document.getElementById("from").value;
        // var len_vehi = v_id.length;
        from1 = from1;
        to = to;
        // if (vehi_id != "" && from != "") {
        //     window.location.href = "vts_new.php?vehicle=" + vehi_id + "&from=" + from1 + "&to=" + to;

        // } else {
        //     alert("Please Select Value")
        // }

        if ($('#check').is(":checked")) {
            
            var selected = $("#asset_id :selected").map((_, e) => e.value).get();
            // alert(selected);
            window.location.href = "hour_report.php?asset=" + selected + "&from=" + from1 + "&to=" + to;
            // alert('Check');
        }
        else {
            window.location.href = "hour_report.php?vehicle=" + vehi_id + "&from=" + from1 + "&to=" + to;
        }

        
    }
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>side