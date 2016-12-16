<?php
$page = "recruitment";
$tab="interview_process";
$sub = "process_visa";
$sub1 = "approved_list";
include('file_parts/header.php');

$empArray = array();
$resFet = $db->selectQuery("SELECT CONCAT( sm_candidate.candidate_firstname,  ' ', sm_candidate.candidate_middlename,  ' ',
 sm_candidate.candidate_lastname ) AS candidate_name,sm_candidate.candidate_code, sm_candidate_visa_process.candidate_id,sm_candidate_visa_process.notified_status,sm_candidate_visa_process.visa_no,sm_candidate_visa_process.visa_type,sm_visa_type.visa_type_name,sm_candidate_visa_process.visa_expiry,sm_candidate_application.application_job_position
FROM sm_candidate LEFT JOIN sm_candidate_application ON  sm_candidate.candidate_id=sm_candidate_application.candidate_id
LEFT JOIN sm_candidate_visa_process ON  sm_candidate.candidate_id=sm_candidate_visa_process.candidate_id
LEFT JOIN sm_visa_type ON sm_candidate_visa_process.visa_type=sm_visa_type.visa_type_id
WHERE  `visa_status`='Approved'");
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
        //$values['medical_status_id'] = $resFet[$rC]['medical_status_id'];
		$s1=explode("-",$resFet[$rC]['visa_expiry']);
		$s=$s1[2]."-".$s1[1]."-".$s1[0];
		echo $s;
        $originalDate  = new DateTime($s);
	    $visa_expiry  = $originalDate->format("d/m/Y");
		
		$values['candidate_name'] = $resFet[$rC]['candidate_name'];
		$name = $resFet[$rC]['candidate_name'];
		$values['application_job_position'] = $resFet[$rC]['application_job_position'];
      $values['candidate_id'] = $resFet[$rC]['candidate_id'];
      $values['candidate_code'] = $resFet[$rC]['candidate_code'];
	  
	  $cand = $resFet[$rC]['candidate_id'];

	  
	  
      $values['visa_expiry'] =$visa_expiry;
	  $values['visa_type'] = $resFet[$rC]['visa_type'];
	  	$values['visa_no'] = $resFet[$rC]['visa_no'];
	   $values['visa_type_name'] = $resFet[$rC]['visa_type_name'];
		$values['notified_status'] = $resFet[$rC]['notified_status'];
        $empArray["data"][] = $values;
    }
}
/* while ($row = mysql_fetch_assoc($resEmp)) {
  $empArray["data"][] = $row;
  } */
$fp = fopen('assets/extras/processvisa.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Visa Issued List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> HR</a>
                    </li>
					  <li>
                        <a>Recruitment</a>
                    </li>
					
					
                    <li>
                        <a>Process Visa</a>
                    </li>
					
                    <li>
                        <a>Visa Issued Candidate List</a>
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
                            <h1 class="custom-font"><strong>Visa Issued Candidate List</strong></h1>
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
                                            <th style="width:10px;" >Sl.no</th>
                                            
											 <th style="width:90px;">Candidate ID</th>
											 <th style="width:90px;">Candidate Name</th>
											 <th style="width:90px;">Designation</th>
										  <th style="width:90px;">Visa No</th>
											 <th style="width:90px;">Visa Type</th>
											 <th style="width:90px;">Expiry Date</th>
											 		 <th style="width:90px;">Status</th>
											 
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

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font"></h3>
                    </div>
                    <div class="modal-body" style="
					text-align:center;
    margin-bottom: 0px;
    border-bottom-width: 55‒;
    padding-bottom: 130px;
">
                        <p>Your Email Send Successfully!!!</p>

                        
                    </div>
                    
                </div>
            </div>
        </div>


</div>
<div class="modal splash fade" id="splash2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Send Mail</h3>
            </div>
            <input type="hidden" name="candidate_id" id="candidate_id" value=""/>

					
					<div class="modal-body">
					 
               
                    
                        <label for="to_name">To: </label>
						
 <input type="text" class="form-control" name="to_name" id="to_name" value=" ">

                                       
					
                </div>
				<div class="modal-body">
				
                   
                        <label>From:</label>
                       <input type="text" class="form-control" name="from" id="from" value="technosteal@gamil.com"/>
                </div>
					<div class="modal-body">
				
                   
                        <label>Subject:</label>
                       <input type="text" class="form-control" name="subject" id="subject" value="Registration Details"/>
                </div>
				<div class="modal-body">
           
                   <label>Content:</label>
           <textarea class="form-control"  name="content" id="content_send" value="" cols='60' rows='15'></textarea>
            
				 </div>
				 <span class="error2" id="error2" style="margin-left:40px; color:green;"></span>
				<div id="SucM" style="margin-left:40px; color:green;"></div>
				
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn3" style="color:blue;">Send</button>
                <button class="btn btn-default btn-border" id="sub_btn4" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="splash1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font"> Update Visa Details</h3>
            </div>
			<input type="hidden" id="hid" value=""/>
			 
 			
 
                        <!-- The file upload form used as target for the file upload widget -->
                         <form name="step2" id="form2" role="form" novalidate method="post" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript><input type="hidden"  id ="reason_box" name="redirect" value=""></noscript>
						
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            
											        
                              <div class="modal-body">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <label >Visa No:</label>
									
									
                                   <input type="text" name="qatar_idd" id ="qatar_idd" class="form-control"  /></div>
								   
								   
								   
								   
								  <div class="modal-body">

								   <label>Visa Issued Date:</label>
								    <div class='input-group datepicker' data-format="L">
                                        <input type='text' name="doj" id="todo_edate" class="form-control"    />
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
							</div>
								  <div class="modal-body">

								   <label>Visa Expiry Date:</label>
								    <div class='input-group datepicker' data-format="L">
                                        <input type='text' name="doj" id="todo_edate1" class="form-control"    />
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
							</div>
                               
								
								<span class="error" id="error" style="margin-left:30px; color:red;"></span>
								<input type="hidden" name="candidate_id" id ="candidate_id" value="" />
								 <input type="hidden" name="medical_result" id ="medical_results" value="" />
                        </form>
                    
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                
				            
 
				           
							
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
               			            
 

					<input type="hidden" name="employee_id" id ="employee_id" value="" />
					<div id="SucM"></div>
					
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn1">Submit</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
       </div>
    </div>
</div>
<div class="modal splash fade" id="splash3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title custom-font">Sure To Cancel This Record ?</h3>

            </div>

            <input type="hidden" id="hid_del" value=""/>

            <div class="modal-body">

                <p id="selected_status" style="color:#080"></p>

            </div>

            <div class="modal-footer">

                <button class="btn btn-default btn-border" id="del_btn">Yes</button>

                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>

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

<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

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
// $('#todo_edate').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
// $('#todo_edate1').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
// </script>
<script>
                                                // $('.date_pic').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});

                                                $('body').on('click', '.datepicker_recurring_start', function () {
                                                    $(this).datepicker({
                                                        changeMonth: true,
                                                        changeYear: true,
                                                        dateFormat: "dd-mm-yy"
                                                    }).focus();
                                                    $(this).removeClass('datepicker');
                                                });</script>
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
            "ajax": 'assets/extras/processvisa.json',
            "order": [[1, "asc"]],
            "columns": [
                {"data": null,
                    "defaultContent": ''
                },
				{"data": "candidate_code"},
                {
                     "type": "html",
                     "data": "candidate_name",
                    // "render": function (data, type, full, meta) {
                        // return '<a href="employee_read.php?uid=' + full.candidate_id + '" class=""><i class=""></i> ' + data + '</a>';
                    // }
					 },
                {"data": "application_job_position"},
                {"data": "visa_no"},
				{"data": "visa_type_name"},
				{"data": "visa_expiry"},
					{"data": "notified_status"},
               
                {
					"data": "candidate_id",
                    "type": "html",
                    
                    "render": function (data) {
                        return '<a onclick="update_id(' + data + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash2" data-options="splash-ef-3">To be Notify</a><a onclick="edit_id(' + data + ')" class="btn btn-xs btn" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"><i class="fa fa-pencil"></i>Edit</a><a onclick="delete_id(' + data + ')" class="btn btn-xs btn-blue" data-toggle="modal" data-target="#splash3" data-options="splash-ef-3"></i>Cancel</a>';
                    }}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "drawCallback": function (settings, json) {
                $(".formatDate").each(function (idx, elem) {
                    $(elem).text($.format.date($(elem).text(), "yyyy,mm,d"));
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

<script>
  function update_id(id)
    {
		$.session.set('update_session',id);
      $('#candidate_id').val($.session.get('update_session'));
	  //	$('#hid').val($.session.get('update_session'));
        // alert($.session.get('delete_seesion'));
		$.ajax({
			url:"email_ajax.php",
			dataType:"json",
			method:"POST",
			data:{update_id:id},
			success:function(data){
				
				$('#to_name').val(data.agent_email2);
				$('#content_send').val(data.content_mail);
				//alert(data);
			}
		});
    }
	function edit_id(id)
    {
        $.session.set('edit_seesion', id);
		//alert(id);
		$('#hid').val($.session.get('edit_seesion'));
		$.ajax({
			url:"visa_no_edit.php",
			dataType:"json",
			method:"POST",
			data:{edit_id:id},
			success:function(data){
				//alert(data);
				$('#qatar_idd').val(data.visa_no);
				$('#todo_edate').val(data.visa_issued);
				$('#todo_edate1').val(data.visa_expiry);
				//val(data.visa_no);
			}
		});
       $('#edit_id').val($.session.get('edit_seesion'));
		}
		</script>
		<script>
        // alert($.session.get('delete_seesion'));
    
	$('#sub_btn3').click(function () {
    
		//var candidate_id=$('#hid').val();
		var candidate_id=$('#candidate_id').val();
					var mail_to=$('#to_name').val();
					var mail_from=$('#from').val();
					var sub=$('#subject').val();
					var cont=$('#content_send').val();
		            //var status=$('#notified_status').val();
		$.ajax({
			url:"mail_notification.php",
			method:"POST",
			data:{candidate_id:candidate_id,mail_to:mail_to,mail_from:mail_from,sub:sub,cont:cont},
			success:function(data){
				
				     //$('#splash').delay(3000).fadeOut();
					$('#error2').html("Your Mail has been Send");
			window.location="visa_approved_list.php";
				//$('#SucM').html(data);
											  
				
			}
		});
		
        // alert($.session.get('delete_seesion'));
    });
	<!---- Upload Visa Details --->
			 $('#sub_btn1').click(function () { 
				     
					var candidate_id=$('#hid').val();
					var visa_no=$('#qatar_idd').val();
					var visa_issued=$('#todo_edate').val();
					var visa_expiry=$('#todo_edate1').val();
					
					if(visa_no==''||visa_issued==''||visa_expiry=='')
								{
									$('#error1').html("");
									$('#error').html("enter all fields");
									
								}
									else{
										
											$.ajax({
											url: "visa_approved_action.php",
											type: "POST",
											data: {candidate_id:candidate_id,visa_no:visa_no,visa_issued:visa_issued,visa_expiry:visa_expiry},
											success: function (data) {
												//alert(data);
												window.location="visa_approved_list.php";
												//$('#SucM').html(data);
											   //setTimeout('Redirect()', 1000);
																}
											
													}); 
								        }
		});
			function delete_id(id) {
        $('#hid_del').val(id);
    }
   
    $('#del_btn').click(function () {
        var sele_can = $('#hid_del').val();
        $.ajax({
            url: "process_visa_cancel.php",
            type: "POST",
            data: {sele_can: sele_can},
            success: function (data) {
              //  alert(data);
                window.location = "visa_approved_list.php";
            }
        });
    });	
			<!---- Visa Staus Approved And Rejected Boxes ---->	
			
				
		/*function sub_btn4(id){
			window.location="visa_approved_list.php";
		}*/		
 
</script>






<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
