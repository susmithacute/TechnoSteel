<?php
$page = "accounts";
$tab = "accounts_work_plan";
$sub = "accounts_external_requirements";
$sub1 = "accounts_external_invoice_list";
//$sub1 = "advance_request";
include("file_parts/header.php");
$hirArray = array();
$resFet = $db->selectQuery("SELECT sm_external_requirment.hiring_requirment_id,sm_external_demands.requirement ,sm_external_requirment.category,sm_external_demands.client,sm_external_requirment.hiring_requirment_date_to,sm_external_requirment.designation,sm_external_demands.id,sm_external_requirment.hiring_requirment_nof_person,sm_designation.designation_name,sm_external_requirment.hiring_requirment_date_from FROM sm_external_requirment INNER JOIN sm_designation ON sm_external_requirment.designation = sm_designation.designation_id INNER JOIN sm_external_demands ON sm_external_demands.id=sm_external_requirment.id Where sm_external_requirment.hiring_requirment_active='1' GROUP BY sm_external_requirment.id");

if (count($resFet)) {

    for ($rC = 0; $rC < count($resFet); $rC++) {
       //$prt_id=$resFet[$rC]['candidate_id'];
	   
	   //$date_from = new DateTime($resFet[$rC]['hiring_requirment_date_from']);
	 //$values['hiring_requirment_date_from']=$date_from1=$date_from->format("d/m/Y");
	 
	   $values['id'] =($resFet[$rC]['id']);
	   $Rid = $values['id']; 
	   $values['client'] =($resFet[$rC]['client']);
	   $values['requirement'] =($resFet[$rC]['requirement']);
	   $values['category'] =($resFet[$rC]['category']);
	   $values['designation'] =($resFet[$rC]['designation_name']);
	   $values['hiring_requirment_id'] =($resFet[$rC]['hiring_requirment_id']);
        //$values['hiring_requirment_date_to'] =($resFet[$rC]['hiring_requirment_date_to']);
        //$values['employee_name'] =  htmlspecialchars_decode($resFet[$rC]['employee_name']);
		 //$values['hiring_requirment_skills'] =($resFet[$rC]['hiring_requirment_skills']);
		 $values['hiring_requirment_nof_person'] =($resFet[$rC]['hiring_requirment_nof_person']);
		 $requirements = $db->selectQuery("SELECT `hiring_requirment_date_from`,`hiring_requirment_date_to` FROM `sm_external_requirment` WHERE `id`='$Rid'");
	$las_row = count($requirements);
	for($reqs = 0; $reqs<count($requirements); $reqs++)
	{
		$hiring_requirment_date_from[] = $requirements[$reqs]['hiring_requirment_date_from'];
		$hiring_requirment_date_to[] = $requirements[$reqs]['hiring_requirment_date_to'];
	}
	

	$from_date_and_to_date = array_merge($hiring_requirment_date_from,$hiring_requirment_date_to);
	
	usort($from_date_and_to_date, function($a, $b) {
    $dateTimestamp1 = strtotime($a);
    $dateTimestamp2 = strtotime($b);

    return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
});
$req_date_from = explode("-",$from_date_and_to_date[0]);
$req_date_to = explode("-",$from_date_and_to_date[count($from_date_and_to_date) - 1]);
$values['hiring_requirment_date_from'] = $req_date_from[2]."-".$req_date_from[1]."-".$req_date_from[0];

$values['hiring_requirment_date_to'] =  $req_date_to[2]."-".$req_date_to[1]."-".$req_date_to[0];
$invoice_status = $db->selectQuery("SELECT `invoice_status` FROM sm_external_invoice WHERE `req_id`='$Rid'");
if(!empty($invoice_status)){
$values['invoice_status'] = @$invoice_status[0]['invoice_status'];
}
        $hirArray["data"][] = $values;
		//print_r($values);no need
		//print_r($comArray["data"][0]);die;
		//echo($comArray["data"][0]);die;

	}
}
    


  
$fp = fopen('assets/extras/hiring.json', 'w');
fwrite($fp, json_encode($hirArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Invoice-External Requirement<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>HR</a>
                    </li>
                    <li>
                        <a>Employee</a>
                    </li>
					 <li>
                        <a>Requirements</a>
                    </li>
					<li>
                        <a>External Requirements</a>
                    </li>
					<li>
                        <a>External Requirement Invoice List</a>
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
                            <h1 class="custom-font"><strong>External Requirement Invoice List</strong></h1>
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
                                        <th style="width:80px;">Sl.no</th>
										 <th style="width:150px;">Client Name</th>
										 <th style="width:150px;">Requirements</th>
										  
                                        
                                        <th style="width:250px;">Requirement Date From</th>
										<th style="width:240px;">Requirement Date To</th>
                                        <th style="width:250px;">Changes</th>
                                        <th style="width:350px;" class="no-sort">Actions</th>
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


	<div class="modal splash fade" id="splash_invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
		
		<div class="modal-header">

                <h3 class="modal-title custom-font">Invoice</h3>

            </div>
			   
			   <div class="modal-body">

			   <input type="hidden" class="invo_req_id" />
			   <div class="row">
				  <div class="col-md-4"></div>
                    <div class="col-md-6"><div class="col-md-2">
			   <button class="btn btn-xs btn-green" onclick="invoice_view()" id="invoice_view">Invoice View</button>
			   </div></div>
			   </div>
			   <!--button class="btn btn-xs btn-green" onclick="invoice_send()" id="invoice_send">Invoice Send</button-->

                  <div class="row">
				  <div class="col-md-4"><label for="no_emp">Invoice Status: </label></div>
				  <div class="col-md-2"></div>
				  
                    <div class="col-md-12">
                        
                                     <select type="text" name="invoice_status" id="invoice_status" class="form-control">
									<option value ="">Select</option>
									<option value ="Completed">Completed</option>
									<option value ="Cancelled">Cancelled</option>
									</select>
                    </div>
					 <div class="col-md-2"></div>
                </div>
			   
			   <div id="Succ"></div>
           </div>
           <div class="modal-footer">
		   <input type="hidden" id="hid_status" value=""/>
		   <div id="suc" style="color:green" ></div>
		   <button  class="btn btn-default btn-border" id="submitss">Submit</button>
			<button class="btn btn-default btn-border" data-dismiss="modal" id="can_btn">Cancel</button>
			 
            </div>
			
        </div>
    </div>
	
<div class="modal splash fade" id="splashdel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Are You Sure To Delete?</h3>
				

            </div>
            <input type="hidden" id="hid_del1" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>
				<!--<button class="btn btn-default btn-border" id="nosub_btn">Rejected</button>-->
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="hiring_req" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
            
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
<script src="assets/js/main.js"></script>
<script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
<script src="assets/js/vendor/datatables/extensions/Pagination/input.js"></script>
<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>

<script src="assets/js/jquerysession.js"></script>
<!--/ vendor javascripts -->




<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->

<!--/ custom javascripts -->




<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->
<script>
    $(window).load(function () {
		
		$('#hiring_req').hide('slow');
		$('#submitted').hide('slow');

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
            "ajax": 'assets/extras/hiring.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": "null",
                    "defaultContent": ''
                },
				 {"data": "client"},
				 {"data": "requirement"},
				
                
                
                {"data": "hiring_requirment_date_from"},
				{"data": "hiring_requirment_date_to"},
                {
                    
                    "data": "invoice_status",
                    "defaultContent": 'Pending',
                },
				{
					"type": "html",
					"data": "hiring_requirment_id",
					"render": function (data,type,full,meta) {
                        return '<a onclick="invoice_id(' + full.id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash_invoice" data-options="splash-ef-3"><i class="fa fa-check"></i>Invoice</a>';
                }},
				
				
					
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
            "drawCallback": function (settings, json) {
                $(".formatDate").each(function (idx, elem) {
                    $(elem).text($.format.date($(elem).text(), "MMM dd, yyyy"));
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
function update_id(id)
    {
		$.session.set('update_session',id);
        $('#hid_del').val($.session.get('update_session'));
        // alert($.session.get('delete_seesion'));
		$.ajax({
			url:"process_ajax.php",
			dataType:"json",
			method:"POST",
			data:{update_id:id},
			success:function(data){
				 //alert (data);
				$('#client').val(data.client);
				$('#req_date_from').val(data.from);
				$('#req_date_to').val(data.to);
				$('#resources').val(data.resources);
				$('#hid_del2').val(data.designation);
				
			}
		});
    }
	function invoice_id(id)
    {
		//alert(id);
		var s= $('.invo_req_id').val(id);
		
    }
    function delete_id(id)
    {
		//alert(id);
		//$.session.set('delete_session',id);
        $('#hid_del1').val(id);
         
    }
    $('#sub_btn').click(function () {
        var pass_val= $('#hid_del1').val();
		//alert(pass_val);
        $.ajax({
            url: "external_requirement_delete.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {
				
                window.location = "accounts_external_requirement_list.php";
            }
        });
    });
	
	
	
	$('#can_btn').click(function () {
		$('#submitted').hide('slow');
		$('#hiring_req').hide('slow');
		$('#employees').val("");
		$('#wage').val("");
		//$('#req_date_from').val("");
		//$('#req_date_to').val(("");
		 
	 });
	 $('#invoice_status').change(function () {
                var selected_val = $(this).val();
				$('#invoice_status').val(selected_val);
                
                
		if($('#invoice_status').val()==0){ alert("must select a status");}	
		else{
	$('#submitss').click(function () {
	   var hire_id = $('.invo_req_id').val();
		var invoice_status = $('#invoice_status').val();
        $.ajax({
            url: "invoice_status_action.php",
            type: "POST",
            data: {hire_id: hire_id,invoice_status:invoice_status},
            success: function (data) {
				if($('#invoice_status').val()==0){ $('#suc').html(data).fadeIn( 3 );}	
				$('#suc').html(data).fadeOut(10000);
                window.location = "accounts_external_print_invoice_list.php";
			   
            }
			});
		});
		}
		});
		
		$('#invoice_send').click(function () {
			alert("haii");
			var hire_id = $('.invo_req_id').val();
			alert(hire_id);
	  $.ajax({
			url:"mail_invoice.php",
			method:"POST",
			data:{hire_id:hire_id},
			success:function(data){
				alert(data);
				//$('#splash').fadeOut(1000);
				     $('#splash').delay(3000).fadeOut();
				//setTimeout('Redirect()', 1000);
				location.href = "accounts_external_print_invoice_list.php";
			}
		});
		});
	function invoice_view() {
	var hir_req_id		= $('.invo_req_id').val();
	//alert("haii");
	//alert(hir_req_id);
    var printWindow = window.open("print_external_requirement.php?Rid="+ hir_req_id, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
       // printWindow.close();
    }, true);
	} 
	
</script>

</body>

</html>
