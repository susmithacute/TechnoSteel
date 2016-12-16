<?php
$page = "";
$sub = "";
include('file_parts/header.php');

$empArray = array();
$thisMonth = date("m");
$thisYear = date("Y");

if (isset($_REQUEST["month"])) {
     $attnd_month = $_REQUEST["month"];
     $attnd_year = $_REQUEST["year"];
	 $d=cal_days_in_month(CAL_GREGORIAN,$emp_month,$emp_year);
    $resFet = $db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,sm_employee.employee_middlename,sm_employee.employee_lastname) as employee_name,sm_employee.employee_employment_id,sm_employee.employee_id,sm_employee.employee_designation,sm_employee_working_hours_total.normal_overtime,sm_employee_working_hours_total.holiday_overtime,sm_employee_working_hours_total.year,sm_employee_working_hours_total.month FROM sm_employee INNER JOIN sm_employee_working_hours_total ON sm_employee.employee_id=sm_employee_working_hours_total.employee_id WHERE sm_employee.employee_status='1' AND sm_employee_working_hours_total.year='$attnd_year' AND sm_employee_working_hours_total.month='$attnd_month'");
} else {
	$thisYear = date("Y");
	$thisMonth = date("m");
    $resFet = $db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,sm_employee.employee_middlename,sm_employee.employee_lastname) as employee_name,sm_employee.employee_employment_id,sm_employee.employee_id,sm_employee.employee_designation,sm_employee_working_hours_total.normal_overtime,sm_employee_working_hours_total.holiday_overtime,sm_employee_working_hours_total.year,sm_employee_working_hours_total.month FROM sm_employee INNER JOIN sm_employee_working_hours_total ON sm_employee.employee_id=sm_employee_working_hours_total.employee_id WHERE sm_employee.employee_status='1' AND sm_employee_working_hours_total.year='$thisYear' AND sm_employee_working_hours_total.month='$thisMonth'");
}


if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
        
       
    }
}


?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Attendance List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Attendance</a>
                    </li>
                    <li>
                        <a>Employee List</a>
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
                            <h1 class="custom-font"><strong>Attendance  List</strong></h1>
                            <ul class="controls">
							    <li>
                                     <a href="employee_add.php" role="button" tabindex="0" class="tile-add" title="add">
                                     <i class="fa fa-plus"></i>
                                     </a>
                                   </li>
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
                            <form method="POST">
							     <div class="form-group col-md-2">
                                            <label for="year">Year: </label>
                                            <select class="form-control mb-10" id="attnd_year" name="year">
                                                <?php
                                                for ($i = date("Y"); $i >= 1990; $i--) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                <div class="form-group col-md-2">

                                            <label for="month">Month: </label>

                                            <select id='attnd_month' class="form-control mb-10">
                                                <option value='' selected>--Select Month--</option>
                                                <option  value='01'<?php if(@$attnd_month=='01'){echo "selected";} ?>>January</option>
                                                <option value='02'<?php if(@$attnd_month=='02'){echo "selected";} ?>>February</option>
                                                <option value='03'<?php if(@$attnd_month=='03'){echo "selected";} ?>>March</option>
                                                <option value='04'<?php if(@$attnd_month=='04'){echo "selected";} ?>>April</option>
                                                <option value='05'<?php if(@$attnd_month=='05'){echo "selected";} ?>>May</option>
                                                <option value='06'<?php if(@$attnd_month=='06'){echo "selected";} ?>>June</option>
                                                <option value='07'<?php if(@$attnd_month=='07'){echo "selected";} ?>>July</option>
                                                <option value='08'<?php if(@$attnd_month=='08'){echo "selected";} ?>>August</option>
                                                <option value='09'<?php if(@$attnd_month=='09'){echo "selected";} ?>>September</option>
                                                <option value='10'<?php if(@$attnd_month=='10'){echo "selected";} ?>>October</option>
                                                <option value='11'<?php if(@$attnd_month=='11'){echo "selected";} ?>>November</option>
                                                <option value='12'<?php if(@$attnd_month=='12'){echo "selected";} ?>>December</option>
                                            </select>


                                        </div>

                                
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;" >
                                                Sl.no
                                            </th>
                                            <th style="width:90px;">Employee ID</th>
                                            <th style="width:90px;">Employee Name</th>
                                            <th>Designation</th>
                                            <th>Normal Overtime</th>
                                            <th style="width:90px;">Holiday Overtime</th>
                                            <?php
											$attnd_month = $_REQUEST["month"];
                                            $attnd_year = $_REQUEST["year"]; 
											$d=cal_days_in_month(CAL_GREGORIAN,$attnd_month,$attnd_year);
                                            for ($i=1; $i<=$d; $i++)
                                              {  
	                                          									  
										  ?>	
	                                           <th style="width:70px;"> <?php echo $i;?></th>
										 <?php } 
                                             ?>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									
							    <?php   if(count($resFet))
							    {
							      for ($rC = 0; $rC < count($resFet); $rC++) 
								  { 
							  
                                   $emp_id = $resFet[$rC]['employee_id'];
								   $emp_year = $resFet[$rC]['year'];
								   $emp_month = $resFet[$rC]['month'];
								 
    							   $month_start_date = $emp_year . "-" . $emp_month . "-01";
								   
								   $d=cal_days_in_month(CAL_GREGORIAN,$emp_month,$emp_year);								   
                                   $month_end_date =  $emp_year . "-" . $emp_month . "-".$d;
                                  
								 
							          ?>
									  <tr class="odd gradeX">
									  <td></td>
									  <td><?php echo $resFet[$rC]['employee_employment_id']; ?></td>
									  <td><?php echo $resFet[$rC]['employee_name']; ?></td>
									  <td><?php echo $resFet[$rC]['employee_designation']; ?></td>
									  <td><?php echo $resFet[$rC]['normal_overtime']; ?></td>
									  <td><?php echo $resFet[$rC]['holiday_overtime']; ?></td>
									  
									  <?php
									  
								       for ($dt = $month_start_date; $dt <= $month_end_date; $dt++) {
									   $check_date = strtotime($dt);
									   $emp_leave = $db->selectQuery("SELECT * FROM `sm_employee_leave` WHERE `employee_id`='$emp_id' AND YEAR(leave_from)='$emp_year' AND month(leave_from)='$emp_month'");
									   if (count($emp_leave)) 
									     {
										    for ($lv = 0; $lv < count($emp_leave); $lv++)
											{
												$leave_from = strtotime($emp_leave[$lv]['leave_from']);
                                                $leave_to = strtotime($emp_leave[$lv]['leave_to']);
												if (($check_date >= $leave_from) && ($check_date <= $leave_to)) 
												      { ?>
                                                      
													   <td>ab</td>
													   
                                                <?php
                                                break;
												} else 
									           	      { ?>
                                                        <td>present</td>
													
                                                <?php
                                                break;	
												}												
											 }										   
									      }
                                      else{   ?>
										  <td>present</td> 
								  <?php   }
	   
								     }  ?>
									  </tr>
							      <?php } 
							
							    } ?> 
									
									</tbody>
									
									
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
<!--/ CONTENT -->

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Sure To Remove This Record ?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

<!--                <p>This sure is a fine modal, isn't it?</p>

 <p>Modals are streamlined, but flexible, dialog prompts with the minimum required functionality and smart defaults.</p>-->
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>




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

<script src="assets/js/jquerysession.js"></script>
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

        //initialize datatable
      var t=  $('#products-list').DataTable({
            "dom": '<"row"<"col-md-8 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"pull-right"f>>>t<"row"<"col-md-4 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"inline-controls text-center"i>><"col-md-4 col-sm-12"p>>'
           
            
        });
        
        //*initialize datatable
    });</script>
<!--/ Page Specific Scripts -->



<script>
    $('#attnd_month').change(function () {
        var month = $(this).val();
		var year = jQuery('#attnd_year').val();
        location.href = 'attendance_timesheet_report.php?month=' + month + '&year=' + year;

    });
</script>




<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
