<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Manage Geofences | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Manage Geofences Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$result = mysqli_query($db,"SELECT * from road_zones");

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
                                <h4 class="mb-sm-0 font-size-18">Manage Geofences</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Geofences</a></li>
                                        <li class="breadcrumb-item active">Manage Geofences</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <!-- <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                style="font-size: 24px;">+</button> -->
                                <a href="geofencing.php" class="btn marron_bg" style="font-size: 24px;">+</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Code</th>
                                        <!-- <th>Coordinates</th> -->
                                        <th>Radius</th>
                                        <th>Type</th>
                                        <th>Geo Type</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        while($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row["consignee_name"]; ?></td>
                                            <td><?php echo $row["location"]; ?></td>
                                            <td><?php echo $row["code"]; ?></td>
                                            <!-- <td ><?php echo $row["Coordinates"]; ?></td> -->
                                            <td><?php echo $row["radius"]; ?></td>
                                            <td><?php echo $row["type"]; ?></td>
                                            <td><?php echo $row["geotype"]; ?></td>
                                            <td><a href="road_zone.php?id=<?php echo $row['id']; ?>"><i class="fas fa-eye text-success" id='<?php echo $row['id']; ?>'></i></a></td>
                                            <td><i class="fas fa-pencil-alt text-success edit_data" id='<?php echo $row['id']; ?>'></i></td>
                                        <td><i class="fas fa-trash-alt text-danger delete-btn" id='<?php echo $row['id']; ?>'></i></td>
                            
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
            <h5 id="offcanvasRightLabel" id='title_edit'>Add Manage Geofences</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">



                                <div class="col-md-12">
                                    <label class="form-label">Name</label>
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
                                    <label class="form-label">CNIC</label>
                                    <input type="text" class="form-control " id="cnic" name="cnic" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Contact #</label>
                                    <input type="text" class="form-control " id="contact" name="contact" required>
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
<script src="script/driver_script.js"></script>
<script>
    $(document).on('click', '.delete-btn', function() {
        var el = this;

        // Delete id
        var employee_id = $(this).attr('id');
        // alert(employee_id);

        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
            // AJAX Request
            $.ajax({
                url: 'ajax/delete/delete_fences.php',
                type: 'POST',
                data: {
                    employee_id: employee_id
                },
                success: function(response) {

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
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html> 