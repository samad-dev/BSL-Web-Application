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
    <!-- App favicon -->
    <?php include_once('css.php'); ?>

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
                            <h1>JMP Report</h1>
                            <!-- <div class="row">
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">ADD</button>

                                </div>



                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card" dir="rtl">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>گاڑی نمبر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>کسٹمر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 4.3%;">
                                            <b>
                                                <p>منزل</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>ٹرپ شروع ہونے کی تاریخ</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="date" name="end_time" id="end_time">
                                        </div>
                                        <!-- <div class="col-1">
                                        <b><p>منصوبے کے مطابق ٹرپ ختم ہونے کی تاریخ </p></b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="date" name="end_time" id="end_time">
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 5%;">
                                            <b>
                                                <p>قائل نمبر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>1 ڈرائیور</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>موبائل نمبر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="number" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>ڈیوٹی پر آنے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 5%;">
                                            <b>
                                                <p>قائل نمبر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>

                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>2 ڈرائیور</p>
                                            </b>
                                        </div>

                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>موبائل نمبر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="number" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>ڈیوٹی پر آنے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>بی ایس ایل ترمینل سے روانگی</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>گاڑی بھرنے کی جگہ پر آمد</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>گاڑی بھرنے کی جگہ پر آمد کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>شپمنٹ نمبر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>





                                    </div>


                                    <div class="row">
                                        <div class="col-1">
                                            <b>
                                                <p>گاڑی کی بھرائی شروع ہونے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>گاڑی کی بھرائی مکمّل ہونے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>ریفائنری سے نکلنے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>

                                        <div class="col-1">
                                            <b>
                                                <p>منزل پر پونچھنے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-1">
                                            <b>
                                                <p>منزل پر پونچھنے کی تاریخ </p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>ٹرمنل میں داخل ہونے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>گاڑی خالی ہونے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>

                                        <div class="col-1">
                                            <b>
                                                <p>ٹرمنل سے نکلنے کا وقت </p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-1">
                                            <b>
                                                <p>ٹرمنل میں کل وقت </p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1">
                                            <b>
                                                <p>ٹرپ ختم ہونے کا وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-1" style="width: 6%;">
                                            <b>
                                                <p>ٹرپ کا کل وقت</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="time" name="end_time" id="end_time">
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <b>
                                                <p>رائیوروں کو ٹرپ کے بارے میں سمجھایا دیا گیا ہےاور ان کو موسم، تازہ
                                                    ترین سڑکوں کی حالت , منظور شدہ آرام گاہوں، منظور شدہ /متبادل راستوں
                                                    کے بارے میں آگاہ کر دیا ہے؟</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        <div class="col-2" style="width:9%">
                                            <b>
                                                <p>دستخط سپروئزر</p>
                                            </b>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>


                                    </div>
                                    <!-- 
                                    <div class="row">
                                        <div class="col-3" style="width:9%">
                                            <p>ٹول باکس میٹنگ کے موزوں پر بات چیت</p>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-3" style="width:9%">
                                            <p>رائیوروں کو ٹرپ کے بارے میں سمجھایا دیا گیا ہےاور ان کو موسم، تازہ ترین سڑکوں کی حالت , منظور شدہ آرام گاہوں، منظور شدہ /متبادل راستوں کے بارے میں آگاہ کر دیا ہے؟</p>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="end_time" id="end_time">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row"> -->
                                    <table class="table table-bordered dt-responsive nowrap w-100" id="example">
                                        <thead>
                                            <tr>
                                                <th>تاریخ </th>
                                                <th>ڈرائیور </th>
                                                <th>ڈرائیونگ </th>
                                                <th>وقفہ</th>
                                                <th>رننگ وقت</th>
                                                <th>رکنے کا مقام</th>
                                                <th>رکنے کا وجہ </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
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
    <?php include_once('right-sidebar.php'); ?>

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <?php include_once('scripts.php'); ?>



</body>
<script>
    $(document).ready(function () {
        console.log("ready!");
        var table = $('#example').DataTable();
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
                const hours = Math.floor(element["stop_time"] / 60);
                const minutes = Math.round(element["stop_time"] % 60);
                const hours2 = Math.floor(element["running"] / 60);
                const minutes2 = Math.round(element["running"] % 60);
                if(i % 2==0){
                    num = 2;
                //The number is even
                }
                else{
                    num = 1;
                }
                
                table.row.add( [d.toLocaleDateString(),"Driver -"+num,d.toLocaleTimeString(),hours+":"+minutes,hours2+":"+minutes2,"",""] ).draw()
                
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
</script>
<!-- Mirrored from P2P Track.com/Nelson/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 10:08:38 GMT -->

</html>