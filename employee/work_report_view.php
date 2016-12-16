<?php
$page = "work_report";
include('header.php');
$report_id = "";
if (isset($_REQUEST["rid"])) {
    $report_id = $_REQUEST["rid"];
    $employee_id = $full_name = $report_text = "";
    $attndArray = array();

    $resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, "
            . "sm_employee.employee_id,sm_employee_work_report.report_text "
            . "FROM sm_employee "
            . "INNER JOIN sm_employee_work_report "
            . "ON sm_employee.employee_id=sm_employee_work_report.employee_id "
            . "WHERE sm_employee_work_report.report_id='$report_id' AND sm_employee_work_report.employee_id='$emp_id'");

    if (count($resFet)) {
        $employee_id = $resFet[0]['employee_id'];
        $full_name = $resFet[0]['full_name'];
        $report_text = $resFet[0]['report_text'];
    }
}
?>

<!-- ====================================================

================= CONTENT ===============================

===================================================== -->
<style>
    .form-control{
        background-color:#ffffff !important;
    }
</style>
<section id="content">



    <div class="page page-shop-products">



        <div class="pageheader">



            <h2>Work Report<span></span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>



                    <li>

                        <a href="companylist.php">Work Report</a>

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





                    <!--                    <div class="alert alert-danger">

                                            <strong>Note!</strong> This table have only demo purpose. Data are not loaded from database but from dummy json.

                                        </div>-->





                    <!-- tile -->

                    <section class="tile">



                        <!-- tile header -->

                        <div class="tile-header dvd dvd-btm">

                            <h1 class="custom-font"><strong>Work</strong> Report Status</h1>

                            <ul class="controls">

                                <!--<li><a href="javascipt:;"><i class="fa fa-plus mr-5"></i> New Company</a></li>-->





                                <li class="dropdown">



                                    <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">

                                        <i class="fa fa-cog"></i>

                                        <i class="fa fa-spinner fa-spin"></i>

                                    </a>



                                    <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">

                                        <li>

                                            <a role="button" tabindex="0" class="tile-toggle">

                                                <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>

                                                <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a role="button" tabindex="0" class="tile-refresh">

                                                <i class="fa fa-refresh"></i> Refresh

                                            </a>

                                        </li>

                                        <li>

                                            <a role="button" tabindex="0" class="tile-fullscreen">

                                                <i class="fa fa-expand"></i> Fullscreen

                                            </a>

                                        </li>

                                    </ul>



                                </li>

                                <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>

                            </ul>

                        </div>

                        <!-- /tile header -->



                        <!-- tile body -->

                        <div class="tile-body">

                            <form method= "POST">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Employee Name: </label>
                                        <input type="text" name="emp_name" id="emp_name" readonly value="<?php echo $full_name; ?> "class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="username">Employee ID: </label>
                                        <input type="text" name="emp_id" id="emp_id" readonly value="<?php echo $employee_id; ?> "class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="username">Work Report: </label>
                                        <textarea class="form-control" rows="5" readonly value="" name="emp_wrk_report" id="emp_wrk_report"><?php echo $report_text; ?></textarea>

                                    </div>

                                </div>
                            </form>

                            <div class="table-responsive">

                                <table class="table table-striped table-hover table-custom" id="products-list">

                                    <thead>



                                    </thead>

                                </table>

                            </div>



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



<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title custom-font">Sure To Remove This Record ?</h3>

            </div>

            <input type="hidden" id="hid_del" value=""/>

            <div class="modal-body">



                <p><span id="emp_count"></span> employees will be deleted.</p>

            </div>

            <div class="modal-footer">

                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>

                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>

            </div>

        </div>

    </div>

</div>

<!--/ CONTENT -->

</div>

<?php include 'footer.php'; ?>

</body>
</html>

