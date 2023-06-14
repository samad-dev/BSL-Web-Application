<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Geofences | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Geofences Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>

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

$geotype_query = mysqli_query($db,"SELECT * FROM geofence_type;");


?>

<body>
    <script>
    // console.log(circle_cord);

    var route_data = [];
    var markersArray = [];
    </script>
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
                                <h4 class="mb-sm-0 font-size-18">Geofences</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Geofences</a></li>
                                        <li class="breadcrumb-item active">Geofences</li>
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
                        <div class="col-md-12">
                            <div id="map-canvas" style="width: 100%; height: 100vh; z-index: 0;" class="">

                            </div>
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
            <h5 id="offcanvasRightLabel" id='title_edit'>Create Geofences</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-3">


                            <form method="post" id="insert_form" enctype="multipart/form-data">

                                <div class="row mb-3">



                                    <div class="col-md-12">
                                        <label class="form-label">Fence Name</label>
                                        <input type="text" class="form-control " id="name" name="name" required>
                                    </div>

                               
                                   
                                    <div class="col-md-12">
                                        <label class="form-label">Co-ordinates</label>
                                        <input type="text" class="form-control " id="lati" name="lati" required
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Geo Type</label>

                                        <select class="form-control" data-trigger name="geotype" id="geotype"
                                            placeholder="Select Geo Type">
                                            <option value="">Select Geo Type</option>
                                            <?php  while($row_geotype = mysqli_fetch_array($geotype_query)) { ?>
                                            <option value="<?php echo $row_geotype['id'];?>">
                                                <?php echo $row_geotype['type'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <input type="hidden" class="form-control input" id="radius" name="radius"
                                        placeholder="Radius" required>
                                    <input type="hidden" class="form-control input" id="type" name="type"
                                        placeholder="Enter Type" required>
                                </div>




                                <input type="hidden" name="employee_id" id="employee_id">
                                <div class="mb-3 text-center">
                                    <input class="btn marron_bg" type="submit" name="insert" id="insert" value="Save">
                                </div>


                            </form>



                        </div>




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

<script>
$('#insert_form').on("submit", function(event) {
    event.preventDefault();
    var data = new FormData(this);

    $.ajax({
        url: "ajax/insert/create_fence.php",
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
                    title: 'Geofence Created Successfully',
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
                    text: 'Geofence Not Created.',
                })
            }




        }
    });

});
</script>

<script>
let map;
var circle;
let flightPath;

function initMap() {

    gmarkers = [];
    map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: {
            lat: 30.3753,
            lng: 69.3451
        },
        zoom: 6,

    });


    const drawingManager = new google.maps.drawing.DrawingManager({
        // drawingMode: google.maps.drawing.OverlayType.MARKER,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.CIRCLE,
                google.maps.drawing.OverlayType.POLYGON,
            ],
        },
        // markerOptions: {
        //   icon:
        //     "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
        // },
        circleOptions: {
            fillColor: "lightGreen",
            fillOpacity: 0.4,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1,
            draggable: true,
            geodesic: false,
        },
        polygonOptions: {
            fillColor: "lightGreen",
            fillOpacity: 0.4,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1,
            draggable: true,
            geodesic: false,
        },
    });
    drawingManager.setMap(map);
    google.maps.event.addListener(drawingManager, 'circlecomplete', onCircleComplete);
    google.maps.event.addListener(drawingManager, 'polygoncomplete', polygon);



}
var circle_point = [];

function onCircleComplete(shape) {
    if (shape == null || (!(shape instanceof google.maps.Circle))) return;

    if (circle != null) {
        circle.setMap(null);
        circle = null;
    }

    circle = shape;
    // console.log('radius', circle.getRadius());
    // console.log('lat', circle.getCenter().lat());
    // console.log('lng', circle.getCenter().lng());

    var radius = circle.getRadius();
    // console.log(radius);
    var cirlat = circle.getCenter().lat();
    // console.log(cirlat);
    var cirlng = circle.getCenter().lng();
    // console.log(cirlng);

    var time = new Date();
    var currentTime = time.toLocaleString();
    circle_point.push(cirlat + ", " + cirlng)
    console.log(circle_point)

    // alert(n);

    // alert(" lat => "+ cirlat +" long => "+ cirlng+"Radius => "+radius );
    document.getElementById("lati").value = circle_point;
    document.getElementById("radius").value = radius;
    document.getElementById("type").value = 'circle';
    circle_point = [];

    google.maps.event.addListener(shape, 'center_changed', function() {
        var circle_point_edit = [];
        var lat = this.getCenter().lat();
        var lng = this.getCenter().lng();
        var radius = this.getRadius();
        circle_point_edit.push(lat + ", " + lng)
        console.log(circle_point_edit)
        document.getElementById("lati").value = circle_point_edit;
        document.getElementById("radius").value = radius;
        document.getElementById("type").value = 'circle';

    })
    google.maps.event.addListener(shape, 'radius_changed', function() {
        var circle_point_edit = [];
        var lat = this.getCenter().lat();
        var lng = this.getCenter().lng();
        var radius = this.getRadius();
        circle_point_edit.push(lat + ", " + lng)
        console.log(circle_point_edit)
        document.getElementById("lati").value = circle_point_edit;
        document.getElementById("radius").value = radius;
        document.getElementById("type").value = 'circle';

    })
    // document.getElementById("longi").value = cirlng;
    // document.getElementById("radius").value = radius;
}
var poly_points = [];

function polygon(polygon) {
    var coordStr = "";
    for (var i = 0; i < polygon.getPath().getLength(); i++) {
        var co_string = polygon.getPath().getAt(i).toUrlValue(6);
        var spl_co = co_string.split(",");
        // console.log(polygon.getPath().getAt(i).toUrlValue(6))
        coordStr += spl_co[1] + "," + spl_co[0] + ";";
        // document.getElementById('coords').value = coordStr;

    }
    poly_points.push(coordStr)
    console.log(poly_points);
    var time = new Date();
    var currentTime = time.toLocaleString();
    document.getElementById("lati").value = poly_points;
    document.getElementById("type").value = 'polygon';

    poly_points = [];

    google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {
        var coordStr_edit = "";
        var poly_points_edit = [];
        for (var i = 0; i < polygon.getPath().getLength(); i++) {
            var co_string = polygon.getPath().getAt(i).toUrlValue(6);
            var spl_co = co_string.split(",");
            console.log(polygon.getPath().getAt(i).toUrlValue(6))
            coordStr_edit += spl_co[1] + "," + spl_co[0] + ";";

        }
        poly_points_edit.push(coordStr_edit)
        console.log(poly_points_edit);
        document.getElementById("lati").value = poly_points_edit;
        document.getElementById("type").value = 'polygon';
    });

    google.maps.event.addListener(polygon.getPath(), 'remove_at', function() {
        var coordStr_edit = "";
        var poly_points_edit = [];
        for (var i = 0; i < polygon.getPath().getLength(); i++) {
            var co_string = polygon.getPath().getAt(i).toUrlValue(6);
            var spl_co = co_string.split(",");
            console.log(polygon.getPath().getAt(i).toUrlValue(6))
            coordStr_edit += spl_co[1] + "," + spl_co[0] + ";";

        }
        poly_points_edit.push(coordStr_edit)
        console.log(poly_points_edit);
        document.getElementById("lati").value = poly_points_edit;
        document.getElementById("type").value = 'polygon';
    });

    google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
        var coordStr_edit = "";
        var poly_points_edit = [];
        for (var i = 0; i < polygon.getPath().getLength(); i++) {
            var co_string = polygon.getPath().getAt(i).toUrlValue(6);
            var spl_co = co_string.split(",");
            console.log(polygon.getPath().getAt(i).toUrlValue(6))
            coordStr_edit += spl_co[1] + "," + spl_co[0] + ";";

        }
        poly_points_edit.push(coordStr_edit)
        console.log(poly_points_edit);
        document.getElementById("lati").value = poly_points_edit;
        document.getElementById("type").value = 'polygon';
    });



}
</script>
<script>
function getcode(value) {
    // alert(value);
    $.ajax({
        url: "ajax/get/get_geo_code.php",
        method: "POST",
        data: {
            code: value
        },
        dataType: "json",
        success: function(data) {

            console.log(data[0])
            if (data[0] == 1) {
                alert("code Already Exist Please enter Another code.")
                $('#code1').val('');
            }
        }
    });

}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>