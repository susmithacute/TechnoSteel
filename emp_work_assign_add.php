<?php
$page = "employee";
$tab = "work_assign";
$sub = "e_add";
$sub1 = "assign_add";
//$sub1 == "assign_add";
$head = "";
$head1 = "";
$success_msg = "";
include('file_parts/header.php');

 
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">

            <h2> Employee <span>Assignment</span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Worksite</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"> Job Position</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"> Assign Employee</a>
                    </li>

                </ul>

            </div>

        </div>


        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab"> Add Employee </a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="step1"  method="post" action="">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="username">Title: </label>
                                    <input type="text"  name="title" id="title" class="form-control" required="">
                                </div>

                                <div class="col-md-6">
                                    <label for="username">Type: </label>
                                    <select class="form-control" name="type" id="type" data-parsley-trigger="change" required="">
                                        <option selected="" value="">Select</option>
                                        <option  value="Inhouse">Inhouse</option>
                                        <option  value="External">External</option>

                                    </select>
                                </div>
                            </div>
										
                            <div class="selected_result" style="display: none">	
                                <div class="tab-pane" id="tab2">
                                    <noscript><input type="hidden" name="redirect" value=""></noscript>


                                    <div class="row fileupload-buttonbar">


                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="phone">Requirements: </label>
                                                <select class="form-control" name="requirements" id="requirements" >
                                                    <option selected="" value=""> Select</option>
                                                    <?php
                                                    $man = $db->selectQuery("SELECT `requirement`,`id` FROM `sm_external_demands`");
                                                    if (count($man) > 0) {
                                                        for ($ei = 0; $ei < count($man); $ei++) {
                                                            ?>
                                                            <option value="<?php echo $man[$ei]['id']; ?>"><?php echo $man[$ei]['requirement']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
											
											<div class="col-md-6" >
                                  
								   <label for="username">Designation: </label>
								<select class="form-control" name="designations" id="designations">
								</select>
                                        
                                </div>

                                            <div class="col-md-6">
                                                <label for="username">No.of Employees: </label>
                                                <input type="text"  name="employees" id="employees" class="form-control emp_num" readonly="">


                                            </div>


                                        </div>

                                        <span class="error" id="error"></span>



                                        <input type="hidden" name="medical_result" id ="leave_results" value="" />

                                    </div>

                                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                </div>
                            </div>
                            <div class="selected_data" style="display: none">	
                                <div class="tab-pane" id="tab2">
                                    <noscript><input type="hidden" name="redirect" value=""></noscript>


                                    <div class="row fileupload-buttonbar">


                                        <div class="row">
										
										 <div class="col-md-6">
                                                <label for="phone">Requirements: </label>
                                                <select class="form-control" name="titles" id="titles" >
                                                    <option selected="" value=""> Select</option>
                                                    <?php
                                                    $man = $db->selectQuery("SELECT sm_inhouse_requirement.title,sm_inhouse_requirement.id,sm_requirements.id FROM sm_requirements INNER JOIN sm_inhouse_requirement ON sm_inhouse_requirement.id=sm_requirements.id WHERE sm_inhouse_requirement.status = 'active' AND sm_requirements.process_status='pending' AND sm_requirements.status='active' GROUP BY sm_inhouse_requirement.title");
                                                    if (count($man) > 0) {
                                                        for ($ei = 0; $ei < count($man); $ei++) {
                                                            ?>
                                                            <option value="<?php echo $man[$ei]['id']; ?>"><?php echo $man[$ei]['title']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
										
										
											<div class="col-md-6">
																<label for="phone">Job Position: </label>
																<select class="form-control" name="job_position" id="job_position" >
																</select>
											</div>
										
										
											
                                           
											
											<div class="col-md-6">
                                                <label for="username">Category: </label>
                                                <input type="text"  name="category" id="category" class="form-control emp_num" readonly="">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="username">No.of Employees: </label>
                                                <input type="text"  name="employees_inhouse" id="employees" class="form-control emp_num" readonly="">


                                            </div>


                                        </div>

                                        <span class="error" id="error"></span>



                                        <input type="hidden" name="medical_result" id ="leave_results" value="" />

                                    </div>

                                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6 work">
                                        <label for="phone">Work site: </label>
                                        <select class="form-control" name="work_site_id" id="work_site_id" readonly=""><span id="exist_status" class="validate_span"></span>
                                            <option selected="" value=""> Select</option>
                                            <?php
                                            $manuf = $db->selectQuery("SELECT `work_site`,`id` FROM `sm_work_site`");
                                            if (count($manuf) > 0) {
                                                for ($ei = 0; $ei < count($manuf); $ei++) {
                                                    ?>
                                                    <option value="<?php echo $manuf[$ei]['id']; ?>"><?php echo $manuf[$ei]['work_site']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    
                                </div>

                              <div class="col-md-6 designation">
                                    <label for="username">Designation: </label>
                                    <select class="form-control" name="designation_id" id="designation_id" readonly="">
                                        <option selected="" value=""> Select</option>
                                        <?php
                                        $manuf = $db->selectQuery("SELECT `designation_name`,`designation_id` FROM `sm_designation`");
                                        if (count($manuf) > 0) {
                                            for ($ei = 0; $ei < count($manuf); $ei++) {
                                                ?>
                                                <option value="<?php echo $manuf[$ei]['designation_id']; ?>"><?php echo $manuf[$ei]['designation_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Date Assign From:</label>
                                   <!-- <div class='input-group datepicker' data-format="L">  -->
                                        <input type="text" name="date_assign_from" id="date_assign_from" class="form-control" readonly="" />
                                       <!-- <span class="input-group-addon"> <span class="fa fa-calendar"></span> 
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <label>Date Assign To:</label>
                                    <div class='input-group datepicker' data-format="L">
                                        <input type="text" name="date_assign_to" id="date_assign_to" class="form-control" readonly=""/>
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> 
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="username">Employee names: </label>
                                    <select class="form-control" name="employee_id[]" id="employee_id"  multiple>

                                    </select>
									<div class="col-md-8">
                                    <p style="color:red;" id = "employee_exceed"></p>
                                </div>
                                </div>
								
                                <div class="col-md-6">
                                    <p style="color:red;" id = "exist_status"></p>
                                </div>
                            </div>
							
<ul class="pager wizard" style="margin-right:17%;">
                        <li class="next finish" >
                           

                             <button class="btn btn-success" type="button" id="finish_btn">Finish</button>

                        </li>
                    </ul>
                        </form> 	
                    </div>



                    




                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <h4 style="margin-left:30px;" class="text-success mt-0 mb-20" id="partner_succes"><?php echo $success_msg; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</section>


<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->

</script>
<script src="assets/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="assets/js/vendor/parsley/parsley.min.js"></script>

<script src="assets/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>




<!--/ vendor javascripts -->




<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="assets/js/main.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">




<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->


<script>
    $(window).load(function () {

        $('#rootwizard').bootstrapWizard({
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }

            },
            onNext: function (tab, navigation, index) {

                var form = $('form[name="step' + index + '"]');

                form.parsley().validate();

                if (!form.parsley().isValid()) {
                    return false;
                }

            },
            onTabClick: function (tab, navigation, index) {

                var form = $('form[name="step' + (index + 1) + '"]');
                form.parsley().validate();

                if (!form.parsley().isValid()) {
                    return false;
                }

            }

        });
		
		});
		
		
		 var last_valid_selection = null;
          $('#employee_id').change(function(event) {
			var employees =$('.emp_num').val();
            if ($(this).val().length > employees) {
			$("#employee_exceed").html("Employee Requirement Exceed Limit")
              $(this).val(last_valid_selection);
            }
			else {
              last_valid_selection = $(this).val();
            }
          });
    
</script>

<script>
    function designation(desig) {
        var designation = desig;
        var date_assign_from = $('#date_assign_from').val();
        var date_assign_to = $('#date_assign_to').val();
        $.ajax({
            url: "emp_work_assign_add_ajax.php",
            type: "POST",
            data: {designation: designation, date_assign_from: date_assign_from, date_assign_to: date_assign_to},
            success: function (data) {
                $('#employee_id').html(data);
            }
        });
    }
  $('#designation_id').change(function () {
        var designation = $(this).val();
        var date_assign_from = $('#date_assign_from').val();
        var date_assign_to = $('#date_assign_to').val();
		
		
        $.ajax({
            url: "emp_work_assign_add_ajax.php",
            type: "POST",
            data: {designation: designation, date_assign_from: date_assign_from, date_assign_to: date_assign_to},
            success: function (data) {
                //alert(data);
                $('#employee_id').html(data);
            }
        });
    });
    $('#type').change(function () {
        var external_val = $(this).val();
        $('#leave_results').val(external_val);
        if (external_val == "External")
        {
            $('.selected_result').show();
            $('.work').hide();
			 $('.selected_data').hide();
        } else if (external_val == "Inhouse") {
            $('.selected_result').hide();
			 $('.selected_data').show();
            $('.work').show();
			$('.designation').hide();
        } else {
			 $('.selected_data').hide();
            $('.selected_result').hide();
            $('.work').show();
        }
    });
	
	$('#type').change(function () {
        var external_val = $(this).val();
        $('#leave_results').val(external_val);
        if (external_val == "External")
        {
            $('.selected_result').show();
            $('.designation').hide();
			 $('.selected_data').hide();
        } else if (external_val == "Inhouse") {
            $('.selected_result').hide();
			 $('.selected_data').show();
            $('.designation').hide();
        } else {
			 $('.selected_data').hide();
            $('.selected_result').hide();
            $('.designation').show();
        }
    });
	


    $('#designations').change(function () {
        var des = $(this).val();
        //alert(des);	
        $.ajax({
            url: "emp_work_assign_action.php",
            dataType: "json",
            method: "POST",
            data: {des: des},
            success: function (data) {
                //alert(data);
             
                $('#date_assign_from').val(data.from);
                $('#date_assign_to').val(data.to);
                $('#employees').val(data.resources);
                //$('#designation_id').val(data.designation);
                var desig = $('#designations').val();
                designation(desig);
            }
        });
    });
	
	
	
	
    $('#job_position').change(function () {
        var job_position = $(this).val();
		var title_id = $('#titles').val();
        
        $.ajax({
            url: "emp_inhouse_work_action.php",
            dataType: "json",
            method: "POST",
            data: {job_position: job_position,title_id:title_id},
            success: function (data) {
                $('#date_assign_from').val(data.from);
                $('#date_assign_to').val(data.to);
               // $('#designation_id').val(data.designation);
                $('.emp_num').val(data.resources);
				$('#work_site_id').val(data.site_id);
				$('#category').val(data.category);
				var desig = $('#job_position').val();
                designation(desig);
            }
        });
    });
	
	$('#requirements').change(function () {
            var requirements = $(this).val();
			//alert(requirements);	
            $.ajax({
                url: "emp_ajax.php",
                type: "POST",
                data: {requirements: requirements},
                success: function (data) {
					//alert(data);
                    $('#designations').html(data);
                }
            });

        });
		
		$('#titles').change(function () {
			//alert("dgfd");
            var titles = $(this).val();
			//alert(requirements);	
            $.ajax({
                url: "emp_ajax.php",
                type: "POST",
                data: {titles: titles},
                success: function (data) {
					//alert(data);
                    $('#job_position').html(data);
                }
            });

        });
		
		
	 $('#finish_btn').click(function () {
		var type = $('#type').val();
		if(type!="")
		{
			var fdata = $('#step1').serialize();
			//alert(fdata);		 
			  $.ajax({
				 url: "emp_work_assign_action.php",
				type: "POST",
				 
				data:fdata,	
				success: function (data) {
					//alert(data);
			 window.location = "emp_title_list.php";
				   
				 }
				 });
		}
		
  });
  
  
	
</script>
<script>
$('#date_assign_from').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true,onSelect: function(date) {
$("#date_assign_to").datepicker('option', 'minDate', date);} });
$('#date_assign_to').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
</script>
</body>
</html>
