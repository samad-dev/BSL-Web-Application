<?php
include("sessioninput.php");
set_time_limit(0);

?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Weekly VTS Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Violation Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$user_id = $_SESSION['user_id'];
$pre_role = $_SESSION['privilege'];

$result2 = mysqli_query($db, "SELECT distinct(us.name) as username FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id;");
$resultdevice = mysqli_query($db, "SELECT * FROM devices;");
// $resultuser = mysqli_query($db, "SELECT * FROM users where privilege='Cartraige';");

if ($pre_role != 'Admin') {
    $resultuser = mysqli_query($db, "SELECT * FROM users where privilege='End-User' and id=$user_id;");

} else {
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
                                <h4 class="mb-sm-0 font-size-18">Weekly VTS Report </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Weekly VTS Report </a>
                                        </li>
                                        <li class="breadcrumb-item active">Weekly VTS Report </li>
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

                                <?php
                                if (isset($_GET['asset'])) {
                                    $result = mysqli_query($db, "SELECT  distinct dc.name as vehi_name,dc.id,ua.overspeed FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where dc.id IN (" . $_GET['asset'] . ")");

                                    // $result = mysqli_query($db, "SELECT dc.name as vehi_name,dc.id,us.name as username,ua.overspeed FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where us.name like '%".$_GET['vehicle']."%'");
                                    $from = $_GET['from'];
                                    // $starting_date = $from.'-01';
                                    // // echo $start_date;
                                    // // Get the ending date of the current month
                                    // $ending_date = date('Y-m-t');
                                    $starting_date = $_GET['from'];

                                    // Get the ending date of the current month
                                    $ending_date = $_GET['to'];
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {


                                        $curl = curl_init();
                                        // echo 'http://119.160.107.173:3002/activity2/'.$row["id"].'/'.$starting_date.'/'.$ending_date.'';
                                        curl_setopt_array(
                                            $curl,
                                            array(
                                                CURLOPT_URL => 'http://119.160.107.173:3002/activity2/' . $row["id"] . '/' . $starting_date . '/' . $ending_date . '',
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
                                        // $response = json_decode($response, true);
                                        $data = json_decode($response, true);

                                        // Get the first (and only) array from the decoded data
                                        $rowData = reset($data);
                                        if ($i == 1) {


                                            ?>

                                            <thead>
                                                <tr>

                                                    <th>S. No</th>
                                                    <th width="100%">Driver Name</th>
                                                    <th>File #</th>
                                                    <th rowspan="3">Vehicle Number</th>
                                                    <th width="100%">Working Hours</th>
                                                    <?php
                                                    // Loop through the dates and create table headers dynamically
                                                    foreach ($rowData as $date => $value) {
                                                        $timestamp = strtotime($date);
                                                        $day = date('D', $timestamp);
                                                        
                                                        echo '<th width="100%">'.$day.'|'.$date.'|Planned</th>';
                                                        echo '<th width="100%">'.$day.'|'.$date.'|Actual</th>';
                                                        if($day=='Sun')
                                                        {
                                                            echo '<th width="100%">Planned Total</th>';
                                                        echo '<th width="100%">Actual Total</th>';
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <?php
                                        }
                                        ?>
                                        <tbody>



                                            <tr>
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>Orangzeb</td>
                                                <td>4790</td>
                                                <td><?php echo $row["vehi_name"]; ?></td>
                                                <td>Duty</td>

                                                <?php
                                                // Loop through the dates and create table cells with fixed values for now
                                                $timestamp2 = 0;
                                                $timestamp3 = 0;

                                                foreach ($rowData as $date => $value) {
                                                    $planned_d = "12:00";
                                                    $actual_d = $value;
                                                    // $total_duration2 += strtotime("1970-01-01 $duration2 UTC");
                                                   
                                                     $timestamp2 += strtotime("1970-01-01 $planned_d UTC");
                                                     $timestamp3 += strtotime("1970-01-01 $actual_d UTC");
                                                    
                                                    echo '<td>12:00</td>';
                                                    echo '<td>' . $value . '</td>';
                                                    $timestamp = strtotime($date);
                                                    $day = date('D', $timestamp);
                                                    if($day=='Sun')
                                                    {
                                                        // echo $timestamp2.'<br>';
                                                        $init = $timestamp2;
                                                        $hours = floor($init / 3600);
                                                        $minutes = floor(($init / 60) % 60);
                                                        $seconds = $init % 60;
                                                        $init2 = $timestamp3;
                                                        $hours2 = floor($init2 / 3600);
                                                        $minutes2 = floor(($init2 / 60) % 60);
                                                        $seconds2 = $init2 % 60;
                                                        $time = date("H:i", $timestamp2);
                                                        $time2 = date("H:i", $timestamp3);
                                                        echo '<td>'."$hours:$minutes".'</td>';
                                                        echo '<td>' ."$hours2:$minutes2". '</td>';
                                                        $timestamp2 = 0;
                                                        $timestamp3 = 0;
                                                        
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Driving</td>

                                                <?php
                                                // Loop through the dates and create table cells with fixed values for now
                                                $timestamp2 = 0;
                                                $timestamp3 = 0;

                                                foreach ($rowData as $date => $value) {
                                                    $planned_d = "12:00";
                                                    $actual_d = $value;
                                                    // $total_duration2 += strtotime("1970-01-01 $duration2 UTC");
                                                   
                                                     $timestamp2 += strtotime("1970-01-01 $planned_d UTC");
                                                     $timestamp3 += strtotime("1970-01-01 $actual_d UTC");
                                                    
                                                    echo '<td>12:00</td>';
                                                    echo '<td>' . $value . '</td>';
                                                    $timestamp = strtotime($date);
                                                    $day = date('D', $timestamp);
                                                    if($day=='Sun')
                                                    {
                                                        // echo $timestamp2.'<br>';
                                                        $init = $timestamp2;
                                                        $hours = floor($init / 3600);
                                                        $minutes = floor(($init / 60) % 60);
                                                        $seconds = $init % 60;
                                                        $init2 = $timestamp3;
                                                        $hours2 = floor($init2 / 3600);
                                                        $minutes2 = floor(($init2 / 60) % 60);
                                                        $seconds2 = $init2 % 60;
                                                        $time = date("H:i", $timestamp2);
                                                        $time2 = date("H:i", $timestamp3);
                                                        echo '<td>'."$hours:$minutes".'</td>';
                                                        echo '<td>' ."$hours2:$minutes2". '</td>';
                                                        $timestamp2 = 0;
                                                        $timestamp3 = 0;
                                                        
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Rest</td>

                                                <?php
                                                // Loop through the dates and create table cells with fixed values for now
                                                $timestamp2 = 0;
                                                $timestamp3 = 0;

                                                foreach ($rowData as $date => $value) {
                                                    $planned_d = "12:00";
                                                    $actual_d = $value;
                                                    // $total_duration2 += strtotime("1970-01-01 $duration2 UTC");
                                                   
                                                     $timestamp2 += strtotime("1970-01-01 $planned_d UTC");
                                                     $timestamp3 += strtotime("1970-01-01 $actual_d UTC");
                                                    
                                                    echo '<td>12:00</td>';
                                                    echo '<td>' . $value . '</td>';
                                                    $timestamp = strtotime($date);
                                                    $day = date('D', $timestamp);
                                                    if($day=='Sun')
                                                    {
                                                        // echo $timestamp2.'<br>';
                                                        $init = $timestamp2;
                                                        $hours = floor($init / 3600);
                                                        $minutes = floor(($init / 60) % 60);
                                                        $seconds = $init % 60;
                                                        $init2 = $timestamp3;
                                                        $hours2 = floor($init2 / 3600);
                                                        $minutes2 = floor(($init2 / 60) % 60);
                                                        $seconds2 = $init2 % 60;
                                                        $time = date("H:i", $timestamp2);
                                                        $time2 = date("H:i", $timestamp3);
                                                        echo '<td>'."$hours:$minutes".'</td>';
                                                        echo '<td>' ."$hours2:$minutes2". '</td>';
                                                        $timestamp2 = 0;
                                                        $timestamp3 = 0;
                                                        
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                            $i++;
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
            <h5 id="offcanvasRightLabel" id='title_edit'>WeeklyReport</h5>
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
                                    <input type="month" class="form-control " id="from" name="from" required>
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

                }
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
        from1 = from1 + "-01";
        to = to + "-30";

        if ($('#check').is(":checked")) {

            var selected = $("#asset_id :selected").map((_, e) => e.value).get();
            // alert(selected);
            window.location.href = "weekly_report.php?asset=" + selected + "&from=" + from1 + "&to=" + to;
            // alert('Check');
        }
        else {
            window.location.href = "weekly_report.php?vehicle=" + vehi_id + "&from=" + from1 + "&to=" + to;
        }



    }
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>