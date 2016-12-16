<?php
$page = "employee";
$tab = "employee_timesheet";
$sub = "employee_list_timesheet";
include('file_parts/header.php');

$empArray = array();
$resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, sm_employee.employee_designation, sm_employee.employee_employment_id, sm_employee.employee_company, sm_employee.employee_id, sm_employee.employee_email, sm_company.company_name
FROM sm_employee
INNER JOIN sm_company ON sm_employee.employee_company = sm_company.company_id
WHERE sm_employee.sponsor_id ='" . $_SESSION['id'] . "'
AND sm_employee.employee_status =1");
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $values['employee_employment_id'] = $resFet[$rC]['employee_employment_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        $values['employee_designation'] = $resFet[$rC]['employee_designation'];
        $values['company_name'] = htmlspecialchars_decode($resFet[$rC]['company_name']);
        $values['employee_id'] = $resFet[$rC]['employee_id'];
        //$values['employee_email'] = $resFet[$rC]['employee_email'];
        //$values['company_status'] = $resFet[$rC]['company_status'];
        $empArray["data"][] = $values;
    }
}

$selectholiday = $db->selectQuery("SELECT holiday FROM holidays");
$holiday=$selectholiday[0]['holiday'];
        //$values['full_name'] = $resFet1[$rC]['full_name'];



$fp = fopen('assets/extras/employee.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== --><section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Employee List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Employee</a>
                    </li>
                    <li>
                        <a>Employee List-All Companies</a>
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
                            <h1 class="custom-font"><strong>Employee  List</strong>-All Companies</h1>
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
                                            <th style="width:150px;" class="no-sort">Actions</th>
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


<div class="modal splash fade" id="splash1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font"> Timesheet add</h3>
            </div>
			<input type="text" id="hid" value=""/>
  <div class="modal-body">
				<div class="row">
				<div class="col-md-1"></div>
                    <div class="col-md-8">
                        <label>Date:</label>
                        <input type="text" name="date" id="date" value="<?php echo date("Y-m-d");?>"class="form-control"/>
                    </div>
                </div>
                  <div class="selected_result" style="display: none">				
 <div class="tab-pane" id="tab2">
                        <!-- The file upload form used as target for the file upload widget -->
                         <form name="step2" id="form2" role="form" novalidate method="post" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript><input type="hidden" name="redirect" value=""></noscript>
						
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            
                                <div class="row">
				  <div class="col-md-1"></div>
                    <div class="col-md-8">
					<label>Normal working hours:</label>
                       <input type="text" name="normal_work_hour" id="normal_work_hour" class="form-control"/>
                    </div>
					 <div class="col-md-2"></div>
                </div>
				<div class="row">
				  <div class="col-md-1"></div>
                    <div class="col-md-8">
					<label>Normal overtime:</label>
                       <input type="text" name="normal_over_time" id="normal_over_time" class="form-control"/>
                    </div>
					 <div class="col-md-2"></div>
                </div>
								<div class="modal-body">
								<span class="error" id="error"></span>
								</div>
								<input type="hidden" name="candidate_id" id ="candidate_id" value="" />
								 <input type="hidden" name="visa_stamp" id ="visa_stamp" value="" />
                        </form>
                    
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                </div>
				            </div>
 
				<div class="selected_result1" style="display: none">				
 <div class="tab-pane" id="tab2">
                        <!-- The file upload form used as target for the file upload widget -->
                         <form name="step2" id="form2" role="form" novalidate method="post" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript><input type="hidden" name="redirect" value=""></noscript>
						
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            
				
				<div class="row">
				  <div class="col-md-1"></div>
                    <div class="col-md-8">
					<label>Holiday overtime:</label>
                       <input type="text" name="holiday_overtime" id="holiday_overtime" class="form-control"/>
                    </div>
					 <div class="col-md-2"></div>
                </div>
				<div class="modal-body">
								<span class="error" id="error"></span>
								</div>
								<input type="hidden" name="candidate_id" id ="candidate_id" value="" />
								 <input type="hidden" name="visa_stamp" id ="visa_stamp" value="" />
                        </form>
                    
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                </div>
				            </div>
				
				
			
			</div>
			<input type="hidden" name="employee_id" id ="employee_id" value="" />
					<span id ="succ" class="error form-control" ></span>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn1">Submit</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>




<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Sure To Remove This Record ?</h3>
            </div>
            <input type="text" id="hid_del" value=""/>
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
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<!--/ custom javascripts -->




<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->
<script>
$('#date').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
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
            "ajax": 'assets/extras/employee.json',
            "order": [[2, "desc"]],
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
                    }},
                {"data": "employee_designation"},
                {"data": "company_name"},
                
                {
                    "type": "html",
                    "data": "employee_id",
                    "render": function (data, type, full, meta) {
						
                        // return '<a onclick="update_id(' + full.employee_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"></i> Add</a>
						return '<a href="time_sheet.php?uid=' + data + '" class="btn btn-xs btn-blue mr-5"><i class="fa fa-pencil"></i> Time Sheet</a>';
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
$('#date').change(function () {
                var selected_val = $(this).val();
				//var pass_val = $('#hid_del').val();
				alert(selected_val);
				$.ajax({
            url: "employee_list_timesheet_action1.php",
            type: "POST",
            data: {selected_val: selected_val},
            success: function (data) {
				alert(data);
				if(data=='holiday'){
						//$('.selected_result').hide();
						$('.selected_result1').show();
						$('.selected_result').hide();
				}
				else{
				
					
					$('.selected_result').show();
					$('.selected_result1').hide();
				}
                //window.location = "employee_list_timesheet.php";
            }
        });
				
				
				//$('#visa_stamp').val(selected_val);
			
                });
function update_id(id)
    {
        $.session.set('update_seesion', id);
		$('#hid').val($.session.get('update_seesion'));
		$('#candidate_code').val($.session.get('update_seesion'));
        $('#update_id').val($.session.get('update_seesion'));
		
		
		$('#cid').val($.session.get('update_seesion'));
        // alert($.session.get('delete_seesion'));
    }
	$('#sub_btn1').click(function () { 
  		var employee_id=$('#hid').val();
		//var candidate_code=$('#candidate_code').val();
		var Date=$('#date').val();
		var normal_work_hour=$('#normal_work_hour').val();
		var normal_over_time=$('#normal_over_time').val();
		var holiday_overtime=$('#holiday_overtime').val();
		//var flight_no=$('#flight_no').val();
       
		//if(Date_of_travel==''||arrival_time==''||departure_time==''||arrival_airport==''||flight_no==''){
			//$('#error').html("enter all fields").fadeOut(300);
		//}
		//else{
        $.ajax({
            url: "employee_list_timesheet_action.php",
            type: "POST",
            data: {employee_id:employee_id,Date:Date,normal_work_hour:normal_work_hour,normal_over_time:normal_over_time,holiday_overtime:holiday_overtime},
            success: function (data) { 
			$('#normal_work_hour').val('');
			$('#normal_over_time').val('');
			$('#holiday_overtime').val('');
			//$("#form2").reset();
			//$("#selected_result1").reset();
			alert(data);
				
				//window.location="employee_list_timesheet.php";
                
            }
			
        });
 });
    function delete_id(id)
    {
        $.session.set('delete_seesion', id);
        $('#hid_del').val($.session.get('delete_seesion'));
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn').click(function () {
        var pass_val = $('#hid_del').val();
        $.ajax({
            url: "delete_emp.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {
				
                window.location = "employee_list.php";
            }
        });
    });
	
	
	
	
</script>






<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
