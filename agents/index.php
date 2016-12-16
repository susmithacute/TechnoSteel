<?php
include('../connection.php');
session_start();
?>
<style>

    .error{
        padding: 0% 5% 55% 47%;
    }
</style>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->




    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sponsor Master - Agent Login</title>
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
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

        <!-- project main css files -->
        <link rel="stylesheet" href="../assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="../assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

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
            <div class="page page-core page-login">

                <div class="text-center"><b><h2 class="text-light text-white"><b>SPONSOR MASTER</b> </h2><b></div>

                            <div class="container w-420 p-15 mt-40 text-center" style="
                                 background-color: rgba(51, 29, 29, 0.31);
                                 ">


                                <h2 class="text-light text-white"><b>Agent  Login</b></h2>

                                <form name="form" class="form-validation mt-20" novalidate="" action="" method="post">

                                    <div class="form-group">
                                        <input type="email" class="form-control underline-input" name="username" placeholder="Username" required="required">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" placeholder="Password" name="password" class="form-control underline-input" required="required">
                                    </div>

                                    <div class="form-group text-left mt-20">
                                        <button  type="submit"  name="submit" class="btn btn-greensea b-0 br-2 mr-5">Login</button>
                                    </div>

                                </form>

                                <hr class="b-3x">

                            </div>

                            </div>
                            </div>
                            <!--/ Application Content -->
                            <!-- ============================================
                            ============== Vendor JavaScripts ===============
                            ============================================= -->
                            <script src="../assets/jquery.min.js"></script>
                            <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

                            <script src="../assets/js/vendor/bootstrap/bootstrap.min.js"></script>

                            <script src="../assets/js/vendor/jRespond/jRespond.min.js"></script>

                            <script src="../assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

                            <script src="../assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

                            <script src="../assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

                            <script src="../assets/js/vendor/screenfull/screenfull.min.js"></script>
                            <!--/ vendor javascripts -->

                            <!-- ============================================
                            ============== Custom JavaScripts ===============
                            ============================================= -->
                            <script src="../assets/js/main.js"></script>
                            <!--/ custom javascripts -->
                            <!-- ===============================================
                            ============== Page Specific Scripts ===============
                            ================================================ -->
                            <script>
                                $(window).load(function () {

                                });
                            </script>
                            <!--/ Page Specific Scripts -->
                            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
                            <script>
                                (function (b, o, i, l, e, r) {
                                    b.GoogleAnalyticsObject = l;
                                    b[l] || (b[l] =
                                            function () {
                                                (b[l].q = b[l].q || []).push(arguments)
                                            });
                                    b[l].l = +new Date;
                                    e = o.createElement(i);
                                    r = o.getElementsByTagName(i)[0];
                                    e.src = '../../www.google-analytics.com/analytics.js';
                                    r.parentNode.insertBefore(e, r)
                                }(window, document, 'script', 'ga'));
                                ga('create', 'UA-XXXXX-X', 'auto');
                                ga('send', 'pageview');
                            </script>
                            </body>
                            </html>
                            <?php
                            if (isset($_POST['submit'])) {
                                $username = $_POST['username'];
                                $password = $_POST['password'];

                                $sql = $db->selectQuery("SELECT * FROM `sm_recruitment_agents` WHERE `agent_email`='$username' AND `agent_password`='$password' AND `agent_status`='1'");
                                if (count($sql)) {
                                    $_SESSION['agent_id'] = $sql[0]['agent_id'];
                                    $_SESSION['agent_area_id'] = $sql[0]['agent_area_id'];
                                    echo("<script>location.href='candidate_list.php'</script>");
                                } else {
                                    ?>
                                    <div class="error">
                                    <?php
                                    echo '<p style="color:red;z-index:333;padding:340px 0px 10px 0px">Invalid Username or Password</p>';
                                    ?>
                                    </div>
                                        <?php
                                        }
                                }
                                ?>
