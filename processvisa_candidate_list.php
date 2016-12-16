<?php
$page = "recruitment";
$sub = "process_visa";
 $tab="interview_process";
$sub1 = "process_list";
include('file_parts/header.php');

$empArray = array();
$resFet = $db->selectQuery("SELECT CONCAT( sm_candidate.candidate_firstname,  ' ', sm_candidate.candidate_middlename,  ' ', sm_candidate.candidate_lastname ) AS candidate_name, sm_candidate_medical_status.medical_status_id,sm_candidate.candidate_id,sm_candidate.candidate_code,sm_candidate_application.application_job_position,sm_candidate.candidate_nationality FROM sm_candidate LEFT JOIN sm_candidate_medical_status ON  sm_candidate.candidate_id=sm_candidate_medical_status.candidate_id LEFT JOIN sm_candidate_application ON  sm_candidate.candidate_id=sm_candidate_application.candidate_id  WHERE  `medical_status`='fit' AND `candidate_interview_status` ='Selected'");
$status ="";
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
		
		
		
        //$values['medical_status_id'] = $resFet[$rC]['medical_status_id'];
        $values['candidate_code'] = $resFet[$rC]['candidate_code'];
		$values['candidate_name'] = $resFet[$rC]['candidate_name'];
		$values['application_job_position'] = $resFet[$rC]['application_job_position'];
     $yoyo = $resFet[$rC]['candidate_id'];
	 $values['candidate_id'] = $resFet[$rC]['candidate_id'];
		  $values['candidate_nationality'] = $resFet[$rC]['candidate_nationality'];
		   
	  $select = $db->selectQuery("SELECT visa_status FROM sm_candidate_visa_process WHERE `candidate_id` = '$yoyo' ");
		    // for ($i = 0; $i < count($select); $i++){
    
	if(count($select)>0){
		$visa_stat = $select[0]['visa_status'];
		if($visa_stat == 'Approved'){
		$values['visa_status'] = "Issued";
		} else {
			$values['visa_status'] = $visa_stat;
		}
		
	$status=$select[0]['visa_status'];
	
	}else{
		$values['visa_status']='Pending';
	}
	$cau_type = $db->selectQuery("SELECT * FROM sm_candidate_visa_process WHERE `visa_status` != 'Pending'  AND`candidate_id` = '$yoyo'");
		
		if(count($cau_type)>0){
			$values['casual']="1";
		}
		else{
			$values['casual']="0";
		}
	
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

            <h2>Selected Candidate List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
					<li>
                        <a>Recruitment</a>
                    </li>
					
                    <li>
                        <a>Process Visa</a>
                    </li>
					
                    <li>
                        <a>Selected Candidate List</a>
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
                            <h1 class="custom-font"><strong>Candidate List For Visa</strong></h1>
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
											 		 <th style="width:90px;">Nationality</th>
										 <th style="width:90px;">Designation</th>
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

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Apply Visa</h3>
            </div>
            <input type="hidden" name="candidate_id" id="candidate_id" value=""/>
<div class="modal-body">
			 
                    
                        <label>Date:</label>
                       <!-- <input type="text" name="todo_edate" id="todo_edate" class="form-control"/>-->
						<div class='input-group datepicker' data-format="L">
                                        <input type='text' name="doj" id="todo_edate" class="form-control"    />
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
							
                    </div>
					
					<div class="modal-body">
					 
               
                    
                        <label for="selected_visa_type">Visa Type: </label>

                                    <select class="form-control" name="visa_type" id="selected_visa_type">
                            <option>Select</option>
							
							<?php
                                        $select_visa_type = $db->selectQuery("SELECT `visa_type_id`,`visa_type_name` FROM `sm_visa_type` WHERE `visa_type_status`=1 AND `visa_type_name` != ''");

                                        if (count($select_visa_type)) {

                                            for ($intr = 0; $intr < count($select_visa_type); $intr++) {
                                                ?>

                                                <option value="<?php echo $select_visa_type[$intr]['visa_type_id']; ?>"><?php echo $select_visa_type[$intr]['visa_type_name']; ?></option>

                                                <?php
                                            }
                                        }
                                        ?>
                           <!-- <option value="Under Process">Visiting</option>
                            <option value="Completed">Working</option>-->
                        </select>
                   
					
                </div>
					<div class="modal-body">
				
                   
                        <label>Visa Category:</label>
                        <select type="text" name="visa_category" id="visa_category" class="form-control visa_category">
                            <option>Select</option>
							 <option>New</option>
                            <!--<option value="Under Process">New</option>
                            <option value="Completed">Second renewal</option>-->
                        </select>
                    
                </div>
				 <span class="error" id="error" style="margin-left:40px; color:red;"></span>
				<div id="SucM" style="margin-left:40px; color:green;"></div>
				
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn3" style="color:blue;">Apply</button>
                <button class="btn btn-default btn-border" id="sub_btn4" data-dismiss="modal">Cancel</button>
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


<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<!--/ custom javascripts -->



<script>
                                                // // $('.date_pic').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});

                                                // $('body').on('click', '.datepicker_recurring_start', function () {
                                                    // $(this).datepicker({
                                                        // changeMonth: true,
                                                        // changeYear: true,
                                                        // dateFormat: "dd/mm/yy"
                                                    // }).focus();
                                                    // $(this).removeClass('datepicker');
                                                // });</script>

<script>
<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->


// $('#todo_edate').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
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
                
               	{"data": "candidate_nationality"},
				{"data": "application_job_position"},
			
            {
					"type": "html",
					"data": "candidate_id",
                    
                    
                    "render": function (data, type, full, meta) {
						 var c="";
						if(full.casual==="0"){
							c='<a onclick="candidate_id(' + data + ')" class="btn btn-xs btn-blue" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"> Apply Visa</a>';
						}
                        else {
							c=full.visa_status; 
							//{"data": "visa_status"};
							}	
						
						
						
						return c;

						
						}
                              	
									  
            }
	          
	
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
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

<script type="text/javascript">
  
	function candidate_id(id)
    {
        $.session.set('delete_seesion', id);
        $('#candidate_id').val($.session.get('delete_seesion'));
		$('#cid').val($.session.get('delete_seesion'));
        // alert($.session.get('delete_seesion'));
    }
	  $('#sub_btn3').click(function () { 

        	$('#SucM').html("");
		var candidate_id=$('#candidate_id').val();
		//var candidate_code=$('#candidate_code').val();
		var visa_date=$('#todo_edate').val();
		var visa_type=$('#selected_visa_type').val();
		var visa_category=$('#visa_category').val();
       //alert(candidate_id);
	  
	  if(visa_date==''||visa_type=='Select'||visa_category=='Select')
								{
									
									$('#error').html("Enter All Fields").fadeOut(3000);
								}
									else{
        $.ajax({
            url: "visa_type_select_action_copy.php",
            type: "POST",
            data: {visa_date:visa_date,visa_type:visa_type,visa_category:visa_category,candidate_id:candidate_id},
            success: function (data) {
				
				$('#SucM').html(data);
				
				 $("#splash").attr("disabled", true);
                
window.location="processvisa_candidate_list.php";
               
              // setTimeout('Redirect()', 3000);
            }
			
        });
		}
									
  
 });
   $('#sub_btn4').click(function () { 
   $('#SucM').html("");
 //$('#selected_visa_type').val("");
 window.location="processvisa_candidate_list.php";
   });
 function Redirect(){
	 				window.location="processvisa_candidate_list.php";
					 }
</script>






<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
