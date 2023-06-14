<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>View | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & View Creation Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$result = mysqli_query($db,"SELECT * from geofenceing where type='circle'");
$resultdevice = mysqli_query($db,"SELECT * FROM devices;");
$resultdriver = mysqli_query($db,"SELECT * FROM driver_detail;");
$resultclient = mysqli_query($db,"SELECT * FROM bsl.users where privilege='End-User';;");


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
                                    <h4 class="mb-sm-0 font-size-18">Invoice Detail</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                            <li class="breadcrumb-item active">Invoice Detail</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="mb-4">
                                                        <img src="assets/images/logo-sm.svg" alt="" height="24"><span class="logo-txt">Minia</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="mb-4">
                                                        <h4 class="float-end font-size-16">Invoice # 12345</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <p class="mb-1">1874 County Line Road City, FL 33566</p>
                                            <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> abc@123.com</p>
                                            <p><i class="mdi mdi-phone align-middle me-1"></i> 012-345-6789</p>
                                        </div>
                                        <hr class="my-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <h5 class="font-size-15 mb-3">Billed To:</h5>
                                                    <h5 class="font-size-14 mb-2">Richard Saul</h5>
                                                    <p class="mb-1">1208 Sherwood Circle
                                                        Lafayette, LA 70506</p>
                                                    <p class="mb-1">RichardSaul@rhyta.com</p>
                                                    <p>337-256-9134</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <div>
                                                        <h5 class="font-size-15">Order Date:</h5>
                                                        <p>February 16, 2020</p>
                                                    </div>
                                                    
                                                    <div class="mt-4">
                                                        <h5 class="font-size-15">Payment Method:</h5>
                                                        <p class="mb-1">Visa ending **** 4242</p>
                                                        <p>richards@email.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="py-2 mt-3">
                                            <h5 class="font-size-15">Order summary</h5>
                                        </div>
                                        <div class="p-4 border rounded">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">No.</th>
                                                            <th>Item</th>
                                                            <th class="text-end" style="width: 120px;">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">01</th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1">Minia</h5>
                                                                <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                                            </td>
                                                            <td class="text-end">$499.00</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">02</th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1">Skote</h5>
                                                                <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                                            </td>
                                                            <td class="text-end">$499.00</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                                            <td class="text-end">$998.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="2" class="border-0 text-end">
                                                                Tax</th>
                                                            <td class="border-0 text-end">$12.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="2" class="border-0 text-end">Total</th>
                                                            <td class="border-0 text-end"><h4 class="m-0">$1010.00</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="d-print-none mt-3">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minia.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                        document.write(new Date().getFullYear())
                        </script> © Minia.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Page-content -->


    <?php include 'footer.php'?>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




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

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>