<?php include_once('sessioninput.php'); 
set_time_limit(0);
?>

<!doctype html>
<html lang="en">


<!-- Mirrored from P2P Track.com/Nelson/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 10:08:38 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Monthly VTS Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="P2P Track" name="author" />
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <!-- App favicon -->
    <?php include_once('head_tag.php'); ?>

    <?php
    $username = "root";
    $password = "";
    $database = "bsl";
    $db = mysqli_connect('localhost', $username, $password, $database);
    if (!$db) {
        die('Not connected : ' . mysqli_error());
    }
    $db_selected = mysqli_select_db($db, $database);
    if (!$db_selected) {
        die('Can\'t use db : ' . mysqli_error());
    }
    ?>

</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include_once('header.php'); ?>


        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <?php include_once('sidebar.php'); ?>

                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <h1>VTS Monthly Report</h1>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-3 p-1">
                        <button class="btn btn-success" onclick="ExportToExcel('xlsx')">Export table to excel</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <table align="left" cellspacing="0" border="0" id="tbl_exporttable_to_xls">
                                <colgroup width="222"></colgroup>
                                <colgroup width="94"></colgroup>
                                <colgroup span="2" width="68"></colgroup>
                                <colgroup width="106"></colgroup>
                                <colgroup width="109"></colgroup>
                                <colgroup width="120"></colgroup>
                                <colgroup width="76"></colgroup>
                                <colgroup width="124"></colgroup>
                                <colgroup width="87"></colgroup>
                                <colgroup width="276"></colgroup>
                                <colgroup width="220"></colgroup>
                                <colgroup width="96"></colgroup>
                                <colgroup width="68"></colgroup>
                               
                                <tr>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        colspan=13 height="49" align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font size=5 color="#000000">VTS Monthly Non-Compliance Report&nbsp;</font>
                                        </b></td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000"
                                        colspan=5 height="21" align="left" valign=middle bgcolor="#FFFF00">
                                        <font size=1 color="#000000">Contractor Name:&nbsp; BSL (Private) Limited</font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00">
                                        <font size=1 color="#000000"><br></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00">
                                        <font size=1 color="#000000">Month: Jan 2023</font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00">
                                        <font size=1 color="#000000"><br></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00">
                                        <font color="#000000">Customer</font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000"
                                        colspan=3 align="left" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#FF0000">United Enrgy Pakistan Limited</font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00">
                                        <font size=1 color="#000000"><br></font>
                                    </td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        height="40" align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">Driver&nbsp;</font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        rowspan=3 align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">Vehicle No.&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">Vehicle Type</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">KM</font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        rowspan=3 align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">VTS Service Provider&nbsp;</font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-right: 2px solid #000000"
                                        align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        rowspan=3 align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">No. of Harsh Brake&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">No. of</font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        rowspan=3 align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">Night Driving Viiolation (1am - 30 Min after Sun rise)
                                            </font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        rowspan=3 align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">Corrective Action &nbsp;</font>
                                        </b></td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        rowspan=3 align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">Remarks&nbsp;</font>
                                        </b></td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        height="60" align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">Name &nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">LV / HV&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">Driven&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">No. of Speed Violation&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">Route Violation&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">Dashcam Reviewed&nbsp;</font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="center" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font color="#000000">Reason given by the driver&nbsp;</font>
                                        </b></td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                                        height="21" align="left" valign=middle bgcolor="#FFFF00"><b>
                                            <font face="Calibri" color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00"><b>
                                            <font face="Calibri" color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-right: 2px solid #000000" align="left" valign=middle
                                        bgcolor="#FFFF00"><b>
                                            <font face="Calibri" color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                        align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                        align="left" valign=middle bgcolor="#FFFF00"><b>
                                            <font face="Calibri" color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                        align="center" valign=middle bgcolor="#FFFF00"><b>
                                            <font color="#000000">(Yes /No)&nbsp;</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                                        align="left" valign=top bgcolor="#FFFF00"><b>
                                            <font face="Calibri" color="#000000"><br></font>
                                        </b></td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                                <?php 
                                $result = mysqli_query($db, "SELECT dc.name as vehi_name,dc.id,us.name as username,ua.overspeed FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id join user_alerts_define as ua on ua.user_id = us.id where us.name = 'UEP'");
                                $starting_date = date('Y-m-01');

                                // Get the ending date of the current month
                                $ending_date = date('Y-m-t');
                                
                                        while ($row = mysqli_fetch_array($result)) {
                                            
                                            // echo 'http://119.160.107.173:3002/violation/'.$row["id"].'/'.str_replace(' ', '%20', $from).'/'.str_replace(' ', '%20', $to).'/'.$row["overspeed"].'';

                                            $curl = curl_init();

                                            curl_setopt_array(
                                                $curl,
                                                array(
                                                    CURLOPT_URL => 'http://119.160.107.173:3002/violation/'.$row["id"].'/'.$starting_date.'/'.$ending_date.'/'.$row["overspeed"].'',
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
                                            if($response != null)
                                            {

                                            
                                            ?>
                                            
                                <tr>
                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        height="160" align="left" valign=middle bgcolor="#FFFFFF">
                                        <font face="Calibri" size=3 color="#0000CC"></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle>
                                        <font face="Calibri" color="#FF0000"><?php echo $response[0]['name'];?></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle>
                                        <font face="Calibri" color="#FF0000">HTV</font>
                                    </td>
                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="right" valign=middle sdval="3307" sdnum="1033;">
                                        <font face="Calibri" color="#FF0000"><?php echo $response[0]['total_distance'];?></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle>
                                        <font face="Calibri" color="#FF0000">Teltonika</font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle sdval="12" sdnum="1033;">
                                        <font face="Calibri" color="#FF0000"><?php echo $response[0]['speedv'];?></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle sdval="2" sdnum="1033;">
                                        <font face="Calibri" color="#FF0000"><?php echo $response[0]['Harsh Break'];?></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle sdval="0" sdnum="1033;">
                                        <font face="Calibri" color="#FF0000">0</font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle sdval="1" sdnum="1033;">
                                        <font face="Calibri" color="#FF0000">1</font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=middle>
                                        <font face="Calibri" color="#0000CC"></font>
                                    </td>
                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="left" valign=middle>
                                        <font face="Calibri" color="#0000CC"></font>
                                    </td>
                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="left" valign=middle>
                                        <font face="Calibri" color="#0000CC"></font>
                                    </td>
                                    <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                                        align="center" valign=middle>
                                        <font face="Calibri" color="#0000CC"><br></font>
                                    </td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                               <?php 
                                            }
                                            }

                                        
                               ?>
                                <tr>
                                    <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                                        colspan=2 height="21" align="center" valign=bottom bgcolor="#FFD966"><b>
                                            <font face="Calibri" color="#000000">Total</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#000000"><b>
                                            <font face="Calibri" color="#000000"><br></font>
                                        </b></td>
                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#FFD966" sdval="78369"
                                        sdnum="1033;0;#,##0"><b>
                                            <font face="Calibri" color="#FF0000">78,369</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#000000"><b>
                                            <font face="Calibri" color="#FF0000"><br></font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#FFD966" sdval="405" sdnum="1033;"><b>
                                            <font face="Calibri" color="#FF0000">405</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#FFD966" sdval="36" sdnum="1033;"><b>
                                            <font face="Calibri" color="#FF0000">36</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#FFD966" sdval="0" sdnum="1033;"><b>
                                            <font face="Calibri" color="#FF0000">0</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#FFD966" sdval="40" sdnum="1033;"><b>
                                            <font face="Calibri" color="#FF0000">40</font>
                                        </b></td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#000000">
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#000000">
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#000000">
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                    <td style="border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                        align="center" valign=bottom bgcolor="#000000">
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                    <td align="left" valign=bottom>
                                        <font face="Calibri" color="#000000"><br></font>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>



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

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <?php include_once('script_tag.php'); ?>



</body>
<script>
$(document).ready(function() {
    console.log("ready!");
    // var table = $('#example').DataTable();
    var settings = {
        "url": "http://119.160.107.173:3002/positions/945/2023-02-15/2023-02-24",
        "method": "GET",
        "timeout": 0,
    };

    $.ajax(settings).done(function(response) {
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
    var elt = document.getElementById('tbl_exporttable_to_xls');
    var wb = XLSX.utils.table_to_book(elt, {
        sheet: "sheet1"
    });
    return dl ?
        XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        }) :
        XLSX.writeFile(wb, fn || ('VTS_REPORT.' + (type || 'xlsx')));
}
</script>
<!-- Mirrored from P2P Track.com/Nelson/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 10:08:38 GMT -->

</html>