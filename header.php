<?php
session_start();
ob_start();
include('connection.php');
if (!isset($_SESSION['id'])) {
    header('Location:index.php');
}
$custid = $_SESSION['id'];
//$_SESSION['LAST_ACTIVITY'] = time();
?>

<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 5 minutes ago
    //session_unset();     // unset $_SESSION variable for the run-time
    // session_destroy();   // destroy session data in storage
    header("location:locked.php");
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
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
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="assets/js/vendor/morris/morris.css">
        <link rel="stylesheet" href="assets/js/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="assets/js/vendor/owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="assets/js/vendor/rickshaw/rickshaw.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/chosen/chosen.css">
        <link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">
        <link rel="stylesheet" href="assets/js/vendor/magnific-popup/magnific-popup.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/js/vendor/file-upload/css/jquery.fileupload.css">
        <link rel="stylesheet" href="assets/js/vendor/file-upload/css/jquery.fileupload-ui.css">
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
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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
                            $resEmp = $db->selectQuery("SELECT * FROM `sm_admin`");
                            if (count($resEmp)) {

                                $image = $resEmp[0]['image'];
                                $firstname = $resEmp[0]['firstname'];

                                $lastname = $resEmp[0]['lastname'];
                            }
                            $image = "";
//$resLogo = $db->selectQuery("SELECT * FROM `sm_employee_files` WHERE `file_title`='Profile_Picture' AND `employee_id`='$id'");

                            if (count($resEmp)) {
                                $image = $resEmp[0]['image'];
                            } else {
                                $image = "profile-default.png";
                            }
                            ?>

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <img src="admin_uploads/<?php echo $image; ?>" alt="" class="img-circle size-30x30">
                                <span><?php echo $firstname; ?> <?php echo $lastname; ?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu animated littleFadeInRight" role="menu" style="margin-left:-47px">
                                <li>
                                    <a href="admin_profile.php" tabindex="0">

        <!---<span class="badge bg-greensea pull-right">86%</span>-->
                                        <i class="fa fa-user"></i>Profile
                                    </a>
                                </li>
                                <li class="divider"></li>
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
                                            if ($page == "dashboard") {
                                                echo "class='active'";
                                            }
                                            ?>><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                            <li <?php
                                            if ($page == "company") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-building"></i> <span>Company</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "c_list") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="companylist.php" ><i class="fa fa-caret-right"></i> Company List</a></li>
                                                    <li <?php
                                                    if ($sub == "c_add") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="company_add.php" ><i class="fa fa-caret-right"></i> Add New Company</a></li>
													<li <?php
                                                    if ($sub == "c_setting") {
                                                        echo "class='active'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Settings</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($tab == "designation") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Designation</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "designation_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="designation_list.php"><i class="fa fa-caret-right"></i>Designation List</a>
                                                                    </li>
                                                                    <li <?php
                                                                    if ($sub1 == "designation_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="designation_add.php"><i class="fa fa-caret-right"></i>Add Designation </a></li>

                                                                </ul>
                                                            </li>
															<li <?php
                                                            if ($tab == "company_noti") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="set_company_notification.php"><i class="fa fa-caret-right"></i>Notification</a>

                                                            </li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li <?php
                                            if ($page == "employee") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-users"></i> <span>Employee</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "e_list") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="employee_list.php"><i class="fa fa-caret-right"></i> Employee List</a></li>
                                                    <li <?php
                                                    if ($sub == "e_add") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="employee_add.php"><i class="fa fa-caret-right"></i> Add New Employee</a></li>
													<li <?php
                                                    if ($sub == "e_setting") {
                                                        echo "class='active'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Settings</a>
                                                        <ul>
                                                      
															<li <?php
                                                            if ($tab == "employee_noti") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="set_employee_notification.php"><i class="fa fa-caret-right"></i>Notification</a>

                                                            </li>

                                                        </ul>
                                                    </li>

                                                </ul>
                                            </li>
											
											<li <?php
                                            if ($page == "recruitment") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a href="#"><i class="glyphicon glyphicon-search"></i> <span>Recruitment</span></a>
                                                <ul>
												 <li <?php
                                                    if ($tab == "agent") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Agent</a>
                                                        <ul>
														   <li <?php
                                                            if ($sub == "agent_list") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="agent_list.php"><i class="fa fa-caret-right"></i>Agent List</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "agent_add") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="agent_add.php"><i class="fa fa-caret-right"></i>Add Agent</a>
                                                            </li>
                                                            


                                                        </ul>
                                                    </li>

                                                    <li <?php
                                                    if ($tab == "interview") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Schedule Interview</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "interview_list") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="interview.php"><i class="fa fa-caret-right"></i>Interview</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "interview_add") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="interview_add.php"><i class="fa fa-caret-right"></i>Add Interview</a>
                                                            </li>


                                                        </ul>
                                                    </li>
                                                    <li <?php
                                                    if ($tab == "candidate") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Candidate</a>
                                                        <ul>
														   <li <?php
                                                            if ($sub == "candidate_list") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidate.php"><i class="fa fa-caret-right"></i>Candidates</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "candidate_add") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="candidate_add.php"><i class="fa fa-caret-right"></i>Add Candidate</a>
                                                            </li>
                                                            

                                                        </ul>
                                                    </li>
                                                    <li <?php
                                                    if ($tab == "interview_form") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="interview_form.php"><i class="fa fa-caret-right"></i>Interview Form</a>

                                                    </li>
                                                    <li <?php
                                                    if ($tab == "candidates_list") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Candidates List</a>
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
													<li <?php
                                                    if ($tab == "recruit") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Settings</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "country") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Country</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "country_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="country_list.php"><i class="fa fa-caret-right"></i>Country List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "country_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="country_add.php"><i class="fa fa-caret-right"></i>Country Add</a></li>
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
                                                                    if ($sub1 == "state_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="state_list.php"><i class="fa fa-caret-right"></i>State List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "state_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="state_add.php"><i class="fa fa-caret-right"></i>State Add</a></li>
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
                                                                    if ($sub1 == "qual_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="qual_list.php"><i class="fa fa-caret-right"></i>Qualification List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "qual_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="qual_add.php"><i class="fa fa-caret-right"></i>Qualification Add</a></li>
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
                                                                    if ($sub1 == "job_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="job_list.php"><i class="fa fa-caret-right"></i>Job Position List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "job_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="job_add.php"><i class="fa fa-caret-right"></i>Job Position Add</a></li>
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
                                                                    if ($sub1 == "categ_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="category_list.php"><i class="fa fa-caret-right"></i>Category List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "categ_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="category_add.php"><i class="fa fa-caret-right"></i>Category Add</a></li>
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
                                                                    if ($sub1 == "skill_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="skill_list.php"><i class="fa fa-caret-right"></i>Skill List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "skill_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="skill_add.php"><i class="fa fa-caret-right"></i>Skill Add</a></li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                            <!--  Vehicle -->
                                            <li <?php
                                            if ($page == "vehicle") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-car"></i> <span>Vehicle</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "vehicle_list") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>>
                                                        <a href="vehicle_list.php"><i class="fa fa-caret-right"></i> Vehicle List</a>
                                                    </li>
                                                    <li <?php
                                                    if ($sub == "vehicle_add") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>>
                                                        <a href="vehicle_add.php"><i class="fa fa-caret-right"></i>Add Vehicle</a>
                                                    </li>
													<li <?php
                                                    if ($tab == "veh") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a href="#"><i class="fa fa-caret-right"></i>Settings</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "manufacturer") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Manufacturer</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "manufacturer_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="manufacturer_list.php"><i class="fa fa-caret-right"></i>Manufacturer List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "manufacturer_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="manufacturer_add.php"><i class="fa fa-caret-right"></i>Add Manufacturer</a></li>
                                                                </ul>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "model") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Model</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "model_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="model_list.php"><i class="fa fa-caret-right"></i>Model List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "model_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="model_add.php"><i class="fa fa-caret-right"></i>Model Add</a></li>
                                                                </ul>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "insurance_company") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Insurance Company</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "insurance_company_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="insurance_company_list.php"><i class="fa fa-caret-right"></i>Insurance Company List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "insurance_company_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="insurance_company_add.php"><i class="fa fa-caret-right"></i>Insurance Company Add</a></li>
                                                                </ul>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "insurance_type") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="#"><i class="fa fa-caret-right"></i>Insurance Type</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "insurance_list") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="insurance_list.php"><i class="fa fa-caret-right"></i>Insurance Type List</a></li>

                                                                    <li <?php
                                                                    if ($sub1 == "insurance_type_add") {
                                                                        echo "class='active'";
                                                                    }
                                                                    ?> ><a href="insurance_type_add.php"><i class="fa fa-caret-right"></i>Insurance Type Add</a></li>
                                                                </ul>
                                                            </li>
															<li <?php
                                                            if ($sub == "vehicle_noti") {
                                                                echo "class='active open'";
                                                            }
                                                            ?> ><a href="set_vehicle_notification.php"><i class="fa fa-caret-right"></i>Notification</a>

                                                            </li>
                                                        </ul>
                                                    </li>

                                                </ul>
                                            </li>
                                            <li <?php
                                            if ($page == "partner") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-user"></i> <span>Partner</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "p_list") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="partner_list.php"><i class="fa fa-caret-right"></i> Partner List</a></li>
                                                    <li <?php
                                                    if ($sub == "p_add") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="partner_add.php"><i class="fa fa-caret-right"></i> Add New Partner</a></li>

                                                </ul>
                                            </li>
                                            <li <?php
                                            if ($page == "visa") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-user"></i> <span>Visa</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($tab == "process_visa") {
                                                        echo "class='active open'";
                                                    }
                                                    ?> ><a href="#"><i class="fa fa-caret-right"></i>Visa Details</a>
                                                        <ul>

                                                            <li <?php
                                                            if ($sub == "visa_add") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="visa_add.php"><i class="fa fa-caret-right"></i> Add New Visa</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "visa_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="visa_list.php"><i class="fa fa-caret-right"></i>New Visa List</a>
                                                            </li>

                                                            <li <?php
                                                            if ($sub == "visa_issued_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="visa_issued_list.php"><i class="fa fa-caret-right"></i>Issued Visa List</a>
                                                            </li>

                                                        </ul>
                                                    </li>


                                                    <li <?php
                                                    if ($tab == "payment_data") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="visa_payment_list.php"><i class="fa fa-caret-right"></i>Payment List</a></li>


                                                    <li><a href="#"><i class="fa fa-caret-right"></i>Travel Details</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "visa_tr_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="visa_travelled_list.php"><i class="fa fa-caret-right"></i> Entered List</a></li>
                                                            <li <?php
                                                            if ($sub == "visa_nottr_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="visa_notravelled_list.php"><i class="fa fa-caret-right"></i>Not Entered List</a></li>

                                                        </ul>
                                                    </li>
                                                    <li <?php
                                                    if ($tab == "visa_nofif") {
                                                        echo "class='active open'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?> ><a href="#"><i class="fa fa-caret-right"></i>Notifications</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "visa_notifs") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="visa_notification.php"><i class="fa fa-caret-right"></i>Visa Expiry</a></li>

                                                        </ul>
                                                    </li>

                                                    <li  <?php
                                                    if ($tab == "visa_report") {
                                                        echo "class='active open'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="#"><i class="fa fa-caret-right"></i>Reports</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "visa_apply_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_applied_visa.php"><i class="fa fa-caret-right"></i>All Visa List</a>
                                                            </li>

                                                            <!---<li <?php
                                                            if ($sub == "visa_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="#"><i class="fa fa-caret-right"></i>Expired Visa</a></li>
                                                            <li <?php
                                                            if ($sub == "visa_list") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_visa_payment.php"><i class="fa fa-caret-right"></i>Payment</a></li>--->

                                                        </ul>
                                                    </li>
                                                    <li <?php
                                                    if ($tab == "visa_settings") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="#"><i class="fa fa-caret-right"></i>Settings</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub == "visa_type_settings") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="#"><i class="fa fa-caret-right"></i>Visa Type</a>
                                                                <ul>
                                                                    <li <?php
                                                                    if ($sub1 == "visa_type_add") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_type_add.php"><i class="fa fa-caret-right"></i>Add Visa Type</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "visa_type_list") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_type_list.php"><i class="fa fa-caret-right"></i>Visa Type List</a></li>
                                                                </ul></li>
                                                            <li <?php
                                                            if ($sub == "visa_category_settings") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="#"><i class="fa fa-caret-right"></i>Visa Category</a>
                                                                <ul><li <?php
                                                                    if ($sub1 == "visa_category_add") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_category_add.php"><i class="fa fa-caret-right"></i>Add Category</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "visa_category_list") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_category_list.php"><i class="fa fa-caret-right"></i>Category List</a></li>
                                                                </ul>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "visa_sponsor_settings") {
                                                                echo "class='active open'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="#"><i class="fa fa-caret-right"></i>Sponsor</a>
                                                                <ul><li <?php
                                                                    if ($sub1 == "visa_sponsor_add") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_sponsor_add.php"><i class="fa fa-caret-right"></i>Add Sponsor</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "visa_sponsor_list") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_sponsor_list.php"><i class="fa fa-caret-right"></i>Sponsor List</a></li>
                                                                </ul>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "visa_client_settings") {
                                                                echo "class='active open'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="#"><i class="fa fa-caret-right"></i>Client</a>
                                                                <ul><li <?php
                                                                    if ($sub1 == "visa_client_add") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="visa_client_add.php"><i class="fa fa-caret-right"></i>Add Client</a></li>
                                                                    <li <?php
                                                                    if ($sub1 == "visa_client_list") {
                                                                        echo "class='active'";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>><a href="client_list.php"><i class="fa fa-caret-right"></i>Client List</a></li>
                                                                </ul>
                                                            </li>
                                                            <li <?php
                                                            if ($sub == "visa_notif_settings") {
                                                                echo "class='active open'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="set_visa_notification.php"><i class="fa fa-caret-right"></i>Notification Days</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li <?php
                                            if ($page == "sponsor") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-money"></i> <span>Sponsorship Fee</span></a>
                                                <ul>
                                                    <!--    <li <?php
                                                    /* if ($sub == "s_li") {
                                                      echo "class='active'";
                                                      } else {
                                                      echo "";
                                                      } */
                                                    ?>>
                                                            <a href="sponsor_list.php"><i class="fa fa-caret-right"></i> Sponsorship Fee List Company</a>
                                                        </li> -->
                                                    <li <?php
                                                    if ($sub == "s_li") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>>
                                                        <a href="sponsor_fee_list.php"><i class="fa fa-caret-right"></i> Sponsorship Fee List</a>
                                                    </li>
                                                    <!--<li <?php
                                                    /*  if ($sub == "s_reciv") {
                                                      echo "class='active'";
                                                      } else {
                                                      echo "";
                                                      } */
                                                    ?>>
                                                        <a href="sponsor_receive.php"><i class="fa fa-caret-right"></i> Recieve Sponsorship Fee</a>
                                                    </li>-->
                                                    <li <?php
                                                    if ($sub == "s_reciv") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>>
                                                        <a href="sponsor_employee_receive.php"><i class="fa fa-caret-right"></i> Recieve Sponsorship Fee</a>
                                                    </li>
                                                    <!--  <li <?php
                                                    /*    if ($sub == "s_recip") {
                                                      echo "class='active'";
                                                      } else {
                                                      echo "";
                                                      } */
                                                    ?>><a href="sponsor_reciept.php"><i class="fa fa-caret-right"></i> Reciepts</a>
                                                      </li>-->
                                                    <li <?php
                                                    if ($sub == "s_recip") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="sponsor_employee_reciept.php"><i class="fa fa-caret-right"></i> Reciepts</a>
                                                    </li>
                                                    <!-- <li <?php
                                                    /*   if ($sub == "s_pen") {
                                                      echo "class='active'";
                                                      } else {
                                                      echo "";
                                                      } */
                                                    ?>><a href="sponsor_pending.php"><i class="fa fa-caret-right"></i> Pending</a>
                                                    </li>-->
                                                    <li <?php
                                                    if ($sub == "s_pen") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="sponsor_employee_pending.php"><i class="fa fa-caret-right"></i> Pending</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li <?php
                                            if ($page == "payroll") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="fa fa-money"></i> <span>Payroll</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "pay_list") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>>
                                                        <a href="salary_list.php"><i class="fa fa-caret-right"></i> Salary List</a>
                                                    </li>
                                                    <li <?php
                                                    if ($sub == "pay_dispatch") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>>
                                                        <a href="salary_dispatch.php"><i class="fa fa-caret-right"></i> Salary Dispatch</a>
                                                    </li>
                                                    <li <?php
                                                    if ($sub == "pay_receipt") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="salary_receipt.php"><i class="fa fa-caret-right"></i> Reciepts</a>
                                                    </li>
                                                    <li <?php
                                                    if ($sub == "payroll_pending") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="salary_pending.php"><i class="fa fa-caret-right"></i> Pending</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li <?php
                                            if ($page == "notification") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="glyphicon glyphicon-bell"></i> <span>Notifications</span>

                                                </a>
                                                <ul>
                                                    <li  <?php
                                                    if ($sub == "not_co") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="notification_company.php" tabindex="0"><i class="fa fa-caret-right"></i>
                                                            Company<!--<span class="label label-success"><?php //echo $CRexdate + $CCNexp;                                                                                                                        ?>New</span>-->
                                                        </a>

                                                        <ul>
                                                            <li <?php
                                                            if ($sub1 == "not_coall") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>>
                                                                <a href="notification_company.php"><i class="fa fa-caret-right"></i> All Notifications
                                                                            <!--<span class="label label-success"><?php //echo $CRexdate;                                                                             ?>new</span>-->
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $sideComp = $db->selectQuery("SELECT DISTINCT `doc_title` FROM `sm_company_docs`");
                                                            if (count($sideComp)) {
                                                                for ($scm = 0; $scm < count($sideComp); $scm++) {
                                                                    $sideCDoc = $sideComp[$scm]['doc_title'];
                                                                    ?>
                                                                    <li <?php
                                                                    if ($sub1 == "not_single") {
                                                                        echo "";
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                    ?>>
                                                                        <a href="company_single_notification.php?doc=<?php echo $sideCDoc; ?>"><i class="fa fa-caret-right"></i> <?php echo $sideCDoc; ?>
                                                                            <!--<span class="label label-success"><?php //echo $CRexdate;                                                                              ?>new</span>-->
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>

                                                    </li>
                                                    <li <?php
                                                    if ($sub == "not_em") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="notification_employee.php" tabindex="0"><i class="fa fa-caret-right"></i> Employee
                                                            <!--<span class="label label-success">New</span>-->
                                                        </a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub1 == "not_emall") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?> >
                                                                <a href="notification_employee.php" ><i class="fa fa-caret-right"></i> All Notifications
                                                                            <!--<span class="label label-success"><?php //echo $CRexdate;                                                                            ?>new</span>-->
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $sideEmp = $db->selectQuery("SELECT DISTINCT `document_title` FROM `sm_employee_documents`");
                                                            if (count($sideComp)) {
                                                                for ($scm = 0; $scm < count($sideEmp); $scm++) {
                                                                    $sideEDoc = $sideEmp[$scm]['document_title'];
                                                                    ?>
                                                                    <li>
                                                                        <a href="employee_single_notification.php?doc=<?php echo $sideEDoc; ?>"><i class="fa fa-caret-right"></i> <?php echo $sideEDoc; ?>
                                                                            <!--<span class="label label-success"><?php //echo $CRexdate;                                                                             ?>new</span>-->
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>


                                                    </li>
                                                    <li <?php
                                                    if ($sub == "notification_vehicle") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="" tabindex="0"><i class="fa fa-caret-right"></i> Vehicle
                                                            <!--<span class="label label-success">New</span>-->
                                                        </a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub1 == "notification_vehicle_all") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?> >
                                                                <a href="notification_vehicle.php" ><i class="fa fa-caret-right"></i> All Notifications
                                                                    <!--<span class="label label-success"><?php //echo $CRexdate;                                                                            ?>new</span>-->
                                                                </a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub1 == "notification_vehicle_regis") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?> >
                                                                <a href="notification_vehicle_registration.php" ><i class="fa fa-caret-right"></i> Registration
                                                                    <!--<span class="label label-success"><?php //echo $CRexdate;                                                                            ?>new</span>-->
                                                                </a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub1 == "notification_vehicle_insu") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?> >
                                                                <a href="notification_vehicle_insurance.php" ><i class="fa fa-caret-right"></i> Insurance
                                                                    <!--<span class="label label-success"><?php //echo $CRexdate;                                                                            ?>new</span>-->
                                                                </a>
                                                            </li>

                                                        </ul>


                                                    </li>
                                                </ul>
                                            </li>
                                            <li <?php
                                            if ($page == "report") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="glyphicon glyphicon-list"></i> <span>Reports</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "r_co") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="report_company.php"><i class="fa fa-caret-right"></i> Company List</a></li>
                                                    <li <?php
                                                    if ($sub == "r_em") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="report_employee.php"><i class="fa fa-caret-right"></i> Employee List</a></li>
                                                    <li <?php
                                                    if ($sub == "r_pa") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="report_partner.php"><i class="fa fa-caret-right"></i> Partner List</a></li>

                                                    <li <?php
                                                    if ($sub == "report_shead") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a role="button" tabindex="0"><i class="fa fa-caret-right"></i>Sponsorship Fee</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub1 == "report_spfee") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_employee_fee.php"><i class="fa fa-caret-right"></i> Sponsorship Fee List</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub1 == "report_spon_pending") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_pending_sponsorfee.php"><i class="fa fa-caret-right"></i>Pending Sponsorship Fee List</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub1 == "report_spon_receipt") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_sponsorfee_receipt.php"><i class="fa fa-caret-right"></i> Sponsorship Fee Receipt List</a>
                                                            </li>
                                                        </ul>

                                                    <li <?php
                                                    if ($sub == "r_pay") {
                                                        echo "class='active open'";
                                                    }
                                                    ?>>
                                                        <a role="button" tabindex="0"><i class="fa fa-caret-right"></i>Payroll</a>
                                                        <ul>
                                                            <li <?php
                                                            if ($sub1 == "report_payroll") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_payroll.php"><i class="fa fa-caret-right"></i>Salary List</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub1 == "report_pending") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_pending_salary.php"><i class="fa fa-caret-right"></i>Pending Salary List</a>
                                                            </li>
                                                            <li <?php
                                                            if ($sub1 == "report_receipt") {
                                                                echo "class='active'";
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>><a href="report_salary_receipt.php"><i class="fa fa-caret-right"></i> Salary Receipt List</a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li <?php
                                                    if ($sub == "r_ve") {
                                                        echo "class='active'";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>><a href="report_vehicle.php"><i class="fa fa-caret-right"></i> Vehicle List</a></li>
                                                </ul>
                                            </li>


                                            <li <?php
                                            if ($page == "archive") {
                                                echo "class='active open'";
                                            }
                                            ?>>
                                                <a role="button" tabindex="0"><i class="glyphicon glyphicon-trash"></i> <span>Archive</span></a>
                                                <ul>
                                                    <li <?php
                                                    if ($sub == "comp") {
                                                        echo "class='active'";
                                                    }
                                                    ?> ><a href="archive_company.php"><i class="fa fa-caret-right"></i> Company Archive</a></li>
                                                    <li <?php
                                                    if ($sub == "emp") {
                                                        echo "class='active'";
                                                    }
                                                    ?> ><a href="archive_employee.php"><i class="fa fa-caret-right"></i> Employee Archive</a></li>
                                                    <li <?php
                                                    if ($sub == "part") {
                                                        echo "class='active'";
                                                    }
                                                    ?> ><a href="archive_partner.php"><i class="fa fa-caret-right"></i> Partner Archive</a></li>
                                                    <li <?php
                                                    if ($sub == "veh") {
                                                        echo "class='active'";
                                                    }
                                                    ?> ><a href="vehicle_archive.php"><i class="fa fa-caret-right"></i> Vehicle Archive</a></li>

                                                    <!-- <li
                                                    <?php
                                                    /*  if ($sub == "sponfee") {
                                                      echo "class='active'";
                                                      } */
                                                    ?> ><a href="archive_sponsorfee.php"><i class="fa fa-caret-right"></i> Sponsorship Archive</a>
                                                     </li>-->
                                                    <li
                                                    <?php
                                                    if ($sub == "sponsor_fee") {
                                                        echo "class='active'";
                                                    }
                                                    ?> ><a href="archive_employee_sponsorfee.php"><i class="fa fa-caret-right"></i> Sponsorship Archive</a>
                                                    </li>

                                                    <!--    <li
                                                    <?php
                                                    /*     if ($sub == "payroll_arc") {
                                                      echo "class='active'";
                                                      } */
                                                    ?> ><a href="archive_employee_payroll.php"><i class="fa fa-caret-right"></i> Payroll Archive</a>
                                                        </li>-->
                                                </ul>
                                            </li>
                                           

                                            <li <?php
                                            if ($page == "calendar") {
                                                echo "class='active'";
                                            } else {
                                                echo "";
                                            }
                                            ?>><a href="calendar.php"><i class="fa fa-calendar-o"></i> <span>Calendar</span> </a></li>

                                        </ul>
                                        <!--/ NAVIGATION Content -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel charts panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarCharts">
                                            Salary Summary <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
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
                                                <div class="media-body">
                                                    This Month Salary Dispatched
                                                    <?php
                                                    $feew = 0;
                                                    $thisMonthw = date('m');
                                                    $thisYearw = date("Y");
                                                    $spFeew = $db->selectQuery("SELECT * FROM `sm_payroll` WHERE MONTH(payroll_date)='$thisMonthw' AND YEAR(payroll_date)='$thisYearw' AND `payroll_status`='Paid'");
                                                    if (count($spFeew)) {

                                                        for ($spa = 0; $spa < count($spFeew); $spa++) {
                                                            $spaFeew = $spFeew[$spa]['salary'];
                                                            $feew = $feew + $spaFeew;
                                                        }
                                                    }
                                                    ?>
                                                    <h4 class="media-heading"><?php echo $feew; ?></h4>
                                                </div>
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
                                                <div class="media-body">
                                                    This Month Salary Pending
                                                    <?php
                                                    $feew1 = 0;
                                                    $spFeew1 = $db->selectQuery("SELECT * FROM `sm_payroll` WHERE MONTH(payroll_date)='$thisMonthw' AND YEAR(payroll_date)='$thisYearw' AND `payroll_status`='Not Paid'");
                                                    if (count($spFeew1)) {

                                                        for ($spa = 0; $spa < count($spFeew1); $spa++) {
                                                            $spaFeew1 = $spFeew1[$spa]['salary'];
                                                            $feew1 = $feew1 + $spaFeew1;
                                                        }
                                                    }
                                                    ?>
                                                    <h4 class="media-heading"><?php echo $feew1; ?></h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="panel settings panel-default">
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
                            </div>---->
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