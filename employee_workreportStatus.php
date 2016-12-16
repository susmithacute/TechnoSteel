<?php

$page = "management";
$tab = "empl_wrkrpt";
$report_id="";

include('file_parts/header.php');
if(isset($_REQUEST["report_id"])){
$report_id=$_REQUEST["report_id"];	
$values['employee_id']=	$values['full_name']= $values['report_text']="";
$attndArray = array();

$resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, sm_employee.employee_id,sm_employee.employee_employment_id,sm_employee_work_report.report_text FROM sm_employee INNER JOIN sm_employee_work_report ON sm_employee.employee_id=sm_employee_work_report.employee_id WHERE sm_employee_work_report.report_id='$report_id'");

if (count($resFet)) {

    for ($rC = 0; $rC < count($resFet); $rC++) {

        $values['employee_id'] = $resFet[$rC]['employee_id'];
		$values['employee_employment_id'] = $resFet[$rC]['employee_employment_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        $values['report_text'] = $resFet[$rC]['report_text'];
        
        
        $attndArray["data"][] = $values;

    }

}
$fp = fopen('assets/extras/workreport.json', 'w');
fwrite($fp, json_encode($attndArray));
fclose($fp);
}
?>

<!-- ====================================================

================= CONTENT ===============================

===================================================== -->

<section id="content">



    <div class="page page-shop-products">



        <div class="pageheader">



            <h2>Work Report Status<span></span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>

                    <li>

                        <a href="#">Employee</a>

                    </li>

                    <li>

                        <a href="companylist.php">Work Report Status</a>

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
                                    <input type="text" name="emp_name" id="emp_name" readonly value="<?php echo  $values['full_name'];?> "class="form-control" required>
                                </div>
								
								 <div class="form-group col-md-6">
                                    <label for="username">Employee ID: </label>
                                    <input type="text" name="emp_id" id="emp_id" readonly value="<?php echo   $values['employee_employment_id'];?> "class="form-control" required>
                                </div>
								 <div class="form-group col-md-12">
                                    <label for="username">Work Report: </label>
									 <textarea class="form-control" rows="5" readonly value="" name="emp_wrk_report" id="emp_wrk_report"><?php echo $values['report_text'];?></textarea>
								                                  
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



<script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

<script src="assets/js/vendor/datatables/extensions/Pagination/input.js"></script>

<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>

<!--/ vendor javascripts -->









<!-- ============================================

============== Custom JavaScripts ===============

============================================= -->

<script src="assets/js/main.js"></script>

<!--/ custom javascripts -->









<!-- ===============================================

============== Page Specific Scripts ===============

================================================ -->




<!--/ Page Specific Scripts -->

</body>
</html>

