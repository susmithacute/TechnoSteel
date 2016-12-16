<?php
$page = "recruitment";
$tab = "CandidateTravel";
$tab1= "CandidateTravelled";
$tab2 = "CandidateTravelledRP";
$sub = "employee_list_RP";

include('file_parts/header.php');

$empArray = array();

$resFet=$db->selectQuery("SELECT DISTINCT CONCAT( sm_candidate.candidate_firstname,  ' ', sm_candidate.candidate_middlename,  ' ', sm_candidate.candidate_lastname ) AS full_name, sm_candidate.candidate_code,  sm_candidate.candidate_id 
FROM sm_candidate
LEFT JOIN sm_candidate_visa_process ON sm_candidate.candidate_id = sm_candidate_visa_process.candidate_id
WHERE   sm_candidate_visa_process.visa_type='4' ");

if (count($resFet)) {
	
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $values['candidate_code'] = $resFet[$rC]['candidate_code'];
        $values['full_name'] = $resFet[$rC]['full_name'];
		//$values['medical_status'] = $resFet[$rC]['medical_status'];
        //$values['employee_designation'] = $resFet[$rC]['employee_designation'];
        
        $values['candidate_id'] = $resFet[$rC]['candidate_id'];
		$candidate_id=$values['candidate_id'];
		
		
		$resFet1=$db->selectQuery("SELECT sm_medical_visa_status.medical_status FROM sm_medical_visa_status WHERE candidate_id = '$candidate_id' ");
		if(count($resFet1)>0){
		$values['medical_status'] = $resFet1[0]['medical_status'];
		
		} else {
		$values['medical_status'] ="Pending";	
		}
		
		
		
        $empArray["data"][] = $values;
    }
}


/* while ($row = mysql_fetch_assoc($resEmp)) {
  $empArray["data"][] = $row;
  } */
$fp = fopen('assets/extras/employee.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Travelled Candidates<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Candidate</a>
                    </li>
                    <li>
                        <a>Travelled Candidates List-Under RP Visa</a>
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
                            <h1 class="custom-font"><strong>Travelled Candidates List</strong>-Under RP Visa</h1>
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
                                            <th style="width:90px;">Candidate Code</th>
                                            <th style="width:90px;">Name</th>
                                            <th style="width:90px;">Status</th>
                                            <!--th style="width:90px;">Email</th-->
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

<div class="modal splash fade" id="splash1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Upload Medical Certificate </h3>
            </div>
			                    <div class="tab-pane" id="tab2">
                        <!-- The file upload form used as target for the file upload widget -->
                        <form name="step2" id="form2" role="form" style="center" novalidate method="post" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript><input type="hidden" name="redirect" value=""></noscript>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
							<div class="row">
							<div class="col-md-1"></div>
                                <div class="col-md-8">
								<br>
								<br>
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <label class="col-sm-6 control-label " align="center">Medical Certificate</label>
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span >Add files...</span>
                                        <input type="file" name="files[]" id="file" multiple onchange="javascript:updateList()">
										
										 <input type="hidden" value="Medical_Certificates" name="profpic" class="dfile">
                                    </span><span  id="error1" style="margin-left:2px;font-size:12px;color:red;"></span></div><div class="col-md-4"></div>
									</div>
									
									<div class="row"><div class="col-md-4"></div>
									<div class="col-md-4"><p id="fileList" style="margin-left:25px;"></p></div>
									<div class="col-md-4"></div></div>
									
                                    <p id="fileList"></p>
                                <span class="fileupload-process"></span>
                               
								<input type="hidden" name="candidate_id" id ="candidate_id" value="" />
                        </form>
                    </div>
						<div class="modal-body">
					    <label>Medical status:</label>
                        <select type="text" name="medical_result" id="medical_result" class="form-control">
                             <option value="<?php?>">Select</option>
                             <option value="Passed">Passed</option>
                             <option value="Failed">Failed</option>
							 <option value="Pending">Pending</option>
                        </select>
						<input type="hidden" name="hid" id ="hid" value="" />
                   
					
                
				
 
 
 
 <div class="selected_result" style="display: none">				
 <div class="tab-pane" id="tab2">
                        <!-- The file upload form used as target for the file upload widget -->
                         <form name="step2" id="form2" role="form" novalidate method="post" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript><input type="hidden" name="redirect" value=""></noscript>
						
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-12">
											        

                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <label>Qatar Id:</label><label id="id"></label>
                                    
                                   <input type="text"  name="qatar_id" id ="qatar_id" value="" class="form-control"/> 
								   <label>Qatar Id Issued Date:</label>
								   <input type="text" name="qatar_id_issued_date" id="qatar_id_issued_date" class="form-control"/>
								   <label>Qatar Id Expiry Date:</label>
								   <input type="text" name="qatar_id_expiry_date" id="qatar_id_expiry_date" class="form-control"/>
                                </div>
                                
                              <!--span class="error" id="error"></span-->
								
								<span class="error" id="error" style="margin-left:19px;"></span>
								<input type="hidden" name="candidate_id" id ="candidate_id" value="" />
								 <input type="hidden" name="medical_result" id ="medical_results" value="" />
                        </form>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                </div>
				            </div>
 </div>
                    <!-- The table listing the FILES available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
					<span id ="succ" class="error form-control" ></span>
                </div>
            <div id="succ"></div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn1">Yes</button>
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

<script src="assets/js/main.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<!--/ custom javascripts -->


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script>
$('#qatar_id_issued_date').datepicker({dateFormat:'dd-mm-yy', changeMonth:true, changeYear:true});
$('#qatar_id_expiry_date').datepicker({dateFormat:'dd-mm-yy', changeMonth:true, changeYear:true});

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
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "candidate_code",
                },
                {
                    "type": "html",
                    "data": "full_name",
                    "render": function (data, type, full, meta) {
                        return '<a href="employee_read.php?uid=' + full.candidate_id + '" class=""><i class=""></i> ' + data + '</a>';
                    }},
                {	"data": "medical_status",
					"defaultContent": 'Pending'
				},
                
                //{"data": "employee_email"},
                /*{
                    "type": "html",
                    "data": "employee_id",
                    "render": function (data) {
                        return '<input type="button" value="Upload" id="nofile"  width="30px"class="btn btn-xs btn-default mr-5" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"/><a onclick="delete_id(' + data + ')" class="btn btn-xs btn-lightred" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-times"></i> Delete</a>';
                    }}*/
					{
                    "": "html",
                    "data": "candidate_id",
                    "render": function (data, type, full, meta) {
						var c=m=a="";
						if(full.medical_status==="Failed"){
                        c= '<a onclick="edit_id(' + data + ')" class="btn btn-xs btn-default mr-5 btn-lightblue" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"> <i class="fa fa-pencil"></i>Edit</a>'
						}
						else{c=="";}
						if(full.medical_status==="Passed") {
						m='<a onclick="edit_id(' + data + ')" class="btn btn-xs btn-default mr-5 btn-lightblue" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"> <i class="fa fa-pencil"></i>Edit</a>';
						}
						else{m=="";}
						if(full.medical_status==="Pending"){
                        a= '<a onclick="upload_id(' + data + ')" class="btn btn-xs btn-default mr-5" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"> Upload</a>'
						}
						else{a=="";}
						
						
						return c+m+a;
                    }}
					
            ],
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
    });</script>
<!--/ Page Specific Scripts -->
<script>

updateList = function () {
                                                var input = document.getElementById('file');
                                                var output = document.getElementById('fileList');

                                                output.innerHTML = '<label class="col-sm-6 control-label">';
                                                for (var i = 0; i < input.files.length; ++i) {
                                                    output.innerHTML += '<p>' + input.files.item(i).name + '</p>';
                                                }
                                                output.innerHTML += '</label>';
                                            }
</script>


<script>
    //$(document).ready(function () {
		
		$('#medical_result').change(function () {
                var selected_val = $(this).val();
				$('#medical_results').val(selected_val);
                if (selected_val == "Passed") {
                $('.selected_result').show();
				}
				else{
					 $('.selected_result').hide();
				}
                
                });
		function upload_id(id)
    {
        $.session.set('upload_seesion', id);
        $('#hid_del').val($.session.get('upload_seesion'));
		 $('#candidate_id').val($.session.get('upload_seesion'));
		 $('#candidate_id').val($.session.get('upload_seesion'));
		 
        //alert($.session.get('delete_seesion'));
    }
        $('#sub_btn1').click(function () {
			$s=$('#file').val();
			
			 var fdata = $('#hid_del').val();
			 //alert(fdata);
			 
			 var fdata = "";

			//$('#next_btn').click(function () {
				fdata = $('#form2').serialize();
			//});
			
			
			var numf = 0;
            var formData = new FormData();
					  
            jQuery.each(jQuery('#file')[0].files, function (i, file) {
            formData.append('file-' + i, file);
			numf = numf + 1;
				
            });
			var edit_ids=$('#hid').val();
			//alert(edit_ids);
			if(edit_ids == ""){
				edit_id = 0;
			} else {
				edit_id = edit_ids;
			}
			var candidate_id = $('#hid_del').val();
			var medical_status = $('#medical_result').val();
			var qatar_id=$('#qatar_id').val();
			var qatar_id_issued_date=$('#qatar_id_issued_date').val();
			var qatar_id_expiry_date=$('#qatar_id_expiry_date').val();
			if(medical_status=="Passed")
			{ 
				alert("passed");
				if($s==''||qatar_id_expiry_date==''||qatar_id_issued_date==''||qatar_id==''||qatar_id_expiry_date < qatar_id_issued_date){
				if($s=='')
			    {
				$('#error').html("Select a certificates").fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
				}
				
			    if(qatar_id_expiry_date==''||qatar_id_issued_date==''||qatar_id=='')
				{
					$('#error').html("Enter All Fields").fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
      			}
				if(qatar_id_expiry_date < qatar_id_issued_date)
				{
					$('#error').html("Qatar ID Expiry Date must be greater than Qatar ID Issued Date").fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
      			}
				}
				else{	
				alert("11111");
            $.ajax({
                url: "visa_certificate_upload.php?" + fdata + '&numf=' + numf + '&medical_status=' + medical_status + '&edit_id=' + edit_id,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
				 data: formData,
                success: function (data) {
					//$('#succ').html(data).fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
					//alert(data);
					window.location = "employee_list_RP.php";
                    }
				});
			
			
			//else{
				
				$.ajax({
				url: "qatarid_upload.php",
				type: "POST",
				data: {medical_status: medical_status,candidate_id:candidate_id,qatar_id:qatar_id,qatar_id_issued_date:qatar_id_issued_date,qatar_id_expiry_date:qatar_id_expiry_date,edit_id:edit_id},
				success: function (data) {
				//$('#qatar_id').html(data).fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
				alert(data);
				//window.location = "employee_list_RP.php";
				}
				});
				//}
			}
			
			}
			else{
				alert("not medical cer");
				if($s=='')
			    {
				$('#error1').html("Select a certificate").fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
				}
				else{
					alert("333333");
			 $.ajax({
                url: "visa_certificate_upload.php?" + fdata + '&numf=' + numf + '&medical_status=' + medical_status + '&edit_id=' + edit_id   ,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
				 data: formData, edit_id:edit_id,
                success: function (data) {
					
					//$('#succ').html(data).fadeIn( 3000 ).delay( 1500 ).fadeOut( 4000 );
					//alert(data);
					//window.location = "employee_list_RP.php";
                    }
				});
			}
			}
        });
    //});
    /**/
</script>

<script>


    function upload_id(id)
    {
        $.session.set('upload_seesion', id);
        $('#hid_del').val($.session.get('upload_seesion'));
		 $('#candidate_id').val($.session.get('upload_seesion'));
		 $('#candidate_id').val($.session.get('upload_seesion'));
		 
        //alert($.session.get('delete_seesion'));
    }
	function edit_id(id)
    {
        $.session.set('edit_seesion', id);
        $('#hid').val($.session.get('edit_seesion'));
		$('#candidate_id').val($.session.get('edit_seesion'));
		//$('#candidate_id').val($.session.get('edit_seesion'));
		//alert(id);
        $.ajax({
			url:"RPedit_ajax.php",
			dataType:"json",
			method:"POST",
			data:{edit_id:id},
			success:function(data){
				alert (data);
			//$('#candidate_id').val(data.candidate_id);
			//$('#medical_result').val(data.medical_status);
			$('#medical_result').val(data.medical_status);
			if(data.medical_status=='Passed'){
			$('.selected_result').show();
			$('#qatar_id').val(data.qatar_id);
			$('#qatar_id_issued_date').val(data.qatar_id_issued_date);
			$('#qatar_id_expiry_date').val(data.qatar_id_expiry_date);			
			}
			else{$('.selected_result').hide();}
			
				//$('#leave_from').val(data.leave_from);
				//$('#leave_to').val(data.leave_to);
				//$('#leave_type_id').val(data.leave_type_id);
			}
		});
    }
    
    
</script>

