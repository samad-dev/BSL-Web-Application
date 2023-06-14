<?php
include("sessioninput.php");


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 09:59:40 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Geofence Type | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Geofence Type Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include 'head_tag.php' ?>


</head>
<?php
include("config.php");

$result = mysqli_query($db, "SELECT * from geofence_type");

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
                                <h4 class="mb-sm-0 font-size-18">Geofence Type</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Geofence Type</a>
                                        </li>
                                        <li class="breadcrumb-item active">Geofence Type</li>
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
                                        <th>GeoFence Type</th>

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
                                                <?php echo $row["type"]; ?>
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
            </div>
            <!-- End Page-content -->


            <?php include 'footer.php' ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id='title_edit'>Add Geofence Type</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluld">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" enctype="multipart/form-data">

                            <div class="row mb-3">



                                <div class="col-md-12">
                                    <label class="form-label">Geofence Type</label>
                                    <input type="text" class="form-control " id="name" name="name" required>
                                </div>



                            </div>




                            <input type="hidden" name="employee_id" id="employee_id">
                            <div class="mb-3 text-center">
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
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });




        $('#add').click(function () {
            $('#insert').val("Save");
            $('#employee_id').val("");
            $('#title_edit').text("Geofence Type");
            $('#insert_form')[0].reset();

        });

        $('#insert_form').on("submit", function (event) {
            event.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: "ajax/insert/create_geo_type.php",
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
                    var offcanvasElement = document.querySelector('#offcanvasRight');
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);

                    if (data != 0) {
                        offcanvas.hide();

                        Swal.fire({
                            position: 'bottom-left',
                            icon: 'success',
                            title: 'Geofence Type Created Successfully',
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
                            text: 'Geofence Type Not Created.',
                        })
                    }




                }
            });

        });

        $(document).on('click', '.edit_data', function () {

            var employee_id = $(this).attr("id");
            // alert(employee_id)
            $.ajax({
                url: "ajax/get/get_geo_type.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                dataType: "json",
                success: function (data) {
                    console.log(data)

                    $('#employee_id').val(data.id);
                    $('#name').val(data.type);

                    $('#insert').val("Update");
                    $('#title_edit').text("Geofence Type");
                    var offcanvasElement = document.querySelector('#offcanvasRight');
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.show();
                }
            });
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
                    url: 'ajax/delete/delete_geotype.php',
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

    });
</script>

<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:07 GMT -->

</html>