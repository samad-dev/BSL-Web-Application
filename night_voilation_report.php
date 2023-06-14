<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Night Violation Report | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Night Violation Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$resultdevice = mysqli_query($db,"SELECT * FROM devices;");

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
                                <h4 class="mb-sm-0 font-size-18">Night Violation Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Night Violation
                                                Report</a>
                                        </li>
                                        <li class="breadcrumb-item active">Night Violation Report</li>
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
                                        <th>S.NO</th>
                                        <th>Date</th>
                                        <th>Vehicle</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Moving Duration</th>
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


            <?php include 'footer.php'?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Add Night Violation Report</h5>
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
                                        <?php foreach($resultdevice as $key => $value){ ?>
                                        <option value="<?= $value['id'];?>"><?= $value['name']; ?></option>
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
                                    onclick="get_history()">Get</button>

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

function get_history() {


    var vehicle = document.getElementById("vehi_id").value;
    var vehicle_name = $("#vehi_id option:selected").text();;
    var from1 = document.getElementById("from").value;
    var to1 = document.getElementById("to").value;
    const format1 = "YYYY-MM-DD HH:mm:ss";

    from = moment(from1).format(format1);
    to = moment(to1).format(format1);


    if (vehicle != 0 && from1 != "" && to1 != "") {
        $.ajax({
            url: 'ajax/get/communicaton.php',
            type: 'POST',
            data: {
                check: vehicle,
                from: from1,
                to: to1,
                vehicle_name: vehicle_name
            },
            beforeSend: function() {
                // $('#insert').val("Updating");
                $("#drawing").prop("disabled", true);
                $("#loader").show();
            },
            success: function(data) {
                data = JSON.parse(data)
                // console.log(data);
                table_html = data;
                console.log(table_html)

                var len = data.length;
                //alert("len "+len)
                var table = $('#example').DataTable();
                table
                    .clear()
                    .draw();

                if (len > 0) {
                    for (var i = 0; i < len; i++) {


                        date = data[i].date;
                        // vehicle_name = data[i].vehicle_name;
                        start_time = data[i].start_time;
                        end_time = data[i].end_time;


                        moving_duration = data[i].moving_duration;


                        table
                            .row.add([
                                (i + 1),
                                date,
                                vehicle_name,
                                start_time,
                                end_time,

                                moving_duration,


                            ])
                            .draw()
                            .node();

                        if (i === len) {
                            $("#loader").hide();

                        }

                    }






                } else {
                    alert("No Data Found");
                    $("#drawing").prop("disabled", false);
                }






            },
            complete: function(data) {
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