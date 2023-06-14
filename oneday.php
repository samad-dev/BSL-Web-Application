<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>One Day Report  | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Violation Report Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");

$result = mysqli_query($db,"SELECT ud.*,dc.name as vehi_name,us.name as username FROM users_devices as ud join devices as dc on dc.id=ud.devices_id join users as us on us.id=ud.users_id;");
// $resultdevice = mysqli_query($db,"SELECT * FROM devices;");
$resultuser = mysqli_query($db,"SELECT * FROM users where privilege='Cartraige';");

$user_id = $_SESSION['user_id']; 
$pre_role = $_SESSION['privilege']; 


$resultdevice = mysqli_query($db,"SELECT dc.* FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id';");


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
                                <h4 class="mb-sm-0 font-size-18">One Day Report  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">One Day Report  </a>
                                        </li>
                                        <li class="breadcrumb-item active">One Day Report  </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-search"></i></button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Vehicle</th>
                                        <th>Time</th>
                                        <th>Speed</th>
                                        <th>Altitude</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Direction</th>
                                        <th>Ignition</th>
                                        <th>Status</th>
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


            <?php include 'footer.php'?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>One Day Report</h5>
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

                                    <select class="form-control" data-trigger name="vehi_id" id="vehi_id"
                                        placeholder="Search Asset" required>
                                        <option value="">Select Asset</option>
                                        <?php foreach($resultdevice as $key => $value){ ?>
                                        <option value="<?= $value['id'];?>"><?= $value['name']; ?></option>
                                        <?php } 
                                                ?>
                                    </select>
                                </div>




                                <div class="col-md-12">
                                    <label class="form-label">From Date</label>
                                    <input type="date" class="form-control " id="from" name="from" required>
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
                {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                
            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                
            },
                'colvis'
            ]
    });

});

function get_history() {

    var v_id = [];

    // $('#vehi_id :selected').each(function(key) {
    //     v_id[key] = $(this).val();


    // })
    var vehi_id = $('#vehi_id').val();
    var vehi_name = $('#vehi_id').text();
    var from1 = document.getElementById("from").value;
    // var len_vehi = v_id.length;
    const format1 = "YYYY-MM-DD HH:mm:ss";



    if (vehi_id != "" && from1 != "") {
        $.ajax({
            url: 'http://119.160.107.173:3002/detail/'+vehi_id+'/'+from1+'',
            type: 'GET',
            beforeSend: function() {
                // $('#insert').val("Updating");
                $("#drawing").prop("disabled", true);
                $("#loader").show();
            },
            success: function(data) {
                console.log(data)
                // data = JSON.parse(data)
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



                        table
                            .row.add([
                                (i + 1),
                                vehi_name,
                                moment(data[i].GpsTime).format(format1),
                                data[i].SPEED,
                                data[i].Altitude,
                                data[i].LAT,
                                data[i].LONG,
                                data[i].DIRECTION,
                                data[i].IGN,
                                data[i].STATUS,
                                data[i].location,
                            ]).draw().node();

                        // if(i===len){
                        //     $("#loader").hide();

                        // }





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