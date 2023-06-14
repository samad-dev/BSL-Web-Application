<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>View | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & View Creation Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$result = mysqli_query($db,"SELECT * from geofenceing where type='circle'");
$resultdevice = mysqli_query($db,"SELECT * FROM devices;");
$resultdriver = mysqli_query($db,"SELECT * FROM driver_detail;");
$resultclient = mysqli_query($db,"SELECT * FROM bsl.users where privilege='End-User';;");


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
                                <h4 class="mb-sm-0 font-size-18">View Creation</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">View Creation</a>
                                        </li>
                                        <li class="breadcrumb-item active">Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <div class="mb-4">
                                                    <span class="logo-txt">Vehicle:JU-9604</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="mb-4">
                                                    <h4 class="float-end font-size-16">Customer  :  Atlas Honda</h4>
                                                    <h4 class="font-size-16">Loading Site: FTTL</h4>
                                                    <h4 class="font-size-16"><b> Decanting Site :</b>  UEPL</h4>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3" style="font-weight:bold;font-size:large">
                                                <p class="mb-1">Trip Start : </p>

                                            </div>
                                            <div class="col-md-2">
                                                <p class="mb-1">06/06/2023 3:15 PM</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3" style="font-weight:bold;font-size:large">
                                                <p class="mb-1">Movement Order(Shipment/Bilti) : </p>

                                            </div>
                                            <div class="col-md-2">
                                                <p class="mb-1">001</p>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-3" style="font-weight:bold; font-size:large;">
                                                <p class="mb-1">Decanting Site : </p>

                                            </div>
                                            <div class="col-md-2">
                                                <p class="mb-1">UEPL</p>
                                            </div>
                                        </div> -->

                                    </div>
                                    <hr class="my-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div>
                                                <h5 class="font-size-18 mb-3">Driver Details:</h5>
                                                <h5 class="font-size-14 mb-2">Driver 1</h5>
                                                <p class="mb-1"> <b> Name : </b>Saleem </p>
                                                <p class="mb-1"> <b> CNIC : </b>44401-34343663-4</p>
                                                <p> <b> Mobile : </b>03217623464</p>
                                                <p> <b> Duty Start Time : </b>03/04/2023 10:00 AM</p>
                                                <br>
                                                <h5 class="font-size-14 mb-2">Driver 2</h5>
                                                <p class="mb-1"> <b> Name : </b>Nadeem </p>
                                                <p class="mb-1"> <b> CNIC : </b>43301-34323263-1</p>
                                                <p> <b> Mobile : </b>03331123464</p>
                                                <p> <b> Duty Start Time : </b>08/06/2023 12:00 AM</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div>
                                                <div>
                                                    <h5 class="font-size-14">Departure from Terminal:</h5>
                                                    <p>May 26, 2023 , 5:00 PM</p>
                                                </div>
                                                <div>
                                                    <h5 class="font-size-14">Arrival At Loading Site:</h5>
                                                    <p>May 26, 2023 , 7:00 PM</p>
                                                </div>
                                                <div>
                                                    <h5 class="font-size-14">Loading Start Time:</h5>
                                                    <p>May 26, 2023 , 7:30 PM</p>
                                                </div>
                                                <div>
                                                    <h5 class="font-size-14">Loading Completion Time:</h5>
                                                    <p>May 26, 2023 , 9:30 PM</p>
                                                </div>
                                                <div>
                                                    <h5 class="font-size-14">Departure From Loading Site:</h5>
                                                    <p>May 26, 2023 , 10:00 PM</p>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div>
                                                <h5 class="font-size-14">Total Loading Time</h5>
                                                <p>May 26 2023, 10:00 hours</p>

                                                <h5 class="font-size-14">ETA at Destination</h5>
                                                <p>42 hours</p>

                                                <h5 class="font-size-14">Estimated Total Trip Time</h5>
                                                <p>50 hours</p>


                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div>
                                                <h5 class="font-size-14">Capacity</h5>
                                                <p>8000</p>

                                                <h5 class="font-size-14">Chamber 1</h5>
                                                <p> 5000</p>

                                                <h5 class="font-size-12">Dip 1</h5>
                                                <p>3000</p>

                                                <h5 class="font-size-14">Chamber 2</h5>
                                                <p>4000</p>

                                                <h5 class="font-size-12">Dip 2</h5>
                                                <p>2000</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="py-2 mt-3">
                            <h5 class="font-size-15">Order summary</h5>
                        </div>
                        <div class="p-4 border rounded">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th class="text-end" style="width: 120px;">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>
                                                <h5 class="font-size-15 mb-1">Minia</h5>
                                                <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                            </td>
                                            <td class="text-end">$499.00</td>
                                        </tr>
                                        
                                        <tr>
                                            <th scope="row">02</th>
                                            <td>
                                                <h5 class="font-size-15 mb-1">Skote</h5>
                                                <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                            </td>
                                            <td class="text-end">$499.00</td>
                                        </tr>

                                        <tr>
                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                            <td class="text-end">$998.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="2" class="border-0 text-end">
                                                Tax</th>
                                            <td class="border-0 text-end">$12.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="2" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end"><h4 class="m-0">$1010.00</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                                <div class="d-print-none mt-3">
                                    <div class="float-end">
                                        <a href="javascript:window.print()"
                                            class="btn btn-success waves-effect waves-light me-1"><i
                                                class="fa fa-print"></i></a>
                                        <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                        document.write(new Date().getFullYear())
                        </script> © Minia.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Page-content -->


    <?php include 'footer.php'?>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




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

    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        var data = new FormData(this);

        $.ajax({
            url: "ajax/insert/jmp_trip_creation.php",
            cache: false,
            contentType: false,
            processData: false,
            method: "POST",
            data: data,
            beforeSend: function() {
                $('#insert').val("Inserting");
            },
            success: function(data) {
                console.log(data);

                if (data != 0) {
                    Swal.fire({
                        position: 'bottom-left',
                        icon: 'success',
                        title: 'Trip Created Successfully',
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
                        text: 'Trip Not Created.',
                    })
                }




            }
        });

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

function get_driver_detail(val, id) {
    // alert(id)
    if (val != "") {
        $.ajax({
            url: "ajax/get/get_driver_detail.php",
            method: "POST",
            data: {
                driver_id: val
            },
            dataType: "json",
            success: function(data) {
                console.log(data)

                $('#cnic_d' + id + '').val(data.cnic);
                $('#mobile_d' + id + '').val(data.mobile_no);
            }
        });
    }
}

function get_drivers(val) {
    // alert(id)
    if (val != "") {
        $.ajax({
            url: "ajax/get/get_driver_detail.php",
            method: "POST",
            data: {
                vehicle_id: val
            },
            dataType: "json",
            success: function(data) {
                console.log(data)

                $('#cnic_d' + id + '').val(data.cnic);
                $('#mobile_d' + id + '').val(data.mobile_no);
            }
        });
    }
}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>