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
        $('#title_edit').text("Add User");
        $('#insert_form')[0].reset();
        $('#role_div').removeClass('d-none');
        $('#role').prop('required', true);

    });

    $('#insert_form').on("submit", function (event) {
        event.preventDefault();
        var data = new FormData(this);

        $.ajax({
            url: "ajax/insert/create_user.php",
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
                    // $('.offcanvas-collapse').toggleClass('open');
                    // $('.offcanvas').removeClass('open');

                    Swal.fire({
                        position: 'bottom-left',
                        icon: 'success',
                        title: 'User Created Successfully',
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
                        text: 'User Not Created.',
                    })
                }




            }
        });

    });



    $(document).on('click', '.edit_data', function () {
        var el = this;

        var employee_id = $(this).attr('id');
        $.ajax({
            url: "ajax/get/get_users.php",
            method: "POST",
            data: {
                employee_id: employee_id
            },
            dataType: "json",
            success: function (data) {
                console.log(data)

                $('#employee_id').val(data.user_id);
                $('#name').val(data.name);
                $('#email').val(data.login);
                $('#address').val(data.address);
                $('#contact').val(data.telephone);
                $('#password').val(data.description);
                $('#overspeed_limit').val(data.overspeed);
                $('#idle_duration').val(data.idle);
                $('#nr_duration').val(data.nr);
                $('#night_from').val(data.night_from);
                $('#night_to').val(data.night_to);
                $('#excess_driving').val(data.excess_driving);
                $('#excess_driving_day').val(data.daily_driving_limit);
                $('#role_div').addClass('d-none');
                $('#role').prop('required', false);
                $('#insert').val("Update");
                $('#title_edit').text("Edit User");
            }
        });
        var offcanvasElement = document.querySelector('#offcanvasRight');
        var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
        offcanvas.show();

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
                url: 'ajax/delete/delete_users.php',
                type: 'POST',
                data: {
                    employee_id: employee_id
                },
                success: function (response) {

                    console.log(response)
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

