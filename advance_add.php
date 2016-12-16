<?php
$success_msg="";
//$success_msg1 ="";
$page = "payroll";
//$tab = "employee_salary";
$sub = "advance_add_add";
$head = "";
$head1 = "";
$sub1 = "advance_add";
$tab1 = "";


include('file_parts/header.php');	
if($_SERVER['REQUEST_METHOD']=='POST')
	{
	$company=$_REQUEST['company_id'];
	$designation=$_REQUEST['designation_id'];
	$cur_sal=$_REQUEST['cur_sal'];
$req_amount = $_REQUEST['req_amount'];
$employee_id=$_REQUEST['emp_name'];
$originalDate = explode("-",$_REQUEST['req_date']);
$advance_date = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
$values["company"] = $company;
$values["designation"] = $designation;
$values["advance_amount"] = $req_amount;
$values["employee_id"]=$employee_id;
$values["advance_requested_date"]=$advance_date;
//echo "<pre>";print_r $values;die;

  $insert = $db->secure_insert("sm_salary_advance", $values);
   if (count($insert)) {
	  echo  $success_msg = "success";
      echo "<script>location.href='advance_requested.php'</script>";
		}
    else
		{

		$success_msg = "Error in insertion";
		} 
		
}
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<style>
.validate_span {
        color: #ff7b76 !important;
        font-size: 12px;
        line-height: 0.9em;
        list-style-type: none;
    }
</style>

<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">

            <h2> Advance <span>Salary</span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Accounting </a>
                    </li>
					<li>
                        <a href="javascript:void(0)"> Salary</a>
                    </li>
					<li>
                        <a href="javascript:void(0)"> Advance salary</a>
                    </li>
                    <li>
                     <!--   <a href="javascript:void(0)">Add Model</a>-->
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab"> Advance Salary </a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">
							     <div class="form-group col-sm-6">
                                                                    <label for="company"> Company Name</label>
																	 <select class="form-control" name="company_id" id="company_id" required="">
																	<option selected="" value=""> Select</option>
																	<?php
																	$cmps = $db->selectQuery("SELECT `company_name`,`company_id` FROM `sm_company` WHERE company_status='1'");
																	if (count($cmps) > 0) {
																		for ($ei = 0; $ei < count($cmps); $ei++) {
																			?>
																			<option value="<?php echo $cmps[$ei]['company_id']; ?>"><?php echo $cmps[$ei]['company_name']; ?></option>
																			<?php
																		}
																	}
																	?>
																</select>
                                                                </div>
																<div class="form-group col-sm-6">
                                                                    <label for="last-name">Designation</label>
                                                                    <select class="form-control" name="designation_id" id="designation_id" required="">
																	<option selected="" value=""> Select</option>
																	<?php
																	$select = $db->selectQuery("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE designation_status='1'");
																	if (count($select) > 0) {
																		for ($ei = 0; $ei < count($select); $ei++) {
																			?>
																			<option value="<?php echo $select[$ei]['designation_id']; ?>"><?php echo $select[$ei]['designation_name']; ?></option>
																			<?php
																		}
																	}
																	?>
																</select>
                                                                </div>
								<div class="form-group col-sm-6">
                                                                    <label for="emp_name">Employee Name</label>
                                                                    <select class="form-control" name="emp_name" id="emp_name" required="" >
									                           </select>
                                                          </div>
								
								<div class="form-group col-md-6">
                                    <label for="username">Current Salary: </label>
                                    
									
									<input type="text" name="cur_sal" id="cur_sal" class="form-control" > 
                                
								</div>
	<div class="form-group col-md-6">
                                    <label for="username">Requested Amount: </label>
                                    <input type="text" name="req_amount" id="req_amount" class="form-control" required>
                                </div>
                       
						
						<div class="form-group col-md-6 mb-0">

                                    <label for="prend">Requested Date: </label>


                                        <input type='text' class="form-control" name="req_date"
                                               id="req_date" required="" />

                                       
                                

                                </div>
                        
						
						  <span style="padding-left:0px" id = "exist_status" class="validate_span"></span>
                         <span style="padding-left:15px" id = "user_exist_status" class="validate_span"></span>
						  
						<ul class="pager wizard" style="margin-right:17%;">
							<li class="next finish" style="display:none;">
							 <button class="btn btn-success" name="submit" id="submit_btn" type="submit">Add</button>
								<!--	<input type="submit" name="submit" value="add"> -->
							</li>
						</ul>
						 </div>

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
    <!-- /page content -->

</div>

</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->

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

<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>




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
  $(function() {
       //$("#req_date").datepicker({dateFormat: 'dd-mm-yy'});
       $("#req_date").datepicker({maxDate: 0,dateFormat: 'dd-mm-yy'});
         });
	
</script>
<script>
    $(window).load(function () {
		//$( "#req_date" ).daterangepicker({  maxDate: new Date() });
		
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
</script>
   <script>
    $('#designation_id').change(function () {
        var designation = $(this).val();
		var company = $('#company_id').val();
		 $.ajax({
            url: "advance_addName_ajax.php",
            type: "POST",
            data: {designation: designation,company:company},
            success: function (data) {
				//alert(data);
                $('#emp_name').html(data);
            }
        });
    });
	</script>
	
	<script>
    $('#emp_name').change(function () {
        var manufacturer = $(this).val();
        $.ajax({
            url: "advance_add_ajax.php",
            type: "POST",
            data: {manufacturer: manufacturer},
            success: function (data) {
                $('#cur_sal').val(data);
            }
        });
    });
	</script>
	
<!--/ Page Specific Scripts -->

	
	<script>
$('#req_amount').on('blur', function (e) {
    var req_amount = jQuery('#req_amount').val(); 
    var emp_name = jQuery('#emp_name').val(); 	
    if(req_amount != ""){
    $.ajax({
        url: 'advance_salaryCheck_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {req_amount: req_amount,emp_name: emp_name},
        success: function (data) {
            $('#exist_status').html(data.Status);
            var ch2 = data.data_val;
            if (ch2 == 0) {
                $('#req_amount').val('');
            }
            if (ch2 == 1) {

            }

        }
    });
}
    });
	</script>
	
	<script>
$('#req_date').on('blur', function (e) {
    var req_date = jQuery('#req_date').val(); 
    var emp_name = jQuery('#emp_name').val(); 	
    if(req_date != ""){
    $.ajax({
        url: 'advance_add_dateCheck.php',
        type: 'POST',
        dataType: 'json',
        data: {req_date: req_date,emp_name: emp_name},
        success: function (data) {
			$('#user_exist_status').fadeIn();
            $('#user_exist_status').html(data.Status).fadeOut(3000);
            var ch2 = data.data_val;
            if (ch2 == 0) {
                $('#req_date').val('');
            }
            if (ch2 == 1) {

            }

        }
    });
}
    });
	</script>

</body>
</html>
