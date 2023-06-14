<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Track Alert | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Track Alert Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNyJWb04pByaU1CTmimoWNl3b86VV6qZ8&callback=initMap&libraries=drawing&v=weekly"
        defer></script>

</head>

<script>
var center = {};
var geo_type = "";
var geo_name = "";
var is_fence = '';
</script>
<?php
include("config.php");
$pos_id = $_GET['id'];
$geo_id = $_GET['geo'];
// $position = mysqli_query($db, "SELECT * FROM bsl.positions where msgid='$pos_id'");
// $row = mysqli_fetch_array($position);


$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => 'http://119.160.107.173:3002/message_pos/'.$pos_id.'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    )
);

$response = curl_exec($curl);
curl_close($curl);

$response = json_decode($response, true);
if($response != null)
{
    $row = $response[0];
}
print_r($row);



if($geo_id!=""){
    $result = mysqli_query($db,"SELECT * FROM `geofenceing` where id='$geo_id'");
    $data = mysqli_fetch_array($result);
    if($data['type']=='circle'){
        ?>

<script>
var cord = "<?php echo $data['Coordinates'] ?>";
var radib = "<?php echo $data['radius'] ?>";
geo_type = "<?php echo $data['type'] ?>";
is_fence = 'yes';

geo_name = '<p>Fence Name :  <?php echo  $data['consignee_name']?></p>';

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
geo_name = '<p>Fence Name :  <?php echo  $data['consignee_name']?></p>';

// alert(geo_name);
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
}
else{
    ?>
<script>
is_fence = 'no';
</script>
<?php
}


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
                                <h4 class="mb-sm-0 font-size-18">Track Alert</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Track Alert</a></li>
                                        <li class="breadcrumb-item active">Track Alert</li>
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
            <h5 id="offcanvasRightLabel" id='title_edit'>Add Track Alert</h5>
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
<script>
let map;
var circle;
var vehicle_name = "<?php echo $row['Number']?>";
var latitude = "<?php echo $row['Y']?>";
var longitude = "<?php echo $row['X']?>";
var time = "<?php echo $row['GpsTime']?>";
var speed = "<?php echo $row['VectorSpeed']?>";
var alert_type = "<?php echo $_GET['type']?>";

function initMap() {
    const myLatLng = {
        lat: <?php echo $row['Y']?>,
        lng: <?php echo $row['X']?>
    };
    gmarkers = [];

    map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: myLatLng,
        zoom: 12,

    });


    if (is_fence != 'no') {

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
            });

        } else {
            console.log(points)

            const bermudaTriangle = new google.maps.Polygon({
                paths: points,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
            });

            bermudaTriangle.setMap(map);
        }
    }


    const fimage = "images/icon/car_icon_green.png";


    const infowindow = new google.maps.InfoWindow({
        content: '<p>Details:' +
            '<p>Alert Type : ' + alert_type + '</p>' +
            '<p>Vehical # : ' + vehicle_name + '</p>' +
            '<p>Latitude : ' + latitude + '</p>' +
            '<p>Longitude : ' + longitude + '</p>' +
            '<p>Speed : ' + speed + ' KM/Hr</p>' +
            '<p>Time : ' + time + '</p>' + geo_name
    });
    const marker = new google.maps.Marker({
        position: myLatLng,
        map,
        icon: fimage
    });

    marker.addListener("click", () => {
        infowindow.open({
            anchor: marker,
            map,

        });
    });

}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>