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
        $('#title_edit').text("Add Driver");
        $('#insert_form')[0].reset();
        $('#vehi_id').val([]).change();


    });

    $('#insert_form').on("submit", function (event) {
        event.preventDefault();
        var data = new FormData(this);

        $.ajax({
            url: "ajax/insert/create_driver.php",
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
                        title: 'Driver Created Successfully',
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
                        text: 'Driver Not Created.',
                    })
                }




            }
        });

    });

    $(document).on('click', '.edit_data', function () {

        var employee_id = $(this).attr("id");
        // alert(employee_id)
        $.ajax({
            url: "ajax/get/get_drivers.php",
            method: "POST",
            data: {
                employee_id: employee_id
            },
            dataType: "json",
            success: function (data) {
                console.log(data)

                $('#employee_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.file_no);
                $('#contact').val(data.mobile_no);
                $('#cnic').val(data.cnic);
                $('#vehi_id').val(data.vehicle_id).change();

                $('#insert').val("Update");
                $('#title_edit').text("Edit Driver");

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
                url: 'ajax/delete/delete_drivers.php',
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

