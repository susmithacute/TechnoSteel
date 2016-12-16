<?php
$page = "employee";
$tab = "employee_travel";
$sub = "yearly_travel";
$head = "";
$head1 = "";
$sub1 = "employee_travel";
$tab1 = "";

include('file_parts/header.php');

$empArray = array();
$resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, sm_employee.employee_designation, sm_employee.employee_employment_id, sm_employee.employee_company, sm_employee.employee_id,sm_company.company_name,sm_employee_leave.leave_from,sm_employee_leave.leave_to
FROM sm_employee INNER JOIN sm_employee_leave ON sm_employee.employee_id = sm_employee_leave.employee_id 
INNER JOIN sm_company ON sm_employee.employee_company = sm_company.company_id 
WHERE sm_employee.employee_employment_id NOT IN (SELECT employee_employment_id FROM sm_employee_travel) AND 
sm_employee.employee_status =1 AND sm_employee_leave.leave_type_id='3' AND sm_employee_leave.status='active'");



if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $values['employee_employment_id'] = $resFet[$rC]['employee_employment_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        $values['employee_designation'] = $resFet[$rC]['employee_designation'];
        $values['company_name'] = htmlspecialchars_decode($resFet[$rC]['company_name']);
        $values['employee_id'] = $resFet[$rC]['employee_id'];
		$leave_to = strtotime($resFet[$rC]['leave_to']); // or your date as well
		$leave_from = strtotime($resFet[$rC]['leave_from']);
		
		$datediff = $leave_to - $leave_from;

		$datediffs = floor($datediff / (60 * 60 * 24));
		$dates =$datediffs+1;
        $values['datediff'] =$dates;
   
        $empArray["data"][] = $values;
    }
}
$fp = fopen('assets/extras/employee_travel_app.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Eligible Employee List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Employee</a>
                    </li>
                    <li>
                        <a>Eligible Employee List - Yearly Leave Request</a>
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
                    <section class="tile">

                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Eligible</strong> Employee  List</h1>
                            <ul class="controls">
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
                                            <th style="width:10px;" >
                                                Sl.no
                                            </th>
                                            <th style="width:90px;">Employee ID</th>
                                            <th style="width:90px;">Name</th>
                                            <th>Designation</th>
                                            <th>Company</th>

                                            <th style="width:90px;">No:of Leaves</th>
                                            <th style="width:150px;" class="no-sort">Actions</th>
											
                                        </tr>
                                    </thead>

                                </table>
                            </div>
<input type="hidden" name="emp_leave" id="emp_leave" value="<?php //echo $values['datediff'];?>">
                        </div>
                    </section>
                </div>
                <!-- /col -->
            </div>
        </div>
    </div>

</section>
<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title custom-font">Book Ticket</h3>

            </div>

           

            <div class="modal-body">

			
           <div class="row"><div class="col-sm-1"></div>
</br>
                                                    <label class="col-sm-3 control-label" for="inputEmail3">Travel status:</label>

                                                    <div class="col-sm-6" style="margin-left:10px;">

                                                        <select class="form-control" name="eligibility"

                                                                id="eligibility">

                                                            <option  value=""> Select </option>

                                                            <option value="yes">Yes</option>
                                                            <option  value="no">No</option>
														
                                                           
                                                        </select>

                                                    </div>

                                                </div>
				 <div id="approved_div" >
				<div class="row">
				<div class="col-md-1"></div>
                  
                </div>
				 <input type="hidden" name="eligibility" id ="eligibility" value="" />
				<div class="row">
					<div class="col-sm-4"></div>
					<span id="err" style="color:red;margin-left:13px;"></span> 
				</div>
				<div class="row">
					<div class="col-sm-4"></div>
					<span id="Succ" style="color:Green;margin-left:13px;"></span> 
				</div>
            </div>
			</div>
			<input type="hidden" id="hid_del" value=""/>
            <div class="modal-footer">

                <button class="btn btn-default btn-border" id="sub_btn">Submit</button>

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
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<!--/ custom javascripts -->
<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->
<script>
$('#leave_from').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true,onSelect: function(date) {
		$("#leave_to").datepicker('option', 'minDate', date);} });
$('#leave_to').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
</script>
<script>
    $(window).load(function () {

        //initialize datatable
      var t=  $('#products-list').DataTable({
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
            "ajax": 'assets/extras/employee_travel_app.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "employee_employment_id",
                },
                {
                    "type": "html",
                    "data": "full_name",
                    "render": function (data, type, full, meta) {
						 return '<a href="employee_read.php?uid=' + full.employee_id + '" class=""><i class=""></i> ' + data + '</a>';
                      //  return '<a href="employee_travel_ticket_details.php?employee_id=' + full.employee_id + '" class=""><i class=""></i> ' + data + '</a>';
                    }},
                {"data": "employee_designation"},
                {"data": "company_name"},
                {"data": "datediff"},
                {
                    "type": "html",
                    "data": "datediff",
                    "render": function (data, type, full, meta) {
					 return '<a href="employee_travel_ticket_details.php?employee_id='+ full.employee_id+ '&emp_leave='+data+'" class="btn btn-xs btn-blue"><i class="fa fa-plus"></i>Apply</a>';
                    }}
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

<script type="text/javascript">
    function delete_id(id,leave)
    {
		
        $.session.set('delete_seesion', id);
        $('#hid_del').val($.session.get('delete_seesion'));
       // alert($.session.get('delete_seesion'));
    
   
	
	  // $('#sub_btn').click(function () {
		 var employee_id = $('#hid_del').val();
         var sele_can = $('#eligibility').val();
		 var emp_leave = leave;
		                 window.location =  'employee_travel_ticket_details.php?employee_id='+ employee_id'&emp_leave='+emp_leave;

		// alert(employee_id);
		 
		
		 //if(sele_can== 'yes'){
       /* $.ajax({
            url: "employee_travel_ticket_details.php" ,
            type: "POST",
            data: {employee_id: employee_id,emp_leave: emp_leave},
            success: function (data, type, full, meta) {
               // alert(data);
            }
        }); */
				
    }
</script>
</body>

</html>
