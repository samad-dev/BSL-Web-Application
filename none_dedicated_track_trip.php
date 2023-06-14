<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Track Trip | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Track Trip Template" name="description" />
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
<style>
.activity-wid {
    margin-left: 0px !important;
}

.simplebar-content {
    padding: 0px !important;
    padding-right: 10px !important;
}
</style>
<?php
include("config.php");

// $resultdevice = mysqli_query($db, "SELECT * FROM devices;");

$user_id = $_SESSION['user_id'];
$pre_role = $_SESSION['privilege'];

$trip_id = $_GET['id'];

$datetime = new DateTime($time);
$datetime->setTime(0, 0, 0);
$only_date = $datetime->format('Y-m-d');

$resultdevice = mysqli_query($db, "SELECT dc.* FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id';");

$sql = "SELECT nd.*,dc.name,td.vehicle as vehi_id,geo.Coordinates as co_origin,geo.consignee_name as origin_name FROM bsl.trips_child_non_dedicated as nd 
join trips_non_dedicated as td on td.id=nd.main_id
join geofenceing as geo on geo.id=nd.origin
join devices as dc on dc.id=td.vehicle where nd.id=$trip_id";

// echo $sql;

$result = mysqli_query($db, $sql);
$row_allow = mysqli_fetch_array($result);

$departure_time = $row_allow['departure_time'];

if ($row_allow['status'] == 3) {
    $delivery_time = $row_allow['delivery_time'];
} else {
    $delivery_time = date('Y-m-d H:i:s');
}

?>




<style>
.activity-wid .activity-list {
    padding: 0 !important;
}
</style>

<body>
    <script>
    // console.log(circle_cord);

    var route_data = [];
    var markersArray = [];
    </script>
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
                                <h4 class="mb-sm-0 font-size-18">Track Trip</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Track Trip</a></li>
                                        <li class="breadcrumb-item active">Track Trip</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->




                    <div class="row">

                        <div class="col-md-12">
                            <div id="map-canvas" style="width: 100%; height: 100vh; z-index: 0;" class="">

                            </div>
                        </div>
                    </div>
                    <!-- end row-->





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
$(document).ready(function() {
    myFunction("<?php echo $row_allow['name'] ?>", "<?php echo $row_allow['vehi_id'] ?>",
        "<?php echo $departure_time ?>", "<?php echo $delivery_time ?>");


    // alert(des_Array[1]);


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
let flightPath;

var poly_marker;
var line;
var intervalId;
var index = 0;
var currentIndex = 0;
var isPlaying = false;
var infowindow;
var opened_info_dis;

function initMap() {

    gmarkers = [];
    map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: {
            lat: 30.3753,
            lng: 69.3451
        },
        zoom: 6,

    });
    // for (var i = 0; i < all_fence.length; i++) {
    //     // console.log(all_fence[i])
    //     const bermudaTriangle = new google.maps.Polygon({
    //         paths: all_fence[i],
    //         strokeColor: "#FF0000",
    //         strokeOpacity: 0.8,
    //         strokeWeight: 2,
    //         fillColor: "#FF0000",
    //         fillOpacity: 0.35,
    //     });

    //     bermudaTriangle.setMap(map);
    // }

    opened_info_dis = new google.maps.InfoWindow();

    // for (var i = 0; i < circle_cord.length; i++) {
    //     // console.log(circle_cord[i])
    //     var str_array = circle_cord[i].split(',');
    //     const cityCircle = new google.maps.Circle({
    //         strokeColor: "#000",
    //         strokeOpacity: 0.8,
    //         strokeWeight: 2,
    //         fillColor: "#000",
    //         fillOpacity: 0.35,
    //         map,
    //         center: {
    //             lat: parseFloat(str_array[0]),
    //             lng: parseFloat(str_array[1])
    //         },
    //         radius: 300,
    //     });

    //     cityCircle.setMap(map);
    // }



    function marker_creation(lat, lng, consignee,radius,type) {
        // alert(lat)
        const image = "images/pump.png";
        const start = "images/icon/start1.png";
        var icon = '';
        if(type!='Destination'){
            icon = start
        }
        else[
            
            icon = image
        ]
        var positiona = new google.maps.LatLng(lat, lng);
        var marker = new google.maps.Marker({
            position: positiona,

            map,
            icon: {
                labelOrigin: new google.maps.Point(11, 50),
                url: icon,

                //size: new google.maps.Size(22, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(11, 40),
            },
        });
        var infowindow = new google.maps.InfoWindow({
            content: '<p>Details:' + '<p>'+type+' # :' + consignee + '</p>'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });

        const cityCircle = new google.maps.Circle({
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
            map,
            center: {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            },
            radius: (parseFloat(radius)*1000),
        });

        cityCircle.setMap(map);

    }
    var destination = "<?php echo $row_allow['destination'];?>";
    var des_Array = destination.split(", ");

    var origin = "<?php echo $row_allow['co_origin'];?>";
    var origin_Array = origin.split(", ");
    marker_creation(des_Array[0], des_Array[1], "<?php echo $row_allow['destination_name'] ?>","<?php echo $row_allow['radius'];?>","Destination");
    marker_creation(origin_Array[0], origin_Array[1], "<?php echo $row_allow['origin_name'] ?>","<?php echo $row_allow['radius'];?>","Origin");
}

function remove_line() {
    flightPath.setMap(null);
    setMapOnAll(null);
    markersArray = [];
    document.getElementById("removing").style.display = 'none';
    document.getElementById("drawing").disabled = false;
}

function setMapOnAll(map) {
    for (let i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(map);
    }
}
</script>

<script>
var startTime;
var pre_time = 0;
var end_time;
var hours;
var sum_hours = 0;
var flightPlanCoordinates = [];
var other_data = [];


function myFunction(vehicle_name, vehicle, from, to) {




    if (vehicle_name != "" && from != "" && to != "") {
        flightPlanCoordinates = [];
        other_data = [];
        // drawing

        $.ajax({
            url: "http://119.160.107.173:3002/positions2/" + vehicle + "/" + from + "/" + to + "",
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                // $('#insert').val("Updating");
                $("#loader").show();
                $("#drawing").prop("disabled", true);
            },
            success: function(data) {

                // data = JSON.parse(data);
                console.log(data)
                var len = data.length;
                $("#my_list").empty();
                if (len > 0) {


                    // document.getElementById("drawing").disabled = true;
                    const lineSymbol = {
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                    };


                    var i = 0;
                    const image = "images/rec.png";
                    const running = "images/icon/car_icon_green.png";

                    const start = "images/icon/start1.png";
                    const end = "images/icon/car_red.png";
                    const stops = "images/stop-sign1.png";

                    data.forEach(obj => {

                        var lat = data[i].LONG;
                        var lng = data[i].LAT;
                        var speed = data[i].SPEED;
                        var power = data[i].IGN;
                        var location = '';
                        // var time = moment(data[i].GpsTime).format(format1);
                        var time = data[i].GpsTime;



                        other_data.push({
                            name: vehicle_name,
                            speed: speed,
                            power: power,
                            location: location,
                            time: time,
                        });

                        var positiona = new google.maps.LatLng(lat, lng);
                        if (i == 0) {
                            // var marker = new google.maps.Marker({
                            //     position: positiona,
                            //     map,
                            //     icon: {
                            //         url: start,
                            //     },


                            // });
                            // markersArray.push(marker);

                            // var infowindow = new google.maps.InfoWindow({
                            //     content: '<p>Details:' + '<p>Vehical # :' +
                            //         vehicle_name +
                            //         '</p>' + '<p>Start Location # :' + location +
                            //         '</p>' + '<p>Latitude:' + lat + '</p>' +
                            //         '<p>Longitude:' + lng + '</p>' + '<p>speed:' +
                            //         speed +
                            //         '</p>' + '<p>Last:' + time + '</p>'
                            // });
                            // marker.addListener('click', function() {
                            //     infowindow.open(map, marker);
                            // });
                        }

                        if (power == 'OFF' && speed == 0) {
                            var starting = time;
                            // console.log("starting " + starting);
                            // console.log("pre " + pre_time);


                            if (i == 0) {
                                startTime = starting;

                                var now = moment(startTime); //todays date
                                var ends = moment(pre_time);
                                var duration = moment.duration(now.diff(ends));
                                hours = duration.asMinutes();
                                // console.log(hours)
                                pre_time = startTime;
                            } else {
                                startTime = starting;

                                var now = moment(startTime); //todays date
                                var ends = moment(pre_time);
                                var duration = moment.duration(now.diff(ends));
                                hours = duration.asMinutes();
                                // console.log(hours)
                                sum_hours = hours + sum_hours;
                                pre_time = startTime;
                            }



                            var marker = new google.maps.Marker({
                                position: positiona,
                                map,
                                icon: {
                                    url: stops,
                                },


                            });
                            markersArray.push(marker);
                            var infowindow = new google.maps.InfoWindow({
                                content: '<p>Details:' + '<p>Vehical # :' +
                                    vehicle_name +
                                    '</p>' + '<p>Stop Location # :' + location +
                                    '</p>' + '<p>Latitude:' + lat + '</p>' +
                                    '<p>Longitude:' + lng + '</p>' + '<p>speed:' +
                                    speed +
                                    '</p>' + '<p>Last:' + time + '</p>' +
                                    '<p>Stop Duration:' + Math.round(sum_hours) +
                                    ' Minutes' + '</p>'
                            });
                            marker.addListener('click', function() {
                                infowindow.open(map, marker);
                            });
                        } else {
                            sum_hours = 0;
                            pre_time = time;
                        }

                        if (i == len - 1) {
                            var marker = new google.maps.Marker({
                                position: positiona,
                                map,
                                icon: {
                                    url: end,
                                },

                            });
                            markersArray.push(marker);
                            var infowindow = new google.maps.InfoWindow({
                                content: '<p>Details:' + '<p>Vehical # :' +
                                    vehicle_name +
                                    '</p>' + '<p>End Location # :' + location +
                                    '</p>' + '<p>Latitude:' + lat + '</p>' +
                                    '<p>Longitude:' + lng + '</p>' + '<p>speed:' +
                                    speed +
                                    '</p>' + '<p>Last:' + time + '</p>'
                            });
                            marker.addListener('click', function() {
                                infowindow.open(map, marker);
                            });
                        }


                        var lati = parseFloat(lat)
                        var lngi = parseFloat(lng)
                        var position = new google.maps.LatLng(lat, lng);
                        flightPlanCoordinates.push({
                            lat: lati,
                            lng: lngi
                        });



                        map.setCenter(position);
                        map.setZoom(12)

                        i++;

                    });

                    flightPath = new google.maps.Polyline({
                        path: flightPlanCoordinates,
                        geodesic: true,
                        strokeColor: "#0008ff",
                        strokeOpacity: 1.0,
                        strokeWeight: 2,
                        icons: [{
                            icon: lineSymbol,
                            offset: "100%",
                            repeat: '100px',
                        }, ],

                    });

                    flightPath.setMap(map);
                    poly_marker = new google.maps.Marker({
                        position: flightPlanCoordinates[0],
                        map: map,
                        icon: {
                            url: running,
                            //                 url: 'https://maps.google.com/mapfiles/kml/shapes/truck.png',
                            // scaledSize: new google.maps.Size(50, 50)
                        },
                        title: 'poly_marker'
                    });
                    infowindow = new google.maps.InfoWindow({
                        content: 'Starting point'
                    });

                    // Attach infowindow to marker
                    poly_marker.addListener('click', function() {
                        infowindow.open(map, poly_marker);
                    });

                    markersArray.push(poly_marker);

                } else {
                    alert("Data Not Found");


                }

                var requestOptions = {
                    method: 'GET',
                    redirect: 'follow'
                };









            }
        });

    } else {
        alert("No Data Found")


    }
}



function animateMarker() {
    // index++;
    // if (index >= flightPlanCoordinates.length) {
    //     clearInterval(intervalId);
    //     return;
    // }
    // poly_marker.setPosition(flightPlanCoordinates[index]);
    // map.panTo(flightPlanCoordinates[index]);
    console.log(other_data[currentIndex].lat);
    console.log(flightPlanCoordinates[currentIndex].lat);
    console.log(flightPlanCoordinates[currentIndex].lng);

    if (currentIndex === flightPlanCoordinates.length) {
        clearInterval(intervalId);
        currentIndex = 0;
        isPlaying = false;
        return;
    }
    // $("#list_"+currentIndex+"").focus();
    poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
    get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng)

    var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p>' +
        '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
        '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
        '<p>Speed:' + other_data[currentIndex].speed + ' km/hr</p>' +
        '<p>Time:' + other_data[currentIndex].time + '</p><p >Location: <span class="set_location"></span></p>';
    infowindow.setContent(info_data);
    map.panTo(flightPlanCoordinates[currentIndex]);

    currentIndex++;
}

function play() {
    if (isPlaying == false) {
        isPlaying = true;
        intervalId = setInterval(animateMarker, 500);
    }
    // intervalId = setInterval(animateMarker, 0.05);
}

function pause() {
    clearInterval(intervalId);
    isPlaying = false;
}

function reset() {
    pause();
    currentIndex = 0;
    poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
    infowindow.setContent('Starting Point');

    map.panTo(flightPlanCoordinates[currentIndex]);

    console.log(flightPlanCoordinates[currentIndex])

    clearInterval(intervalId);
    isPlaying = false;
}

function forward() {

    if (currentIndex < flightPlanCoordinates.length - 1) {
        pause();
        console.log(flightPlanCoordinates[currentIndex].lat)
        // currentIndex++;
        currentIndex += 1;

        poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
        get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng)
        var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p>' +
            '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
            '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
            '<p>Speed:' + other_data[currentIndex].speed + ' km/hr</p>' +
            '<p>Time:' + other_data[currentIndex].time + '</p><p >Location: <span class="set_location"></span></p>';
        infowindow.setContent(info_data);

        map.panTo(flightPlanCoordinates[currentIndex]);

        isPlaying = false;
    }
}

function fast_forward() {

    if (currentIndex < flightPlanCoordinates.length - 1) {
        pause();
        console.log(flightPlanCoordinates[currentIndex].lat)
        // currentIndex++;
        currentIndex += 50;

        poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
        get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng)
        var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p>' +
            '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
            '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
            '<p>Speed:' + other_data[currentIndex].speed + ' km/hr</p>' +
            '<p>Time:' + other_data[currentIndex].time + '</p><p >Location: <span class="set_location"></span></p>';
        infowindow.setContent(info_data);

        map.panTo(flightPlanCoordinates[currentIndex]);

        isPlaying = false;
    }
}

function backward() {
    if (currentIndex > 0) {
        pause();
        // currentIndex--;
        currentIndex -= 1;
        poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
        get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng)

        var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p><p>Location:' +
            get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng) +
            '</p>' +
            '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
            '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
            '<p>Speed:' + other_data[currentIndex].speed + ' km/hr</p>' +
            '<p>Time:' + other_data[currentIndex].time + '</p><p >Location: <span class="set_location"></span></p>';
        infowindow.setContent(info_data);

        map.panTo(flightPlanCoordinates[currentIndex]);
        isPlaying = false;

    }
}

function fast_backward() {
    if (currentIndex > 0) {
        pause();
        // currentIndex--;
        currentIndex -= 50;
        poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
        get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng)

        var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p><p>Location:' +
            get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng) +
            '</p>' +
            '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
            '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
            '<p>Speed:' + other_data[currentIndex].speed + ' km/hr</p>' +
            '<p>Time:' + other_data[currentIndex].time + '</p><p >Location: <span class="set_location"></span></p>';
        infowindow.setContent(info_data);

        map.panTo(flightPlanCoordinates[currentIndex]);
        isPlaying = false;

    }
}

function focus_on_map(lat, lng, index) {



    if (index > 0) {
        pause();
        currentIndex = index;
        // currentIndex--;
        poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
        get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng)

        var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p><p>Location:' +
            get_location_name(flightPlanCoordinates[currentIndex].lat, flightPlanCoordinates[currentIndex].lng) +
            '</p>' +
            '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
            '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
            '<p>Speed:' + other_data[currentIndex].speed + ' km/hr</p>' +
            '<p>Time:' + other_data[currentIndex].time + '</p><p >Location: <span class="set_location"></span></p>';
        infowindow.setContent(info_data);

        map.panTo(flightPlanCoordinates[currentIndex]);
        isPlaying = false;

    }


}

function showInfo_dis(event) {
    opened_info_dis.close();
    if (opened_info_dis.name != this.infowindow.name) {
        this.infowindow.setPosition(event.latLng);
        this.infowindow.open(map);
        opened_info_dis = this.infowindow;
    } else {
        this.infowindow.setPosition(event.latLng);
        this.infowindow.open(map);
        opened_info_dis = this.infowindow;
    }
}


// $(document).keydown(function (event) {
//     if (event.which === 40) {
//         // event.preventDefault(); // Left arrow key
//         // Call function for left arrow key
//         backward();
//     } else if (event.which === 38) {
//         // event.preventDefault();// Right arrow key
//         // Call function for right arrow key
//         forward();
//     }
//     else if (event.which === 32) {
//         // event.preventDefault(); // Space key
//         if (isPlaying) {
//             // Call pause function
//             pause();
//         } else {
//             // Call play function
//             play();
//         }
//     }
// });
document.addEventListener("keydown", function(event) {

    if (event.keyCode === 40) {
        // event.preventDefault(); // Left arrow key
        // Call function for left arrow key
        backward();
        event.preventDefault();
    } else if (event.keyCode === 38) {
        // event.preventDefault();// Right arrow key
        // Call function for right arrow key
        forward();
        event.preventDefault();
    } else if (event.keyCode === 32) {
        // event.preventDefault(); // Space key
        if (isPlaying) {
            // Call pause function
            pause();
            event.preventDefault();
        } else {
            // Call play function
            play();
            event.preventDefault();
        }
    } else if (event.keyCode === 27) {
        // event.preventDefault();// Right arrow key
        // Call function for right arrow key
        reset();
        event.preventDefault();
    } else if (event.keyCode === 33) {
        // event.preventDefault();// Right arrow key
        // Call function for right arrow key
        fast_forward();
        event.preventDefault();
    } else if (event.keyCode === 34) {
        // event.preventDefault();// Right arrow key
        // Call function for right arrow key
        fast_backward();
        event.preventDefault();
    }
});


// document.addEventListener('keydown', function (event) {
//     if (event.keyCode === 32) {
//         // event.preventDefault(); // Space key
//         if (isPlaying) {
//             // Call pause function
//             pause();
//             isPlaying = false;
//         } else {
//             // Call play function
//             play();
//             isPlaying = true;
//         }
//     }
// });

// document.addEventListener('keydown', function (event) {
//     if (event.keyCode === 37 || event.keyCode === 39 || event.keyCode === 32) {
//         event.preventDefault(); // Block default behavior for left, right, and space keys
//     } else if (event.which === 37) { // Left arrow key
//         // Call function for left arrow key
//         backward();
//     } else if (event.which === 39) { // Right arrow key
//         // Call function for right arrow key
//         forward();
//     } else if (event.keyCode === 32) { // Space key
//         if (isPlaying) {
//             // Call pause function
//             pause();
//             isPlaying = false;
//         } else {
//             // Call play function
//             play();
//             isPlaying = true;
//         }
//     }
// });

function get_location_name(lat, lng) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://119.160.107.173:3002/location_name/" + lat + "/" + lng + "", requestOptions)
        .then(response => response.json())
        .then(result => {
            console.log(result[0]['location']);
            $(".set_location").text(result[0]['location']);
            // return result[0]['location'];
        })
        .catch(error => console.log('error', error));

}
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>