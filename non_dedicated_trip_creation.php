<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Trip Creation | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Trip Creation Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNyJWb04pByaU1CTmimoWNl3b86VV6qZ8&callback=initMap&libraries=drawing&v=weekly"
        defer></script>
</head>
<script>
    var all_fence = [];
    var circle_cord = [];
</script>
<?php
include("config.php");

$result = mysqli_query($db, "SELECT * from geofenceing where type='circle'");
$resultdevice = mysqli_query($db, "SELECT * FROM devices;");
$resultdriver = mysqli_query($db, "SELECT * FROM driver_detail;");
$resultclient = mysqli_query($db, "SELECT * FROM bsl.users where privilege='End-User';;");


?>
<?php

$result = mysqli_query($db, "SELECT * FROM `geofenceing` where type='circle'");
while ($row = mysqli_fetch_array($result)) {
    ?>

    <script>
        var cord = "<?php echo $row[7] ?>";
        var radib = "<?php echo $row[2] ?>";



        circle_cord.push(cord)
    </script>
    <?php
}
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
                                <h4 class="mb-sm-0 font-size-18">Trip Creation</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trip Creation</a>
                                        </li>
                                        <li class="breadcrumb-item active">Trip Creation</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="container-fluld ">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="insert_form" enctype="multipart/form-data">
                                    <div class="row offcanvas-body">
                                        <div class="col-md-4">
                                            <label class="form-label">Trip Start Time</label>
                                            <input type="datetime-local" class="form-control " id="tip_start_time"
                                                name="tip_start_time" required>
                                        </div>

                                        <!-- <div class="col-md-4">
                                            <label for="inputAddress">Trip Type</label>

                                            <select class="form-control all_select" name="trip_type" id="trip_type"
                                                required>
                                                <option value="">Select Type</option>
                                                <option value="Dedicated">Dedicated</option>
                                                <option value="Non Dedicated">Non Dedicated</option>

                                            </select>
                                        </div> -->
                                        <input type="hidden" name="trip_type" id="trip_type" value="Non Dedicated">
                                        <div class="col-md-4">
                                            <label for="inputAddress">Driver</label>

                                            <select class="form-control all_select" name="driver" id="driver" required>
                                                <option value="">Select Driver</option>
                                                <?php foreach ($resultdriver as $key => $value) { ?>
                                                    <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Vehicle</label>

                                            <select class="form-control all_select" name="vehi_id" id="vehi_id"
                                                required>
                                                <option value="">Select Vehicle</option>
                                                <?php foreach ($resultdevice as $key => $value) { ?>
                                                    <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Size</label>
                                            <input type="text" class="form-control " id="size_vehi" name="size_vehi"
                                                required>
                                        </div>
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Client</label>

                                            <select class="form-control all_select" name="client" id="client" required>
                                                <option value="">Select Client</option>
                                                <?php foreach ($resultclient as $key => $value) { ?>
                                                    <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class=" col-md-4">
                                            <label for="inputAddress">Origin (Circle)</label>

                                            <select class="form-control all_select" name="origin" id="origin" required>
                                                <option value="">Select Origin</option>
                                                <?php foreach ($result as $key => $value) { ?>
                                                    <option value="<?= $value['id']; ?>"><?= $value['consignee_name']; ?>
                                                    </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- <div class=" col-md-4">
                                            <label for="inputAddress">Destination</label>

                                            <select class="form-control all_select" name="destination" id="destination"
                                                required>
                                                <option value="">Select Destination</option>
                                                <?php foreach ($result as $key => $value) { ?>
                                                    <option value="<?= $value['id']; ?>"><?= $value['consignee_name']; ?>
                                                    </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div> -->
                                        <div class="col-md-4">
                                            <label class="form-label">Std TT</label>
                                            <input type="number" class="form-control " id="std" name="std" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Destination Name</label>
                                            <input type="text" class="form-control " id="dst_name" name="dst_name"
                                                required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Destination Points</label>
                                            <input type="text" class="form-control " id="destination" name="destination"
                                                required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Points radius (In Kms)</label>
                                            <input type="text" class="form-control " id="point_radius" value="2"
                                                name="point_radius" required>
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

                        <div class="row">
                            <div class="col-md--12">
                                <div id="map-canvas" style="width: 100%; height: 100vh; z-index: 0;" class="">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php include 'footer.php' ?>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
</body>

<script>
    var map;
    var marker = null;

    function initMap() {

        gmarkers = [];
        map = new google.maps.Map(document.getElementById("map-canvas"), {
            center: {
                lat: 30.3753,
                lng: 69.3451
            },
            zoom: 6,

        });
        for (var i = 0; i < circle_cord.length; i++) {
            // console.log(circle_cord[i])
            var str_array = circle_cord[i].split(',');
            const cityCircle = new google.maps.Circle({
                strokeColor: "#000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#000",
                fillOpacity: 0.35,
                map,
                center: {
                    lat: parseFloat(str_array[0]),
                    lng: parseFloat(str_array[1])
                },
                radius: 300,
            });

            cityCircle.setMap(map);
        }


        google.maps.event.addListener(map, 'click', function (event) {
            // Remove the previous marker, if it exists
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            if (marker) {
                marker.setMap(null);
            }
            // Add a new marker at the clicked location
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
            $('#destination').val(lat + ", " + lng);
        });










    }
</script>
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

        $('#insert_form').on("submit", function (event) {
            event.preventDefault();
            if ($('#destination').val() != "") {
                var data = new FormData(this);
                $.ajax({
                    url: "ajax/insert/create_trip.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: data,
                    beforeSend: function () {
                        $('#insert').val("Inserting");
                    },
                    success: function (data) {
                        console.log(data);

                        if (data != 0) {
                            Swal.fire({
                                position: 'bottom-left',
                                icon: 'success',
                                title: 'Trip Created Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            setTimeout(function () {
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

            } else {
                alert("Please Select Destination");
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
                url: 'ajax/delete/delete_fences.php',
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

    function get_geo(vehi) {
        // alert(vehi)
        if (vehi != "") {
            $.ajax({
                url: 'ajax/get/get_vehi_geo.php',
                type: 'POST',
                data: {
                    vehi_id: vehi
                },
                success: function (data) {
                    data = JSON.parse(data)
                    console.log(data);
                    var len = data.length;
                    // ////alert(len)
                    $("#origin").empty();

                    if (len > 0) {
                        $("#origin").append(`<option value="">Select Origin</option>`);
                        for (var i = 0; i < len; i++) {
                            var id = data[i]['id'];
                            var consignee_name = data[i]['consignee_name'];
                            console.log(consignee_name);
                            $("#origin").append(
                                `<option value="${id}">${consignee_name}</option>`);


                        }

                    } else {
                        alert("No Records Found");
                    }
                }
            });
        }
    }
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>