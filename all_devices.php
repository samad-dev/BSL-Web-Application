
<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Asset | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Asset Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$user_id = $_SESSION['user_id']; 
$pre_role = $_SESSION['privilege']; 


$result = mysqli_query($db,"SELECT dc.* FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id';");


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
                                <h4 class="mb-sm-0 font-size-18">Asset</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Asset</a></li>
                                        <li class="breadcrumb-item active">Asset</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                style="font-size: 24px;">+</button>

                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%" >
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>License Plate #</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Type</th>
                                        <th>Year</th>
                                        <th>Color</th>
                                        <th>Registration Expiry Date</th>
                                        <th>Insurance Expiry Date</th>
                                        <th>Status</th>
                                        <th>Mileage</th>
                                        <th>Fuel Type</th>
                                        <th>Purchase Date</th>
                                        <th>Purchase Price</th>
                                        <th>Owner</th>
                                        <th>Driver</th>

                                        <!-- <th>Edit</th>
                                        <th>Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        while($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <td><?php echo $row["trackername"]; ?></td>
                                        <!-- <td><i class="fas fa-pencil-alt text-success edit_data" id='<?php echo $row['id']; ?>'></i></td>
                                        <td><i class="fas fa-trash-alt text-danger delete-btn" id='<?php echo $row['id']; ?>'></i></td> -->

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


            <?php include 'footer.php'?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Add Asset</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">



                                <div class="col-md-12">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control " id="name" name="name" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control " id="email" name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control " id="address" name="address" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control " id="password" name="password" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Contact #</label>
                                    <input type="text" class="form-control " id="contact" name="contact" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Role</label>

                                    <select id="role" name="role" class="form-control selectpicker" required>
                                        <option selected>Choose...</option>
                                        <option value="admin_user">Admin User</option>
                                        <option value="viewer">viewer</option>
                                        <option value="Cartraige">Cartraige</option>


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
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>