<?php
$page = "employee";
$tab = "employee_leave"; 
$sub = "leave_up_list";
include("file_parts/header.php");
$daylen = 60 * 60 * 24;
$empArray = array();
$resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,sm_employee.employee_employment_id,sm_employee.employee_id,sm_employee_leave.leave_from,sm_employee_leave.leave_to,sm_employee_leave.employee_id,sm_employee_leave.leave_type_id,sm_employee.employee_designation FROM sm_employee INNER JOIN sm_employee_leave ON sm_employee.employee_id = sm_employee_leave.employee_id WHERE sm_employee_leave.status='active' GROUP BY sm_employee_leave.employee_id");
if (count($resFet)) {
	
    for ($rC = 0; $rC < count($resFet); $rC++) {
		
		$leave_from=$resFet[$rC]['leave_from'];
		$leave_to=$resFet[$rC]['leave_to'];
		$emp_id=$resFet[$rC]['employee_id'];
		$cau_type = $db->selectQuery("SELECT * FROM sm_employee_leave WHERE status='active' AND leave_type_id='1' AND employee_id=$emp_id");
		if(count($cau_type)>0){
			$num_day =0;
			for ($C = 0; $C < count($cau_type); $C++) {
			
			$values['casual']="1";
			$find_noti = (strtotime($cau_type[$C]['leave_to']) - strtotime($cau_type[$C]['leave_from'])) / $daylen;
		//echo strtotime($date_to1)."%%%%%%%%%%%%%%".strtotime($date_from1);
		         $num_days = round($find_noti);
				//$values['num_days'] = $num_days;
				if(($num_days)>0){
				$num_day+=  $num_days +"1";
				}
				else
				{
					$num_day="1";
				}
				$values['num_days'] = $num_day;
			
			
		}}
		else{
			$values['casual']="0";
		}
		$med_type = $db->selectQuery("SELECT * FROM sm_employee_leave WHERE status='active' AND leave_type_id='2' AND employee_id=$emp_id");
		if(count($med_type)>0){
			
			$med_day =0;
			for ($M = 0; $M < count($med_type); $M++) {
			
			$values['medical']="2";
			
		$find_med = (strtotime($med_type[$M]['leave_to']) - strtotime($med_type[$M]['leave_from'])) / $daylen;
		//echo strtotime($date_to1)."%%%%%%%%%%%%%%".strtotime($date_from1);
		         $med_days = round($find_med);
				//$values['num_days'] = $num_days;
				if(($med_days)>0){
				$med_day+=  $med_days +"1";
				}
				else
				{
					$med_day="1";
				}
				$values['med_days'] = $med_day;
			
			
		}}
		else{
			$values['medical']="0";
		}
			$ann_type = $db->selectQuery("SELECT * FROM sm_employee_leave WHERE status='active' AND leave_type_id='3' AND employee_id=$emp_id");
		if(count($ann_type)>0){
			 
			 
			 $ann_day =0;
			for ($M = 0; $M < count($ann_type); $M++) {
			
			$values['annual']="3";
			
		$find_ann = (strtotime($ann_type[$M]['leave_to']) - strtotime($ann_type[$M]['leave_from'])) / $daylen;
		//echo strtotime($date_to1)."%%%%%%%%%%%%%%".strtotime($date_from1);
		         $ann_days = round($find_ann);
				//$values['num_days'] = $num_days;
				if(($ann_days)>0){
				$ann_day+=  $ann_days +"1";
				}
				else
				{
					$ann_day="1";
				}
				$values['ann_days'] = $ann_day;
			
			
		}}
		
		else{
			$values['annual']="0";
			
		}
		
		$emr_type = $db->selectQuery("SELECT * FROM sm_employee_leave WHERE status='active' AND leave_type_id='4' AND employee_id=$emp_id");
		if(count($emr_type)>0){
			 
			 
			 $emr_day =0;
			for ($E = 0; $E < count($emr_type); $E++) {
			
			$values['emargency']="4";
			
		$find_emr = (strtotime($emr_type[$E]['leave_to']) - strtotime($emr_type[$E]['leave_from'])) / $daylen;
		//echo strtotime($date_to1)."%%%%%%%%%%%%%%".strtotime($date_from1);
		         $emr_days = round($find_emr);
				//$values['num_days'] = $num_days;
				if(($emr_days)>0){
				$emr_day+=  $emr_days +"1";
				}
				else
				{
					$emr_day="1";
				}
				$values['emr_days'] = $emr_day;
			
			
		}}
		
		else{
			$values['emargency']="0";
			
		}
		
			$abs_type = $db->selectQuery("SELECT * FROM sm_employee_leave WHERE status='active' AND leave_type_id='5' AND employee_id=$emp_id");
		if(count($abs_type)>0){
			 
			 
			 $abs_day =0;
			for ($B = 0; $B < count($abs_type); $B++) {
			
			$values['absence']="5";
			
		$find_abs = (strtotime($abs_type[$B]['leave_to']) - strtotime($abs_type[$B]['leave_from'])) / $daylen;
		//echo strtotime($date_to1)."%%%%%%%%%%%%%%".strtotime($date_from1);
		         $abs_days = round($find_abs);
				//$values['num_days'] = $num_days;
				if(($abs_days)>0){
				$abs_day+=  $abs_days +"1";
				}
				else
				{
					$abs_day="1";
				}
				$values['abs_days'] = $abs_day;
			
			
		}}
		
		else{
			$values['absence']="0";
			
		}
		
	
        $values['employee_employment_id'] = $resFet[$rC]['employee_employment_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        $values['employee_designation'] = $resFet[$rC]['employee_designation'];
        //$values['company_name'] = htmlspecialchars_decode($resFet[$rC]['company_name']);
        $values['employee_id'] = $resFet[$rC]['employee_id'];
        $values['leave_from'] = $resFet[$rC]['leave_from'];
        $values['leave_to'] = $resFet[$rC]['leave_to'];
        $empArray["data"][] = $values;
    }
}
/* while ($row = mysql_fetch_assoc($resEmp)) {
  $empArray["data"][] = $row;
  } */
$fp = fopen('assets/extras/employeeleave.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Employee Leave List <span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Employee</a>
                    </li>
                    <li>
                        <a>Leave Tracker</a>
                    </li>
					 <li>
                        <a>Leave List</a>
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
                            <h1 class="custom-font"><strong>Employee Leave List</strong></h1>
                            <ul class="controls">
							<li>
 <a href="employeeLeave.php" role="button" tabindex="0" class="tile-add" title="Add Leave">
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

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                    <tr>
                                        <th style="width:150px;">Sl.No</th>
                                        <th style="width:150px;">Employee Id</th>
                                        <th style="width:200px;">Employee Name</th>
                                     <th style="width:200px;">Employee Designation</th>
										
                                        <th style="width:500px;" class="no-sort">Type Of Leaves</th>
                                    </tr>
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
<!--/ CONTENT -->








</div>

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
        var t =$('#products-list').DataTable({
            "dom": '<"row"<"col-md-8 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"pull-right"f>>>t<"row"<"col-md-4 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"inline-controls text-center"i>><"col-md-4 col-sm-12"p>>',
            "language": {
                "sLengthMenu": 'View _MENU_ records',
                "sInfo": 'Found _TOTAL_ records',
                "oPaginate": {
                    "sPage": "Page ",
                    "sPageOf": "of",
                    "sNext": '<i class="fa fa-angle-right"></i>',
                    "sPrevious": '<i class="fa fa-angle-left"></i>'
                }
            },
            "pagingType": "input",
            "ajax": 'assets/extras/employeeleave.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": "null",
                    "defaultContent": ''
                },
               
               
                {"data": "employee_employment_id"},
                {"data": "full_name"},
				{"data": "employee_designation"},                
				{
					"type": "html",
					"data": "employee_id",
					//"data": "validity_period",
					"render": function (data, type, full, meta) {
						 var c=m=a=e=b="";
						if(full.casual==="1"){
							
						
							
						
                        c= ' <a href="casual_leavelist.php?uid=' + data + '" class="btn btn-xs btn-green" class="btn btn-xs btn-default mr-5"><i></i>Casual (' +full.num_days+') </a>';
                }
				else{
					c="";
				}
				if(full.medical==="2"){
						
                        m= ' <a href="medical_leavelist.php?uid=' + data + '" class="btn btn-xs btn-green" class="btn btn-xs btn-default mr-5"><i ></i>Medical (' +full.med_days+') </a>';
				}
				else{
					m= "";
				}
				if(full.annual==="3"){
					
                        a= ' <a href="yearly_leavelist.php?uid=' + data + '" class="btn btn-xs btn-green" class="btn btn-xs btn-default mr-5"><i></i>Annual (' +full.ann_days+')</a>';
					}
					else{
					a= "";
				}
			   if(full.emargency==="4"){
					
                      e= ' <a href="emergency_leavelist.php?uid=' + data + '" class="btn btn-xs btn-green" class="btn btn-xs btn-default mr-5"><i></i>Emergency (' +full.emr_days+')</a>';
					}
					else{
					e= "";
				}
				
					if(full.absence==="5"){
					
                        b= ' <a href="absence_leavelist.php?uid=' + data + '" class="btn btn-xs btn-green" class="btn btn-xs btn-default mr-5"><i></i>Absence (' +full.abs_days+')</a>';
					}
					else{
					b= "";
				}
				return c + m + a + e + b;
					}
				}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "drawCallback": function (settings, json) {
                $(".formatDate").each(function (idx, elem) {
                    $(elem).text($.format.date($(elem).text(), "MMM d, yyyy"));
                });
                $('#select-all').change(function () {
                    if ($(this).is(":checked")) {
                        $('#products-list tbody .selectMe').prop('checked', true);
                    } else {
                        $('#products-list tbody .selectMe').prop('checked', false);
                    }
                });
            }
        });
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
        //*initialize datatable
    });</script>
<!--/ Page Specific Scripts -->


</body>

</html>
