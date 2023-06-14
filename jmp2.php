<?php
// include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>History Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & History Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

    $result = mysqli_query($db, "SELECT * FROM bsl.positions where device_id = 14 and time >='2023-01-04' ORDER BY `id` asc;");

    // $result = $connect->query($sql_query) or die ("Error :".mysqli_error());
    $first_time = "";
    $end_time = "";
    $start_time = "";
    $first_last_time = "";
    $first_location = "";
    $last_time = "";
    $last_location = "";
    $users = array();
    $inside = array();

    while ($user = $result->fetch_assoc()) {

        if ($first_time == "") {
            if ($user["speed"] == '0') {
                // echo 'No Trip Started </br>';
            } else {
                $first_time = $user["time"];
                // echo 'Trip Started at '.$user["address"].'-'.$user["time"].'</br>';
                $first_location = $user["address"];
                $inside['start_time'] = $user["time"];
                $start_time = $user["time"];
            }

        } else {
            $last_time = $user["time"];
            if ($user["speed"] == '0') {

                $from_time = strtotime($start_time);
                $to_time = strtotime($last_time);
                $diff_minutes = round(abs($from_time - $to_time) / 60, 2) . " minutes";

                if ($diff_minutes >= 30) {
                    // echo 'Stop Duration: '.$diff_minutes.'</br>';
                    // echo 'Trip End  at '.$user["address"].'-'.$user["time"].'</br>';
                    $inside['end_time'] = $user["time"];
                    $inside['end_location'] = $user["address"];
                    $end_time = $user["time"];
                    $from_time = strtotime($start_time);
                    $to_time = strtotime($end_time);
                    $diff_minutes = round(abs($from_time - $to_time) / 60, 2) . " minutes";
                    $inside['running_time'] = $diff_minutes;

                    $users[] = array(
                        "start_time" => $first_time,
                        "start_loc" => $first_location,
                        "end_time" => $end_time,
                        "end_loc" => $user["address"],
                        "running_time" => $diff_minutes
                    );
                    $first_time = "";
                    $first_last_time = "";
                }


            }
        }


        // $users[] = $user;
    }
    $output = json_encode($users);
    ?>
<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include_once('header.php'); ?>


        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <?php include_once('sidebar.php'); ?>

                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <h1>JMP Report</h1>
                            <!-- <div class="row">
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">ADD</button>

                                </div>



                            </div> -->
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-12">
                            <div class="card" dir="rtl">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <p>گاڑی نمبر</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 4.3%;">
                                            <p>منزل</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>ٹرپ شروع ہونے کی تاریخ</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="date" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>منصوبے کے مطابق ٹرپ ختم ہونے کی تاریخ </p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="date" name="end_time" id="end_time">
                                        </div>





                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <p>1 ڈرائیور</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 5%;">
                                            <p>قائل نمبر</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>ڈیوٹی پر آنے کا وقت</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>موبائل نمبر</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="number" name="end_time" id="end_time">
                                        </div>





                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <p>2 ڈرائیور</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 5%;">
                                            <p>قائل نمبر</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>ڈیوٹی پر آنے کا وقت</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>موبائل نمبر</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="number" name="end_time" id="end_time">
                                        </div>





                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <p>بی ایس ایل ساؤتھ ترمینل  سے روانگی</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <p>شیل لیوب پلانٹ پر آمد</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>گاڑی کی بھرائی شروع ہونے کا وقت</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <p>گاڑی کی بھرائی مکمّل  ہونے کا وقت</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>





                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <p>شیل لیوب پلانٹ سے روانگی</p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <p>شپمنٹ نمبر </p>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="number" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-2">
                                            <p>پری ٹریپ بریفنگ کا انعقاد بذریعہ</p>
                                        </div>
                                        <div class="col-4">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-3" style="width:9%">
                                            <p>ٹول باکس میٹنگ کے موزوں پر بات چیت</p>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-3" style="width:9%">
                                            <p>رینڈم چیک باے</p>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                    <table class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Start DateTime</th>
                                                <th>Stop DateTime</th>
                                                <th>Driver</th>
                                                <th>Start Location</th>
                                                <th>Driving Time</th>
                                                <th>Stop Time</th>
                                                <th>Stop Location</th>
                                                <th>Stop Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $obj = json_decode($output, TRUE);
                                            $a = 1;
                                            foreach ($obj as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $value['start_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['end_time'] ?>
                                                    </td>
                                                    <?php
                                                    if ($a % 2 == 0) {
                                                        ?>
                                                        <td>
                                                            <?php echo '2'; ?>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <?php echo '1'; ?>
                                                        </td>

                                                        <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <?php echo $value['start_loc'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['running_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['running_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['end_loc'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo 'null'; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $a++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                
                                    </div>
                                
                                </div>
                            </div>
                            <!-- <div class="card">

                                <div class="card-body">
                                    <table class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Start DateTime</th>
                                                <th>Stop DateTime</th>
                                                <th>Driver</th>
                                                <th>Start Location</th>
                                                <th>Driving Time</th>
                                                <th>Stop Time</th>
                                                <th>Stop Location</th>
                                                <th>Stop Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $obj = json_decode($output, TRUE);
                                            $a = 1;
                                            foreach ($obj as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $value['start_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['end_time'] ?>
                                                    </td>
                                                    <?php
                                                    if ($a % 2 == 0) {
                                                        ?>
                                                        <td>
                                                            <?php echo '2'; ?>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <?php echo '1'; ?>
                                                        </td>

                                                        <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <?php echo $value['start_loc'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['running_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['running_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['end_loc'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo 'null'; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $a++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                             -->
                            <!-- end cardaa -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
                <!-- end page title -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->





        <div class="card">

            <div class="card-body">
                <div>

                    <div id="login-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Address</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="insert_form" enctype="multipart/form-data"
                                        class="ps-3 pe-3">

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Select Route</label>
                                                <select class="form-control select2" data-toggle="select2" id="user_id"
                                                    name="user_id">
                                                    <option>Select</option>
                                                    <?php foreach ($users as $key => $value) { ?>
                                                        <option value="<?= $value['id']; ?>">
                                                            <?= $value['route_name']; ?>
                                                        </option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label class="form-label">First Name </label>
                                                <input class="form-control" type="text" id="first_name"
                                                    name="first_name" required="" placeholder="First Name ">
                                            </div>
                                            <input type="hidden" name="employee_id" id="employee_id">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name </label>
                                                <input class="form-control" type="text" id="last_name" name="last_name"
                                                    required="" placeholder="Last Name ">
                                            </div>


                                            <div class="col-md-6">
                                                <label class="form-label">Address 1 </label>
                                                <input class="form-control" type="text" id="address_a" name="address_a"
                                                    required="" placeholder="Address 1">
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Address 2 </label>
                                                <input class="form-control" type="text" id="address_b" name="address_b"
                                                    required="" placeholder="Address 2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">City</label>
                                                <input class="form-control" type="text" id="city" name="city"
                                                    required="" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">State</label>
                                                <input class="form-control" type="text" id="state" name="state"
                                                    required="" placeholder="State">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Country</label>
                                                <input class="form-control" type="text" id="country" name="country"
                                                    required="" placeholder="Country">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Post Code</label>
                                                <input class="form-control" type="number" id="postcode" name="postcode"
                                                    required="" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    required="" placeholder="Email">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Phone</label>
                                                <input class="form-control" type="number" id="phone" name="phone"
                                                    required="" placeholder="Phone">
                                            </div>

                                        </div>




                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div><!-- end card body -->
    </div>
    </div>

    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->
   

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
   



</body>


<?php include 'script_tag.php'?>
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

    $('#vehi_id :selected').each(function(key) {
        v_id[key] = $(this).val();


    })

    var from1 = document.getElementById("from").value;
    var to1 = document.getElementById("to").value;
    const format1 = "YYYY-MM-DD HH:mm:ss";

    from = moment(from1).format(format1);
    to = moment(to1).format(format1);

    var len_vehi = v_id.length;


    if (len_vehi != 0 && from1 != "" && to1 != "") {
        $.ajax({
            url: '../attock/get_history_positions.php',
            type: 'POST',
            data: {
                check: v_id,
                from: from,
                to: to
            },
            beforeSend: function() {
                // $('#insert').val("Updating");
                $("#drawing").prop("disabled", true);
                $("#loader").show();
            },
            success: function(data) {
                data = JSON.parse(data)
                // console.log(data);
                table_html = data;
                console.log(table_html)

                var len = data.length;
                //alert("len "+len)
                var table = $('#example').DataTable();
                table
                    .clear()
                    .draw();

                if (len > 0) {
                    for (var i = 0; i < len; i++) {

                        // console.log(data[i].location);


                        var power;
                        if (data[i].power === '1') {
                            power = '1';
                        } else {
                            power = '0'
                        }

                        table
                            .row.add([(i + 1), data[i].name, data[i].location, power, data[i].speed,
                                data[i]
                                .time
                            ])
                            .draw()
                            .node();

                        // if(i===len){
                        //     $("#loader").hide();

                        // }





                    }







                } else {
                    alert("No Data Found");
                    $("#drawing").prop("disabled", false);
                }






            },
            complete: function(data) {
                // Hide image container
                $("#loader").hide();
                $("#drawing").prop("disabled", false);

            }
        });
    } else {
        alert("Please Select Value")
    }

}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>