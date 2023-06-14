<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Assign Geofence | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Assign Geofence Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");
$user_id = $_SESSION['user_id'];
$result = mysqli_query($db, "SELECT vg.*,dc.name,geo.consignee_name FROM bsl.vehicle_geofence as vg 
join geofenceing as geo on geo.id=vg.geo_id
join devices as dc on dc.id=vg.vehicle_id where vg.created_by='$user_id';");

$resultdevice = mysqli_query($db, "SELECT dc.* FROM bsl.users_devices as ud join devices as dc on dc.id=ud.devices_id where ud.users_id='$user_id'");
$result_geo = mysqli_query($db, "SELECT * FROM geofenceing;");
$result_geo_group = mysqli_query($db, "SELECT * FROM geogence_group;");
$resultuser = mysqli_query($db, "SELECT * FROM users;");



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
                                <h4 class="mb-sm-0 font-size-18">Assign Geofence</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Assign Geofence</a>
                                        </li>
                                        <li class="breadcrumb-item active">Assign Geofence</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <button class="btn marron_bg" id='add' type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                style="font-size: 24px;">+</button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Vehicle #</th>
                                        <th>Geofence Name</th>
                                        <th>Speed Limit</th>
                                        <th>Created Time</th>

                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>
                                            <td>
                                                <?php echo $row["name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["consignee_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["speed_limit"]; ?> Km/Hr
                                            </td>
                                            <td>
                                                <?php echo $row["created_at"]; ?>
                                            </td>

                                            <td><i class="fas fa-pencil-alt text-success edit_data"
                                                    id='<?php echo $row['id']; ?>'></i></td>
                                            <td><i class="fas fa-trash-alt text-danger delete-btn"
                                                    id='<?php echo $row['id']; ?>'></i></td>

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
                <div id='zoomupModal' class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="edit_form" enctype="multipart/form-data">

                                    <div class="row mb-3">


                                        <div class="form-group col-md-12">
                                            <label for="inputAddress">Geofences</label><br>

                                            <select class="form-control modal_select" name="edit_geo" id="edit_geo"
                                                required style="width: 100%;height: 32px !important;">
                                                <option value="">Select Geofence</option>
                                                <?php foreach ($result_geo as $key => $value) { ?>
                                                    <option value="<?= $value['id']; ?>"><?= $value['consignee_name']; ?>
                                                    </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Overspeed Limit</label>
                                            <input type="text" class="form-control " id="edit_overspeed_limit"
                                                name="edit_overspeed_limit" required>
                                        </div>



                                        <input type="hidden" name="row_id" id="row_id">
                                        <input type="hidden" name="vehicle_id" id="vehicle_id">
                                        <div class="my-3 text-center">
                                            <input class="btn marron_bg" type="submit" name="edit_insert"
                                                id="edit_insert" value="Update">
                                        </div>


                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            
            </div>
            <!-- End Page-content -->


            <?php include 'footer.php' ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" id='title_edit'>Add Assign Geofence</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">

                                <div class="form-check my-3">
                                    <input class="form-check-input" type="checkbox" id="for_users">
                                    <label class="form-check-label" for="formCheck2">
                                        User Vehicles
                                    </label>
                                </div>
                                <div class="form-group col-md-12" id="user_div">
                                    <label for="inputAddress">Users</label><br>

                                    <select class="form-control all_select" name="user_id" id="user_id"
                                        style="width: 100%;height: 32px !important;"
                                        onchange="get_user_vehicles(this.value)">
                                        <option value="">Select User</option>
                                        <?php foreach ($resultuser as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Asset</label>

                                    <select class="form-control all_select" name="vehi_id[]" id="vehi_id" multiple
                                        required>
                                        <option value="">Select Asset</option>
                                        <?php foreach ($resultdevice as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-check my-3">
                                    <input class="form-check-input" type="checkbox" id="myCheckbox">
                                    <label class="form-check-label" for="formCheck2">
                                        Group Assign
                                    </label>
                                </div>
                                <div class="form-group col-md-12" id="geo_group">
                                    <label for="inputAddress">Geofence Group</label><br>

                                    <select class="form-control all_select" name="group_id" id="group_id"
                                        style="width: 100%;height: 32px !important;"
                                        onchange="get_group_fence(this.value)">
                                        <option value="">Select Group</option>
                                        <?php foreach ($result_geo_group as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12" id="individual_geo">
                                    <label for="inputAddress">Geofences</label>

                                    <select class="form-control all_select" name="geo_id[]" id="geo_id" multiple
                                        required>
                                        <option value="">Select Geofence</option>
                                        <?php foreach ($result_geo as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['consignee_name']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Overspeed Limit</label>
                                    <input type="text" class="form-control " id="overspeed_limit" name="overspeed_limit"
                                        required>
                                </div>



                                <input type="hidden" name="employee_id" id="employee_id">
                                <div class="my-3 text-center">
                                    <!-- <button class="btn rounded-pill marron_bg" type="submit" name="insert"
                                                    id="insert">Save</button> -->
                                    <input class="btn marron_bg" type="submit" name="insert" id="insert" value="Save">
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
        $("#geo_group").hide();
        $("#user_div").hide();

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
        $('#insert_form').on("submit", function (event) {
            event.preventDefault();
            var data = new FormData(this);
            var v_id = $('#vehi_id').val();
            var g_id = $('#geo_id').val();
            var overspeed_limit = $('#overspeed_limit').val();
            var employee_id = $('#employee_id').val();


            console.log(v_id);

            $.ajax({
                url: "ajax/insert/insert_geo_vehicle.php?vehi_id=" + v_id + "&geo_id=" + g_id +
                    "&employee_id=" + employee_id + "&overspeed_limit=" + overspeed_limit,
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",
                data: {
                    vehi_id: v_id,
                    geo_id: g_id
                },
                beforeSend: function () {
                    $('#insert').val("Inserting");
                },
                success: function (data) {
                    console.log(data);

                    if (data != 0) {
                        Swal.fire({
                            position: 'bottom-left',
                            icon: 'success',
                            title: 'Assigned Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        setTimeout(function () {
                            window.location.reload();

                        }, 2000);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Geofence Not Assign.',
                        })
                    }




                }
            });

        });

        $('#edit_form').on("submit", function (event) {
            event.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: "ajax/insert/update_assign_vehi_geo.php",
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function () {
                    $('#insert').val("Inserting");
                },
                success: function (data) {
                    console.log(data);

                    if (data != 0) {
                        Swal.fire({
                            position: 'bottom-left',
                            icon: 'success',
                            title: 'Record Updated Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        setTimeout(function () {
                            window.location.reload();

                        }, 2000);

                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Not Updated.',
                        })
                    }




                }
            });

        });


        $(document).on('click', '.edit_data', function () {
            var el = this;

            // Delete id
            var employee_id = $(this).attr('id');
            // alert(employee_id)
            $.ajax({
                url: "ajax/get/get_assign_fence_vehi.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                dataType: "json",
                success: function (data) {
                    console.log(data)

                    $('#row_id').val(data.id);
                    $('#edit_overspeed_limit').val(data.speed_limit);
                    $('#vehicle_id').val(data.vehicle_id);
                    $('#edit_geo').val(data.geo_id).change();

                    $('#insert').val("Update");
                    $('#title_edit').text("Edit Assign Geofence");
                    $('#zoomupModal').modal('show');
                }
            });
            // $("#offcanvasRight").toggleClass("open");
            // $("#offcanvasRight").toggleClass("show");
            // $("#offcanvasRight").modal("show");

            // $("#offcanvasRight").toggleClass("open");
        });
        $(document).on('click', '.delete-btn', function () {
            var el = this;

            // Delete id
            var employee_id = $(this).attr('id');
            // alert(employee_id);

            var confirmalert = confirm("Are you sure?");
            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                    url: 'ajax/delete/delete_assign_vehi_geo.php',
                    type: 'POST',
                    data: {
                        employee_id: employee_id
                    },
                    success: function (response) {

                        if (response == 1) {
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background', 'tomato');
                            $(el).closest('tr').fadeOut(800, function () {
                                $(this).remove();
                                Swal.fire({
                                    position: 'bottom-left',
                                    icon: 'success',
                                    title: 'Record Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            });

                            setTimeout(function () {
                                window.location.reload();

                            }, 2000);


                        } else {
                            alert('Invalid ID.');
                        }

                    }
                });
            }

        });
        $("#myCheckbox").click(function () {
            if ($(this).is(":checked")) {
                $("#geo_group").show();
                $("#geo_id").prop("disabled", true);

            } else {
                $("#geo_group").hide();
                $('#geo_id').prop("disabled", false);
                $('#geo_id').val([]).change();
                $('#group_id').val('').change();


            }
        });
        $("#for_users").click(function () {
            if ($(this).is(":checked")) {
                $("#user_div").show();

            } else {
                $("#user_div").hide();
                $('#vehi_id').val([]).change();
                $('#user_id').val('').change();


            }
        });
    });

    function get_group_fence(val) {
        if (val != "") {
            $.ajax({
                url: 'ajax/get/get_group_fence.php',
                type: 'POST',
                data: {
                    group_id: val
                },
                success: function (data) {
                    data = JSON.parse(data)
                    console.log(data);



                    var len = data.length;
                    if (len > 0) {
                        // $('#' + region_id + '').off('change');
                        // $('#' + count_id + '').off('change');
                        var re = [];
                        var cu = [];
                        for (var i = 0; i < len; i++) {

                            var geo_id = data[i]['id'];
                            cu.push(geo_id);


                        }
                        $('#geo_id').val(cu).change();

                    } else {
                        ////alert("No Records Found");
                    }
                }
            });

        }
    }

    function get_user_vehicles(val) {
        if (val != "") {
            $.ajax({
                url: 'ajax/get/get_users_vehicle.php',
                type: 'POST',
                data: {
                    user_id: val
                },
                success: function (data) {
                    data = JSON.parse(data)
                    console.log(data);



                    var len = data.length;
                    if (len > 0) {
                        // $('#' + region_id + '').off('change');
                        // $('#' + count_id + '').off('change');
                        var re = [];
                        var cu = [];
                        for (var i = 0; i < len; i++) {

                            var vehi_id = data[i]['devices_id'];
                            cu.push(vehi_id);


                        }
                        $('#vehi_id').val(cu).change();

                    } else {
                        alert("No Vehicles Found");
                    }
                }
            });

        }
    }
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>