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

$result = mysqli_query($db, "SELECT * FROM bsl.bilti_records;");

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
                                <h4 class="mb-sm-0 font-size-18">Bilti Records</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bilti Record</a></li>
                                        <li class="breadcrumb-item active">Bilti Records</li>
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
                            <!-- <a href="trip_creation.php" class="btn marron_bg" style="font-size: 24px;">+</a> -->

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Bilty No</th>
                                        <th>Bilty Date</th>
                                        <th>Entry Date</th>
                                        <th>Reference Bilty No</th>
                                        <th>Ref Challan No</th>
                                        <th>Customer Name</th>
                                        <th>Dedicated</th>
                                        <th>Vehicle Size</th>
                                        <th>Product Name</th>
                                        <th>Owner Name</th>
                                        <th>Up Local</th>
                                        <th>Paid Topday</th>
                                        <th>Distributor Name</th>
                                        <th>Shipping KHI</th>
                                        <th>Shipping LHR</th>
                                        <th>DA No</th>
                                        <th>Shipment No</th>
                                        <th>Seal No</th>
                                        <th>Container1</th>
                                        <th>Container2</th>
                                        <th>Total KM</th>
                                        <th>Total Hrs</th>
                                        <th>Remarks</th>
                                        <th>Odo Mtr Start</th>
                                        <th>Gen Meter Start</th>
                                        <th>Cooling Temp</th>
                                        <th>Gate In</th>
                                        <th>Loading Start</th>
                                        <th>Loading End</th>
                                        <th>Gate Out</th>
                                        <th>POH Gate In</th>
                                        <th>Unloading Start</th>
                                        <th>Unloading End</th>
                                        <th>POH Gate Out</th>
                                        <th>Detention Days</th>
                                        <th>Location From</th>
                                        <th>Location To</th>
                                        <th>Filling Temp</th>
                                        <th>Filling Gravity</th>
                                        <th>Decanted Temp</th>
                                        <th>Decanted Gravity</th>
                                        <th>Tracker Gen Hrs</th>
                                        <th>Trip No</th>
                                        <th>Trolley No</th>
                                        <th>Trip Start Date</th>
                                        <th>Driver Name</th>
                                        <th>Driver2 Name</th>
                                        <th>Driver3 Name</th>
                                        <th>Odo Meter Start</th>
                                        <th>Trip Days</th>
                                        <th>Gen Set Meter Start</th>
                                        <th>Vehicle No</th>
                                        <th>Vehicle Category</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Make</th>
                                        <th>Vehicle Total Tyre</th>
                                        <th>Vehicle Axel</th>
                                        <th>Vehicle Spare Tyre</th>
                                        <th>Primary No Tyre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        // $date = date_create($row["trip_start_date"]);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>
                                            <td><?php echo $row["bilty_no"]; ?></td>
                                            <td><?php echo $row["bilty_date"]; ?></td>
                                            <td><?php echo $row["entry_date"]; ?></td>
                                            <td><?php echo $row["reference_bilty_no"]; ?></td>
                                            <td><?php echo $row["ref_challan_no"]; ?></td>
                                            <td><?php echo $row["customer_name"]; ?></td>
                                            <td><?php echo $row["dedicated"]; ?></td>
                                            <td><?php echo $row["vehicle_size"]; ?></td>
                                            <td><?php echo $row["product_name"]; ?></td>
                                            <td><?php echo $row["owner_name"]; ?></td>
                                            <td><?php echo $row["up_local"]; ?></td>
                                            <td><?php echo $row["paid_topday"]; ?></td>
                                            <td><?php echo $row["distributor_name"]; ?></td>
                                            <td><?php echo $row["shipping_khi"]; ?></td>
                                            <td><?php echo $row["shipping_lhr"]; ?></td>
                                            <td><?php echo $row["da_no"]; ?></td>
                                            <td><?php echo $row["shipment_no"]; ?></td>
                                            <td><?php echo $row["seal_no"]; ?></td>
                                            <td><?php echo $row["container1"]; ?></td>
                                            <td><?php echo $row["container2"]; ?></td>
                                            <td><?php echo $row["total_km"]; ?></td>
                                            <td><?php echo $row["total_hrs"]; ?></td>
                                            <td><?php echo $row["remarks"]; ?></td>
                                            <td><?php echo $row["odo_mtr_start"]; ?></td>
                                            <td><?php echo $row["gen_meter_start"]; ?></td>
                                            <td><?php echo $row["cooling_temp"]; ?></td>
                                            <td><?php echo $row["gate_in"]; ?></td>
                                            <td><?php echo $row["loading_start"]; ?></td>
                                            <td><?php echo $row["loading_end"]; ?></td>
                                            <td><?php echo $row["gate_out"]; ?></td>
                                            <td><?php echo $row["poh_gate_in"]; ?></td>
                                            <td><?php echo $row["unloading_start"]; ?></td>
                                            <td><?php echo $row["unloading_end"]; ?></td>
                                            <td><?php echo $row["poh_gate_out"]; ?></td>
                                            <td><?php echo $row["detention_days"]; ?></td>
                                            <td><?php echo $row["location_from"]; ?></td>
                                            <td><?php echo $row["location_to"]; ?></td>
                                            <td><?php echo $row["filling_temp"]; ?></td>
                                            <td><?php echo $row["filling_gravity"]; ?></td>
                                            <td><?php echo $row["decanted_temp"]; ?></td>
                                            <td><?php echo $row["decanted_gravity"]; ?></td>
                                            <td><?php echo $row["tracker_gen_hrs"]; ?></td>
                                            <td><?php echo $row["trip_no"]; ?></td>
                                            <td><?php echo $row["trolley_no"]; ?></td>
                                            <td><?php echo $row["trip_start_date"]; ?></td>
                                            <td><?php echo $row["driver_name"]; ?></td>
                                            <td><?php echo $row["driver2_name"]; ?></td>
                                            <td><?php echo $row["driver3_name"]; ?></td>
                                            <td><?php echo $row["odo_meter_start"]; ?></td>
                                            <td><?php echo $row["trip_days"]; ?></td>
                                            <td><?php echo $row["genset_meter_start"]; ?></td>
                                            <td><?php echo $row["vehicle_no"]; ?></td>
                                            <td><?php echo $row["vehicle_category"]; ?></td>
                                            <td><?php echo $row["vehicle_type"]; ?></td>
                                            <td><?php echo $row["vehicle_make"]; ?></td>
                                            <td><?php echo $row["vehicle_total_tyre"]; ?></td>
                                            <td><?php echo $row["vehicle_axel"]; ?></td>
                                            <td><?php echo $row["vehilce_spare_tyre"]; ?></td>
                                            <td><?php echo $row["primary_no_tyre"]; ?></td>
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



    </div><!-- /.modal -->




    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
</body>
<script src="script/driver_script.js"></script>
<script>
    $(document).on('click', '.closing_trip', function() {
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
    $(document).on('click', '.con_trip', function() {
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

    $('#edit_form').on("submit", function(event) {
        event.preventDefault();
        var data = new FormData(this);

        $.ajax({
            url: "ajax/insert/jmp_update_close_consequence.php",
            cache: false,
            contentType: false,
            processData: false,
            method: "POST",
            data: data,
            beforeSend: function() {
                $('#edit_insert').val("Updating");
            },
            success: function(data) {
                console.log(data);

                if (data != 0) {
                    Swal.fire({
                        position: 'bottom-left',
                        icon: 'success',
                        title: 'Record Updated Successfully',
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

    $('#edit_form2').on("submit", function(event) {
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
            beforeSend: function() {
                $('#edit_insert').val("Updating");
            },
            success: function(data) {
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

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Record Not Updated.',
                    })
                }




            }
        });

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
                url: 'ajax/delete/delete_dedicated_trips.php',
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