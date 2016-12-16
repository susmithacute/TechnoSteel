<?php
$success_msg="";
$page = "management";
$tab = "New_Login_list";


include('file_parts/header.php');

if(isset($_REQUEST["emp_id"]))
{
	$emp_id=$_REQUEST["emp_id"];
	
	$sql2=$db->selectQuery(" SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,sm_employee.employee_id,sm_employee.employee_employment_id,sm_employee.employee_company,sm_employee.employee_designation,sm_employee_login.employee_username,sm_employee_login.employee_password FROM sm_employee INNER JOIN sm_employee_login ON sm_employee.employee_id=sm_employee_login.employee_id WHERE sm_employee.employee_id='".$emp_id."'");
	if(count($sql2) > 0 )
	{
		$company_id=$sql2[0]["employee_company"];
		$designation=$sql2[0]["employee_designation"];
		$full_name=$sql2[0]["full_name"];
		$employee_id=$sql2[0]["employee_id"];
		$employee_employment_id=$sql2[0]["employee_employment_id"];
		$employee_username=$sql2[0]["employee_username"];
		$employee_password=$sql2[0]["employee_password"];
		
		
	}
}

if($_SERVER['REQUEST_METHOD']=='POST')
	{
	
$employee_id = $_REQUEST['employ_id'];
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

$values["employee_id"] = $employee_id;
$values["employee_username"]=$username;
$values["employee_password"]=$password;

$update = $db->secure_update("sm_employee_login",$values, "WHERE employee_id='$employee_id'");
if (count($update)) {
	  echo  $success_msg = "success";
echo "<script>location.href='employee_login_list.php'</script>";
		}
  else
		{

		$success_msg = "Error in updation";
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
            <h2>Add New Login<span></span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Employee</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Employee Management </a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Add New Login</a>
                    </li>
					
                    
                </ul>

            </div>

        </div>
        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
               <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Add New Login </a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">

                                                                <div class="form-group col-sm-6">
                                                                    <label for="company"> Company Name</label>
																	 <select class="form-control" name="company" id="company" readonly value="" required="">
																	<option selected="" value=""> Select</option>
																	<?php
																	$cmps = $db->selectQuery("SELECT `company_name`,`company_id` FROM `sm_company` WHERE company_status='1'");
																	if (count($cmps) > 0) {
																		for ($ei = 0; $ei < count($cmps); $ei++) {
																			?>
																			<option value="<?php echo $cmps[$ei]['company_id']; ?>"<?php if($cmps[$ei]['company_id']==@$company_id){ echo "selected";}?>><?php echo $cmps[$ei]['company_name']; ?></option>
																			<?php
																		}
																	}
																	?>
																</select>
                                                                </div>

                                                                <div class="form-group col-sm-6">
                                                                    <label for="last-name">Designation</label>
                                                                    <select class="form-control" name="designation" readonly value="" id="designation" required="">
																	<option selected="" value=""> Select</option>
																	<?php
																	$select = $db->selectQuery("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE designation_status='1'");
																	if (count($select) > 0) {
																		for ($ei = 0; $ei < count($select); $ei++) {
																			?>
																			<option value="<?php echo $select[$ei]['designation_id']; ?>"<?php if($select[$ei]['designation_name']==@$designation){ echo "selected";}?>><?php echo $select[$ei]['designation_name']; ?></option>
																			<?php
																		}
																	}
																	?>
																</select>
                                                                </div>

                                                            </div>
															 <div class="row">
																<div class="form-group col-sm-6">
                                                                    <label for="address2">Employee Name</label>
                                                                    <select class="form-control" readonly value="" name="emp_name" id="emp_name" >
																	<option value=""><?php echo @$full_name; ?></option>
									                           </select>
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="emp_id">Employee Id</label>
                                                                
																	<input type="text" name="emp_id" id="emp_id"readonly value="<?php echo @$employee_employment_id;?>" class="form-control" > 
                                                                </div>
															<input type="hidden" value="<?php echo @$employee_id;?>" name="employ_id" >
                                                            </div>
															 <div class="row">

                                                                <div class="form-group col-sm-6">
                                                                    <label for="username">Username</label>
                                                                    <input type="text" class="form-control" name="username" id="username" value="<?php echo @$employee_username;?>" required="">
                                                                </div>
                                                     

                                                                <div class="form-group col-sm-6">
                                                                    <label for="password">Password</label>
                                                                    <input type="password" name="password" class="form-control" id="password" value="<?php echo @$employee_password;?>" required="">
                                                                </div>

                                                            </div>
															
                                             <span class="validate_span" id = "exist_status"></span>
                                                    
															
																<button type="submit" id="finish-btn"  style="margin-bottom:15px" class="btn btn-success pull-right">Submit</button>
															

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
$(document).ready(function () {
    $("#form1").submit(function () {
        $(".btn .btn-success").attr("disabled", true);
        return true;
    });
});
</script>


<!--/ Page Specific Scripts -->

<script>
    $('#designation').change(function () {
        var designation = $(this).val();
		var company = $('#company').val();
		 $.ajax({
            url: "employee_login_ajax.php",
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
        var emp_name = $(this).val();
		$.ajax({
            url: "employee_login_id_ajax.php",
            type: "POST",
            data: {emp_name: emp_name},
            success: function (data) {
				//alert(data);
                $('#emp_id').val(data);
            }
        });
    });
	</script>
	<script>

$('#username').on('blur', function (e) {
    var username = jQuery('#username').val();
  // $('#exist_status').html('Please wait...');
    if(username != ""){
    $.ajax({
        url: 'username_check.php',
        type: 'POST',
        dataType: 'json',
        data: {username: username},
        success: function (data) {
            $('#exist_status').html(data.Status);
            var ch2 = data.data_val;
            if (ch2 == 0) {
                $('#username').val('');
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
