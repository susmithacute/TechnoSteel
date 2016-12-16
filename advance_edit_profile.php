<?php
$success_msg="";
$page = "employee";
$tab = "employee_salary";
$sub = "advance_add_add";
$head = "";
$head1 = "";
$sub1 = "advance_requested";
$tab1 = "";

include('file_parts/header.php');
if(isset($_REQUEST["adv_id"]))
{
	$adv_id=$_REQUEST["adv_id"];
	//echo $adv_id;
	$sql2=$db->selectQuery(" SELECT sm_employee.employee_id,sm_employee.employee_company,sm_employee.employee_designation,sm_employee.employee_firstname,sm_employee.employee_salary,sm_salary_advance.advance_id,sm_salary_advance.advance_amount,sm_salary_advance.advance_requested_date,sm_company.company_name FROM sm_employee INNER JOIN sm_salary_advance ON sm_employee.employee_id=sm_salary_advance.employee_id INNER JOIN sm_company ON sm_employee.employee_company=sm_company.company_id WHERE sm_salary_advance.advance_id='".$adv_id."'");
	
	if(count($sql2) > 0 )
	{
		$employee_company=$sql2[0]["employee_company"];
		$company_name=$sql2[0]["company_name"];
		$employee_name=$sql2[0]["employee_firstname"];
		$employee_designation=$sql2[0]["employee_designation"];
		$name=$sql2[0]["employee_id"];
		$nam=$sql2[0]["employee_salary"];
		$advv_amt=$sql2[0]["advance_amount"];
		$datee =new DateTime($sql2[0]["advance_requested_date"]);
        $reqq_date = $datee->format("d/m/Y");
	}
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
$company=$_REQUEST['company_id'];
$designation=$_REQUEST['designation_id'];
$cur_sal = $_REQUEST['cur_sal'];
$req_amount = $_REQUEST['req_amount'];
$employee_id=$_REQUEST['emp_name'];
$originalDate = explode("/",$_REQUEST['req_date']);
$advance_date = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
$values["company"] = $company;
$values["designation"] = $designation;
$values["advance_amount"] = $req_amount;
$values["employee_id"]=$employee_id;
$values["advance_requested_date"]=$advance_date;
if ($req_amount<=$cur_sal){

$insert = $db->secure_update("sm_salary_advance", $values,"WHERE advance_id='$adv_id'");


if (count($insert)) {

	  echo  $success_msg = "success";

 echo "<script>location.href='advance_requested.php'</script>";
		}

		else

		{

		$success_msg = "Error in insertion";

  }
 }
 else{
	 echo $success_msg =  "Requested Amount Should Be Less Than Salary";
	 
 }

 
}

?>





<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
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
																	<input type="text" name="company_id" value="<?php echo $company_name; ?>" id="company_id" class="form-control" readonly>
																
                                                                </div>
																<div class="form-group col-sm-6">
                                                                    <label for="last-name">Designation</label>
																	<input type="text" name="designation_id" value="<?php echo $employee_designation; ?>" id="designation_id" class="form-control" readonly
									required> 
                                                                    
                                                                </div>
								<div class="form-group col-md-6">
                                    <label for="phone">Employee Name: </label>
									<input type="text" name="emp_name" value="<?php echo $employee_name; ?>" id="cur_sal" class="form-control" readonly
									required> 
                                   
                                </div>
								
								<div class="form-group col-md-6">
                                    <label for="username">Current Salary: </label>
                                    
									
									<input type="text" name="cur_sal" value="<?php echo $nam; ?>" id="cur_sal" class="form-control" readonly
									required> 
                                
								</div>
	<div class="form-group col-md-6">
                                    <label for="username">Requested Amount: </label>
                                    <input type="text" name="req_amount" value="<?php echo $advv_amt; ?>"id="req_amount" class="form-control" required readonly>
                                </div>
                        
						
						<div class="form-group col-md-6 mb-0">

                                    <label for="prend">Requested Date: </label>

                                    <div class='input-group datepicker' data-format="L">
                                        <input type='text' class="form-control" name="req_date" value="<?php echo $reqq_date; ?>"
                                               id="req_date" required="" readonly>

                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>

                                </div>
                        
						
						
                         
						   <div class="col-md-6">
                                    <p style="color:red;" id = "exist_status"></p>
                            </div>
						  
					
						 </div>

                            </m> 
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
</body>
</html>
