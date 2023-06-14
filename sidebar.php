<?php 
error_reporting(9);
    $user_id = $_SESSION['user_id'];
    $p_role = $_SESSION['privilege'];

    
    $all_admin = "SELECT * FROM bsl.users where privilege='Admin'";
    $sidebaaar_all_admin = mysqli_query($db, $all_admin);
    
    if($p_role=='Admin'){
        $distributor = "SELECT us.* FROM bsl.admin_distributers as ds join users as us on us.id=ds.distributor_id where ds.admin_id='$user_id'";
        $catraige = "SELECT us.* FROM bsl.distributor_end_user as eu join users as us on us.id=eu.end_user_id where eu.distributor_id='$user_id'";
        $sidebaaar_distributor = mysqli_query($db, $distributor);
        $sidebaaar_catraige = mysqli_query($db, $catraige);
    }
    else if($p_role=='Distributor'){
        $distributor = "SELECT us.* FROM bsl.admin_distributers as ds join users as us on us.id=ds.distributor_id where ds.distributor_id='$user_id'";
        $catraige = "";
        $sidebaaar_distributor = mysqli_query($db, $distributor);
// $sidebaaar_catraige = mysqli_query($db, $catraige);
        
    }
    else if($p_role=='End-User'){
        $distributor = "";
        $catraige = "SELECT us.* FROM bsl.distributor_end_user as eu join users as us on us.id=eu.end_user_id where eu.end_user_id='$user_id'";
        // $sidebaaar_distributor = mysqli_query($db, $distributor);
        $sidebaaar_catraige = mysqli_query($db, $catraige);
    }
    else if($p_role=='Non-Dedicated' || $p_role=='Dedicated'){
        $distributor = "SELECT us.* FROM bsl.admin_distributers as ds join users as us on us.id=ds.distributor_id where ds.admin_id='1'";
        $catraige = "SELECT us.* FROM bsl.distributor_end_user as eu join users as us on us.id=eu.end_user_id where eu.distributor_id='1    '";
        $sidebaaar_distributor = mysqli_query($db, $distributor);
        $sidebaaar_catraige = mysqli_query($db, $catraige);
    }

    $current_date = date('Y-m-d');
    $next_dat = date('Y-m-d', strtotime($current_date . '+1 day'));

?>
<style>
.vertical-menu,
body[data-sidebar-size=sm] .vertical-menu #sidebar-menu>ul>li:hover>a,
body[data-sidebar-size=sm] .vertical-menu #sidebar-menu>ul>li:hover>ul {
    background-color: maroon !important;
}

#sidebar-menu i,
#sidebar-menu a {
    color: #FFF !important;
}
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-light" data-key="t-menu">Menu</li>

                <!-- <li>
                    <a href="index.php">
                        <i class="fas fa-align-justify"></i>
                        <span data-key="fas fa-align-justify">Dashboard</span>
                    </a>
                </li> -->

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-chalkboard"></i>
                        <span data-key="t-apps" class="arrow_text" class="arrow_text">Dashboards</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="admin_role end_user_role">
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps" class="arrow_text">Admin</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <ul>


                                    <?php foreach($sidebaaar_all_admin as $key => $value1){ ?>

                                    <li>
                                        <a href="dashboard.php?id=<?php echo $value1['id'];?>&from=<?php echo $current_date;?>&to=<?php echo $next_dat;?>">
                                            <span data-key="t-calendar"><?php echo $value1['name'];?></span>
                                        </a>
                                    </li>


                                    <?php } ?>


                                </ul>



                            </ul>
                        </li>
                        <li class="end_user_role">
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps" class="arrow_text">TSD Company</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <ul>
                                    <?php foreach($sidebaaar_distributor as $key => $value1){ ?>

                                    <li>

                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i data-feather="grid"></i>
                                            <span data-key="t-apps"
                                                class="arrow_text"><?php echo $value1['name'];?></span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <ul>
                                                <li>
                                                    <a href="dashboard.php?id=<?php echo $value1['id'];?>&from=<?php echo $current_date;?>&to=<?php echo $next_dat;?>">
                                                        <span data-key="t-calendar"><?php echo $value1['name'];?></span>
                                                    </a>
                                                </li>


                                                <ul>
                                                <?php 
                                                $d_id = $value1['id'];
                                                $dis_end_sql = "SELECT us.* FROM bsl.distributor_end_user as eu join users as us on us.id=eu.end_user_id where eu.distributor_id=$d_id";
                                                $dis_end = mysqli_query($db, $dis_end_sql);
                                                foreach($dis_end as $key => $value2){ 
                                                    ?>



                                                    <li>
                                                        <a href="dashboard.php?id=<?php echo $value2['id'];?>&from=<?php echo $current_date;?>&to=<?php echo $next_dat;?>">
                                                            <span
                                                                data-key="t-calendar"><?php echo $value2['name'];?></span>
                                                        </a>
                                                    </li>
                                                    <?php } 
                                                    ?>
                                                    </ul>
                                            </ul>



                                        </ul>
                                    </li>
                        </li>


                        <?php } 
                            ?>
                    </ul>



            </ul>
            </li>

            <li class="admin_role">
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="grid"></i>
                    <span data-key="t-apps" class="arrow_text">Clients</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">

                    <ul>
                        <?php foreach($sidebaaar_catraige as $key => $value1){ ?>

                        <li>
                            <a href="dashboard.php?id=<?php echo $value1['id'];?>&from=<?php echo $current_date;?>&to=<?php echo $next_dat;?>">
                                <span data-key="t-calendar"><?php echo $value1['name'];?></span>
                            </a>
                        </li>


                        <?php } 
                        ?>
                    </ul>



                </ul>
            </li>



            </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class=" fas fa-map-marked-alt"></i>
                    <span data-key="t-apps" class="arrow_text">Map</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>

                        <a href="javascript: void(0);" class="has-arrow">
                            <span data-key="t-apps" class="arrow_text">Track Map</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li class="admin_role end_user_role">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps" class="arrow_text">Admin</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">

                                    <ul>


                                        <?php foreach($sidebaaar_all_admin as $key => $value1){ ?>

                                        <li>
                                            <a
                                                onclick="post_new_data('<?php echo $value1['id'];?>','<?php echo $value1['name'];?>')">
                                                <span data-key="t-calendar"><?php echo $value1['name'];?></span>
                                            </a>
                                        </li>


                                        <?php } 
?>

                                    </ul>



                                </ul>
                            </li>
                            <li class="end_user_role">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps" class="arrow_text">Child Company</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">

                                    <ul>
                                        <?php foreach($sidebaaar_distributor as $key => $value1){ ?>

                                        <li>

                                            <a href="javascript: void(0);" class="has-arrow">
                                                <i data-feather="grid"></i>
                                                <span data-key="t-apps"
                                                    class="arrow_text"><?php echo $value1['name'];?></span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">

                                                <ul>
                                                    <li>
                                                        <a
                                                            onclick="post_new_data('<?php echo $value1['id'];?>','<?php echo $value1['name'];?>')">
                                                            <span
                                                                data-key="t-calendar"><?php echo $value1['name'];?></span>
                                                        </a>
                                                    </li>
                                                    <?php 
                                                $d_id = $value1['id'];
                                                $dis_end_sql = "SELECT us.* FROM bsl.distributor_end_user as eu join users as us on us.id=eu.end_user_id where eu.distributor_id=$d_id";
                                                $dis_end = mysqli_query($db, $dis_end_sql);
                                                foreach($dis_end as $key => $value2){ 
                                                    ?>
                                                    <ul>


                                                        <li>
                                                            <a
                                                                onclick="post_new_data('<?php echo $value2['id'];?>','<?php echo $value2['name'];?>')">
                                                                <span
                                                                    data-key="t-calendar"><?php echo $value2['name'];?></span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <?php } 
                                                    ?>
                                                </ul>



                                            </ul>
                                        </li>
                            </li>


                            <?php } 
                            ?>
                        </ul>



                </ul>
            </li>

            <li class="admin_role">
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="grid"></i>
                    <span data-key="t-apps" class="arrow_text">Admin Clients</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">

                    <ul>
                        <?php foreach($sidebaaar_catraige as $key => $value1){ ?>

                        <li>
                            <a onclick="post_new_data('<?php echo $value1['id'];?>','<?php echo $value1['name'];?>')">
                                <span data-key="t-calendar"><?php echo $value1['name'];?></span>
                            </a>
                        </li>


                        <?php } 
                        ?>
                    </ul>



                </ul>
            </li>



            </ul>
            </li>
            <li>
                <a href="playback.php">
                    <span data-key="t-calendar">Play Back</span>
                </a>
            </li>


            </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-user"></i>
                    <span data-key="t-apps" class="arrow_text">Manage Users</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="users.php">
                            <span data-key="t-calendar">Add Users</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-truck-moving"></i>
                    <span data-key="t-apps" class="arrow_text">Manage Asset</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="all_devices.php">
                            <span data-key="t-calendar">All Asset</span>
                        </a>
                    </li>
                    <li>
                        <a href="asset_assign.php">
                            <span data-key="t-calendar">Assign Asset</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class=" fas fa-users"></i>
                    <span data-key="t-apps" class="arrow_text">Manage Drivers</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="drivers.php">
                            <span data-key="t-calendar">Add Drivers</span>
                        </a>
                    </li>


                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="far fa-map"></i>
                    <span data-key="t-apps" class="arrow_text">Manage Geofences</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="geo_type.php">
                            <span data-key="t-calendar">Add Fences Type</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_fences.php">
                            <span data-key="t-calendar">Add Fences</span>
                        </a>
                    </li>
                    <li>
                        <a href="geo_grouping.php">
                            <span data-key="t-calendar">Fence Grouping</span>
                        </a>
                    </li>
                    <li>
                        <a href="assign_fence_vehi.php">
                            <span data-key="t-calendar">Assign Geofence</span>
                        </a>
                    </li>


                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span data-key="t-apps" class="arrow_text">Manage Alert</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="all_alert.php">
                            <span data-key="t-calendar">All Alert</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="load_alerts.php">
                            <span data-key="t-calendar">Load Alerts</span>
                        </a>
                    </li> -->



                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fab fa-tripadvisor"></i>
                    <span data-key="t-apps" class="arrow_text">Trip</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="dedicated_trip.php">
                            <span data-key="t-calendar">Dedicated Trip</span>
                        </a>
                    </li>
                    <li>
                        <a href="non_dedicated.php">
                            <span data-key="t-calendar">None Dedicated Trip</span>
                        </a>
                    </li>
                    <li>
                        <a href="trip_creation_jmp.php">
                            <span data-key="t-calendar">Jmp Trip</span>
                        </a>
                    </li>



                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-file-signature"></i>
                    <span data-key="t-apps" class="arrow_text">Reports</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                <li>
                        <a href="report_list.php">
                            <span data-key="t-calendar">All Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="nr_report.php">
                            <span data-key="t-calendar">NR Asset</span>
                        </a>
                    </li>
                    <li>
                        <a href="speed_vioaltion.php">
                            <span data-key="t-calendar">Speed Vioalation Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="current_location_report.php">
                            <span data-key="t-calendar">Asset Current Location</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="overspeed_report.php">
                            <span data-key="t-calendar">Asset Violation </span>
                        </a>
                    </li> -->
                    <li>
                        <a href="history_report.php">
                            <span data-key="t-calendar">Asset History Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="night_report.php">
                            <span data-key="t-calendar">Asset Night Violation Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="jmp_list.php">
                            <span data-key="t-calendar">JMP Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="vts_daily_new.php">
                            <span data-key="t-calendar">Daily VTS Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="unauth.php">
                            <span data-key="t-calendar">Un Authorized Stoppage Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="hour_report.php">
                            <span data-key="t-calendar">Bowzer Movement Report (UEP)</span>
                        </a>
                    </li>
                    <li>
                        <a href="daily_movement_report_uep.php">
                            <span data-key="t-calendar">Daily Movement Report (UEP)</span>
                        </a>
                    </li>
                    <li>
                        <a href="vts_new.php">
                            <span data-key="t-calendar">Monthly VTS Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="daily_movement_report3.php">
                            <span data-key="t-calendar">Daily Movement Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="trip_stops_report.php">
                            <span data-key="t-calendar">Trip Stops Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="transit.php">
                            <span data-key="t-calendar">Transit Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="oneday.php">
                            <span data-key="t-calendar">One Day Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="vehicle_performance.php">
                            <span data-key="t-calendar">Vehicle Performance Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="daily_activity_report.php">
                            <span data-key="t-calendar">Daily Activity Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="mileage_report.php">
                            <span data-key="t-calendar">Mileage Report</span>
                        </a>
                    </li>


                </ul>
            </li>


            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<script>
// var user_id = "<?php echo $_SESSION['user_id'];?>";
function post_new_data(id, name) {
    var pre = "<?php echo $_SESSION['privilege'];?>";
    var u_name = "<?php echo $_SESSION['user_name'];?>";
    localStorage.setItem("user_id", id);
    localStorage.setItem("prev", pre);
    localStorage.setItem("name", name);
    window.open('maps-google.php', '_blank');
}
var previlage = "<?php echo $_SESSION['privilege'];?>";
// alert(previlage)
if (previlage === 'Distributor') {
    // $('.admin_role').addClass('d-none');
    var elements = document.getElementsByClassName("admin_role");

    for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
    }


}
else if (previlage === 'End-User') {
    // $('.admin_role').addClass('d-none');
    var elements = document.getElementsByClassName("end_user_role");

    for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
    }


}
</script>