<?php include("sessioninput.php"); ?>

<!doctype html>
<html lang="en">


<!-- Mirrored from P2P Track.com/Nelson/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 10:08:38 GMT -->

<head>

    <meta charset="utf-8" />
    <title>JMP Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & History Report Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$resultdevice = mysqli_query($db, "SELECT * FROM devices;");

?>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include 'header.php' ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php' ?>
        <?php
        // include("config.php");
        
        $resultdevice = mysqli_query($db, "SELECT * FROM devices;");

        ?>
        <?php
        set_time_limit(0);
        $result = mysqli_query($db, "SELECT * FROM bsl.jmp_view where id = " . $_GET['id'] . ";");
        $row = mysqli_fetch_array($result);
        $vehicle = $row['vehicle_id'];
        $datetime = new DateTime($row['trip_start_date']);
        $from = $datetime->format('Y-m-d');
        $to = $datetime->format('Y-m-d');
        // echo $row['arrival_time'].' Sam';
        if($row['arrival_time'] =='')
        {
            $to = $datetime->modify('+6 day');
        }
        else
        {
            $to = $row['arrival_time'];
        }

        $to = $to->format('Y-m-d');
        echo $to;
        ?>

        <div class="main-content">

            <div class="page-content">


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <h1>JMP Report</h1>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-3 p-1">
                        <button class="btn btn-success" onclick="ExportToExcel('xlsx')">Export table to excel</button>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-3">
                        <select class="form-control all_select" data-toggle="select2" required id="vehi_id" name="vehi_id">
                            <option>Select </option>
                            <?php foreach ($resultdevice as $key => $value) { ?>
                                        <option value="<?= $value['id']; ?>"><?= $value['name']; ?>
                                        </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input id="from" class="form-control " type="date" placeholder="Select Date..">
                    </div>
                    <div class="col-md-3">
                        <input id="to" class="form-control " type="date" placeholder="Select Date..">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" id="drawing" onclick="myFunction()">Get</button>
                    </div>


                </div> -->

                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <div class="card">
                                <table cellspacing="0" border="0" id="jmp">
                                    <colgroup span="2" width="94"></colgroup>
                                    <colgroup width="19"></colgroup>
                                    <colgroup width="94"></colgroup>
                                    <colgroup width="58"></colgroup>
                                    <colgroup width="94"></colgroup>
                                    <colgroup width="53"></colgroup>
                                    <colgroup width="94"></colgroup>
                                    <colgroup width="69"></colgroup>
                                    <colgroup width="94"></colgroup>
                                    <colgroup width="6"></colgroup>
                                    <colgroup span="2" width="94"></colgroup>
                                    <colgroup width="3"></colgroup>
                                    <colgroup width="94"></colgroup>
                                    <colgroup width="3"></colgroup>
                                    <tr>
                                        <td colspan=16 height="21" align="center" valign=bottom><b>
                                                <font size=5 color="#000000">BSL (PRIVATE) LIMITED</font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 2px solid #000000" colspan=16 height="21"
                                            align="center" valign=bottom><b>
                                                <font size=4 color="#000000">Journey Plan / Trip Log</font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="left" valign=bottom>
                                            <font color="#000000">Vehicle #</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['vehicle_name']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">Customer</font>
                                        </td>

                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=4 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['client_name']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom>
                                            <font color="#000000">Loading Site</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000"><br></font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                            colspan=5 align="center" valign=bottom><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['l_site']; ?>
                                                </font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="left" valign=bottom sdnum="1033;1033;H:MM">
                                            <font color="#000000">Trip Start Date</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.3333333333"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['trip_start_date']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom>
                                            <font color="#000000">Shipmen/Bilti #</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">
                                                <?php echo $row['shipment_bilti']; ?><br>
                                            </font>
                                        </td>

                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">Destination</font>
                                        </td>


                                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                            colspan=10 align="center" valign=bottom><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['dt_site']; ?>
                                                </font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="left" valign=bottom sdnum="1033;1033;H:MM">
                                            <font color="#000000">Driver 1</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=4 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['d1_name']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">CNIC #</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=3 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['dr1_cnic']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">Mobile #</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['dr1_mobile']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom>
                                            <font color="#000000">Duty Time Start</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000"><br></font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.3333333333"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php 
                                                    $duty1 =new DateTime($row['duty_time_d1']);
                                                    $duty1 = $duty1->format('Y-m-d H:i');
                                                    echo $duty1; ?>
                                                </font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="left" valign=bottom sdnum="1033;1033;H:MM">
                                            <font color="#000000">Driver 2</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=4 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['dr2_name']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">CNIC #</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=3 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['dr2_cnic']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000">Mobile #</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom><b>
                                                <font color="#A50021">
                                                    <?php echo $row['dr2_mobile']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom>
                                            <font color="#000000">Duty Time Start</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000"><br></font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.5"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php 
                                                    $duty =new DateTime($row['duty_time_d2']);
                                                    $duty = $duty->format('Y-m-d H:i');
                                                    echo $duty ?>
                                                </font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="left" valign=bottom sdnum="1033;1033;H:MM">
                                            <font color="#000000">Departure from Terminal</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.375"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['departure_from_terminal']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">Arrival at Loading Site</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.4166666667"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php 
                                                    $ar =new DateTime($row['arrival_loading_site']);
                                                    $ar = $ar->format('Y-m-d H:i');
                                                    echo $ar ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">Loading Start Time</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.625"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['arrival_loading_site']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom>
                                            <font color="#000000">Loading Completion Time</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000"><br></font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            align="left" valign=bottom>
                                            <font color="#000000"><br></font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.7083333333"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['loading_completion_time']; ?>
                                                </font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="left" valign=bottom sdnum="1033;1033;H:MM">
                                            <font color="#000000">Departure from Loading Site</font>
                                        </td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44972.7291666667"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['departure_from_loading_site']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">Total Loading Time</font>
                                        </td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="0" sdnum="1033;0;[H]:MM"><b>
                                                <font color="#FF0000">
                                                    <?php echo $row['total_loading_time']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">ETA at Destination</font>
                                        </td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="44974.6666666667"
                                            sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                <font color="#0000CC">
                                                    <?php echo $row['eta_destination']; ?>
                                                </font>
                                            </b></td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                            colspan=3 align="center" valign=bottom>
                                            <font color="#000000">Estimated Total Trip Time</font>
                                        </td>
                                        <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                            colspan=2 align="center" valign=bottom sdval="0" sdnum="1033;0;[H]:MM"><b>
                                                <font color="#FF0000">
                                                    <?php echo $row['estimated_total_trip_time']; ?>
                                                </font>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                            colspan=16 height="21" align="center" valign=bottom sdnum="1033;1033;H:MM">
                                            <b>
                                                <font size=4 color="#000000">Driving</font>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                            height="21" align="center" valign=bottom sdnum="1033;1033;H:MM">
                                            <font color="#000000">Driver</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">Driving Start</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">Driving End</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=2 align="center" valign=bottom>
                                            <font color="#000000">Driving Time</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                            colspan=4 align="center" valign=bottom>
                                            <font color="#000000">Stopping Place</font>
                                        </td>
                                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                            colspan=5 align="center" valign=bottom bgcolor="#FFFF00">
                                            <font color="#000000">Reason for Stopping (Remove)</font>
                                        </td>
                                    </tr>

                                    <?php
                                    // echo 'http://119.160.107.173:3002/jmp_trip/' . $vehicle . '/' . $from . '/' . $to . '';
                                    $curl = curl_init();
                                    curl_setopt_array(
                                        $curl,
                                        array(
                                            CURLOPT_URL => 'http://119.160.107.173:3002/jmp_trip/' . $vehicle . '/' . $from . '/' . $to . '',
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
                                    $resp = json_decode($response);
                                    $resp2 = json_decode($response, true);
                                    // print_r($resp);
                                    $driver1_time = "00:00:00";
                                    $driver2_time = "00:00:00";
                                    $s = 1;
                                    $num;

                                    foreach ($resp as $item) {
                                        if ($s > 2) {
                                            $s = 1;

                                        }

                                        $date = strtotime($item->start);
                                        $date2 = strtotime($item->end);

                                        ?>
                                        <tr>
                                            <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                                height="21" align="center" valign=bottom sdval="1" sdnum="1033;0;0"><b>
                                                    <font color="#000000">
                                                        <?php echo ''; ?>
                                                    </font>
                                                </b></td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                colspan=2 align="center" valign=bottom sdval="44972.7291666667"
                                                sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                    <font color="#FF0000">
                                                        <?php echo date('d/M/Y h:i A', $date); ?>
                                                    </font>
                                                </b></td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                colspan=2 align="center" valign=bottom sdval="44972.8472222222"
                                                sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                                    <font color="#FF0000">
                                                        <?php echo date('d/M/Y h:i A', $date2); ?>
                                                    </font>
                                                </b></td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                colspan=2 align="center" valign=bottom sdval="0" sdnum="1033;1033;H:MM"><b>
                                                    <font color="#FF0000">
                                                        <?php echo $item->duration ?>
                                                    </font>
                                                </b></td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                colspan=4 align="center" valign=bottom><b>
                                                    <font color="#FF0000">
                                                        <?php echo $item->end_l ?>
                                                    </font>
                                                </b></td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                                                colspan=5 align="center" valign=bottom bgcolor="#FFFF00"><b>
                                                    <font color="#0000CC"></font>
                                                </b></td>
                                        </tr>
                                        <?php
                                        $s++;

                                    }
                                    curl_close($curl);
                                    // echo $response;
                                    ?>
                            </div>



                            <tr>
                                <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                    height="21" align="left" valign=bottom>
                                    <font color="#000000">Arrivat at Delivery Site</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom sdval="44974.71875" sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom>
                                    <font color="#000000">Entry in Delivery Site</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom sdval="44974.7604166667"
                                    sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom>
                                    <font color="#000000">Exit from Delivery Site</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom sdval="44974.8333333333"
                                    sdnum="1033;1033;M/D/YYYY H:MM"><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000" colspan=3
                                    align="center" valign=bottom>
                                    <font color="#000000">Total Time at Delivery Site</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000" colspan=2
                                    align="center" valign=bottom sdval="0" sdnum="1033;1033;H:MM"><b>
                                        <font color="#FF0000"></font>
                                    </b></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                    colspan=16 height="21" align="center" valign=bottom><b>
                                        <font size=3 color="#000000">Drivers Hours of Work Summary</font>
                                    </b></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                    rowspan=2 height="42" align="center" valign=bottom><b>
                                        <font color="#000000">Day</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3
                                    rowspan=2 align="center" valign=bottom><b>
                                        <font color="#000000">Date</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Driver 1</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Driver 2</font>
                                    </b></td>
                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=1
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Rest Hours</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan=6
                                    align="center" valign=bottom>
                                    <font color="#000000">Remarks</font>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Lunch/Tea</font>
                                    </b></td> -->
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Driving Hours</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Lunch/Tea</font>
                                    </b></td>
                                
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Driving Hours</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom><b>
                                        <font color="#000000">Lunch/Tea</font>
                                    </b></td>
                                    <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan=6
                                    align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan=6
                                    align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                            </tr>
                            <?php

                            $current_date2 = '';
                            $total_duration2 = 0;
                            $b = 1;
                            $d2 = array();

                            for ($i = 1; $i < count($resp2); $i += 2) {
                                // Extract the date and duration
                                // check if the key (i.e., row number) is odd
                                // do your calculation for odd rows here
                                $date2 = substr($resp2[$i]['start'], 0, 11);
                                $duration2 = $resp2[$i]['duration'];

                                // If it's a new date, print the total duration for the previous date
                                if ($date2 != $current_date2 && $key > 0) {
                                    if ($total_duration2 != '0') {
                                        //  echo "Total duration for Driver 2 $current_date2: $total_duration2\n";
                                        array_push($d2, $total_duration2);
                                        $total_duration2 = 0;
                                    }
                                }
                                $total_duration2 += strtotime("1970-01-01 $duration2 UTC");

                                // Update the current date
                            





                                $current_date2 = $date2;
                            }
                            array_push($d2, $total_duration2);
                            // print_r($d2);
                            // echo "Total duration for Driver 2 $current_date2: $total_duration2\n";
                            $current_date = '';
                            $total_duration = 0;
                            $s = 1;
                            $index = 0;
                            $total_d1 = 0;
                            $total_d2 = 0;
                            $w = 1;


                            for ($i = 0; $i < count($resp2); $i += 2) {

                                // Extract the date and duration
                                // check if the key (i.e., row number) is odd
                                // do your calculation for odd rows here
                                $date = substr($resp2[$i]['start'], 0, 11);
                                $duration = $resp2[$i]['duration'];

                                // If it's a new date, print the total duration for the previous date
                                if ($date != $current_date && $key > 0) {
                                    if ($total_duration != '0') {


                                        ?>
                                        <tr>
                                            <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                                height="21" align="center" valign=bottom sdval="1" sdnum="1033;"><b>
                                                    <font color="#000000">
                                                        <?php echo $w; ?>
                                                    </font>
                                                </b></td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3
                                                align="left" valign=bottom>
                                                <font color="#000000"><br>
                                                    <?php echo str_replace('T','', $current_date); ?>
                                                </font>
                                            </td>
                                            <!-- <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000"><br></font>
                                            </td> -->
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000"><br>
                                                    <?php $total_d1 += 27000000;
                                                        echo '07:30';
                                                    // echo gmdate("H:i:s", $total_duration);
                                                     ?>
                                                </font>
                                            </td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000"><br>
                                                    <?php 
                                                    $total_d2 += $d2[$index];
                                                    $total_rest_hour = $total_duration + $d2[$index];
                                                    $total_rest_hour =  86400-$total_rest_hour;
                                                    echo '00:30';
                                                    // echo gmdate("H:i", $total_rest_hour);
                                                     ?>
                                                </font>
                                            </td>
                                            <!-- <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000"><br></font>
                                            </td> -->
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000"><br>
                                                    <?php 
                                                    echo '07:30'
                                                    // echo gmdate("H:i:s", $d2[$index]); 
                                                    ?>
                                                </font>
                                            </td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000"><br>
                                                    <?php
                                                    echo '00:30'; 
                                                    // echo gmdate("H:i", $total_rest_hour); 
                                                    ?>
                                                </font>
                                            </td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000">08:00</font>
                                            </td>
                                            <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan=6
                                                align="left" valign=bottom>
                                                <font color="#000000"><br></font>
                                            </td>
                                        </tr>

                                        <?php
                                        $index = $index + 1;
                                        // echo "Total duration for Driver 1 $current_date: $total_duration\n";
                                        $total_duration = 0;
                                        $w = $w +1;
                                    }
                                }

                                // Add the duration to the total for the current date
                                $total_duration += strtotime("1970-01-01 $duration UTC");
                                $s += 1;
                                // Update the current date
                            





                                $current_date = $date;

                            }
                            
                            ?>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                    height="21" align="center" valign=bottom sdval="1" sdnum="1033;"><b>
                                        <font color="#000000">
                                            <?php echo $w; 
                                            $w=$w+1;?>
                                        </font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3
                                    align="left" valign=bottom>
                                    <font color="#000000"><br>
                                        <?php 
                                        echo str_replace('T','',$current_date); ?>
                                    </font>
                                </td>
                                <!-- <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td> -->
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br>
                                        <?php $total_d1 +=27000000;
                                        echo '07:30'
                                        // echo gmdate("H:i:s", $total_duration); 
                                        ?>
                                    </font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br>
                                        <?php 
                                        
                                        $total_d2 += end($d2);
                                        $total_rest_hour2 = $total_duration + end($d2);
                                        
                                                    $total_rest_hour2 =  86400-$total_rest_hour2;
                                                    // echo gmdate("H:i", $total_rest_hour2);
                                                    echo '00:30'
                                                     ?>
                                        <!-- echo gmdate("H:i:s", end($d2)); ?> -->
                                    </font>
                                </td>
                                <!-- <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td> -->
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br>
                                        <?php 
                                        // echo gmdate("H:i:s", end($d2));
                                        echo '07:30';
                                         ?>
                                    </font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br>
                                        <?php 
                                        echo '00:30'
                                        // echo gmdate("H:i", $total_rest_hour2); 
                                        ?>
                                    </font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                                align="left" valign=bottom>
                                                <font color="#000000">08:00</font>
                                            </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan=6
                                    align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                            </tr>


                            <tr>
                                <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                    colspan=4 height="21" align="center" valign=bottom><b>
                                        <font color="#000000">Total Duty/Driv/Rest Hours</font>
                                    </b></td>
                                <!-- <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td> -->
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br><?php
                                    $w=$w-1;
                                    $totalHours = $w* 7.5;
                                    $hours = floor($totalHours);
                                    $minutes = ($totalHours - $hours) * 60;
                                    $time = sprintf('%02d:%02d', $hours, $minutes);
                                    echo $time;?></font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br><?php 
                                    
                                    $totalHours = $w* 0.5;
                                    $hours = floor($totalHours);
                                    $minutes = ($totalHours - $hours) * 60;
                                    $time2 = sprintf('%02d:%02d', $hours, $minutes);
                                    echo $time2;
                                    ?></font>
                                </td>
                                
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br><?php echo $time; ?></font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000"><br><?php echo $time2 ?></font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom>
                                    <font color="#000000">
                                    <?php
                                    $totalHours = $w* 8;
                                    $hours = floor($totalHours);
                                    $minutes = ($totalHours - $hours) * 60;
                                    $time = sprintf('%02d:%02d', $hours, $minutes);
                                    echo $time;
                                    ?>    
                                    </font>
                                </td>
                                <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000" colspan=6
                                    align="center" valign=bottom bgcolor="#FF0000"><b>
                                        <font color="#FFFFFF">Individual Drivers hours of service sheet also to be
                                            linked and updated</font>
                                    </b></td>
                            </tr>
                            <tr>
                                <td colspan=16 rowspan=2 height="42" align="center" valign=bottom><b>
                                        <font size=3 color="#000000">Trip Violations Details</font>
                                    </b></td>
                            </tr>
                            <tr>
                            </tr>
                            <?php
                            $curl = curl_init();

                            curl_setopt_array(
                                $curl,
                                array(
                                    CURLOPT_URL => 'http://119.160.107.173:3002/violation/' . $vehicle . '/' . $from . '/' . $to . '/60',
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
                            // echo $response;
                            
                            $response = json_decode($response, true);
                            if ($response != null) {
                                $speedv = $response[0]['speedv'];
                                $hb = $response[0]['Harsh Break'];
                                $ex = $response[0]['Excess_Idle_Time'];
                            }
                            ?>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    colspan=3 height="21" align="left" valign=bottom>
                                    <font color="#000000">Voilation</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom><b>
                                        <font color="#000000">Numbers</font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="left" valign=bottom>
                                    <font color="#000000">Consequence Applied</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="left" valign=bottom>
                                    <font color="#000000">Applied By</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom>
                                    <font color="#000000">Applying Date</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    colspan=3 height="21" align="left" valign=bottom>
                                    <font color="#000000">Speed Violations</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom sdval="2" sdnum="1033;"><b>
                                        <font color="#FF0000">
                                            <?php echo $speedv; ?>
                                        </font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"><?php echo $row['con_applied_sp']; ?></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"><?php echo $row['applied_by_sp']; ?></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom sdval="44977" sdnum="1033;0;D/M/YYYY"><b>
                                        <font color="#0000CC"><?php echo $row['applied_on_sp']; ?></font>
                                    </b></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    colspan=3 height="21" align="left" valign=bottom>
                                    <font color="#000000">Harsh Brakes</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom sdval="1" sdnum="1033;"><b>
                                        <font color="#FF0000">
                                            <?php echo $hb; ?>
                                        </font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"><?php echo $row['con_applied_hb']; ?></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"><?php echo $row['applied_by_hb']; ?></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom sdval="44977" sdnum="1033;0;D/M/YYYY"><b>
                                        <font color="#0000CC"><?php echo $row['applied_on_hb']; ?></font>
                                    </b></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    colspan=3 height="21" align="left" valign=bottom>
                                    <font color="#000000">Excess Idle (&gt; 10 minutes)</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom sdval="4" sdnum="1033;"><b>
                                        <font color="#FF0000">
                                            <?php echo $ex; ?>
                                        </font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"><?php echo $row['con_applied_ed']; ?></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"><?php echo $row['applied_by_ed']; ?></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom sdval="44977" sdnum="1033;0;D/M/YYYY"><b>
                                        <font color="#0000CC"><?php echo $row['applied_on_ed']; ?></font>
                                    </b></td>
                            </tr>

                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    colspan=3 height="21" align="left" valign=bottom>
                                    <font color="#000000">Black Spot Stoppage</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom sdval="4" sdnum="1033;"><b>
                                        <font color="#FF0000">
                                            <?php echo 0; ?>
                                        </font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom sdval="44977" sdnum="1033;0;D/M/YYYY"><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    colspan=3 height="21" align="left" valign=bottom>
                                    <font color="#000000">Un-Authorized Stoppage</font>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign=bottom sdval="4" sdnum="1033;"><b>
                                        <font color="#FF0000">
                                            <?php echo 0; ?>
                                        </font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                                <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4
                                    align="center" valign=bottom sdval="44977" sdnum="1033;0;D/M/YYYY"><b>
                                        <font color="#0000CC"></font>
                                    </b></td>
                            </tr>


                            <tr>
                                <td height="21" align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                            </tr>
                            <tr>
                                <td height="21" align="right" valign=bottom>
                                    <font color="#000000">Driver 1 Signatures</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000" colspan=4 align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td colspan=2 align="right" valign=bottom>
                                    <font color="#000000">Driver 2 Signatures</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000" colspan=3 align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td colspan=2 align="center" valign=bottom>
                                    <font color="#000000">Supervisor's Signatures</font>
                                </td>
                                <td style="border-bottom: 2px solid #000000" align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td style="border-bottom: 2px solid #000000" align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td style="border-bottom: 2px solid #000000" align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                                <td style="border-bottom: 2px solid #000000" align="left" valign=bottom>
                                    <font color="#000000"><br></font>
                                </td>
                            </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    </div><!-- end card body -->
    </div>
    </div>

    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->
    <!-- <?php include_once('right-sidebar.php'); ?> -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <?php include_once('script_tag.php'); ?>



</body>
<script>
    $(document).ready(function () {
        $(".all_select").select2();
        console.log("ready!");
        // var table = $('#example').DataTable();
        var settings = {
            "url": "http://119.160.107.173:3002/positions/945/2023-02-15/2023-02-24",
            "method": "GET",
            "timeout": 0,
        };

        $.ajax(settings).done(function (response) {
            console.log(response.length);
            var i = 1;
            var num;
            response.forEach(element => {
                console.log(element["start_time"]);
                var d = new Date(element["start_time"]);
                var dt2 = new Date(element["stop_time"]);
                const hours = Math.floor(element["stop_time"] / 60);
                const minutes = Math.round(element["stop_time"] % 60);
                const hours2 = Math.floor(element["running"] / 60);
                const minutes2 = Math.round(element["running"] % 60);
                var row =
                    '<tr><td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=bottom sdval="1" sdnum="1033;0;0"><b><font color="#000000">' +
                    num +
                    '</font></b></td><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom sdval="44972.7291666667" sdnum="1033;1033;M/D/YYYY H:MM"><b><font color="#FF0000">' +
                    d.toLocaleTimeString() +
                    '</font></b></td><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom sdval="44972.8472222222" sdnum="1033;1033;M/D/YYYY H:MM"><b><font color="#FF0000">' +
                    dt2.toLocaleTimeString() +
                    '</font></b></td><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom sdval="0" sdnum="1033;1033;H:MM"><b><font color="#FF0000">0:00</font></b></td><td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom><b><font color="#FF0000">Kathore Hotel Super Highway</font></b></td><td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan=5 align="center" valign=bottom bgcolor="#FFFF00"><b><font color="#0000CC">For Dinner</font></b></td></tr>';
                if (i % 2 == 0) {
                    num = 2;
                    //The number is even
                } else {
                    num = 1;
                }
                document.getElementById("rows").innerHTML += row;

                // table.row.add( [d.toLocaleDateString(),"Driver -"+num,d.toLocaleTimeString(),hours+":"+minutes,hours2+":"+minutes2,"",""] ).draw()

                i++

            });

            // const c = JSON.parse(response);
            // console.log(c['start_time']);
            // table.row.add( [response['start_time'],32,'Edinburgh'] ).draw()
        });

        function msToTime(s) {
            var ms = s % 1000;
            s = (s - ms) / 1000;
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;

            return hrs + ':' + mins + ':' + secs + '.' + ms;
        }
    });

    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('jmp');
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: "sheet1"
        });
        return dl ?
            XLSX.write(wb, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            }) :
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }
    function myFunction() {
        var vehicle = document.getElementById("vehi_id").value;
        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;
        const format1 = "YYYY-MM-DD";

        from = moment(from).format(format1);
        to = moment(to).format(format1);
        // alert(vehicle + " " + from + " " + to);

        if (vehicle != "" && from != "" && to != "") {
            window.location.href = "jmp_new.php?vehicle=" + vehicle + "&from=" + from + "&to=" + to;
        }
    }
</script>
<!-- Mirrored from P2P Track.com/Nelson/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 10:08:38 GMT -->

</html>