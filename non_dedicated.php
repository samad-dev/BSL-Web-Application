<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Non Dedicated Trip | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Non Dedicated Trip Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

// $result = mysqli_query($db, "SELECT ts.*,tc.*,us.name as client_name,origin_geo.consignee_name as origin_name,tc.destination_name as destination_name,dc.name as vehicle_name,dd.name as driver_name FROM bsl.trips_child_non_dedicated as tc 
// join trips_non_dedicated as ts on ts.id=tc.main_id
// join users as us on us.id=tc.client
// join geofenceing origin_geo on origin_geo.id=tc.origin
// join driver_detail as dd on dd.id=ts.driver
// join devices dc on dc.id=ts.vehicle;");

$result = mysqli_query($db, "SELECT ts.*,dc.name as vehicle_name,dd.name as driver_name,(SELECT count(*) FROM bsl.trips_child_non_dedicated where main_id=ts.id) as trips_count FROM bsl.trips_non_dedicated as ts 
join driver_detail as dd on dd.id=ts.driver
join devices dc on dc.id=ts.vehicle ");

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
                                <h4 class="mb-sm-0 font-size-18">Non Dedicated Trip</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Non Dedicated
                                                Trip</a></li>
                                        <li class="breadcrumb-item active">Non Dedicated Trip</li>
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
                            <a href="non_dedicated_trip_creation.php" class="btn marron_bg"
                                style="font-size: 24px;">+</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Trip Type</th>
                                        <th>Driver Name</th>
                                        <th>Vehicle #</th>
                                        <th>Size</th>

                                        <th>Trip Counts</th>
                                        <!-- <th>Edit</th> -->
                                        <th>Add Sub Trip</th>
                                        <th>View</th>
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
                                                <?php echo $row["type"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["driver_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["vehicle_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["size"]; ?>
                                            </td>

                                            <td>
                                                <?php echo $row["trips_count"]; ?>
                                            </td>
                                            <!-- <td><i class="fas fa-pencil-alt text-success edit_data"
                                                    id='<?php echo $row['id']; ?>'></i></td> -->
                                            <td>
                                                <a href="add_more_non_dedicated_trip.php?id=<?php echo $row['id']; ?>"
                                                    target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-plus text-primary "></i></a>
                                            </td>
                                            <td><i class="fas fa-eye text-success view_trips"
                                                    id='<?php echo $row['id']; ?>'></i></td>
                                            <td><i class="fas fa-trash-alt text-danger delete-btn"
                                                    id='<?php echo $row['id']; ?>'></i></td>

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
        <div class="modal fade bs-example-modal-xl" id="view_trips" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Large modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">

                            <div class="row">


                                <div class="col-md-12" style="overflow: auto;">
                                    <table id="example1" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Vehicle #</th>
                                                <th>Location</th>
                                                <th>Origin</th>
                                                <th>Destination</th>
                                                <th>ETA (Hour)</th>
                                                <th>Departure Time</th>
                                                <th>ETA</th>
                                                <th>Arrival Time</th>
                                                <th>Delivery Time</th>
                                                <th>Trip Status</th>
                                                <th>Created Time</th>
                                                <th>Track Trip</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
</body>
<!-- <script src="script/driver_script.js"></script> -->
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
        $('#example1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
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
                url: 'ajax/delete/delete_none_dedicated_trips.php',
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

    $(document).on('click', '.view_trips', function () {
        var el = this;

        // Delete id
        var employee_id = $(this).attr('id');
        // alert(employee_id);

        $.ajax({
            url: "ajax/get/get_none_sub_trips.php",
            method: "POST",
            data: {
                trip_id: employee_id
            },
            dataType: "json",
            success: function (data) {
                console.log(data)


                var len = data.length;
                //alert("len "+len)

                if (len != 0) {

                    var table = $('#example1').DataTable();
                    table
                        .clear()
                        .draw();

                    var location_status = '';
                    // $("email_btn").fadeIn();
                    for (var i = 0; i < len; i++) {
                        if(data[i].status==3){
                            location_status = 'Completed';
                        }
                        else{
                            location_status= data[i].location;
                        }


                        table
                            .row.add([
                                (i + 1),
                                data[i].vehicle_name,
                                location_status,
                                data[i].origin_name,
                                data[i].destination_name,
                                data[i].eta_hour,
                                data[i].departure_time,
                                data[i].eta,
                                data[i].arrival_time,
                                data[i].delivery_time,
                                data[i].current_status,
                                data[i].craated_at,
                                '<td class="text-center"><a href="none_dedicated_track_trip.php?id='+data[i].trip_sub_id+'" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></a></td>'
                            ])
                            .draw()
                            .node();

                        // if(i===len){
                        //     $("#loader").hide();

                        // }





                    }





                    $('#view_trips').modal('show');
                }
            }
        });

    });

</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>