<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>All Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & All Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$result = mysqli_query($db, "SELECT * from driver_detail");

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
                                <h4 class="mb-sm-0 font-size-18">All Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">All Report</a></li>
                                        <li class="breadcrumb-item active">All Report</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                </div>
                <div class="conatiner-fluid">
                    <div class="row mt-5">
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="nr_report.php" target="_blank">
                                        <span data-key="t-calendar">NR Asset</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="current_location_report.php" target="_blank">
                                        <span data-key="t-calendar">Asset Current Location</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="overspeed_report.php" target="_blank">
                                        <span data-key="t-calendar">Asset Violation </span>
                                    </a>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="history_report.php" target="_blank">
                                        <span data-key="t-calendar">Asset History Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="night_report.php" target="_blank">
                                        <span data-key="t-calendar">Asset Night Violation Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="nr_report.php" target="_blank">
                                        <span data-key="t-calendar">NR Asset</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="jmp_list.php" target="_blank">
                                        <span data-key="t-calendar">JMP Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="unauth.php" target="_blank">
                                        <span data-key="t-calendar">Un Authorized Stoppage  Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="hour_report.php" target="_blank">
                                        <span data-key="t-calendar">Bowzer Movement Report (UEP)</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="daily_movement_report_uep.php" target="_blank">
                                        <span data-key="t-calendar">Daily Movement Report (UEP)</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="vts_daily_new.php" target="_blank">
                                        <span data-key="t-calendar">VTS Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="monthly_vts.php" target="_blank">
                                        <span data-key="t-calendar">Monthly VTS Report UEP</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="vts_new.php" target="_blank">
                                        <span data-key="t-calendar">Monthly VTS Report Custom </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="daily_movement_report3.php" target="_blank">
                                        <span data-key="t-calendar">Daily Movement Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="trip_stops_report.php" target="_blank">
                                        <span data-key="t-calendar">Trip Stops Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="transit.php" target="_blank">
                                        <span data-key="t-calendar">Transit Report </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="oneday.php" target="_blank">
                                        <span data-key="t-calendar">One Day Report</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="vehicle_performance.php" target="_blank">
                                        <span data-key="t-calendar">Vehicle Performance Report</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="daily_activity_report.php" target="_blank">
                                        <span data-key="t-calendar">Daily Activity Report</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="mileage_report.php" target="_blank">
                                        <span data-key="t-calendar">Mileage Report</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2 mt-4">
                            <div class="row p-2" style="box-shadow: 3px 4px 1px 4px grey;">
                                <div class="col-md-12 text-center">
                                    <i class="fas fa-file-pdf" style="font-size: 60px;color: maroon;"></i>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a href="speed_vioaltion.php" target="_blank">
                                        <span data-key="t-calendar">Speed Vioaltion Report</span>
                                    </a>
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
<script src="script/driver_script.js"></script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>