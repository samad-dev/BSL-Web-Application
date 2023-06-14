<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>JMP Creation | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & JMP Creation Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$result = mysqli_query($db,"SELECT * from geofenceing");
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
                                <h4 class="mb-sm-0 font-size-18">JMP Creation</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">JMP Creation</a>
                                        </li>
                                        <li class="breadcrumb-item active">JMP Creation</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="container-fluld">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="insert_form" enctype="multipart/form-data">
                                    <div class="row offcanvas-body">
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Vehicle</label>
                                            <select class="form-control all_select" name="vehi_id" id="vehi_id"
                                                required onchange="get_drivers(this.value)">
                                                <option value="">Select </option>
                                                <?php foreach($resultdevice as $key => $value){ ?>
                                                <option value="<?= $value['id'];?>"><?= $value['name']; ?></option>
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>

                                        <div class=" col-md-4">
                                            <label for="inputAddress">Customer</label>

                                            <select class="form-control all_select" name="customer" id="customer"
                                                required>
                                                <option value="">Select </option>
                                                <?php foreach($resultclient as $key => $value){ ?>
                                                <option value="<?= $value['id'];?>"><?= $value['name']; ?></option>
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Loading Site</label>

                                            <select class="form-control all_select" name="loading_site"
                                                id="loading_site" required>
                                                <option value="">Select </option>
                                                <?php foreach($result as $key => $value){ ?>
                                                <option value="<?= $value['id'];?>"><?= $value['consignee_name']; ?>
                                                </option>
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Trip Start Date</label>

                                            <input type="datetime-local" class="form-control " id="trip_start_date"
                                                name="trip_start_date" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Movement Order (Shipment/Bilti)</label>
                                            <input type="number" class="form-control " id="shipment_bilti"
                                                name="shipment_bilti" required>
                                        </div>
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Decanting Site</label>

                                            <select class="form-control all_select" name="destination" id="destination"
                                                required>
                                                <option value="">Select </option>
                                                <?php foreach($result as $key => $value){ ?>
                                                <option value="<?= $value['id'];?>"><?= $value['consignee_name']; ?>
                                                </option>
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputAddress">Driver 1</label>

                                            <select class="form-control all_select" name="driver_d1" id="driver_d1"
                                                onchange="get_driver_detail(this.value,1)" >
                                                <option value="">Select </option>
                                                <?php foreach($resultdriver as $key => $value){ ?>
                                                <option value="<?= $value['id'];?>"><?= $value['name']; ?></option>
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">CNIC</label>
                                            <input type="text" class="form-control " id="cnic_d1" name="cnic_d1"
                                                >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Mobile #</label>
                                            <input type="text" class="form-control " id="mobile_d1" name="mobile_d1"
                                                >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Duty Time Start</label>
                                            <input type="datetime-local" class="form-control " id="duty_time_d1"
                                                name="duty_time_d1" >
                                        </div>

                                        <div class="col-md-3">
                                            <label for="inputAddress">Driver 2</label>

                                            <select class="form-control all_select" name="driver_d2" id="driver_d2"
                                                onchange="get_driver_detail(this.value,2)" >
                                                <option value="">Select Driver</option>
                                                <?php foreach($resultdriver as $key => $value){ ?>
                                                <option value="<?= $value['id'];?>"><?= $value['name']; ?></option>
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">CNIC</label>
                                            <input type="text" class="form-control " id="cnic_d2" name="cnic_d2"
                                                >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Mobile #</label>
                                            <input type="text" class="form-control " id="mobile_d2" name="mobile_d2"
                                                >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Duty Time Start</label>
                                            <input type="datetime-local" class="form-control " id="duty_time_d2"
                                                name="duty_time_d2" >
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Departure from Terminal</label>
                                            <input type="datetime-local" class="form-control "
                                                id="departure_from_terminal" name="departure_from_terminal" >
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Arrival at Loading Site</label>
                                            <input type="datetime-local" class="form-control "
                                                id="arrival_at_loading_site" name="arrival_at_loading_site" >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Loading Start Time</label>
                                            <input type="datetime-local" class="form-control " id="loading_start_time"
                                                name="loading_start_time" >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Loading Completion Time</label>
                                            <input type="datetime-local" class="form-control "
                                                id="loading_complete_time" name="loading_complete_time" >
                                        </div>


                                        <div class="col-md-3">
                                            <label class="form-label">Departure from Loading Site</label>
                                            <input type="datetime-local" class="form-control "
                                                id="departure_at_loading_site" name="departure_at_loading_site"
                                                >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Total Loading Time</label>
                                            <input type="text" class="form-control " id="total_loading_time"
                                                name="total_loading_time">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Arrival Back at Terminal</label>
                                            <input type="text" class="form-control " id="eta_destination"
                                                name="eta_destination" >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Estimated Total Trip Time</label>
                                            <input type="text" class="form-control " id="estimated_total_trip_time"
                                                name="estimated_total_trip_time">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Capacity</label>
                                            <input type="text" class="form-control " id="capacity"
                                                name="capacity">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Chamber# 1</label>
                                            <input type="text" class="form-control " id="chamber1"
                                                name="chamber1">
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label">DIP 1</label>
                                            <input type="number" class="form-control " id="dip1"
                                                name="dip1">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Chamber# 2</label>
                                            <input type="text" class="form-control " id="chamber2"
                                                name="chamber2">
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label">DIP 2</label>
                                            <input type="number" class="form-control " id="dip2"
                                                name="dip2">
                                        </div>


                                        <input type="hidden" name="employee_id" id="employee_id">
                                        <div class="my-3 text-center">
                                            <!-- <button class="btn rounded-pill marron_bg" type="submit" name="insert"
                                                            id="insert">Save</button> -->
                                            <input class="btn marron_bg" type="submit" name="insert" id="insert"
                                                value="Start Trip">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <!-- container-fluid -->
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

function get_driver_detail(val,id){
    // alert(id)
    if(val!=""){
        $.ajax({
            url: "ajax/get/get_driver_detail.php",
            method: "POST",
            data: {
                driver_id: val
            },
            dataType: "json",
            success: function (data) {
                console.log(data)

                $('#cnic_d'+id+'').val(data.cnic);
                $('#mobile_d'+id+'').val(data.mobile_no);
            }
        });
    }
}

function get_drivers(val){
    // alert(id)
    if(val!=""){
        $.ajax({
            url: "ajax/get/get_driver_detail.php",
            method: "POST",
            data: {
                vehicle_id: val
            },
            dataType: "json",
            success: function (data) {
                console.log(data)

                $('#cnic_d'+id+'').val(data.cnic);
                $('#mobile_d'+id+'').val(data.mobile_no);
            }
        });
    }
}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>