<?php include_once('sessioninput.php'); ?>

<!doctype html>
<html lang="en">


<!-- Mirrored from P2P Track.com/Nelson/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 10:08:38 GMT -->

<head>

    <meta charset="utf-8" />
    <title>JMP Report</title>
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
                            <h1>VTS Report</h1>

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
                        <table cellspacing="0" border="0" class="sortable" id="tbl_exporttable_to_xls">
                    <colgroup width="202"></colgroup>
                    <colgroup span="9" width="64"></colgroup>
                    <colgroup width="96"></colgroup>
                    <colgroup span="2" width="64"></colgroup>
                    <colgroup width="237"></colgroup>
                    <colgroup width="175"></colgroup>
                    <colgroup width="304"></colgroup>

                    <tr>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            colspan=10 height="43" align="left" valign=middle bgcolor="#FFFF00">
                            <font color="#000000">Contractor Name:&nbsp;BSL (Private) Limited</font>
                        </td>
                        <td style="border-top: 2px solid #000000; border-left: 1px solid #000000" align="right"
                            valign=middle bgcolor="#FFFF00" sdval="44971" sdnum="1033;1033;D-MMM-YY"><b>
                                <font size=2 color="#FF0000">14-Feb-23</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000" align="left" valign=middle bgcolor="#FFFF00"
                            sdnum="1033;1033;D-MMM-YY"><b>
                                <font size=3 color="#000000"><br></font>
                            </b></td>
                        <td style="border-top: 2px solid #000000" align="left" valign=middle bgcolor="#FFFF00"
                            sdnum="1033;1033;D-MMM-YY"><b>
                                <font size=3 color="#000000"><br></font>
                            </b></td>
                        <td style="border-top: 2px solid #000000" align="left" valign=middle bgcolor="#FFFF00"
                            sdnum="1033;1033;D-MMM-YY"><b>
                                <font size=3 color="#000000">Cusomer:</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000"
                            colspan=2 align="left" valign=middle bgcolor="#FFFF00" sdnum="1033;1033;D-MMM-YY"><b>
                                <font size=3 color="#FF0000">United Energy Pakistan Limited</font>
                            </b></td>
                    </tr>
                    <tr>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            rowspan=4 height="100" align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Driver Name&nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Vehicle No.&nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Vehicle Type<br>LV/HV</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">KM Driven</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
                            colspan=5 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000"> Speed Violation&nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">No. of Harsh Brake &nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">No. of Route Violation &nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FF0000"><b>
                                <font color="#FFFFFF">Night Driving (1am - 30 Minutes after sun rise)</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000"><br></font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Reason given by the driver&nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Corrective Action&nbsp;</font>
                            </b></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                            rowspan=4 align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Remarks&nbsp;</font>
                            </b></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">20-40</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">40-70</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">70-80</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="100" sdnum="1033;"><b>
                                <font color="#000000">100</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="120" sdnum="1033;"><b>
                                <font color="#000000">120</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#00B050"><b>
                                <font color="#000000">Dashcam Reviewed&nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFF00"><b>
                                <font face="Calibri" color="#000000"><br></font>
                            </b></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">KM</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">KM</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">KM</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">KM</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">KM</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#00B050"><b>
                                <font color="#000000">(Yes /No)&nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFF00"><b>
                                <font face="Calibri" color="#000000"><br></font>
                            </b></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Zone &nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Zone &nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Zone &nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Zone &nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00"><b>
                                <font color="#000000">Zone &nbsp;</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=top bgcolor="#FFFF00"><b>
                                <font face="Calibri" color="#000000"><br></font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFF00"><b>
                                <font face="Calibri" color="#000000"><br></font>
                            </b></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC"></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1206</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="455" sdnum="1033;">
                            <font color="#FF0000">455</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="34" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC"></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1208</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="560" sdnum="1033;">
                            <font color="#FF0000">560</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 2 km/hr
                                )</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">SOC will be conducted</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top>
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC"></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1211</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="420" sdnum="1033;">
                            <font color="#FF0000">420</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top>
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Zubair/Liaqat</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1213</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="380" sdnum="1033;">
                            <font color="#FF0000">380</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top>
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Zahoor-2/Tahir</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1214</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="419" sdnum="1033;">
                            <font color="#FF0000">419</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="34" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Atif/Afzal</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1216</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="440" sdnum="1033;">
                            <font color="#FF0000">440</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="2" sdnum="1033;">
                            <font color="#FF0000">2</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 4 km/hr
                                )</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">SOC will be conducted</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 11 km/hr
                                )</font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="34" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Ilyas/Ajmal</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-1223</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 2 km/hr
                                )</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">SOC will be conducted</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top>
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Ramzan/Wasim</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5731</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="25" sdnum="1033;">
                            <font color="#FF0000">25</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Asif/Ali Hassan </font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5732</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="317" sdnum="1033;">
                            <font color="#FF0000">317</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="51" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Wajid/Gul Raiz</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5733</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="55" sdnum="1033;">
                            <font color="#FF0000">55</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC">*Harsh Break: In Investigation it is noticed that
                                during low speed, break padal is being pushed hard.</font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Hafeez/Murtaza</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5734</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="567" sdnum="1033;">
                            <font color="#FF0000">567</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="51" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Wahid/Akhtar Abbas</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5829</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="416" sdnum="1033;">
                            <font color="#FF0000">416</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="5" sdnum="1033;">
                            <font color="#FF0000">5</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 1 km/hr
                                )</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">SOC will be conducted</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC">*Harsh Break: In Investigation it is noticed that
                                during low speed, break padal is being pushed hard.</font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Nazir/Zahid</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5830</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="389" sdnum="1033;">
                            <font color="#FF0000">389</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Sattar/Shahid</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5831</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="475" sdnum="1033;">
                            <font color="#FF0000">475</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Ilyas II/Wazir</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5832</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="16" sdnum="1033;">
                            <font color="#FF0000">16</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Saeed/Riaz Muhammad</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5833</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="480" sdnum="1033;">
                            <font color="#FF0000">480</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Naqash/Faisal</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5834</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="367" sdnum="1033;">
                            <font color="#FF0000">367</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="34" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Sakhawat/Yasir</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5835</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="440" sdnum="1033;">
                            <font color="#FF0000">440</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 3 km/hr
                                )</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">SOC will be conducted</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">A. Rasheed/Naveed</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5836</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="320" sdnum="1033;">
                            <font color="#FF0000">320</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Zafar/Usman</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5837</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="456" sdnum="1033;">
                            <font color="#FF0000">456</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-5838</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="385" sdnum="1033;">
                            <font color="#FF0000">385</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Suleman/Fayyaz</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-9027</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="120" sdnum="1033;">
                            <font color="#FF0000">120</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Yaqoob/Asad</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-9028</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="398" sdnum="1033;">
                            <font color="#FF0000">398</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="34" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Sajawal/Zameer</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">JQ-9029</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="414" sdnum="1033;">
                            <font color="#FF0000">414</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;">
                            <font color="#FF0000">1</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC">Driver didin't realize crossing limit ( Limit cross max speed 5 km/hr
                                )</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">SOC will be conducted</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="21" align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#0000CC">Zahoor/Akhtar</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFFFFF">
                            <font face="Calibri" size=3 color="#FF0000">TLX-543</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF">
                            <font color="#FF0000">HV</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"
                            sdval="378" sdnum="1033;">
                            <font color="#FF0000">378</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF" sdval="0" sdnum="1033;">
                            <font color="#FF0000">0</font>
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"
                            valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC">Yes</font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=top bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font color="#0000CC"><br></font>
                        </td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
                            align="left" valign=middle bgcolor="#FFFFFF">
                            <font face="Calibri" color="#0000CC"><br></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=2 height="20" align="center" valign=bottom bgcolor="#FFD966"><b>
                                <font face="Calibri" color="#000000">Total</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#000000"><br></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="8692" sdnum="1033;"><b>
                                <font color="#FF0000">8692</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="3" sdnum="1033;"><b>
                                <font color="#FF0000">3</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="5" sdnum="1033;"><b>
                                <font color="#FF0000">5</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="0" sdnum="1033;"><b>
                                <font color="#FF0000">0</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="0" sdnum="1033;"><b>
                                <font color="#FF0000">0</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="0" sdnum="1033;"><b>
                                <font color="#FF0000">0</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="6" sdnum="1033;"><b>
                                <font color="#FF0000">6</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="0" sdnum="1033;"><b>
                                <font color="#FF0000">0</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="center" valign=bottom bgcolor="#FFD966" sdval="0" sdnum="1033;"><b>
                                <font color="#FF0000">0</font>
                            </b></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#000000"><br></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#000000"><br></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#000000"><br></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#000000"><br></td>
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