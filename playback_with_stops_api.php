<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Playback | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Playback Template" name="description" />
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

$resultdevice = mysqli_query($db, "SELECT * FROM devices;");


?>
<?php

$result = mysqli_query($db, "SELECT * FROM `geofenceing` where type='polygon'");
while ($row = mysqli_fetch_array($result)) {
    ?>

    <script>
        var poly_cord = [];
        var cord = "<?php echo $row[7] ?>";
        var radib = "<?php echo $row[2] ?>";
        // console.log(radib);

        var str = cord;
        var str_array = str.split(';');
        var center = {};

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
        all_fence.push(points);
    </script>
<?php } ?>

<?php

// $result = mysqli_query($db, "SELECT * FROM `geofenceing` where type='circle'");
// while ($row = mysqli_fetch_array($result)) {
    ?>

    <script>
        // var cord = "<?php echo $row[7] ?>";
        // var radib = "<?php echo $row[2] ?>";



        // circle_cord.push(cord)
    </script>
<?php 
// } 
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
                                <h4 class="mb-sm-0 font-size-18">Playback</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Playback</a></li>
                                        <li class="breadcrumb-item active">Playback</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                    class="fas fa-search"></i></button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button id="playBtn" class="btn btn-success poly_btn" onclick="play()">Play</button>
                            <button id="pauseBtn" class="btn btn-danger poly_btn" onclick="pause()">Pause</button>
                            <button id="resetBtn" class="btn btn-info poly_btn" onclick="reset()">Reset</button>
                            <button id="backwordBtn" class="btn btn-warning poly_btn" onclick="backward()">Backward</button>
                            <button id="fowardBtn" class="btn btn-warning poly_btn" onclick="forward()">Forward</button>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h3>
                                Distance :
                            </h3>
                            <h3 id="distance">

                            </h3>

                        </div>
                        <!-- <div class="col-md-3">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Playback Records

                                <div class="card-body px-0">
                                    <div class="px-3" data-simplebar style="max-height: 80vh;">
                                        <ul class="list-unstyled activity-wid mb-0" id="my_list">




                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div> -->
                        <div class="col-md-12">
                            <div id="map-canvas" style="width: 100%; height: 100vh; z-index: 0;" class="">

                            </div>
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Search Playback</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-3">





                            <div class="form-group col-md-12">
                                <label for="inputAddress">Asset</label>

                                <select class="form-control" data-trigger name="vehi_id" id="vehi_id"
                                    placeholder="Search Asset">
                                    <option value="">Select Asset</option>
                                    <?php foreach ($resultdevice as $key => $value) { ?>
                                        <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">From</label>
                                <input type="datetime-local" class="form-control " id="from" name="from" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">To</label>
                                <input type="datetime-local" class="form-control " id="to" name="to" required>
                            </div>
                        </div>




                        <div class="mb-3 text-center">
                            <button type="button" class="btn marron_bg" id="drawing"
                                onclick="myFunction()">Playback</button>

                        </div>



                        <div class="col-md-12 mt-4">
                            <button type="button" class="btn marron_bg" id="removing" onclick="remove_line()"
                                style="float:right; display: none">Remove</button>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Right bar overlay-->
    <?php include 'script_tag.php' ?>
</body>
<script>
    $(document).ready(function () {
        $('.poly_btn').prop('disabled', true);
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


        function marker_creation(lat, lng, consignee) {
            const image = "images/rec.png";
            var positiona = new google.maps.LatLng(lat, lng);
            var marker = new google.maps.Marker({
                position: positiona,

                map,
                icon: {
                    labelOrigin: new google.maps.Point(11, 50),
                    url: image,

                    //size: new google.maps.Size(22, 40),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(11, 40),
                },
            });
            var infowindow = new google.maps.InfoWindow({
                content: '<p>Details:' + '<p>Consignee # :' + consignee + '</p>'
            });
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });

        }

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
    var flightPlanCoordinates = [];
    var other_data = [];


    function myFunction() {
        document.getElementById("drawing").disabled = true;

        var vehicle = document.getElementById("vehi_id").value;

        var selectElement = document.getElementById("vehi_id");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedText = selectedOption.text;
        // alert(selectedText)

        var from_ = document.getElementById("from").value;
        var to_ = document.getElementById("to").value;
        const format1 = "YYYY-MM-DD HH:mm:ss";

        var from = moment(from_).format(format1);
        var to = moment(to_).format(format1);
        // alert(vehicle + " " + from + " " + to);

        if (vehicle != "" && from_ != "" && to_ != "") {
            flightPlanCoordinates = [];
            other_data = [];
            // drawing


            $.ajax({
                url: 'ajax/get/get_route.php',
                type: 'POST',
                data: {
                    vehicle: vehicle,
                    from: from,
                    to: to
                },
                beforeSend: function () {
                    // $('#insert').val("Updating");
                    $("#loader").show();
                    $("#drawing").prop("disabled", true);
                },
                success: function (data) {

                    data = JSON.parse(data);
                    console.log(data)
                    var len = data.length;
                    if (len > 0) {
                        document.getElementById("removing").style.display = 'block';
                        $('.poly_btn').prop('disabled', false);

                        // document.getElementById("drawing").disabled = true;
                        const lineSymbol = {
                            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                        };


                        var i = 0;
                        const image = "images/rec.png";
                        const start = "images/icon/car_icon_blue.png";
                        const end = "images/icon/car_red.png";
                        const stops = "images/stop-sign1.png";
                        const running = "images/icon/car_icon_green.png";

                        data.forEach(obj => {

                            var vehicle_name = data[i][0];
                            // $('#my_list').append('<li class="activity-list " onClick="focus(' + data[i][
                            //     1
                            // ] + ',' + data[i][2] + ')">' +

                            //     '<div class="timeline-list-item">' +
                            //     '<div class="d-flex">' +
                            //     '<div class="flex-grow-1 overflow-hidden me-4">' +
                            //     '<h5 class="font-size-14 mb-1">' + data[i][4] + '</h5>' +
                            //     '<p class="text-truncate text-muted font-size-13">' +
                            //     '</p>' +
                            //     '</div>' +

                            //     data[i][1] + ' , ' +
                            //     data[i][2] +

                            //     '</div>' +
                            //     '</div>' +
                            //     '</li>');
                            var lat = data[i][1];
                            var lng = data[i][2];
                            var speed = data[i][3];
                            var power = data[i][5];
                            var location = data[i][6];
                            var time = data[i][4];

                            other_data.push({
                                name: selectedText,
                                speed: speed,
                                power: power,
                                location: location,
                                time: time,
                            });

                            var positiona = new google.maps.LatLng(lat, lng);
                            if (i == 0) {
                                var marker = new google.maps.Marker({
                                    position: positiona,
                                    map,
                                    icon: {
                                        url: start,
                                    },


                                });
                                markersArray.push(marker);

                                var infowindow = new google.maps.InfoWindow({
                                    content: '<p>Details:' + '<p>Vehical # :' +
                                        vehicle_name +
                                        '</p>' + '<p>Start Location # :' + location +
                                        '</p>' + '<p>Latitude:' + lat + '</p>' +
                                        '<p>Longitude:' + lng + '</p>' + '<p>speed:' +
                                        speed +
                                        '</p>' + '<p>Last:' + time + '</p>'
                                });
                                marker.addListener('click', function () {
                                    infowindow.open(map, marker);
                                });
                            }

                            // if (power === '0' && speed === '0') {
                            //     var starting = time;
                            //     console.log("starting " + starting);
                            //     console.log("pre " + pre_time);


                            //     if (i == 0) {
                            //         startTime = starting;

                            //         var now = moment(startTime); //todays date
                            //         var ends = moment(pre_time);
                            //         var duration = moment.duration(now.diff(ends));
                            //         hours = duration.asMinutes();
                            //         console.log(hours)
                            //         pre_time = startTime;
                            //     } else {
                            //         startTime = starting;

                            //         var now = moment(startTime); //todays date
                            //         var ends = moment(pre_time);
                            //         var duration = moment.duration(now.diff(ends));
                            //         hours = duration.asMinutes();
                            //         console.log(hours)
                            //         pre_time = startTime;
                            //     }



                            //     var marker = new google.maps.Marker({
                            //         position: positiona,
                            //         map,
                            //         icon: {
                            //             url: stops,
                            //         },


                            //     });
                            //     markersArray.push(marker);
                            //     var infowindow = new google.maps.InfoWindow({
                            //         content: '<p>Details:' + '<p>Vehical # :' +
                            //             vehicle_name +
                            //             '</p>' + '<p>Stop Location # :' + location +
                            //             '</p>' + '<p>Latitude:' + lat + '</p>' +
                            //             '<p>Longitude:' + lng + '</p>' + '<p>speed:' +
                            //             speed +
                            //             '</p>' + '<p>Last:' + time + '</p>' +
                            //             '<p>Stop Duration:' + Math.round(hours) +
                            //             ' Minutes' + '</p>'
                            //     });
                            //     marker.addListener('click', function () {
                            //         infowindow.open(map, marker);
                            //     });
                            // }

                            if (i == len - 1) {
                                //console.log("samad")
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
                                marker.addListener('click', function () {
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
                            },],

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
                        poly_marker.addListener('click', function () {
                            infowindow.open(map, poly_marker);
                        });

                        markersArray.push(poly_marker);

                    } else {
                        alert("Data Not Found");
                        document.getElementById("drawing").disabled = false;
                        $('.poly_btn').prop('disabled', true);


                    }

                    var requestOptions = {
                        method: 'GET',
                        redirect: 'follow'
                    };

                    fetch("http://119.160.107.173:3002/distance/" + vehicle + "/" + from + "/" + to + "", requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            result = JSON.parse(result);
                            console.log(result[0]['Total Distance Travelled'])
                            document.getElementById("distance").innerHTML = result[0]['Total Distance Travelled'] + " KM";
                        })
                        .catch(error => console.log('error', error));



                    const from_datetimeString = from;
                    const date = new Date(from_datetimeString);
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const from_formattedDate = `${year}-${month}-${day}`;
                    console.log(from_formattedDate);

                    const to_datetimeString = to;
                    const date1 = new Date(to_datetimeString);
                    const year1 = date1.getFullYear();
                    const month1 = String(date1.getMonth() + 1).padStart(2, '0');
                    const day1 = String(date1.getDate()).padStart(2, '0');
                    const to_formattedDate = `${year1}-${month1}-${day1}`;
                    console.log(to_formattedDate);

                    var requestOptions1 = {
                        method: 'GET',
                        redirect: 'follow'
                    };
                    console.log("http://119.160.107.173:3002/stop/" + vehicle + "/" + from_formattedDate + "/" + to_formattedDate + "");
                    fetch("http://119.160.107.173:3002/stop/" + vehicle + "/" + from_formattedDate + "/" + to_formattedDate + "", requestOptions1)
                        .then(response => response.json())
                        .then(result => {
                            // result = JSON.parse(result);
                            const stops_icon = "images/stop-sign1.png";

                            for (var i = 0; i < result.length; i++) {
                                console.log(result[i]);
                                // console.log(circle_cord[i])
                                // var str_array = circle_cord[i].split(',');
                                // const cityCircle_stops = new google.maps.Circle({
                                //     strokeColor: "#FF0000",
                                //     strokeOpacity: 0.8,
                                //     strokeWeight: 2,
                                //     fillColor: "#FF0000",
                                //     fillOpacity: 0.35,
                                //     map,
                                //     center: {
                                //         lat: parseFloat(result[i].LAT),
                                //         lng: parseFloat(result[i].LONG)
                                //     },
                                //     radius: 300,
                                // });

                                // cityCircle_stops.setMap(map);

                                // var marker_stop = new google.maps.Marker({
                                //     position: { lat: result[i].LAT, lng: result[i].LONG },
                                //     map,
                                //     icon: {
                                //         url: stops_icon,
                                //     },


                                // });
                                // markersArray.push(marker_stop);
                                // var infowindow_stops = new google.maps.InfoWindow({
                                //     content: '<p>Details:' + '<p>Stop Location # :' + result[i].LOCATION +
                                //         '</p>' + '<p>Latitude:' + result[i].LAT + '</p>' +
                                //         '<p>Longitude:' + result[i].LAT + '</p>' + '<p>speed:' +
                                //         result[i].SPEED +
                                //         '</p>' + '<p>Start Time:' + result[i].FROM + '</p>' +
                                //         '</p>' + '<p>End Time:' + result[i].TO + '</p>' +
                                //         '<p>Stop Duration:' + result[i].stop_duration +
                                //         '' + '</p>'
                                // });
                                // marker_stop.addListener('click', function () {
                                //     infowindow_stops.open(map, marker_stop);
                                // });

                                marker = new google.maps.Marker({
                                    position: { lat: result[i].LAT, lng: result[i].LONG },
                                    map,
                                    icon: {
                                        url: stops_icon,
                                    },


                                });
                                markersArray.push(marker);



                                marker.infowindow = new google.maps.InfoWindow({
                                    // content: "<b>" + result[i]['geo_name'] + "</b>" + "</br>",
                                    content: '<p>Details:' + '<p>Stop Location # :' + result[i].LOCATION +
                                        '</p>' + '<p>Latitude:' + result[i].LAT + '</p>' +
                                        '<p>Longitude:' + result[i].LAT + '</p>' + '<p>speed:' +
                                        result[i].SPEED +
                                        '</p>' + '<p>Start Time:' + result[i].FROM + '</p>' +
                                        '</p>' + '<p>End Time:' + result[i].TO + '</p>' +
                                        '<p>Stop Duration:' + result[i].stop_duration +
                                        '' + '</p>'

                                });
                                marker.infowindow.name = 'stops' + result[i]['LAT'];
                                marker.setMap(map);
                                // google.maps.event.addListener(bermudaTriangle, 'click', showInfo);
                                google.maps.event.addListener(marker, 'click', showInfo_dis);
                            }
                        })
                        .catch(error => console.log('error', error));



                }
            });

        } else {
            alert("Please Select Field")
            document.getElementById("drawing").disabled = false;
            $('.poly_btn').prop('disabled', true);


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


        if (currentIndex === flightPlanCoordinates.length) {
            clearInterval(intervalId);
            currentIndex = 0;
            isPlaying = false;
            return;
        }

        poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
        var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p>' +
            '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
            '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
            '<p>speed:' + other_data[currentIndex].speed + ' km/hr</p>';
        infowindow.setContent(info_data);
        map.panTo(flightPlanCoordinates[currentIndex]);

        currentIndex++;
    }

    function play() {
        if (!isPlaying) {
            isPlaying = true;
            intervalId = setInterval(animateMarker, 300);
        }
        // intervalId = setInterval(animateMarker, 0.05);
    }

    function pause() {
        clearInterval(intervalId);
        isPlaying = false;
    }

    function reset() {
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
            // currentIndex++;
            currentIndex += 1;

            poly_marker.setPosition(flightPlanCoordinates[currentIndex]);

            var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p>' +
                '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
                '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
                '<p>speed:' + other_data[currentIndex].speed + ' km/hr</p>';
            infowindow.setContent(info_data);

            map.panTo(flightPlanCoordinates[currentIndex]);

            isPlaying = false;
        }
    }

    function backward() {
        if (currentIndex > 0) {
            // currentIndex--;
            currentIndex -= 1;
            poly_marker.setPosition(flightPlanCoordinates[currentIndex]);
            var info_data = '<p>Details</p>' + '<p>Vehical # :' + other_data[currentIndex].name + '</p>' +
                '<p>Latitude:' + flightPlanCoordinates[currentIndex].lat + '</p>' +
                '<p>Longitude:' + flightPlanCoordinates[currentIndex].lng + '</p>' +
                '<p>speed:' + other_data[currentIndex].speed + ' km/hr</p>';
            infowindow.setContent(info_data);

            map.panTo(flightPlanCoordinates[currentIndex]);
            isPlaying = false;

        }
    }

    function focus(lat, lng) {
        poly_marker.setPosition({
            lat: lat,
            lng: lng
        });
        map.panTo({
            lat: lat,
            lng: lng
        });
        map.setZoom(15);


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


    $(document).keydown(function (event) {
        if (event.which === 37) { // Left arrow key
            // Call function for left arrow key
            backward();
        } else if (event.which === 39) { // Right arrow key
            // Call function for right arrow key
            forward();
        }
    });

    
document.addEventListener('keydown', function(event) {
  if (event.keyCode === 32) { // Space key
    if (isPlaying) {
      // Call pause function
      pause();
      isPlaying = false;
    } else {
      // Call play function
      play();
      isPlaying = true;
    }
  }
});

</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>