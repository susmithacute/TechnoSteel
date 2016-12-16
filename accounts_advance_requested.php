<?php
$page = "accounts";
$tab = "accounts_employee_salary";
$sub = "accounts_advance_add_add";
$head = "";
$head1 = "";
$sub1 = "advance_requested";
$tab1 = "";
include("file_parts/header.php");
$advArray = array();
$resFet = $db->selectQuery("SELECT sm_employee.employee_id,CONCAT(sm_employee.employee_firstname,' ',sm_employee.employee_middlename,' ',sm_employee.employee_lastname) as employee_name,
sm_employee.employee_salary,sm_salary_advance.advance_amount,sm_salary_advance.advance_id,sm_salary_advance.advance_requested_date,
sm_salary_advance.advance_status FROM sm_employee INNER JOIN sm_salary_advance
 ON sm_employee.employee_id=sm_salary_advance.employee_id");

if (count($resFet)) {
	$advance_requested_date ="";
//$date_arr = array();
    for ($rC = 0; $rC < count($resFet); $rC++) {
	   $values['advance_id'] =($resFet[$rC]['advance_id']);
        $values['employee_id'] =($resFet[$rC]['employee_id']);
        $values['employee_name'] =  htmlspecialchars_decode($resFet[$rC]['employee_name']);
		 $values['employee_salary'] =($resFet[$rC]['employee_salary']);
		 $values['advance_amount'] =($resFet[$rC]['advance_amount']);
		 $var = $resFet[$rC]['advance_requested_date'];
         $advance_requested_date = date('d-M-Y', strtotime(str_replace('-', '/', $var)));
        $values['advance_requested_date'] = $advance_requested_date;
		 
		 
		 $values['advance_status'] =($resFet[$rC]['advance_status']);
        $advArray["data"][] = $values;
		


    }

}
  
$fp = fopen('assets/extras/advreq.json', 'w');
fwrite($fp, json_encode($advArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Advance Requested<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Advance Requested</a>
                    </li>
                    <li>
                        <a>Advance Requested List</a>
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
                            <h1 class="custom-font"><strong>Advance Requested List</strong></h1>
                            <ul class="controls">
							
							<li>
 <a href="accounts_advance_add.php" role="button" tabindex="0" class="tile-add" title="Advance Request">
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
                                        <th style="width:20px;">>Sl.no</th>
										<th style="width:90px;">Employee Id</th>
                                        <th style="width:110px;">Employee Name</th>
                                        <th style="width:90px;">Employee Salary</th>
                                        <th style="width:90px;">Advance Amount Requested</th>
                                        <th style="width:90px;">Requested Date</th>
                                        <th style="width:90px;">Status</th>
                                        <th style="width:150px;" class="no-sort">Actions</th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>

                        </div>
                    </section>
                </div>
				</div>
        </div>
        <!-- /page content -->

    </div>

</section>
<!--/ CONTENT -->

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Advance Approved?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Approved</button>
				<button class="btn btn-default btn-border" id="nosub_btn">Rejected</button>
                <!--<button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>-->
            </div>
        </div>
    </div>
</div>

<div class="modal splash fade" id="approved_splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Pay Advance?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn_yes">Yes</button>
				<button class="btn btn-default btn-border" id="sub_btn_can">No</button>
                <!--<button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>-->
            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="pending_splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Pay Advance?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn_paid">Yes</button>
				<button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
                <!--<button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>-->
            </div>
        </div>
    </div>
</div>


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
            "ajax": 'assets/extras/advreq.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": "null",
                    "defaultContent": ''
                },
                  {"data": "employee_id"},
				
				{
                    "type": "html",
                    "data": "employee_name",
                    "render": function (data, type, full, meta) {
                        return '<a href="accounts_advance_edit_profile.php?adv_id=' + full.advance_id + '" class=""><i class=""></i> ' + data + '</a>';
                    }},
                //{"data": "employee_name"},
                {"data": "employee_salary"},
                {"data": "advance_amount"},
                {"data": "advance_requested_date"},
				//{"data": "advance_payment_status"},
				{
					 "type": "html",
					 "data": "advance_status",
					 "render": function (data) {
						 if (data=="Approved"){ return '<span style="color:green;">' +data+'</span>';}
						  else if (data=="Rejected"){ return '<span style="color:red;">' +data+'</span>';}
						   else if (data=="Requested"){ return '<span style="color:blue;">' +data+'</span>';}
						   else if (data=="Not Paid"){ return '<span style="color:red;">' +data+'</span>';}
						    else if (data=="Paid"){ return '<span style="color:green;">' +data+'</span>';}
						   else { return '<span style="color:blue;">' +data+'</span>';}
						 
				}},
                {
                    "type": "html",
                    "data": "advance_status",
                    "render": function (data, type, full, meta)  {
						if(data==="Requested"){
                        return '<a onclick="update_id(' +full.advance_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-check"></i>Change</a> <a href="accounts_advance_edit.php?adv_id=' + full.advance_id + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a>';
						}
						
						else if(data==="Approved"){
							 return '<a onclick="update_id(' + full.advance_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#approved_splash" data-options="splash-ef-3"><i class="fa fa-check"></i>Change</a> <a href="accounts_advance_edit.php?adv_id=' + full.advance_id + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a>';
						}
						else if(data==="Paid"){
							 return '<a onclick="update_id(' + full.advance_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#approved_splash" data-options="splash-ef-3"><i class="fa fa-check"></i>Change</a> <a href="accounts_advance_edit.php?adv_id=' + full.advance_id + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a>';
						}
						else if(data==="Not Paid"){
							 return '<a onclick="update_id(' + full.advance_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#pending_splash" data-options="splash-ef-3"><i class="fa fa-check"></i>Change</a> <a href="accounts_advance_edit.php?adv_id=' + full.advance_id + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a>';
						}
						else{
							 return '<a onclick="update_id(' +full.advance_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-check"></i>Change</a> <a href="accounts_advance_edit.php?adv_id=' + full.advance_id + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a>';
						}
                    }}
            ],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
	
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
		
	
    });
	
	</script>
<!--/ Page Specific Scripts -->

<script type="text/javascript">
    function update_id(id)
    {
        $('#hid_del').val(id);
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn').click(function () {
        var update_id= $('#hid_del').val();
        $.ajax({
            url: "advance_approved_status.php",
            type: "POST",
            data: {update_id: update_id},
            success: function (data) {
                window.location = "accounts_advance_requested.php";
            }
        });
    });
</script>
<script type="text/javascript">
    function update_id(id)
    {
        $('#hid_del').val(id);
        // alert($.session.get('delete_seesion'));
    }
    $('#nosub_btn').click(function () {
        var update_id= $('#hid_del').val();
        $.ajax({
            url: "advance_rejected_status.php",
            type: "POST",
            data: {update_id: update_id},
            success: function (data) {
               window.location = "accounts_advance_requested.php";
            }
        });
    });
</script>
<script type="text/javascript">
    function update_id(id)
    {
        $('#hid_del').val(id);
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn_yes').click(function () {
        var update_id= $('#hid_del').val();
        $.ajax({
            url: "advance_paid_status.php",
            type: "POST",
            data: {update_id: update_id},
            success: function (data) {
               window.location = "accounts_advance_requested.php";
            }
        });
    });
</script>
<script type="text/javascript">
    function update_id(id)
    {
        $('#hid_del').val(id);
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn_paid').click(function () {
        var update_id= $('#hid_del').val();
        $.ajax({
            url: "advance_paid_status.php",
            type: "POST",
            data: {update_id: update_id},
            success: function (data) {
               window.location = "accounts_advance_requested.php";
            }
        });
    });
</script>
<script type="text/javascript">
    function update_id(id)
    {
        $('#hid_del').val(id);
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn_can').click(function () {
        var update_id= $('#hid_del').val();
        $.ajax({
            url: "advance_pending_status.php",
            type: "POST",
            data: {update_id: update_id},
            success: function (data) {
               window.location = "accounts_advance_requested.php";
            }
        });
    });
</script>
</body>

</html>
