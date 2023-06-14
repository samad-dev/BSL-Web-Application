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

$result = mysqli_query($db, "SELECT us.id as user_id,us.*,uad.* FROM bsl.users as us join user_alerts_define as uad on uad.user_id=us.id");
$admin_user = mysqli_query($db, "SELECT * FROM bsl.users where privilege='Admin'");
$admin_dis = mysqli_query($db, "SELECT * FROM bsl.users where privilege='Distributor' or privilege='Admin'");

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
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                style="font-size: 24px;">+</button>

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
                                            <td><i class="fas fa-pencil-alt text-success edit_data"
                                                    id='<?php echo $row['user_id']; ?>'></i></td>
                                            <td><i class="fas fa-trash-alt text-danger delete-btn"
                                                    id='<?php echo $row['user_id']; ?>'></i></td>

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
                                    <input type="text" class="form-control " id="overspeed_limit" name="overspeed_limit"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Idle Limit (Minutes)</label>
                                    <input type="text" class="form-control " id="idle_duration" name="idle_duration"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NR (Hour)</label>
                                    <input type="text" class="form-control " id="nr_duration" name="nr_duration"
                                        required>
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
                                    <input type="text" class="form-control" id="excess_driving" name="excess_driving" maxlength="12" pattern="\d{1,12}"
                                        required value="3">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Excess Driving (Per Day)</label>
                                    <input type="text" class="form-control" id="excess_driving_day" name="excess_driving_day" maxlength="12" pattern="\d{1,12}"
                                        required value="12">
                                </div>
                                <div class="form-group col-md-12" id="role_div">
                                    <label for="inputAddress">Role</label>

                                    <select id="role" name="role" class="form-control all_select" required
                                        onchange="check_right(this.value)">
                                        <option></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Distributor">Child Company</option>
                                        <option value="End-User">Client</option>


                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-none" id='admin_div'>
                                    <label for="inputAddress">Admin</label><br>

                                    <select id="all_admin" name="all_admin" class="form-control all_select"
                                        style="width: 364px;height: 32px !important;">
                                        <option></option>
                                        <?php foreach ($admin_user as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>


                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-none" id='end_user_div'>
                                    <label for="inputAddress">Child Company</label> <br>

                                    <select id="all_end_user" name="all_end_user" class="form-control all_select"
                                        style="width: 364px;height: 32px !important;">
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
<script src="script/user_script.js"></script>
<script>
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

    
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>