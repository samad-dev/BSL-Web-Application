<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>JMP Trip | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dedicated Trip Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$result = mysqli_query($db, "SELECT * FROM bsl.jmp_view;");

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
                                <h4 class="mb-sm-0 font-size-18">JMP Trip</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">JMP
                                                Trip</a></li>
                                        <li class="breadcrumb-item active">JMP Trip</li>
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
                            <a href="trip_creation.php" class="btn marron_bg" style="font-size: 24px;">+</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Vehicle #</th>
                                        <th>Client</th>
                                        <th>Loading Site</th>
                                        <th>Trip Start Date</th>
                                        <th>Shipment No.</th>
                                        <th>View</th>
                                        <th>Closing</th>
                                        <th>Add Consequence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $date = date_create($row["trip_start_date"]);
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>
                                            <td>
                                                <?php echo $row["vehicle_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["client_name"] ?>
                                            </td>
                                            <td>
                                                <?php echo $row["l_site"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $date->format('Y-m-d H:i:s'); ?>
                                            </td>
                                            <td>
                                                <?php echo $row["shipment_bilti"]; ?>
                                            </td>

                                            <!-- <td><i class="fas fa-pencil-alt text-success edit_data"
                                                                                                id='<?php echo $row['main_id']; ?>'></i></td> -->
                                            <td><a href="jmp_new.php?id=<?php echo $row['id'] ?>"><i
                                                        class="fas fa-eye text-danger"></i></a></td>
                                            <td>
                                                <i class="fas fa-times-circle text-success closing_trip"
                                                    id='<?php echo $row['id']; ?>'></i>
                                            </td>
                                            <td>

                                                <i class="fas fa-edit text-success con_trip"
                                                    id='<?php echo $row['id']; ?>'></i>
                                            </td>

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
    </div>

    <div id='zoomupModal' class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" id="cn">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Add Consequence </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form2" enctype="multipart/form-data">

                        <div class="row mb-3">



                            <div class="col-md-6">
                                <label class="form-label">Consequences Applied on Speed Violations</label>
                                <input type="text" class="form-control " id="casp"
                                    name="casp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequence Applied By on Speed Vioaltions</label>
                                <input type="text" class="form-control " id="cbsp"
                                    name="cbsp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequence Applied Date on Speed Vioaltions</label>
                                <input type="datetime-local" class="form-control " id="cdsp"
                                    name="cdsp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequences Applied on Harsh Breaking</label>
                                <input type="text" class="form-control " id="cahb"
                                    name="cahb" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequence Applied By on Harsh Breaking</label>
                                <input type="text" class="form-control " id="cbhb"
                                    name="cbhb" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequence Applied Date on Harsh Breaking</label>
                                <input type="datetime-local" class="form-control " id="cdhb"
                                    name="cdhb" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequences Applied on Excess Idling</label>
                                <input type="text" class="form-control " id="caed"
                                    name="caed" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequence Applied By on Excess Idling</label>
                                <input type="text" class="form-control " id="cbed"
                                    name="cbed" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consequence Applied Date on Excess Idling</label>
                                <input type="datetime-local" class="form-control " id="cded"
                                    name="cded" required>
                            </div>




                            <input type="hidden" name="close_row_id" id="close_row_id">
                            <input type="hidden" name="modal_type" id="modal_type">
                            <div class="my-3 text-center">
                                <input class="btn marron_bg" type="submit" name="edit_insert" id="edit_insert"
                                    value="Update">
                            </div>


                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal-dialog modal-dialog-centered" id="cl">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Edit </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form" enctype="multipart/form-data">

                    <div class="row mb-3">



                        <div class="col-md-12">
                            <label class="form-label">Arrival at Delivery Site</label>
                            <input type="datetime-local" class="form-control " id="arrival_delivery_site"
                                name="arrival_delivery_site" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Entry in Delivery Site</label>
                            <input type="datetime-local" class="form-control " id="entry_at_deleivery_site"
                                name="entry_at_deleivery_site" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Exit at Delivery Site</label>
                            <input type="datetime-local" class="form-control " id="exit_at_deleivery_site"
                                name="exit_at_deleivery_site" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Total Time at Delivery Site</label>
                            <input type="text" class="form-control " id="total_at_deleivery_site"
                                name="total_at_deleivery_site" required>
                        </div>



                        <input type="hidden" name="close_row_id" id="close_row_id">
                        <input type="hidden" name="modal_type" id="modal_type">
                        <div class="my-3 text-center">
                            <input class="btn marron_bg" type="submit" name="edit_insert" id="edit_insert"
                                value="Update">
                        </div>


                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->



    </div><!-- /.modal -->




    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
</body>
<script src="script/driver_script.js"></script>
<script>

    $(document).on('click', '.closing_trip', function () {
        var el = this;

        // Delete id
        var employee_id = $(this).attr('id');
        // alert(employee_id)
        $('#close_row_id').val(employee_id);
        $('#modal_type').val('Closing');
        $("#cl").css("display", "block")
        $("#cn").css("display", "none")
        $('#zoomupModal').modal('show');

    });
    $(document).on('click', '.con_trip', function () {
        var el = this;

        // Delete id
        var employee_id = $(this).attr('id');
        // alert(employee_id)
        $('#close_row_id').val(employee_id);
        $('#modal_type').val('consequence');
        $("#cn").css("display", "block")
        $("#cl").css("display", "none")
        $('#zoomupModal').modal('show');

    });

    $('#edit_form').on("submit", function (event) {
        event.preventDefault();
        var data = new FormData(this);

        $.ajax({
            url: "ajax/insert/jmp_update_close_consequence.php",
            cache: false,
            contentType: false,
            processData: false,
            method: "POST",
            data: data,
            beforeSend: function () {
                $('#edit_insert').val("Updating");
            },
            success: function (data) {
                console.log(data);

                if (data != 0) {
                    Swal.fire({
                        position: 'bottom-left',
                        icon: 'success',
                        title: 'Record Updated Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    setTimeout(function () {
                        window.location.reload();

                    }, 2000);

                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User Not Created.',
                    })
                }




            }
        });

    });

    $('#edit_form2').on("submit", function (event) {
        event.preventDefault();
        var data = new FormData(this);
        console.log('gotcha');
        $.ajax({
            url: "ajax/insert/add_consequences.php",
            cache: false,
            contentType: false,
            processData: false,
            method: "POST",
            data: data,
            beforeSend: function () {
                $('#edit_insert').val("Updating");
            },
            success: function (data) {
                console.log(data);

                if (data != 0) {
                    Swal.fire({
                        position: 'bottom-left',
                        icon: 'success',
                        title: 'Record Updated Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    // setTimeout(function () {
                    //     window.location.reload();

                    // }, 2000);

                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Record Not Updated.',
                    })
                }




            }
        });

    });

    $(document).on('click', '.delete-btn', function () {
        var el = this;

        // Delete id
        var employee_id = $(this).attr('id');
        // alert(employee_id);

        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
            // AJAX Request
            $.ajax({
                url: 'ajax/delete/delete_dedicated_trips.php',
                type: 'POST',
                data: {
                    employee_id: employee_id
                },
                success: function (response) {

                    if (response == 1) {
                        // Remove row from HTML Table
                        $(el).closest('tr').css('background', 'tomato');
                        $(el).closest('tr').fadeOut(800, function () {
                            $(this).remove();
                            Swal.fire({
                                position: 'bottom-left',
                                icon: 'success',
                                title: 'Record Deleted Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        });

                        setTimeout(function () {
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