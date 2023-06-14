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

    <?php include 'head_tag.php' ?>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNyJWb04pByaU1CTmimoWNl3b86VV6qZ8&callback=initMap&libraries=drawing&v=weekly"
        defer></script>

</head>
<?php
include("config.php");
$id = $_GET['id'];

$result = mysqli_query($db,"SELECT * FROM `geofenceing` where id='$id'");
$data = mysqli_fetch_array($result);

    


if($data['type']=='circle'){
    ?>

<script>
var cord = "<?php echo $data['Coordinates'] ?>";
var radib = "<?php echo $data['radius'] ?>";
geo_type = "<?php echo $data['type'] ?>";
//alert(cord);
var chars = cord.split(', ')
center = {
    lat: parseFloat(chars[0]),
    lng: parseFloat(chars[1])
}
// alert(chars[0]+":"+chars[1]+":"+radib)
</script>
<?php 
}
else{
    ?>

<script>
var poly_cord = [];
var cord = "<?php echo $data['Coordinates'] ?>";
var radib = "<?php echo $data['radius'] ?>";
geo_type = "<?php echo $data['type'] ?>";


var str = cord;
var str_array = str.split(';');


var points = [];
for (var i = 0; i < str_array.length - 1; i++) {
    var co = str_array[i].split(',');
    if (i == 0) {
        center = {
            lat: parseFloat(co[1]),
            lng: parseFloat(co[0])
        }
    }

    points.push({
        lat: parseFloat(co[1]),
        lng: parseFloat(co[0])
    });
}

console.log(center);
console.log(points);
</script>
<?php 
}

// $result = "SELECT tc_users.name,tc_users.email,users.privilege,users.login,users.description\n"

//     . "FROM tc_users\n"

//     . "INNER JOIN users ON tc_users.id=users.id";
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

                    <div class="row layout-top-spacing" id="cancel-row">

                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-6">
                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div id="mapid" style="width: 100%; height: 70vh; z-index: 0;" class="">
                                        </div>
                                    </div>
                                    <div class="table-responsive mb-4 mt-4">


                                    </div>
                                </div>
                            </div>

                            <script>
                            function initMap() {
                                const map = new google.maps.Map(document.getElementById("mapid"), {
                                    zoom: 18,
                                    center: center,
                                    mapTypeId: "terrain",
                                });
                                // Define the LatLng coordinates for the polygon's path.
                                // const triangleCoords = [objects];

                                // Construct the polygon.
                                if (geo_type != "polygon") {
                                    const cityCircle = new google.maps.Circle({
                                        strokeColor: "#FF0000",
                                        strokeOpacity: 0.8,
                                        strokeWeight: 2,
                                        fillColor: "#FF0000",
                                        fillOpacity: 0.35,
                                        map,
                                        center: {
                                            lat: parseFloat(chars[0]),
                                            lng: parseFloat(chars[1])
                                        },
                                        radius: 300,
                                        clickable: false,
                                        editable: true,
                                        zIndex: 1,
                                        draggable: true,
                                        geodesic: false
                                    });
                                    google.maps.event.addListener(cityCircle, 'center_changed', function() {
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
                                    google.maps.event.addListener(cityCircle, 'radius_changed', function() {
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

                                } else {
                                    const bermudaTriangle = new google.maps.Polygon({
                                        map,
                                        paths: points,
                                        strokeColor: "#FF0000",
                                        strokeOpacity: 0.8,
                                        strokeWeight: 2,
                                        fillColor: "#FF0000",
                                        fillOpacity: 0.35,
                                        draggable: true,
                                        geodesic: false,
                                        editable: true
                                    });
                                    // console.log(bermudaTriangle.getPaths())
                                    bermudaTriangle.getPaths().forEach(function(path, index) {

                                        google.maps.event.addListener(path, 'insert_at', function() {
                                            var coordStr_edit = "";
                                            var poly_points_edit = [];
                                            for (var i = 0; i < path.getLength(); i++) {
                                                var co_string = path.getAt(i).toUrlValue(6);
                                                var spl_co = co_string.split(",");
                                                console.log(path.getAt(i).toUrlValue(6))
                                                coordStr_edit += spl_co[1] + "," + spl_co[0] + ";";

                                            }
                                            poly_points_edit.push(coordStr_edit)
                                            console.log(poly_points_edit);
                                            document.getElementById("lati").value = poly_points_edit;
                                            document.getElementById("type").value = 'polygon';
                                        });

                                        google.maps.event.addListener(path, 'remove_at', function() {
                                            var coordStr_edit = "";
                                            var poly_points_edit = [];
                                            for (var i = 0; i < path.getLength(); i++) {
                                                var co_string = path.getAt(i).toUrlValue(6);
                                                var spl_co = co_string.split(",");
                                                console.log(path.getAt(i).toUrlValue(6))
                                                coordStr_edit += spl_co[1] + "," + spl_co[0] + ";";

                                            }
                                            poly_points_edit.push(coordStr_edit)
                                            console.log(poly_points_edit);
                                            document.getElementById("lati").value = poly_points_edit;
                                            document.getElementById("type").value = 'polygon';
                                        });

                                        google.maps.event.addListener(path, 'set_at', function() {
                                            var coordStr_edit = "";
                                            var poly_points_edit = [];
                                            for (var i = 0; i < path.getLength(); i++) {
                                                var co_string = path.getAt(i).toUrlValue(6);
                                                var spl_co = co_string.split(",");
                                                console.log(path.getAt(i).toUrlValue(6))
                                                coordStr_edit += spl_co[1] + "," + spl_co[0] + ";";

                                            }
                                            poly_points_edit.push(coordStr_edit)
                                            console.log(poly_points_edit);
                                            document.getElementById("lati").value = poly_points_edit;
                                            document.getElementById("type").value = 'polygon';
                                        });
                                    });


                                    bermudaTriangle.setMap(map);
                                }
                            }

                            window.initMap = initMap;
                            </script>







                            <!-- CONTENT AREA -->

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
    <?php include 'script_tag.php' ?>
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