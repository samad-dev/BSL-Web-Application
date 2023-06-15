<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Users | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Users Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php

include("config.php");

// $result = mysqli_query($db, "SELECT us.id as user_id,us.*,uad.* FROM bsl.users as us join user_alerts_define as uad on uad.user_id=us.id");
$user_id = $_SESSION['user_id'];
$pre_role = $_SESSION['privilege'];

if ($pre_role == 'Admin') {
    $result = mysqli_query($db, "SELECT us.id as user_id,us.*,uad.* FROM bsl.users as us join user_alerts_define as uad on uad.user_id=us.id");
    $admin_dis = mysqli_query($db, "SELECT * FROM bsl.users where privilege='Distributor' or privilege='Admin'");
} elseif ($pre_role == 'Distributor') {
    $result = mysqli_query($db, "SELECT us.id as user_id,us.*,uad.* FROM bsl.distributor_end_user as de
    join users as us on us.id=de.end_user_id
    join user_alerts_define as uad on uad.user_id=us.id where de.distributor_id='$user_id';");
    $admin_dis = mysqli_query($db, "SELECT * FROM bsl.users where privilege='Distributor' or privilege='Admin' and id='$user_id'");
}
$admin_user = mysqli_query($db, "SELECT * FROM bsl.users where privilege='Admin'");



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
                                <h4 class="mb-sm-0 font-size-18">Users</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                        <li class="breadcrumb-item active">Users</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="font-size: 24px;">+</button>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Privilege</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>privilege</th>
                                        <th>Overspeed Limit</th>
                                        <th>Idle Duration</th>
                                        <th>Nr Duration</th>
                                        <th>Night Voilation</th>
                                        <th>Excess Driving</th>
                                        <th>Define Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>
                                            <td>
                                                <?php echo $row["name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["privilege"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["login"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["description"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["address"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["telephone"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["privilege"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["overspeed"]; ?> KM/HR
                                            </td>
                                            <td>
                                                <?php echo $row["idle"]; ?> Minutes
                                            </td>
                                            <td>
                                                <?php echo $row["nr"]; ?> Hours
                                            </td>
                                            <td>
                                                <?php echo $row["night_from"] . ' - ' . $row["night_to"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["excess_driving"]; ?> Hours
                                            </td>
                                            <td><i class=" fas fa-spell-check text-success check_right" id='<?php echo $row['user_id']; ?>'></i></td>
                                            <td><i class="fas fa-pencil-alt text-success edit_data" id='<?php echo $row['user_id']; ?>'></i></td>
                                            <td><i class="fas fa-trash-alt text-danger delete-btn" id='<?php echo $row['user_id']; ?>'></i></td>

                                        </tr>

                                    <?php
                                        $i++;
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
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content" style="margin-top: 75px; width:125%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                        Define Roles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_role_form" enctype="multipart/form-data">


                        <div class="row">
                            <table class="table table-flush permission-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Module</th>
                                        <th>Permissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Dashboarbs Tabs</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_harsh" name="dash_harsh" class="dash_harsh">
                                                        <span class="new-control-indicator"></span>Harsh Breaking
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_acce" name="dash_acce" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Harsh Acceleration
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_cornering" name="dash_cornering" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Harsh Cornering
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_geo_in" name="dash_geo_in" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Geofence In Vehicles
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_night_voilation" name="dash_night_voilation" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Night Driving Voilation
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_speed_voilation" name="dash_speed_voilation" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Total Speed Voilation
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_un_auth_stop" name="dash_un_auth_stop" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Un-Authorized Stops
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" value="1" id="dash_ecess_driving" name="dash_ecess_driving" class="new-control-input">
                                                        <span class="new-control-indicator"></span>Excess Driving (per Day)
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reports</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="report_nr" name="report_nr">
                                                        <span class="new-control-indicator"></span>NR Asset
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="asset_location" name="asset_location">
                                                        <span class="new-control-indicator"></span>Asset Current Location
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="voilation_report" name="voilation_report">
                                                        <span class="new-control-indicator"></span>Asset Violation
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="history_report" name="history_report">
                                                        <span class="new-control-indicator"></span>Asset History Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="night_report" name="night_report">
                                                        <span class="new-control-indicator"></span>Asset Night Violation Report
                                                    </label>
                                                </div>

                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="jmp_report" name="jmp_report">
                                                        <span class="new-control-indicator"></span>JMP Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="stoppage_report" name="stoppage_report">
                                                        <span class="new-control-indicator"></span>Un Authorized Stoppage Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="movement_report" name="movement_report">
                                                        <span class="new-control-indicator"></span>Bowzer Movement Report (UEP)
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="daily_report" name="daily_report">
                                                        <span class="new-control-indicator"></span>Daily Movement Report (UEP)
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="vts_report" name="vts_report">
                                                        <span class="new-control-indicator"></span>VTS Report
                                                    </label>
                                                </div>

                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="monthly_vts_report" name="monthly_vts_report">
                                                        <span class="new-control-indicator"></span>Monthly VTS Report UEP
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="monthly_vts_custom" name="monthly_vts_custom">
                                                        <span class="new-control-indicator"></span>Monthly VTS Report Custom
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="daily_movement_report" name="daily_movement_report">
                                                        <span class="new-control-indicator"></span>Daily Movement Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="trip_stop_report" name="trip_stop_report">
                                                        <span class="new-control-indicator"></span>Trip Stops Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="transit_report" name="transit_report">
                                                        <span class="new-control-indicator"></span>Transit Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="one_day_report" name="one_day_report">
                                                        <span class="new-control-indicator"></span>One Day Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="performace_report" name="performace_report">
                                                        <span class="new-control-indicator"></span>Vehicle Performance Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="daily_activity_report" name="daily_activity_report">
                                                        <span class="new-control-indicator"></span>Daily Activity Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="mileage_report" name="mileage_report">
                                                        <span class="new-control-indicator"></span>Mileage Report
                                                    </label>
                                                </div>
                                                <div class="col-3 n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                        <input type="checkbox" class="new-control-input" value="1" id="overspeed_report" name="overspeed_report">
                                                        <span class="new-control-indicator"></span>Overspeed Report
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <input type="hidden" name="r_user_id" id="r_user_id">
                                </tbody>
                            </table>

                        </div>



                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                Cancel</button>
                            <!--     <input type="" class="btn btn-primary" style="width: 120px;height: 42px;" type="submit" name="insert" id="insert" value="Insert" style="float:right" /> -->
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <!-- <input type="submit" name="time" class="btn btn-primary"> -->
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id='title_edit'>Add Users</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">



                                <div class="col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control " id="name" name="name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control " id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control " id="address" name="address" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control " id="password" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contact #</label>
                                    <input type="text" class="form-control " id="contact" name="contact" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Overspeed Limit</label>
                                    <input type="text" class="form-control " id="overspeed_limit" name="overspeed_limit" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Idle Limit (Minutes)</label>
                                    <input type="text" class="form-control " id="idle_duration" name="idle_duration" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NR (Hour)</label>
                                    <input type="text" class="form-control " id="nr_duration" name="nr_duration" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Night Voilation From</label>
                                    <input type="time" class="form-control " id="night_from" name="night_from" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Night Voilation To</label>
                                    <input type="time" class="form-control " id="night_to" name="night_to" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Excess Driving</label>
                                    <input type="text" class="form-control" id="excess_driving" name="excess_driving" maxlength="12" pattern="\d{1,12}" required value="3">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Excess Driving (Per Day)</label>
                                    <input type="text" class="form-control" id="excess_driving_day" name="excess_driving_day" maxlength="12" pattern="\d{1,12}" required value="12">
                                </div>
                                <div class="form-group col-md-12" id="role_div">
                                    <label for="inputAddress">Role</label>

                                    <select id="role" name="role" class="form-control all_select" required onchange="check_right(this.value)">
                                        <option></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Distributor">Child Company</option>
                                        <option value="End-User">Client</option>


                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-none" id='admin_div'>
                                    <label for="inputAddress">Admin</label><br>

                                    <select id="all_admin" name="all_admin" class="form-control all_select" style="width: 364px;height: 32px !important;">
                                        <option></option>
                                        <?php foreach ($admin_user as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>


                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-none" id='end_user_div'>
                                    <label for="inputAddress">Child Company</label> <br>

                                    <select id="all_end_user" name="all_end_user" class="form-control all_select" style="width: 364px;height: 32px !important;">
                                        <option></option>
                                        <?php foreach ($admin_dis as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>


                                    </select>
                                </div>


                            </div>




                            <input type="hidden" name="employee_id" id="employee_id">
                            <div class="mb-3 text-center">
                                <!-- <button class="btn rounded-pill marron_bg" type="submit" name="insert"
                                                    id="insert">Save</button> -->
                                <input class="btn marron_bg" type="submit" name="insert" id="insert" value="Save">
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
<!-- <script src="script/user_script.js"></script> -->
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


        var checking = "<?php echo $pre_role ?>";
        // alert(checking)

        $('#add').click(function() {
            $('#insert').val("Save");
            $('#employee_id').val("");
            $('#title_edit').text("Add User");
            $('#insert_form')[0].reset();
            if (checking == 'Distributor') {
                // check_right('End-User');
                $('#role_div').addClass('d-none');
                $('#role').val('End-User').change();
                // $('#role').prop('required', false);
            } else {
                $('#role_div').removeClass('d-none');
                $('#role').prop('required', true);
            }



        });

        $('#insert_form').on("submit", function(event) {
            event.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: "ajax/insert/create_user.php",
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function() {
                    $('#insert').val("Inserting");
                },
                success: function(data) {
                    //console.log(data);

                    if (data != 0) {
                        // $('.offcanvas-collapse').toggleClass('open');
                        // $('.offcanvas').removeClass('open');

                        Swal.fire({
                            position: 'bottom-left',
                            icon: 'success',
                            title: 'User Created Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        setTimeout(function() {
                            window.location.reload();

                        }, 2000);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'User Not Created.',
                        })
                    }




                }
            });

        });


        $(document).on('click', '.check_right', function() {
            var el = this;

            var employee_id = $(this).attr('id');
            alert(employee_id)

            $.ajax({
                url: "ajax/get/get_user_right.php",
                type: "POST",
                data: {
                    employee_id: employee_id
                },
                cache: false,
                success: function(data) {
                    data = JSON.parse(data)
                    //console.log(data);

                    if (data != null) {



                        var acl = data['reports'];
                        var r_acl = JSON.parse(acl);
                        var report_nr = r_acl.report_nr;
                        var asset_location = r_acl.asset_location;
                        var voilation_report = r_acl.voilation_report;
                        var history_report = r_acl.history_report;
                        var night_report = r_acl.night_report;
                        var jmp_report = r_acl.jmp_report;
                        var stoppage_report = r_acl.stoppage_report;
                        var movement_report = r_acl.movement_report;
                        var daily_report = r_acl.daily_report;
                        var vts_report = r_acl.vts_report;
                        var monthly_vts_custom = r_acl.monthly_vts_custom;
                        var daily_movement_report = r_acl.daily_movement_report;
                        var trip_stop_report = r_acl.trip_stop_report;
                        var transit_report = r_acl.transit_report;
                        var one_day_report = r_acl.one_day_report;
                        var performace_report = r_acl.performace_report;
                        var daily_activity_report = r_acl.daily_activity_report;
                        var mileage_report = r_acl.mileage_report;
                        var monthly_vts_report = r_acl.monthly_vts_report;
                        var overspeed_report = r_acl.overspeed_report;


                        //    alert(dash_ecess_driving)

                        if (report_nr == 1) {
                            // document.getElementById('report_nr').style.display = 'none';
                            $('#report_nr').prop('checked', true);


                        } else {
                            $('#report_nr').prop('checked', false);
                        }

                        if (asset_location == 1) {
                            // document.getElementById('asset_location').style.display = 'none';
                            $('#asset_location').prop('checked', true);


                        } else {
                            $('#asset_location').prop('checked', false);
                        }
                        if (voilation_report == 1) {
                            // document.getElementById('voilation_report').style.display = 'none';

                            $('#voilation_report').prop('checked', true);


                        } else {
                            $('#voilation_report').prop('checked', false);
                        }
                        if (history_report == 1) {
                            // document.getElementById('history_report').style.display = 'none';

                            $('#history_report').prop('checked', true);


                        } else {
                            $('#history_report').prop('checked', false);
                        }
                        if (night_report == 1) {
                            // document.getElementById('night_report').style.display = 'none';

                            $('#night_report').prop('checked', true);


                        } else {
                            $('#night_report').prop('checked', false);
                        }

                        if (jmp_report == 1) {
                            // document.getElementById('jmp_report').style.display = 'none';

                            $('#jmp_report').prop('checked', true);


                        } else {
                            $('#jmp_report').prop('checked', false);
                        }
                        if (stoppage_report == 1) {
                            // document.getElementById('stoppage_report').style.display = 'none';

                            $('#stoppage_report').prop('checked', true);


                        } else {
                            $('#stoppage_report').prop('checked', false);
                        }
                        if (movement_report == 1) {
                            // document.getElementById('movement_report').style.display = 'none';

                            $('#movement_report').prop('checked', true);


                        } else {
                            $('#movement_report').prop('checked', false);
                        }
                        if (daily_report == 1) {
                            // document.getElementById('daily_report').style.display = 'none';

                            $('#daily_report').prop('checked', true);


                        } else {
                            $('#daily_report').prop('checked', false);
                        }
                        if (vts_report == 1) {
                            // document.getElementById('vts_report').style.display = 'none';

                            $('#vts_report').prop('checked', true);


                        } else {
                            $('#vts_report').prop('checked', false);
                        }
                        if (monthly_vts_custom == 1) {
                            // document.getElementById('monthly_vts_custom').style.display = 'none';

                            $('#monthly_vts_custom').prop('checked', true);


                        } else {
                            $('#monthly_vts_custom').prop('checked', false);
                        }
                        if (daily_movement_report == 1) {
                            // document.getElementById('daily_movement_report').style.display = 'none';

                            $('#daily_movement_report').prop('checked', true);


                        } else {
                            $('#daily_movement_report').prop('checked', false);
                        }
                        if (trip_stop_report == 1) {
                            // document.getElementById('trip_stop_report').style.display = 'none';

                            $('#trip_stop_report').prop('checked', true);


                        } else {
                            $('#trip_stop_report').prop('checked', false);
                        }
                        if (transit_report == 1) {
                            // document.getElementById('transit_report').style.display = 'none';

                            $('#transit_report').prop('checked', true);


                        } else {
                            $('#transit_report').prop('checked', false);
                        }
                        if (one_day_report == 1) {
                            // document.getElementById('one_day_report').style.display = 'none';

                            $('#one_day_report').prop('checked', true);


                        } else {
                            $('#one_day_report').prop('checked', false);
                        }

                        if (performace_report == 1) {
                            // document.getElementById('performace_report').style.display = 'none';

                            $('#performace_report').prop('checked', true);


                        } else {
                            $('#performace_report').prop('checked', false);
                        }

                        if (daily_activity_report == 1) {
                            // document.getElementById('daily_activity_report').style.display = 'none';

                            $('#daily_activity_report').prop('checked', true);


                        } else {
                            $('#daily_activity_report').prop('checked', false);
                        }
                        if (mileage_report == 1) {
                            // document.getElementById('mileage_report').style.display = 'none';

                            $('#mileage_report').prop('checked', true);


                        } else {
                            $('#mileage_report').prop('checked', false);
                        }
                        if (monthly_vts_report == 1) {
                            // document.getElementById('monthly_vts_report').style.display = 'none';

                            $('#monthly_vts_report').prop('checked', true);


                        } else {
                            $('#monthly_vts_report').prop('checked', false);
                        }
                        if (overspeed_report == 1) {
                            // document.getElementById('overspeed_report').style.display = 'none';

                            $('#overspeed_report').prop('checked', true);


                        } else {
                            $('#overspeed_report').prop('checked', false);
                        }

                        var acl = data['dashboard_tab'];
                        var r_acl = JSON.parse(acl);
                        var dash_harsh = r_acl.dash_harsh;
                        var dash_acce = r_acl.dash_acce;
                        var dash_cornering = r_acl.dash_cornering;
                        var dash_geo_in = r_acl.dash_geo_in;
                        var dash_speed_voilation = r_acl.dash_speed_voilation;
                        var dash_night_voilation = r_acl.dash_night_voilation;
                        var dash_un_auth_stop = r_acl.dash_un_auth_stop;
                        var dash_ecess_driving = r_acl.dash_ecess_driving;
                        //    alert(dash_ecess_driving)

                        if (dash_harsh == 1) {
                            // document.getElementById('dash_harsh').style.display = 'none';

                            $('#dash_harsh').prop('checked', true);


                        } else {
                            $('#dash_harsh').prop('checked', false);
                        }

                        if (dash_harsh == 1) {
                            // document.getElementById('dash_acce').style.display = 'none';

                            $('#dash_acce').prop('checked', true);


                        } else {
                            $('#dash_acce').prop('checked', false);
                        }
                        if (dash_cornering == 1) {
                            // document.getElementById('dash_cornering').style.display = 'none';

                            $('#dash_cornering').prop('checked', true);


                        } else {
                            $('#dash_cornering').prop('checked', false);
                        }
                        if (dash_geo_in == 1) {
                            // document.getElementById('dash_geo_in').style.display = 'none';

                            $('#dash_geo_in').prop('checked', true);


                        } else {
                            $('#dash_geo_in').prop('checked', false);
                        }
                        if (dash_speed_voilation == 1) {
                            // document.getElementById('dash_speed_voilation').style.display = 'none';

                            $('#dash_speed_voilation').prop('checked', true);


                        } else {
                            $('#dash_speed_voilation').prop('checked', false);
                        }

                        if (dash_night_voilation == 1) {
                            // document.getElementById('dash_night_voilation').style.display = 'none';

                            $('#dash_night_voilation').prop('checked', true);


                        } else {
                            $('#dash_night_voilation').prop('checked', false);
                        }
                        if (dash_un_auth_stop == 1) {
                            // document.getElementById('dash_un_auth_stop').style.display = 'none';

                            $('#dash_un_auth_stop').prop('checked', true);


                        } else {
                            $('#dash_un_auth_stop').prop('checked', false);
                        }

                        if (dash_ecess_driving == 1) {
                            // document.getElementById('dash_ecess_driving').style.display = 'none';

                            $('#dash_ecess_driving').prop('checked', true);


                        } else {
                            $('#dash_ecess_driving').prop('checked', false);
                        }




                        // //console.log("main_desh  =>" + create);


                        // $('#table').html(data);
                    }
                }

            });


            $('#r_user_id').val(employee_id);

            $('#exampleModalScrollable').modal('show');

        });

        $(document).on('click', '.edit_data', function() {
            var el = this;

            var employee_id = $(this).attr('id');
            $.ajax({
                url: "ajax/get/get_users.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                dataType: "json",
                success: function(data) {
                    //console.log(data)

                    $('#employee_id').val(data.user_id);
                    $('#name').val(data.name);
                    $('#email').val(data.login);
                    $('#address').val(data.address);
                    $('#contact').val(data.telephone);
                    $('#password').val(data.description);
                    $('#overspeed_limit').val(data.overspeed);
                    $('#idle_duration').val(data.idle);
                    $('#nr_duration').val(data.nr);
                    $('#night_from').val(data.night_from);
                    $('#night_to').val(data.night_to);
                    $('#excess_driving').val(data.excess_driving);
                    $('#excess_driving_day').val(data.daily_driving_limit);
                    $('#role_div').addClass('d-none');
                    $('#role').prop('required', false);
                    $('#insert').val("Update");
                    $('#title_edit').text("Edit User");
                }
            });
            var offcanvasElement = document.querySelector('#offcanvasRight');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.show();

        });

        $(document).on('click', '.delete-btn', function() {
            var el = this;

            // Delete id
            var employee_id = $(this).attr('id');
            // alert(employee_id);

            var confirmalert = confirm("Are you sure?");
            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                    url: 'ajax/delete/delete_users.php',
                    type: 'POST',
                    data: {
                        employee_id: employee_id
                    },
                    success: function(response) {

                        //console.log(response)
                        if (response == 1) {
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background', 'tomato');
                            $(el).closest('tr').fadeOut(800, function() {
                                $(this).remove();
                                Swal.fire({
                                    position: 'bottom-left',
                                    icon: 'success',
                                    title: 'Record Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            });

                            setTimeout(function() {
                                window.location.reload();

                            }, 2000);


                        } else {
                            alert('Invalid ID.');
                        }

                    }
                });
            }

        });



    });

    function check_right(value) {
        // alert(value)
        if (value != "") {
            if (value == 'Distributor') {
                $('#admin_div').removeClass('d-none')
                $('#end_user_div').addClass('d-none')
                $('#all_admin').prop('required', true);
                $('#all_end_user').prop('required', false);
            } else if (value == 'End-User') {
                $('#admin_div').addClass('d-none')
                $('#end_user_div').removeClass('d-none')
                $('#all_admin').prop('required', false);
                $('#all_end_user').prop('required', true);
            }
        }
    }

    var dash_harsh, history_report, dash_acce, dash_cornering, dash_geo_in, dash_night_voilation, dash_speed_voilation, dash_un_auth_stop, dash_ecess_driving;


    $('#insert_role_form').on("submit", function(event) {
        event.preventDefault();
        // alert('vip')
        val = document.getElementById('dash_harsh');
        if (val.checked == true) {
            dash_harsh = 1;
            //console.log(dash_harsh)
        } else {
            dash_harsh = 0;
            //console.log(dash_harsh)
        }
        val = document.getElementById('dash_acce');
        if (val.checked == true) {
            dash_acce = 1;
            //console.log(dash_acce)
        } else {
            dash_acce = 0;
            //console.log(dash_acce)
        }
        val = document.getElementById('dash_cornering');
        if (val.checked == true) {
            dash_cornering = 1;
            //console.log(dash_cornering)
        } else {
            dash_cornering = 0;
            //console.log(dash_cornering)
        }
        val = document.getElementById('dash_speed_voilation');
        if (val.checked == true) {
            dash_speed_voilation = 1;
            //console.log(dash_speed_voilation)
        } else {
            dash_speed_voilation = 0;
            //console.log(dash_speed_voilation)
        }
        val = document.getElementById('dash_un_auth_stop');
        if (val.checked == true) {
            dash_un_auth_stop = 1;
            //console.log(dash_un_auth_stop)
        } else {
            dash_un_auth_stop = 0;
            //console.log(dash_un_auth_stop)
        }
        val = document.getElementById('dash_geo_in');
        if (val.checked == true) {
            dash_geo_in = 1;
            //console.log(dash_geo_in)
        } else {
            dash_geo_in = 0;
            //console.log(dash_geo_in)
        }
        val = document.getElementById('dash_ecess_driving');
        if (val.checked == true) {
            dash_ecess_driving = 1;
            //console.log(dash_ecess_driving)
        } else {
            dash_ecess_driving = 0;
            //console.log(dash_ecess_driving)
        }
        val = document.getElementById('dash_night_voilation');
        if (val.checked == true) {
            dash_night_voilation = 1;
            //console.log(dash_night_voilation)
        } else {
            dash_night_voilation = 0;
            //console.log(dash_night_voilation)
        }

        var p_all = {
            "dash_harsh": dash_harsh,
            "dash_acce": dash_acce,
            "dash_cornering": dash_cornering,
            "dash_geo_in": dash_geo_in,
            "dash_night_voilation": dash_night_voilation,
            "dash_speed_voilation": dash_speed_voilation,
            "dash_un_auth_stop": dash_un_auth_stop,
            "dash_ecess_driving": dash_ecess_driving,
        };
        //console.log(p_all);



        report_nr = document.getElementById('report_nr');
        if (val.checked == true) {
            report_nr = 1;
            //console.log(report_nr)
        } else {
            report_nr = 0;
            //console.log(report_nr)
        }
        val = document.getElementById('asset_location');
        if (val.checked == true) {
            asset_location = 1;
            //console.log(asset_location)
        } else {
            asset_location = 0;
            //console.log(asset_location)
        }
        val = document.getElementById('voilation_report');
        if (val.checked == true) {
            voilation_report = 1;
            //console.log(voilation_report)
        } else {
            voilation_report = 0;
            //console.log(voilation_report)
        }
        val = document.getElementById('history_report');
        if (val.checked == true) {
            history_report = 1;
            //console.log(history_report)
        } else {
            history_report = 0;
            //console.log(history_report)
        }
        val = document.getElementById('night_report');
        if (val.checked == true) {
            night_report = 1;
            //console.log(night_report)
        } else {
            night_report = 0;
            //console.log(night_report)
        }
        val = document.getElementById('jmp_report');
        if (val.checked == true) {
            jmp_report = 1;
            //console.log(jmp_report)
        } else {
            jmp_report = 0;
            //console.log(jmp_report)
        }
        val = document.getElementById('stoppage_report');
        if (val.checked == true) {
            stoppage_report = 1;
            //console.log(stoppage_report)
        } else {
            stoppage_report = 0;
            //console.log(stoppage_report)
        }
        val = document.getElementById('movement_report');
        if (val.checked == true) {
            movement_report = 1;
            //console.log(movement_report)
        } else {
            movement_report = 0;
            //console.log(movement_report)
        }
        val = document.getElementById('daily_report');
        if (val.checked == true) {
            daily_report = 1;
            //console.log(daily_report)
        } else {
            daily_report = 0;
            //console.log(daily_report)
        }
        val = document.getElementById('vts_report');
        if (val.checked == true) {
            vts_report = 1;
            //console.log(vts_report)
        } else {
            vts_report = 0;
            //console.log(vts_report)
        }
        val = document.getElementById('monthly_vts_custom');
        if (val.checked == true) {
            monthly_vts_custom = 1;
            //console.log(monthly_vts_custom)
        } else {
            monthly_vts_custom = 0;
            //console.log(monthly_vts_custom)
        }

        val = document.getElementById('daily_movement_report');
        if (val.checked == true) {
            daily_movement_report = 1;
            //console.log(daily_movement_report)
        } else {
            daily_movement_report = 0;
            //console.log(daily_movement_report)
        }
        val = document.getElementById('trip_stop_report');
        if (val.checked == true) {
            trip_stop_report = 1;
            //console.log(trip_stop_report)
        } else {
            trip_stop_report = 0;
            //console.log(trip_stop_report)
        }
        val = document.getElementById('transit_report');
        if (val.checked == true) {
            transit_report = 1;
            //console.log(transit_report)
        } else {
            transit_report = 0;
            //console.log(transit_report)
        }
        val = document.getElementById('one_day_report');
        if (val.checked == true) {
            one_day_report = 1;
            //console.log(one_day_report)
        } else {
            one_day_report = 0;
            //console.log(one_day_report)
        }
        val = document.getElementById('performace_report');
        if (val.checked == true) {
            performace_report = 1;
            //console.log(performace_report)
        } else {
            performace_report = 0;
            //console.log(performace_report)
        }
        val = document.getElementById('daily_activity_report');
        if (val.checked == true) {
            daily_activity_report = 1;
            //console.log(daily_activity_report)
        } else {
            daily_activity_report = 0;
            //console.log(daily_activity_report)
        }
        val = document.getElementById('mileage_report');
        if (val.checked == true) {
            mileage_report = 1;
            //console.log(mileage_report)
        } else {
            mileage_report = 0;
            //console.log(mileage_report)
        }
        val = document.getElementById('monthly_vts_report');
        if (val.checked == true) {
            monthly_vts_report = 1;
            //console.log(monthly_vts_report)
        } else {
            monthly_vts_report = 0;
            //console.log(monthly_vts_report)
        }
        val = document.getElementById('overspeed_report');
        if (val.checked == true) {
            overspeed_report = 1;
            //console.log(overspeed_report)
        } else {
            overspeed_report = 0;
            //console.log(overspeed_report)
        }

        s_all = {
            "report_nr": report_nr,
            "asset_location": asset_location,
            "voilation_report": voilation_report,
            "history_report": history_report,
            "night_report": night_report,
            "jmp_report": jmp_report,
            "stoppage_report": stoppage_report,
            "movement_report": movement_report,
            "daily_report": daily_report,
            "vts_report": vts_report,
            "monthly_vts_report": monthly_vts_report,
            "monthly_vts_custom": monthly_vts_custom,
            "daily_movement_report": daily_movement_report,
            "trip_stop_report": trip_stop_report,
            "transit_report": transit_report,
            "one_day_report": one_day_report,
            "performace_report": performace_report,
            "daily_activity_report": daily_activity_report,
            "mileage_report": mileage_report,
            "overspeed_report": overspeed_report

        };
        console.log(p_all);
        console.log(s_all);
        var user_id = $('#r_user_id').val();

        $.ajax({
            url: "ajax/insert/insert_permissions.php?p_all=" + JSON.stringify(p_all) + "&s_all=" + JSON.stringify(s_all) + "&r_user_id=" + user_id,
            cache: false,
            contentType: false,
            processData: false,
            method: "GET",
            data: {
                data: 'data'
            },
            beforeSend: function() {
                $('#insert').val("Inserting");
            },
            success: function(data) {
                console.log(data);
                // $('#insert_form')[0].reset();
                // $('#login-modal').modal('hide');


                if (data != 0) {
                    Swal.fire({
                        position: 'bottom-left',
                        icon: 'success',
                        title: 'Record Created Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    setTimeout(function() {
                        window.location.reload();

                    }, 2000);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Record Not Created.',
                    })
                }


            }
        });

    });
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>