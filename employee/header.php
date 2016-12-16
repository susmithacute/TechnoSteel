<?php
session_start();
ob_start();
include('../connection.php');
include './time_zone.php';
if (!isset($_SESSION['eid'])) {
    header('Location:index.php');
}
$emp_id = $_SESSION['eid'];
//$_SESSION['LAST_ACTIVITY'] = time();

$ip_addr = $_SERVER['REMOTE_ADDR'];
$geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip_addr));
if (is_numeric($geoplugin['geoplugin_latitude']) && is_numeric($geoplugin['geoplugin_longitude'])) {
    $lat = $geoplugin['geoplugin_latitude'];
    $long = $geoplugin['geoplugin_longitude'];
    $city = $geoplugin['geoplugin_city'];
    $country = $geoplugin['geoplugin_countryName'];
    $country_code = $geoplugin['geoplugin_countryCode'];
    $zone = get_nearest_timezone($lat, $long, $country_code);
    date_default_timezone_set($zone);
}
$date_today = date('Y-m-d');
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SME</title>
        <link rel="icon" type="image/ico" href="../assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/vendor/animate.css">
        <link rel="stylesheet" href="../assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="../assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="../assets/js/vendor/morris/morris.css">
        <link rel="stylesheet" href="../assets/js/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="../assets/js/vendor/owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="../assets/js/vendor/rickshaw/rickshaw.min.css">
        <link rel="stylesheet" href="../assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="../assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="../assets/js/vendor/chosen/chosen.css">
        <link rel="stylesheet" href="../assets/js/vendor/summernote/summernote.css">
        <link rel="stylesheet" href="../assets/js/vendor/magnific-popup/magnific-popup.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/js/vendor/file-upload/css/jquery.fileupload.css">
        <link rel="stylesheet" href="../assets/js/vendor/file-upload/css/jquery.fileupload-ui.css">
        <style>
            @media print
            {
                .no-print, .no-print *
                {
                    display: none !important;
                }
            }
        </style>
        <!--/ stylesheets -->
        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="../assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->


    </head>
    <body id="minovate" class="appWrapper">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">
            <!-- ===============================================
            ================= HEADER Content ===================
            ================================================ -->
            <section id="header">
                <header class="clearfix">

                    <!-- Branding -->
                    <div class="branding">
                        <a class="brand" href="dashboard.php">
                            <span><strong>SPONSOR MASTER</strong></span>
                        </a>
                        <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Branding end -->



                    <!-- Left-side navigation -->
                    <ul class="nav-left pull-left list-unstyled list-inline">
                        <li class="sidebar-collapse divided-right">
                            <a role="button" tabindex="0" class="collapse-sidebar">
                                <i class="fa fa-outdent"></i>
                            </a>
                        </li>
                        <li class="dropdown divided-right settings">
                            <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu with-arrow animated littleFadeInUp" role="menu" >
                                <li>

                                    <ul class="color-schemes list-inline">
                                        <li class="title">Header Color:</li>
                                        <li><a role="button" tabindex="0" class="scheme-drank header-scheme" data-scheme="scheme-default"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-black header-scheme" data-scheme="scheme-black"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-greensea header-scheme" data-scheme="scheme-greensea"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-cyan header-scheme" data-scheme="scheme-cyan"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-lightred header-scheme" data-scheme="scheme-lightred"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-light header-scheme" data-scheme="scheme-light"></a></li>
                                        <li class="title">Branding Color:</li>
                                        <li><a role="button" tabindex="0" class="scheme-drank branding-scheme" data-scheme="scheme-default"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-black branding-scheme" data-scheme="scheme-black"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-greensea branding-scheme" data-scheme="scheme-greensea"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-cyan branding-scheme" data-scheme="scheme-cyan"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-lightred branding-scheme" data-scheme="scheme-lightred"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-light branding-scheme" data-scheme="scheme-light"></a></li>
                                        <li class="title">Sidebar Color:</li>
                                        <li><a role="button" tabindex="0" class="scheme-drank sidebar-scheme" data-scheme="scheme-default"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-black sidebar-scheme" data-scheme="scheme-black"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-greensea sidebar-scheme" data-scheme="scheme-greensea"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-cyan sidebar-scheme" data-scheme="scheme-cyan"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-lightred sidebar-scheme" data-scheme="scheme-lightred"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-light sidebar-scheme" data-scheme="scheme-light"></a></li>
                                        <li class="title">Active Color:</li>
                                        <li><a role="button" tabindex="0" class="scheme-drank color-scheme" data-scheme="drank-scheme-color"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-black color-scheme" data-scheme="black-scheme-color"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-greensea color-scheme" data-scheme="greensea-scheme-color"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-cyan color-scheme" data-scheme="cyan-scheme-color"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-lightred color-scheme" data-scheme="lightred-scheme-color"></a></li>
                                        <li><a role="button" tabindex="0" class="scheme-light color-scheme" data-scheme="light-scheme-color"></a></li>
                                    </ul>

                                </li>

                                <li>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xs-8 control-label">Fixed header</label>
                                            <div class="col-xs-4 control-label">
                                                <div class="onoffswitch lightred small">
                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="fixed-header" checked="">
                                                    <label class="onoffswitch-label" for="fixed-header">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xs-8 control-label">Fixed aside</label>
                                            <div class="col-xs-4 control-label">
                                                <div class="onoffswitch lightred small">
                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="fixed-aside" checked="">
                                                    <label class="onoffswitch-label" for="fixed-aside">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Left-side navigation end -->
                    <!-- Search -->
                    <!--<div class="search" id="main-search">
                        <input type="text" class="form-control underline-input" placeholder="Search...">
                    </div>-->
                    <!-- Search end -->
                    <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">

                        <li class="dropdown nav-profile">
                            <?php
                            $resEmp = $db->selectQuery("SELECT * FROM `sm_employee` WHERE `employee_id`='$emp_id'");
                            if (count($resEmp)) {

                                $image = $resEmp[0]['image'];
                                $firstname = $resEmp[0]['employee_firstname'];

                                $lastname = $resEmp[0]['employee_lastname'];
                            }
                            $dpImg = "";
                            $resLogo = $db->selectQuery("SELECT * FROM `sm_employee_files` WHERE `file_title`='Profile_Picture' AND `file_status`='1' AND `employee_id`='$emp_id'");
                            if (count($resLogo)) {
                                $dpImg = $resLogo[0]['file_name'];
                            } else {
                                $dpImg = "../assets/images/profile-default.png";
                            }
                            ?>

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $dpImg; ?>" alt="" class="img-circle size-30x30">
                                <span><?php echo $firstname; ?> <?php echo $lastname; ?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu animated littleFadeInRight" role="menu" style="margin-left:-47px">
                                <li>
                                    <a href="dashboard.php" tabindex="0">

        <!---<span class="badge bg-greensea pull-right">86%</span>-->
                                        <i class="fa fa-user"></i>Profile
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="logout.php" tabindex="0">
                                        <i class="fa fa-sign-out"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Right-side navigation end -->
                </header>
            </section>
            <!--/ HEADER Content  -->
            <!-- =================================================
            ================= CONTROLS Content ===================
            ================================================== -->
            <div id="controls">
                <!-- ================================================
                ================= SIDEBAR Content ===================
                ================================================= -->
                <aside id="sidebar">
                    <div id="sidebar-wrap">
                        <div class="panel-group slim-scroll" role="tablist">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarNav">
                                            Navigation <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <!-- ===================================================
                                        ================= NAVIGATION Content ===================
                                        ==================================================== -->
                                        <ul id="navigation">
                                            <li <?php
                                            if ($page == "dashboard") {
                                                echo "class='active'";
                                            }
                                            ?>><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Profile</span></a></li>
                                            <li <?php
                                            if ($page == "employee") {
                                                echo "class='active'";
                                            }
                                            ?>><a href="attendance_report.php"><i class="fa fa-list"></i> <span>Attendance Report</span></a>
                                            </li>
                                            <li <?php
                                            if ($page == "work_report") {
                                                echo "class='active'";
                                            }
                                            ?>><a href="work_report.php"><i class="fa fa-book"></i> <span>Work Report</span></a>
                                            </li>

                                        </ul>
                                        <!--/ NAVIGATION Content -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel charts panel-default">

                                <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="summary">
                                            <div class="media">
                                                <a class="pull-right" role="button" tabindex="0">
                                                   <!-- <span class="sparklineChart"
                                                          values="5, 8, 3, 4, 6, 2, 1, 9, 7"
                                                          sparkType="bar"
                                                          sparkBarColor="#92424e"
                                                          sparkBarWidth="6px"
                                                          sparkHeight="36px">
                                                        Loading...</span>-->
                                                </a>

                                            </div>
                                            <div class="media">
                                                <a class="pull-right" role="button" tabindex="0">
                                                    <!---<span class="sparklineChart"
                                                          values="2, 4, 5, 3, 8, 9, 7, 3, 5"
                                                          sparkType="bar"
                                                          sparkBarColor="#397193"
                                                          sparkBarWidth="6px"
                                                          sparkHeight="36px">
                                                        Loading...</span>-->
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel charts panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarCharts">
                                            Work Hours <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="summary">

                                            <div class="media">
                                                <a class="pull-right" href="#">
                                                    <span class="sparklineChart"
                                                          values="5, 8, 3, 4, 6, 2, 1, 9, 7"
                                                          sparkType="bar"
                                                          sparkBarColor="#92424e"
                                                          sparkBarWidth="6px"
                                                          sparkHeight="36px">
                                                        Loading...</span>
                                                </a>
                                                <div class="media-body">
                                                    This week hours
                                                    <?php
                                                    $diff_week = 0;
                                                    $week_start = strtotime('saturday last week');
                                                    $week_stop = strtotime('thursday this week 23:59:59');
                                                    $start_date_week = date('Y-m-d', $week_start);
                                                    $end_date_week = date('Y-m-d', $week_stop);
                                                    $select_hrs = $db->selectQuery("SELECT * FROM `sm_employee_attendance` WHERE `employee_id`='$emp_id' AND `attendance_date` BETWEEN '$start_date_week' AND '$end_date_week'");
                                                    if (count($select_hrs) > 0) {
                                                        for ($wc = 0; $wc < count($select_hrs); $wc++) {
                                                            $ts1 = strtotime($select_hrs[$wc]['attendance_punch_in_time']);
                                                            $ts2 = strtotime($select_hrs[$wc]['attendance_punch_out_time']);
                                                            if ($ts2 != "") {
                                                                $diff = abs($ts1 - $ts2) / 3600;
                                                            } else {
                                                                $diff = 0;
                                                            }
                                                            $diff_week = $diff_week + $diff;
                                                        }
                                                    }
                                                    ?>
                                                    <h4 class="media-heading"><?php echo round($diff_week); ?></h4>
                                                </div>
                                            </div>

                                            <div class="media">
                                                <a class="pull-right" href="#">
                                                    <span class="sparklineChart"
                                                          values="2, 4, 5, 3, 8, 9, 7, 3, 5"
                                                          sparkType="bar"
                                                          sparkBarColor="#397193"
                                                          sparkBarWidth="6px"
                                                          sparkHeight="36px">
                                                        Loading...</span>
                                                </a>
                                                <div class="media-body">
                                                    This month hours
                                                    <?php
                                                    $diff_month = 0;
                                                    $first_day_this_month = date('Y-m-01');
                                                    $last_day_this_month = date('Y-m-t');
                                                    $select_hrs_month = $db->selectQuery("SELECT * FROM `sm_employee_attendance` WHERE `employee_id`='$emp_id' AND `attendance_date` BETWEEN '$first_day_this_month' AND '$last_day_this_month'");
                                                    if (count($select_hrs_month) > 0) {
                                                        for ($mc = 0; $mc < count($select_hrs_month); $mc++) {
                                                            $ts3 = strtotime($select_hrs_month[$mc]['attendance_punch_in_time']);
                                                            $ts4 = strtotime($select_hrs_month[$mc]['attendance_punch_out_time']);
                                                            if ($ts4 != "") {
                                                                $diff_m = abs($ts3 - $ts4) / 3600;
                                                            } else {
                                                                $diff_m = 0;
                                                            }
                                                            $diff_month = $diff_month + $diff_m;
                                                        }
                                                    }
                                                    ?>
                                                    <h4 class="media-heading"><?php echo round($diff_month); ?></h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel settings panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarControls">
                                            Attendance <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarControls" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-xs-8 control-label">Punch IN</label>
                                                <div class="col-xs-4 control-label">
                                                    <div class="onoffswitch greensea punch_in">
                                                        <?php
                                                        $result_val = $id_style = $checked = "";
                                                        $select_punch_in = $db->selectQuery("SELECT `attendance_punch_in_time` FROM `sm_employee_attendance` WHERE `attendance_date`='$date_today' AND `employee_id`='$emp_id'");
                                                        if (count($select_punch_in)) {
                                                            $result_val = $select_punch_in[0]['attendance_punch_in_time'];
                                                        }
                                                        if ($result_val != "") {
                                                            $id_style = "switch-on";
                                                            $checked = 'checked=""';
                                                        } else {
                                                            $id_style = "switch-off";
                                                            $checked = '';
                                                        }
                                                        ?>
                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $id_style; ?>" <?php echo $checked; ?>>
                                                        <label class="onoffswitch-label" for="switch-on">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-xs-8 control-label">Punch OUT</label>
                                                <div class="col-xs-4 control-label">
                                                    <div class="onoffswitch greensea punch_out">
                                                        <?php
                                                        $result_val1 = $id_style1 = $checked1 = "";
                                                        $select_punch_in1 = $db->selectQuery("SELECT `attendance_punch_out_time` FROM `sm_employee_attendance` WHERE `attendance_date`='$date_today' AND `employee_id`='$emp_id'");
                                                        if (count($select_punch_in1)) {
                                                            $result_val1 = $select_punch_in1[0]['attendance_punch_out_time'];
                                                        }
                                                        if ($result_val1 != "") {
                                                            $id_style1 = "switch-on";
                                                            $checked1 = 'checked=""';
                                                            ?>
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-on" checked="">
                                                            <?php
                                                        } else {
                                                            $id_style1 = "switch-off";
                                                            $checked1 = '';
                                                            ?>
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-off">
                                                            <?php
                                                        }
                                                        ?>
                                                        <label class="onoffswitch-label" for="switch-off">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display:none">
                        <div class="col-md-4">
                            <button class="btn btn-success mb-10" id="report_and_punchout" data-toggle="modal" data-target="#splashz" data-options="splash-2 splash-primary splash-ef-2">Write Report</button>
                        </div>
                    </div>
                </aside>
                <!--/ SIDEBAR Content -->
                <!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
                <!--/ RIGHTBAR Content -->
            </div>
            <!--/ CONTROLS Content -->
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->