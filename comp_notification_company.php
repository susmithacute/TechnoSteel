<?php
$page = "company";
$sub = "company_notifications";
$sub1 = "company_all_notifications";
include("./file_parts/header.php");
?>

<section id="content">



    <div class="page page-timeline">



        <div class="pageheader">



            <h2>Company <span>Notifications</span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a href="#"><i class="fa fa-home"></i> Sponsor Master</a>

                    </li>

                    <li>

                        <a href="#">Notifications</a>

                    </li>

                    <li>

                        <a href="#">Company</a>

                    </li>

                </ul>



            </div>



        </div>



        <!-- page content -->

        <div class="pagecontent">





            <!-- row -->

            <div class="row">

                <!-- col -->

                <div class="col-md-12">



                    <!-- tile -->

                    <section class="tile tile-simple no-bg">

                        <!-- tile body -->

                        <div class="tile-body streamline timeline p-0">



                            <?php

                            $today = date('Y-m-d');

                            $yesterday = date('Y-m-d', strtotime("-1 days"));

                            $daylen = 60 * 60 * 24;

                            $cur_date = date("d-m-Y");

                            $cmpArray = array();

                            ?>

                            <ul>

                                <li class="heading"><a href="javascript:;" class="btn btn-greensea b-0">Today</a></li>



                                <?php

                                //$today = date('Y-m-d');

                                $text_color = "text-greensea";

                                $selToday = $db->selectQuery("SELECT * FROM `sm_notification` WHERE `notification_start_date`='$today' ORDER BY `notification_id` DESC");

                                if (count($selToday)) {

                                    for ($tn = 0; $tn < count($selToday); $tn++) {

                                        $notfT = htmlspecialchars_decode($selToday[$tn]['notification_data']);

                                        if (strpos($notfT, "Commertial Registration") !== false) {

                                            $text_color = "text-blue";

                                        }

                                        if (strpos($notfT, "Computer Card") !== false) {

                                            $text_color = "text-drank";

                                        }

                                        if (strpos($notfT, "Municipal License") !== false) {

                                            $text_color = "text-danger";

                                        }

                                        if (strpos($notfT, "Tax Card") !== false) {

                                            $text_color = "text-orange";

                                        }

                                        ?>

                                        <li class="timeline-post">

                                            <aside>

                                                <div class="thumb wh30 bg-blue">

                                                    <i class="fa fa-clock-o"></i>

                                                </div>

                                            </aside>

                                            <div class="post-container">

                                                <div class="panel panel-default b-0">

                                                    <h3 class="custom-font <?php echo $text_color; ?>"><?php echo $selToday[$tn]['notification_data']; ?></h3>

                                                    <!--<span class="text-muted time"><i class="fa fa-clock-o"></i> 4 hours ago</span>-->

                                                    <p></p>

                                                </div>

                                            </div>

                                        </li>

                                        <?php

                                    }

                                }

                                ?>











                                <li class="heading"><a href="javascript:;" class="btn btn-lightred b-0">Yesterday</a></li>

                                <?php

                                $text_color = "text-greensea";

                                $selYesterday = $db->selectQuery("SELECT * FROM `sm_notification` WHERE `notification_start_date`='$yesterday' ORDER BY `notification_id` DESC");

                                if (count($selYesterday) > 0) {

                                    for ($yn = 0; $yn < count($selYesterday); $yn++) {

                                        $notfY = $selYesterday[$yn]['notification_data'];

                                        if (strpos($notfY, "CR ID") !== false) {

                                            $text_color = "text-blue";

                                        }

                                        if (strpos($notfY, "Computer Card") !== false) {

                                            $text_color = "text-drank";

                                        }

                                        if (strpos($notfY, "Baladiya") !== false) {

                                            $text_color = "text-danger";

                                        }

                                        ?>

                                        <li class="timeline-post">

                                            <aside>

                                                <div class="thumb wh30 bg-blue">

                                                    <i class="fa fa-clock-o"></i>

                                                </div>

                                            </aside>

                                            <div class="post-container">

                                                <div class="panel panel-default b-0">

                                                    <h3 class="custom-font <?php echo $text_color; ?>"><?php echo $selYesterday[$yn]['notification_data']; ?></h3>

                                                    <!--<span class="text-muted time"><i class="fa fa-clock-o"></i> yesterday</span>-->

                                                    <p></p>

                                                </div>

                                            </div>

                                        </li>

                                        <?php

                                    }

                                }

                                ?>



                                <?php

                                $selDates = $db->selectQuery("SELECT DISTINCT  `notification_start_date` FROM `sm_notification` WHERE `notification_start_date`< DATE_SUB(NOW(), INTERVAL 1 DAY)");

                                //print_r($selDates);

                                $text_color = "text-greensea";

                                if (count($selDates)) {

                                    for ($gn = 0; $gn < count($selDates); $gn++) {

                                        $sdate = $selDates[$gn]['notification_start_date'];

                                        $selData = $db->selectQuery("SELECT * FROM `sm_notification` WHERE `notification_start_date`='$sdate' ORDER BY `notification_id` DESC")

                                        ?>

                                        <li class="heading"><a href="javascript:;" class="btn btn-lightred b-0"><?php echo $sdate; ?></a></li>



                                        <?php

                                        for ($fu = 0; $fu < count($selData); $fu++) {

                                            $notfD = $selData[$fu]['notification_data'];

                                            if (strpos($notfD, "CR ID") !== false) {

                                                $text_color = "text-blue";

                                            }

                                            if (strpos($notfD, "Computer Card") !== false) {

                                                $text_color = "text-drank";

                                            }

                                            if (strpos($notfD, "Baladiya") !== false) {

                                                $text_color = "text-danger";

                                            }

                                            ?>

                                            <li class="timeline-post">

                                                <aside>

                                                    <div class="thumb wh30 bg-blue">

                                                        <i class="fa fa-clock-o"></i>

                                                    </div>

                                                </aside>

                                                <div class="post-container">

                                                    <div class="panel panel-default b-0">

                                                        <h3 class="custom-font <?php echo $text_color; ?>"><?php echo $selData[$fu]['notification_data']; ?></h3>

                                                        <!--<span class="text-muted time"><i class="fa fa-clock-o"></i> yesterday</span>-->

                                                        <p></p>

                                                    </div>

                                                </div>

                                            </li>

                                            <?php

                                        }

                                    }

                                }

                                ?>

                            </ul>

                        </div>

                        <!-- /tile body -->

                    </section>

                    <!-- /tile -->

                </div>

                <!-- /col -->

            </div>

            <!-- /row -->

        </div>

        <!-- /page content -->

    </div>

</section>

<!--/ CONTENT -->

</div>

<!--/ Application Content -->





























<!-- ============================================

============== Vendor JavaScripts ===============

============================================= -->

<script src="assets/jquery.min.js"></script>

<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>



<script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>



<script src="assets/js/vendor/jRespond/jRespond.min.js"></script>



<script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>



<script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>



<script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>



<script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

<!--/ vendor javascripts -->









<!-- ============================================

============== Custom JavaScripts ===============

============================================= -->

<script src="assets/js/main.js"></script>

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



<!-- Mirrored from www.tattek.sk/minovate-noAngular/timeline.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jun 2016 08:44:38 GMT -->

</html>

