<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Load Alerts | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Load Alerts Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php'?>


</head>
<?php 
include("config.php");
$user_id = $_SESSION['user_id'];
$todate=date("Y-m-d H:i:s", time());

$prev_date=date("Y-m-d H:i:s", strtotime($todate .' -1 day'));
$result = mysqli_query($db,"SELECT * FROM driving_alerts where is_load=1 and created_at>='$prev_date' and created_by='$user_id' order by id desc ");
$alert_result = mysqli_query($db, "SELECT distinct(type) FROM driving_alerts");
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
                                <h4 class="mb-sm-0 font-size-18">Load Alerts</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Load Alerts</a></li>
                                        <li class="breadcrumb-item active">Load Alerts</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                style="font-size: 24px;">+</button>

                        </div>
                    </div> -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row mb-4">

                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Alert</label>

                                        <select class="form-control all_select" id="alert_type" name="alert_type"
                                            onchange="get_history()" multiple>
                                            <!-- <option value="all">All</option> -->
                                            <option value="all">All Load Alerts</option>
                                            <?php foreach($alert_result as $key => $lorry){ ?>
                                            <option value="<?= $lorry['type'];?>">
                                                <?= $lorry['type']; ?></option>
                                            <?php } 
                                                            ?>
                                        </select>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Alert Type</th>
                                        <th class="text-center">Alert</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Track</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        while($row = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"><?php echo $row["type"]; ?></td>
                                        <td class="text-center" style="width:30%"><?php echo $row["message"]; ?></td>
                                        <td class="text-center"><?php echo $row["created_at"]; ?></td>
                                        <td class="text-center">

                                            <a href="check_alerts.php?id=<?php echo $row["pos_id"]; ?>&geo=<?php echo $row["geo_id"]; ?>&type=<?php echo $row["type"]; ?>"
                                                target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-activity">
                                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                </svg></a>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                 if($row["description"]!=""){
                                                    echo $row["description"];
                                                 } 
                                                 else{
                                                     ?>
                                            <a name="edit" id="<?php echo $row["id"]; ?>" class="edit_data"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2 text-success">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg></a>
                                            <?php
                                                 }
                                                ?>
                                        </td>








                                    </tr>
                                    <?php
                                            $i++;
                                            }
                                        ?>


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
   

    <div id="zoomupModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container my-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="insert_description" enctype="multipart/form-data">
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Description</label>
                                            <input type="text" class="form-control" id="cname" name="cname"
                                                placeholder="Enter Description">
                                        </div>




                                        <input type="hidden" name="alert_idd" id="alert_idd">
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" class="btn marron_bg" name="insert" id="insert"
                                                    value="Insert" style="float:right" />

                                            </div>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer md-button">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                        Cancel</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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
    $(document).on('click', '.edit_data', function() {

        var employee_id = $(this).attr("id");
        // alert(employee_id)
        $('#zoomupModal').modal('show');
        $('#alert_idd').val(employee_id);

    });
    $('#insert_description').on("submit", function(event) {
        event.preventDefault();
        if ($('#cname').val() == "") {
            alert("Driver name is required");

        } else {
            $.ajax({
                url: "ajax/insert/add_alert_des.php",
                method: "POST",
                data: $('#insert_description').serialize(),
                beforeSend: function() {
                    $('#insert').val("Inserting");
                },
                success: function(data) {
                    console.log(data)
                    $('#insert_description')[0].reset();
                    $('#zoomupModal').modal('hide');
                    //    $("#html5-extension").load(" #html5-extension");
                    window.location.reload();

                }
            });
        }
    });
});

function get_history() {

    var v_id = [];

    $('#alert_type :selected').each(function(key) {
        v_id[key] = $(this).val();


    })
    // alert(vehicle_name);
    // var vehicle = document.getElementById("lorry_number").value;

    var len_vehi = v_id.length;


    if (len_vehi != 0) {
        $.ajax({
            url: 'ajax/get/get_alerts_data.php',
            type: 'POST',
            data: {
                check: v_id
            },
            beforeSend: function() {
                $("#loader").show();
            },
            success: function(data) {
                data = JSON.parse(data)

                console.log(data)
                var len = data.length;
                //alert("len "+len)
                var table = $('#example').DataTable();
                table
                    .clear()
                    .draw();

                if (len > 0) {

                    for (var i = 0; i < len; i++) {

                        var disc = "";
                        if (data[i].description != '') {
                            disc = data[i].description;
                        } else {
                            disc = '<a name="edit" id="' + data[i].id +
                                '" class="edit_data" data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"> <path  d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></svg></a>'
                        }

                        table.row.add(
                                [(i + 1),
                                    data[i].type,
                                    data[i].message,
                                    data[i].created_at,
                                    '<a href="check_alerts.php?id=' + data[i].pos_id + '&type=' + data[i]
                                    .type + '&geo=' + data[i].geo_id +
                                    '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></a>',
                                    disc,
                                ])
                            .draw()
                            .node();

                        // if(i===len){
                        //     $("#loader").hide();

                        // }





                    }

                } else {
                    alert("No Data Found")
                }






            },
            complete: function(data) {
                // Hide image container
                $("#loader").hide();
                $("#geted").prop("disabled", false);
            }
        });
    }

}

setInterval(function() {
    get_history()
}, 120000);
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>