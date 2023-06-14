<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:26 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Login | BSL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index.php" class="d-block auth-logo">
                                        <img src="https://www.pkbsl.com/wp-content/uploads/2018/01/logo.png" alt=""
                                            height="28"> <span class="logo-txt"></span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back !</h5>
                                        <p class="text-muted mt-2">Sign in to continue to BSL.</p>
                                        <p class="text-muted mb-4" id='lav'>Enter your email address and password to
                                            access admin panel.
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" required=""
                                            name="username" placeholder="Enter username">
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label">Password</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <!-- <a href="auth-recoverpw.html" class="text-muted">Forgot password?</a> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password"
                                                aria-label="Password" aria-describedby="password-addon" id="password"
                                                required="" name="password">
                                            <button class="btn btn-light shadow-none ms-0" type="button"
                                                id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn marron_bg w-100 waves-effect waves-light" type="submit"
                                            onclick="do_login()">Log In</button>
                                    </div>



                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                        </script> BSL . Design and Developed by P2P Track <i
                                            class="mdi mdi-heart text-danger"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="login_banner"></div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="assets/libs/pace-js/pace.min.js"></script>
    <!-- password addon init -->
    <script src="assets/js/pages/pass-addon.init.js"></script>


    <script type="text/javascript">
    function do_login() {
        var username = $("#username").val();
        var password = $("#password").val();
        if (username != "" && password != "") {
            $.ajax({
                type: 'post',
                url: 'ajax/get/loginn.php',
                data: {
                    do_login: "do_login",
                    username: username,
                    password: password
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    var result = JSON.parse(response[0]['result']);
                    if (result == 1) {
                        var user_id = JSON.parse(response[0]['user_id']);
                        // var data = JSON.parse(response[0]);
                        var privilege = response[0];
                        console.log(typeof privilege.privilege)   

                        <?php 
                            $current_date = date('Y-m-d');
                            $next_dat = date('Y-m-d', strtotime($current_date . '+1 day'));

                        ?>
                        $('#lav').html('Login Succesfully');
                        if(privilege.privilege==="Non-Dedicated" || privilege.privilege==="Dedicated"){
                            window.location.href = "dashboard.php?id=1&from=<?php echo $current_date;?>&to=<?php echo $next_dat;?>";

                        }else{

                            window.location.href = "dashboard.php?id=" + user_id + "&from=<?php echo $current_date;?>&to=<?php echo $next_dat;?>";
                        }
                    } else if (result == 2) {
                        $('#lav').html(
                            'You are not able to login to the system for some reason ,For further detail please contact to admin'
                        );
                        $('#lav').addClass('text-danger');
                    } else {
                        $('#lav').html('Your Login Name or Password is invalid');
                        $('#lav').addClass('text-danger');

                        // alert('Your Login Name or Password is invalid');

                        // $("#loading_spinner").css({
                        //     "display": "none"
                        // });
                    }
                }
            });
        } else {
            alert("Please Fill All The Details");
        }


    }
    </script>
</body>


<!-- Mirrored from themesbrand.com/minia/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Jan 2023 10:00:26 GMT -->

</html>