<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Daily Movement Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Daily Movement Report Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    
<script src='https://cdnjs.cloudflare.com/ajax/libs/exceljs/1.7.0/exceljs.min.js'></script>
    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

// $resultdevice = mysqli_query($db, "SELECT * FROM devices;");

$user_id = $_SESSION['user_id'];
$pre_role = $_SESSION['privilege'];


$resultdevice = mysqli_query($db, "SELECT dc.* FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id';");


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
                                <h4 class="mb-sm-0 font-size-18">Daily Movement Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Daily Movement
                                                Report</a>
                                        </li>
                                        <li class="breadcrumb-item active">Daily Movement Report</li>
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
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>S.No</th> -->
                                        <!-- <th>Vehicle</th> -->
                                        <th>Time</th>
                                        <th>Speed</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Ignition</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>

                            </table>
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
            <h5 id="offcanvasRightLabel" id='title_edit'>Create Daily Movement Report</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">

                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Asset</label>

                                    <select class="form-control" data-trigger name="vehi_id[]" id="vehi_id"
                                        placeholder="Search Asset" required>
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
                                <div class="col-md-12">
                                    <label class="form-label">Time Interval</label>
                                    <input type="number" class="form-control " id="interval" name="interval" required>
                                </div>

                            </div>




                            <div class="mb-3 text-center">
                                <button type="button" class="btn marron_bg" id="drawing"
                                    onclick="get_history()">Get</button>

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

<script>
    $(document).ready(function () {
        //    var table =  $('#example').DataTable({
        //         dom: 'Bfrtip',
        //         buttons: [
        //             {
        //                 extend: 'csvHtml5',
        //                 exportOptions: {
        //                     columns: ':visible'
        //                 },

        //             },
        //             {
        //                 extend: 'excelHtml5',
        //                 exportOptions: {
        //                     columns: ':visible'
        //                 },

        //             },
        //             {
        //                 extend: 'copyHtml5',
        //                 exportOptions: {
        //                     columns: ':visible'
        //                 },

        //             },
        //             'colvis'
        //         ]
        //     });

    });

    function get_history() {

        var v_id = [];

        // $('#vehi_id :selected').each(function(key) {
        //     v_id[key] = $(this).val();


        // })
        const format1 = "YYYY-MM-DD HH:mm:ss";
        var vehi_id = $('#vehi_id').val();
        var vehi_name = $('#vehi_id').text();
        var from1 = document.getElementById("from").value;
        var to = document.getElementById("to").value;
        var interval = document.getElementById("interval").value;
        // var len_vehi = v_id.length;
        console.log("http://119.160.107.173:3002/history2/" + vehi_id + "/" + from1 + "/" + to + "/" + interval + "");
        // var table1 = $('#example').DataTable({
        //     "ajax": "http://119.160.107.173:3002/history2/" + vehi_id + "/" + from1 + "/" + to + "",
        //     "columns": [
        //         {
        //             "data": "GpsTime",

        //         },
        //         {
        //             "data": "SPEED"
        //         },
        //         {
        //             "data": "LAT"
        //         },
        //         {
        //             "data": "LONG"
        //         },
        //         {
        //             "data": "IGN"
        //         },
        //         {
        //             "data": "location"
        //         },
        //     ],
        //     dom: 'Bfrtip',
        //     buttons: [
        //         {
        //             extend: 'csvHtml5',
        //             exportOptions: {
        //                 columns: ':visible'
        //             },

        //         },
        //         {
        //             extend: 'excelHtml5',
        //             exportOptions: {
        //                 columns: ':visible'
        //             },

        //         },
        //         {
        //             extend: 'copyHtml5',
        //             exportOptions: {
        //                 columns: ':visible'
        //             },

        //         },
        //         'colvis'
        //     ],
        //     stateSave: true,
        //     "bDestroy": true,
        //     "pageLength": 10
        // });

        if (vehi_id != "" && from1 != "") {
            console.log('http://119.160.107.173:3002/history/' + vehi_id + '/' + from1 + '/' + to + '');
            $.ajax({
                url: 'http://119.160.107.173:3002/history/' + vehi_id + '/' + from1 + '/' + to + '/' + interval + '',
                type: 'GET',
                beforeSend: function () {
                    // $('#insert').val("Updating");
                    $("#drawing").prop("disabled", true);
                    $("#loader").show();
                },
                success: function (data2) {
                    console.log(data2)
                    var logo = new Image();
                    logo.src = '';
                    var myImg = "data:image/png;base64,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";

                    var table = $("#example").DataTable({
                        data: data2,
                        columns: [
                            { "data": "GpsTime" },
                            { "data": "SPEED" },
                            { "data": "LAT" },
                            { "data": "LONG" },
                            { "data": "IGN" },
                            { "data": "LOCATION" },
                        ],
                        rowCallback: function (row, data) {
                            console.log('empty');
                            if (data.LOCATION == null || data.LOCATION == '') {
                                var previousRow = $(row).prev();
                                if (previousRow.length > 0) {
                                    var previousLocation = $('td:eq(6)', previousRow).text();
                                    $('td:eq(6)', row).text(previousLocation);
                                }
                            }
                        },
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'collection',
                                text: 'Export',
                                buttons: [
                                    {
                                        extend: 'pdf',
                                        text: 'PDF',
                                        title: 'Daily Movement Report | BSL Private Limited',
                                        message: 'Date From: ' + from1 + ' | Date To:' + to + ' ',
                                        orientation: 'landscape',
                                        exportOptions: {
                                            columns: ':visible'
                                        },
                                        customize: function (doc) {
                                            doc.content.splice(0, 0, {
                                                margin: [0, 0, 0, 12],
                                                alignment: 'center',
                                                image: myImg, width: 100
                                            });
                                        }
                                    },
                                    {
                                        extend: 'excel',
                                        text: 'EXCEL',
                                        title: 'Daily Movement Report | BSL Private Limited',
                                        message: 'Date From: ' + from1 + ' | Date To:' + to + ' ',
                                        orientation: 'landscape',
                                        exportOptions: {
                                            columns: ':visible'
                                        },
                                        customize: function (doc) {
                                            var workbook = new ExcelJS.Workbook();
                                            var worksheet = workbook.addWorksheet('Main sheet');

                                            const logo = workbook.addImage({
                                                base64: myImg,
                                                extension: 'png',
                                            });

                                            worksheet.addImage(logo, 'D2:F6');

                                            worksheet.columns = [
                                                { width: 10 }, { width: 15 }, { width: 15 }, { width: 15 }
                                            ];
                                           doc =  workbook.xlsx.writeBuffer();
                                        }
                                    },

                                ]
                            }
                        ],


                    });


                    // table.buttons().container().prepend(customHeader);

                    //     // data = JSON.parse(data)
                    //     // console.log(data);
                    //     table_html = data;
                    //     console.log(table_html)

                    //     var len = data.length;
                    //     const format1 = "YYYY-MM-DD HH:mm:ss";
                    //     //alert("len "+len)
                    //     var table = $('#example').DataTable();
                    //     table
                    //         .clear()
                    //         .draw();

                    //     if (len > 0) {
                    //         for (var i = 0; i < len; i++) {



                    //             table
                    //                 .row.add([
                    //                     (i + 1),
                    //                     vehi_name,
                    //                     moment(data[i].GpsTime).format(format1),
                    //                     data[i].SPEED,
                    //                     data[i].LAT,
                    //                     data[i].LONG,
                    //                     data[i].IGN,
                    //                     data[i].location,]).draw().node();
                    //         }
                    //     } else {
                    //         alert("No Data Found");
                    //         $("#drawing").prop("disabled", false);
                    //     }
                },
                complete: function (data) {
                    // Hide image container
                    $("#loader").hide();
                    $("#drawing").prop("disabled", false);
                }
            });
        } else {
            alert("Please Select Value")
        }

    }
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>