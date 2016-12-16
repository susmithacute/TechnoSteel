<?php
session_start();
ob_start();
include('../connection.php');
if (!isset($_SESSION['agent_id'])) {
    header('Location:index.php');
}
//$custid = $_SESSION['id'];
$agent_id = $_SESSION['agent_id'];
$agent_area_id = $_SESSION['agent_area_id'];
//$_SESSION['LAST_ACTIVITY'] = time();
?>

<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 5 minutes ago
    //session_unset();     // unset $_SESSION variable for the run-time
    // session_destroy();   // destroy session data in storage
    header("location:locked.php");
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 900) {
    // session started more than 5 minutes ago
    session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
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
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-81667531-1', 'auto');
            ga('send', 'pageview');

        </script>

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
                            $resEmp = $db->selectQuery("SELECT `agent_company` FROM `sm_recruitment_agents` WHERE agent_id = '".$_SESSION['agent_id']."'");
                            if (count($resEmp)) {

                                $name = $resEmp[0]['agent_company'];
                            }
                            ?>    

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../assets/images/profile-default.png" alt="" class="img-circle size-30x30">
                                <span><?php echo @$name; ?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu animated littleFadeInRight" role="menu" style="margin-left:-47px">
                               <?php /* <li>
                                    <a href="agent_read.php?uid=<?php echo $_SESSION['agent_id']; ?>" tabindex="0">

        <!---<span class="badge bg-greensea pull-right">86%</span>-->
                                        <i class="fa fa-user"></i>Profile
                                    </a>
                                </li> */ ?>
							<?php /*  <li class="divider"></li>		*/ ?>
                               
                                <li>
                                    <a href="locked.php" tabindex="0">
                                        <i class="fa fa-lock"></i>Lock
                                    </a>
                                </li>
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
                                            if ($page == "recruitment") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a href="#"><i class="glyphicon glyphicon-cog"></i> <span>Recruitment</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($tab == "candidate") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Candidate</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "candidate_add") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidate_add.php"><i class="fa fa-caret-right"></i>Add Candidate</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "candidate_list") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidate_list.php"><i class="fa fa-caret-right"></i>Candidate List</a>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                    <li <?php
                                                    if ($tab == "candidates_list") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Selection Status</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "candidates_selected") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidates_selected.php"><i class="fa fa-caret-right"></i>Selected Candidates</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "candidates_retest") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidates_retest.php"><i class="fa fa-caret-right"></i>Retest Candidates</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "candidates_rejected") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidates_rejected.php"><i class="fa fa-caret-right"></i>Rejected Candidates</a>
                                                            </li>
															<li <?php
                                                            if ($sub == "candidates_ohhold") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidates_onhold.php"><i class="fa fa-caret-right"></i>On Hold Candidates</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--  Vehicle -->

                                           <?php /* <li <?php
                                            if ($page == "settings") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a href="#"><i class="glyphicon glyphicon-cog"></i> <span>Settings</span></a>
                                                <ul>

                                                    <li <?php
                                                    if ($tab == "recruit") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Recruitment</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "country") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Country</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "country_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="country_add.php"><i class="fa fa-caret-right"></i>Country Add</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "country_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="country_list.php"><i class="fa fa-caret-right"></i>Country List</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "state") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>State</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "state_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="state_add.php"><i class="fa fa-caret-right"></i>State Add</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "state_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="state_list.php"><i class="fa fa-caret-right"></i>State List</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "qual") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Qualification</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "qual_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="qual_add.php"><i class="fa fa-caret-right"></i>Qualification Add</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "qual_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="qual_list.php"><i class="fa fa-caret-right"></i>Qualification List</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "job") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Job Position</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "job_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="job_add.php"><i class="fa fa-caret-right"></i>Job Position Add</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "job_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="job_list.php"><i class="fa fa-caret-right"></i>Job Position List</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "categ") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Category</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "categ_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="category_add.php"><i class="fa fa-caret-right"></i>Category Add</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "categ_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="category_list.php"><i class="fa fa-caret-right"></i>Category List</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "skill") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Skill</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "skill_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="skill_add.php"><i class="fa fa-caret-right"></i>Skill Add</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "skill_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="skill_list.php"><i class="fa fa-caret-right"></i>Skill List</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li> */ ?>
                                        </ul>
                                        <!--/ NAVIGATION Content -->
                                    </div>
                                </div>
                            </div>
                            <?php /*<div class="panel charts panel-default">
                                <div class="panel-heading" role="tab">
                                </div>
                                <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                            <div class="panel settings panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarControls">
                                            General Settings <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarControls" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-xs-8 control-label">Switch ON</label>
                                                <div class="col-xs-4 control-label">
                                                    <div class="onoffswitch greensea">
                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-on" checked="">
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
                                                <label class="col-xs-8 control-label">Switch OFF</label>
                                                <div class="col-xs-4 control-label">
                                                    <div class="onoffswitch greensea">
                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-off">
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
                            </div>*/ ?>
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