<div class="modal splash fade" id="splash12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Write Report</h3>
                <?php
                echo date("D M d, Y");
                ?>

            </div>
            <div class="modal-body">
                <p> </p>

                <p></p>


                <div class="col-md-12">
                    <form method="post" action="" enctype="multipart/form-data">
                        <?php
                        $report_text = "";
                        $select_report = $db->selectQuery("SELECT `report_text` FROM `sm_employee_work_report` WHERE `employee_id`='$emp_id' AND `report_date`='$date_today'");
                        if (count($select_report)) {
                            $report_text = $select_report[0]['report_text'];
                        }
                        ?>
                        <textarea class="col-md-12" name="report_text" style="color:black;"id="report_text" cols="70" rows="10"><?php echo $report_text; ?></textarea>
                        <br>

                        <div class="modal-footer">
                            <p id="btn-click">
                                <button type="button" class="btn btn-cyan btn-ef btn-ef-7 btn-ef-7h mb-10" id="report_submit" ><i class="fa fa-envelope"></i> Submit Report</button>
                            </p>
                            <button class="btn btn-cyan btn-ef btn-ef-7 btn-ef-7h mb-6" data-dismiss="modal" style="
                                    padding-right: 55px;">Cancel</button>
                            <p id="report_msg" style="color:#fff"></p>
                        </div>
                    </form>
                </div>

            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="splash12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Write Report</h3>
                <?php
                echo date("D M d, Y");
                ?>

            </div>
            <div class="modal-body">
                <p> </p>

                <p></p>


                <div class="col-md-12">
                    <form method="post" action="" enctype="multipart/form-data">
                        <?php
                        $report_text = "";
                        $select_report = $db->selectQuery("SELECT `report_text` FROM `sm_employee_work_report` WHERE `employee_id`='$emp_id' AND `report_date`='$date_today'");
                        if (count($select_report)) {
                            $report_text = $select_report[0]['report_text'];
                        }
                        ?>
                        <textarea class="col-md-12" name="report_text" style="color:black;" id="report_text" cols="70" rows="10"><?php echo $report_text; ?></textarea>
                        <br>

                        <div class="modal-footer">
                            <p id="btn-click">
                                <button type="button" class="btn btn-cyan btn-ef btn-ef-7 btn-ef-7h mb-10" id="report_submit" ><i class="fa fa-envelope"></i> Submit Report</button>
                            </p>
                            <button class="btn btn-cyan btn-ef btn-ef-7 btn-ef-7h mb-6" data-dismiss="modal" style="
                                    padding-right: 55px;">Cancel</button>
                            <p id="report_msg" style="color:#fff"></p>
                        </div>
                    </form>
                </div>

            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="splashz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Write Report</h3>
                <?php
                echo date("D M d, Y");
                ?>

            </div>
            <div class="modal-body">
                <p> </p>

                <p></p>


                <div class="col-md-12">
                    <form method="post" action="" enctype="multipart/form-data">
                        <?php
                        $report_text = "";
                        $select_report = $db->selectQuery("SELECT `report_text` FROM `sm_employee_work_report` WHERE `employee_id`='$emp_id' AND `report_date`='$date_today'");
                        if (count($select_report)) {
                            $report_text = $select_report[0]['report_text'];
                        }
                        ?>
                        <textarea class="col-md-12" name="report_text" style="color:black;" id="report_text1" cols="70" rows="10"><?php echo $report_text; ?></textarea>
                        <br>

                        <div class="modal-footer">
                            <p id="btn-click">
                                <button type="button" class="btn btn-cyan btn-ef btn-ef-7 btn-ef-7h mb-10" id="sub_punout" ><i class="fa fa-envelope"></i> Submit Report & Punch Out</button>
                            </p>
                            <button class="btn btn-cyan btn-ef btn-ef-7 btn-ef-7h mb-6" data-dismiss="modal" style="
                                    padding-right: 55px;">Cancel</button>
                            <p id="report_msg1" style="color:#fff"></p>
                        </div>
                    </form>
                </div>

            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<script src="../assets/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<script src="../assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="../assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="../assets/js/vendor/d3/d3.min.js"></script>
<script src="../assets/js/vendor/d3/d3.layout.min.js"></script>

<script src="../assets/js/vendor/rickshaw/rickshaw.min.js"></script>

<script src="../assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="../assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="../assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="../assets/js/vendor/daterangepicker/daterangepicker.js"></script>

<script src="../assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="../assets/js/vendor/flot/jquery.flot.min.js"></script>
<script src="../assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
<script src="../assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>

<script src="../assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>

<script src="../assets/js/vendor/raphael/raphael-min.js"></script>
<script src="../assets/js/vendor/morris/morris.min.js"></script>

<script src="../assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>

<script src="../assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="../assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="../assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

<script src="../assets/js/vendor/datatables/extensions/Pagination/input.js"></script>

<script src="../assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>

<script src="../assets/js/vendor/chosen/chosen.jquery.min.js"></script>

<script src="../assets/js/vendor/summernote/summernote.min.js"></script>

<script src="../assets/js/vendor/coolclock/coolclock.js"></script>
<script src="../assets/js/vendor/coolclock/excanvas.js"></script>
<script src="../assets/js/jquerysession.js"></script>
<script src="../assets/js/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<script src="../assets/js/vendor/mixitup/jquery.mixitup.min.js"></script>
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
    $('.punch_in').click(function () {
        //$(this).find('input').attr("id", "switch-on");
        $(this).find('input').prop("checked", "checked");
        $.ajax({
            url: "employee_report_ajax.php",
            type: "POST",
            data: {set_punch_in: "set_punch", emp_id: '<?php echo $emp_id; ?>'},
            success: function (data) {

            }
        });
    });
    function punchout() {
        $('.punch_out').find('input').prop("id", "switch-on");
        $('.punch_out').find('input').prop("checked", "true");
        $.ajax({
            url: "employee_report_ajax.php",
            type: "POST",
            data: {set_punch_out: "set_punch", emp_id: '<?php echo $emp_id; ?>'},
            success: function (data) {

            }
        });
    }
    function close_modal1() {
        $('#splashz').modal('hide');
    }
    $('#sub_punout').click(function (e) {
        e.preventDefault();
        var report_text = $('#report_text1').val();
        var emp_id = '<?php echo $emp_id; ?>';
        $.ajax({
            url: "employee_report_ajax.php",
            type: "POST",
            data: {report_text: report_text, emp_id: emp_id},
            success: function (data) {
                $('#report_msg1').html(data);
                punchout();
                setTimeout('close_modal1()', 2000);

            }
        });
    });
    $('.punch_out').click(function (e) {
        e.preventDefault();
        var submit_ok = 1;
        $.ajax({
            url: "employee_report_ajax.php",
            type: "POST",
            data: {check: "check", emp_id: '<?php echo $emp_id; ?>'},
            success: function (data) {
                if (data === "1")
                {
                    punchout();
                }
                if (data === "0") {
                    e.preventDefault();
                    return   $('#report_and_punchout').click();
                }
            }
        });

    });
</script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
