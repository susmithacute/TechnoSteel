<?php
$page = "recruitment";
$tab="interview_process";
$sub = "candidateToemployee";
include("./file_parts/header.php");
$cmpArray = array();
$resFet = $db->selectQuery("SELECT sm_candidate.candidate_id, CONCAT(sm_candidate.candidate_firstname,' ',sm_candidate.candidate_middlename,' ',sm_candidate.candidate_lastname) as fullname, sm_candidate.candidate_email, sm_candidate.candidate_phone, sm_candidate.candidate_code,sm_candidate_visa_process.visa_type ,sm_candidate_documents.documents_title,sm_candidate_documents.documents_data FROM sm_candidate LEFT JOIN sm_candidate_documents ON sm_candidate.candidate_id=sm_candidate_documents.candidate_id 
LEFT JOIN sm_travelling_details ON sm_candidate.candidate_id=sm_travelling_details.candidate_id 
LEFT JOIN sm_candidate_visa_process ON sm_candidate.candidate_id=sm_candidate_visa_process.candidate_id WHERE candidate_status='1' AND candidate_interview_status='Selected' AND travelling_status='travelled' AND candidate_toemployee='No' GROUP BY candidate_id");
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
		$values['candidate_id']='';
        $values['candidate_id'] = $resFet[$rC]['candidate_id'];
		$candidate_id = $resFet[$rC]['candidate_id'];
        $values['candidate_code'] = $resFet[$rC]['candidate_code'];
        $values['fullname'] = $resFet[$rC]['fullname'];
        $values['candidate_email'] = $resFet[$rC]['candidate_email'];
        $values['visa_type'] = $resFet[$rC]['visa_type'];
		
		$visa_type=$resFet[$rC]['visa_type'];
		$visa_type_select = $db->selectQuery("SELECT `visa_type_name` FROM sm_visa_type WHERE `visa_type_id`='$visa_type'");
		$values['visa_type_name'] = $visa_type_select[0]['visa_type_name'];
		$values['documents_data'] ="";
		if($visa_type==4){
			$document_qatar=$db->selectQuery("SELECT documents_title,documents_data FROM sm_candidate_documents WHERE candidate_id=$candidate_id AND documents_title='QatarID'");
			if(count($document_qatar))
			{
			$qatar=$document_qatar[0]['documents_data'];
			
			$values['documents_data'] = $qatar;
			}
		}
      //  $values['candidate_job'] = $resFet[$rC]['application_job_position'];
	 //  $values['documents_title'] = $resFet[$rC]['documents_title'];
	    //$values['documents_data'] = $resFet[$rC]['documents_data'];
        $cmpArray["data"][] = $values;
    }
}
$fp = fopen('assets/extras/company.json', 'w');
fwrite($fp, json_encode($cmpArray));
fclose($fp);
?>
<section id="content">
    <div class="page page-shop-products">
        <div class="pageheader">
            <h2>Candidate List <span></span></h2>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="#">Recruitment</a>
                    </li>
                    <li>
                        <a href="#">Candidate</a>
                    </li>
                    <li>
                        <a href="#">Candidate List</a>
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

                            <h1 class="custom-font"><strong>Candidate</strong> List</h1>

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



                            <div class="table-responsive">

                                <table class="table table-striped table-hover table-custom" id="products-list">

                                    <thead>

                                        <tr>

                                            <th style="width:5px;">Sl.no</th>

                                            <th style="width:90px;">Candidate ID</th>

                                            <th style="width:80px;">Candidate Name</th>

											
											<th style="width:80px;" class="no-sort">E-mail</th>

                                            <th style="width:80px;">Visa Category</th>
										
											  <th style="width:80px;">Qatar ID</th>

                                            <th style="width:80px;">Action</th>

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



<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title custom-font">Are You Sure, You Want to Change Candidate to Employee ?</h3>

            </div>

            <input type="hidden" id="hid_del" value=""/>

            <div class="modal-body">

                <p id="selected_status" style="color:#080"></p>
				<div class="row">
				<div class="col-sm-1"></div>

			<label class="col-sm-3 control-label" for="inputEmail3">Employee Code:</label>

			<div class="col-sm-6">

				<input type="text" name ="employee_code" class="form-control" id= "employee_code" value="" />

			</div>

			</div>
			<div class="row">
			<div class="col-sm-4"></div>
			<span id="err" style="color:red;margin-left:13px;"></span> 
			</div>
			
			
			
			
            </div>
			
			<div class="modal-body">

                <p id="selected_status" style="color:#080"></p>
				<div class="row">
				<div class="col-sm-1"></div>

			<label class="col-sm-3 control-label" for="inputEmail3">Employee Joining Date:</label>
			<div class="col-md-6">
			<div class='input-group datepicker' data-format="L">
                                        <input type='text' class="form-control" name="emp_join_date"
                                               id="emp_join_date" required="" onkeydown="return false"/>
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
				</div>
			</div>
			<div class="row">
			<div class="col-sm-4"></div>
			<span id="err" style="color:red;margin-left:13px;"></span> 
			</div>
			
			 

            </div>
			
			
			

            <div class="modal-footer">

                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>

                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
					
					
						<div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <h4 style="margin-left:30px;" class="text-success mt-0 mb-20" id="message"></h4>
                        </div>
                    </div>
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

<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>
<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


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
                                                       $('body').on('click', '.date_pick', function () {
                                                           $(this).datepicker({
                                                               changeMonth: true,
                                                               changeYear: true,
                                                               dateFormat: "dd/mm/yy"
                                                           }).focus();
                                                           $(this).removeClass('datepicker');
                                                       });
</script>
<script>
    function delete_id(id) {
        $('#hid_del').val(id);
    }
    $(window).load(function () {



        //initialize datatable

        var t = $('#products-list').DataTable({
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
            "ajax": 'assets/extras/company.json',
            "order": [[1, "desc"]],
            "columns": [
                {"data": null},
                {"data": "candidate_code"},
                {
                    "type": "html",
                    "data": "fullname",
                    "render": function (data, type, full, meta) {

                        return '<a href="candidate_interview_profile.php?can_id=' + full.candidate_id + '" class=""><i class=""></i> ' + data + '</a>';

                    }},
               
                {"data": "candidate_email"},
                {"data": "visa_type_name"},
				
				  {"data": "documents_data"},
                {
                    "type": "html",
                    "data": "candidate_id",
					"defaultContent": '',
                    "render": function (data, type, full, meta) {
						
						if(full.visa_type==4){
							if(full.documents_data==''){}
							else{
                        return '<a onclick="delete_id(' + full.candidate_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-plus"></i> CandidateToEmployee</a>';
							}
							}
						
						else{
							return '<a onclick="delete_id(' + full.candidate_id + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-plus"></i> CandidateToEmployee</a>';
						}
						
                    }}
            ],
            "aoColumnDefs": [
                {'bSortable': true, 'aTargets': 0}

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

        t.on('order.dt search.dt', function () {

            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {

                cell.innerHTML = i + 1;

            });

        }).draw();        //*initialize datatable

    });
    $('#sub_btn').click(function () {
        var sele_can = $('#hid_del').val();
		var employee_code = $('#employee_code').val();
		var emp_join_date = $('#emp_join_date').val();
		if(sele_can!="" && employee_code!="" && emp_join_date!="")
		{
			$.ajax({
				url: "candidateToEmployeeAction.php",
				type: "POST",
				data: {candi_id: sele_can,employee_code : employee_code,emp_join_date :emp_join_date},
				success: function (data) {
					$('#message').html(data).fadeOut(1000);
					//$('#selected_status').html(data);
					//$('#message').html(data);
					//alert(data);
					
				    window.location = "candidateToEmployee.php";
				}
			});
		} else {
			$('#err').html("Employee Code Is Required*");
		}
    });
</script>
<!--/ Page Specific Scripts -->




</body>

</html>
