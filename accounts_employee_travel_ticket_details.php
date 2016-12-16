<?php
$page = "accounts";
$tab = "accounts_work_plan";
$sub = "yearly_travel";
$sub1 = "accounts_employee_travel";
include("file_parts/header.php");
$employee_id= $_GET['employee_id'];
$emp_leave= $_GET['emp_leave'];
//echo $leave;die;
//$selectCandCode = $db->selectQuery("SELECT `employee_firstname`,`employee_employment_id` FROM `sm_employee` WHERE `employee_id`='$employee_id'");
 //count($selectCandCode);
 $selectCandCode = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,sm_employee.employee_employment_id,sm_employee_leave.leave_from,sm_employee_leave.leave_to FROM sm_employee INNER JOIN sm_employee_leave ON sm_employee.employee_id = sm_employee_leave.employee_id  WHERE sm_employee_leave.employee_id='$employee_id'");

 if (count($selectCandCode)) {
 
	  $employee_fname = $selectCandCode[0]['full_name'];
	  $employee_employment_id = $selectCandCode[0]['employee_employment_id'];
	//$employee_id = $selectCandCode[0]['employee_id'];
     
	 
	
 }

?>
<!--/ CONTROLS Content -->
<style>
    .addt_text:focus {
        outline: none;
    }

    .addt_text {
        background-color: transparent;
        border: 0px solid;
        height: 30px;
        width: 260px;
    }

    .file_status {
        color: #428bca;
    }
</style>
<!-- ====================================================
          ================= CONTENT ===============================
          ===================================================== -->
<section id="content">
    <div class="page page-forms-wizard">
        <div class="pageheader">
            <h2>Employee <span>Ticket Details</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> SME</a></li>
                    <li><a href="#">Employee</a></li>
                    <li><a href="#">Ticket Details</a></li>
                </ul>
            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Basic <span
                                class="badge badge-default pull-right wizard-step">1</span></a></li>
                    <li><a href="#tab2" data-toggle="tab">Ticket Details<span
                                class="badge badge-default pull-right wizard-step">2</span></a></li>
                    
                    <li><a href="#tab3" data-toggle="tab">Finish<span
                                class="badge badge-default pull-right wizard-step">3</span></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <form name="step1" role="form" id="step1">
						
					<!--	<?php if(isset($_GET['Form'])){?>
						<input type="hidden" name="form" value="1" />
						<?php } else { ?>
						<input type="hidden" name="form" value="" />
						<?php } ?>-->
						
                            <div class="row">
							<input value="<?php echo $employee_id; ?>" name="employee_id" type="hidden" />
                                <div class="form-group col-md-6">
                                    <label for="username">Name: </label>
                                    <input type="text" name="employee_name" value="<?php echo @$employee_fname ;?>" readonly="" class="form-control"
                                           data-parsley-trigger="change"
                                           pattern="/^[a-zA-Z ]+$/" required=""
                                           >
                                </div>
                            
								<div class="form-group col-md-6">
                                    <label for="companyname">Employee Code: </label>
                                    <input type="text" name="employee_employment_id" class="form-control" id="employee_employment_id" value="<?php echo @$employee_employment_id; ?>" readonly="">
                                <input type="hidden" name="travel_type_id" class="form-control" id="travel_type_id" value="1">
                                
								</div>
                                
                            </div>
                            <div class="row">
                             
                              <div class="form-group col-md-6">
                                    <label for="companyname">No:of Leaves: </label>
                                    <input type="text" name="employee_leaves" id="employee_leaves" readonly value="<?php echo @$emp_leave; ?>" class="form-control"
                                           >
                                </div>
								
								
								
                                <div class="form-group col-md-6">
                                    <label for="phone">Eligible for: </label>
                                    <select class="form-control mb-10" name="eligibility" id="eligibility">
                                        <option selected="" value=""> Select</option>
                                        <option value="up and down">Up and Down</option>
                                        <option value="up">Up</option>
                                        <option value="down">Down</option>
                                    </select>
									
                                </div>
								
								  <div class="form-group col-md-6">
                                    <label for="companyname">Cost: </label>
                                    <input type="text" name="travel_cost" id="travel_cost" class="form-control" 
                                                       data-parsley-type="digits" 
                                           >
                                </div>
                               <div class="row">
								
							
                             
								</div>
								<!--<div class="form-group col-md-6">
                                    <label for="companyname">Cost: </label>
                                    <input type="text" name="travel_cost" id="travel_cost" class="form-control"
                                           >
                                </div>
                             </div> -->
                            </div>
                          
                           
                            
                        </form>
                    </div>
                   
                      <div class="tab-pane" id="tab2">
                        <form name="step2" role="form" id="step2">
                         <h4 class="custom-font"><strong>Ticket Details </strong></h4>
                            
                                   <div class="row">
                                 <div class="form-group col-md-4">
                                    <label for="username">From: </label>
                                    <input type="text" name="from" id="from" class="form-control"
                                           data-parsley-trigger="change"
                                           pattern="/^[a-zA-Z ]+$/" required=""
                                           >
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="username">To: </label>
                                    <input type="text" name="to" id="to" class="form-control"
                                           data-parsley-trigger="change"
                                           pattern="/^[a-zA-Z ]+$/" required=""
                                           >
                                </div>
								
								
								
								
								<div class="form-group col-md-4 mb-0">
                                    <label for="scstart"> Departure Date:</label>
                                   <div class='input-group datepicker' data-format="L"> 
                                        <input type='text' class="form-control" name="departure_date"
                                               id="departure_date" required="" onkeydown="return false"/>
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span> 
                                    </div>
                                </div>
								<!-- <div class="form-group col-md-4">
                                    <label for="scstart">Departure: </label>
                                    <input type='text' name="departure_date" id="departure_date" class="form-control date_pick" onkeydown="return false"/>
                                </div>-->
                          
							   </div>
							    <div class="row">
								
									<div class="form-group col-md-4 mb-0">
                                    <label for="scstart"> Arrival Date:</label>
                                    <div class='input-group datepicker' data-format="L"> 
                                        <input type='text' class="form-control" name="return_date"
                                               id="return_date" required="" onkeydown="return false"/>
                                      <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
                                </div>
                               
                               <!-- <div class="form-group col-md-4 ">
                                    <label for="scstart">Return: </label>
                                    <input type='text' name="return_date" id="return_date" class="form-control date_pick" onkeydown="return false"/>

                                </div> -->
								<div class="form-group col-md-4 mb-0">
                                    <label for="username">Airport: </label>
                                    <input type="text" name="airport" id="airport" class="form-control"
                                         required="">
                                </div>
							    <div class="form-group col-md-4 mb-0">
                                    <label for="username">Flight: </label>
                                    <input type="text" name="flight" id="flight" class="form-control"
                                         required="">
                                </div>
								
                            </div>
                            <div class="row">
							
                            </div>
							
							<div class="row">
							       <div class="form-group col-md-4 mb-0">
                                    <label for="username">Flight Class: </label>
                                    <input type="text" name="flight_class" id="flight_class" class="form-control"
                                         required="">
                                </div>    
                            </div> 
                        </form>
                    
                        <form name="step3" role="form" id="step3">
                         <h4 class="custom-font"><strong>Ticket Details Down</strong></h4>
                            
                                   <div class="row">
                                 <div class="form-group col-md-4">
                                    <label for="username">From: </label>
                                    <input type="text" name="from_downs" id="from_downs" class="form-control"
                                           data-parsley-trigger="change"
                                           pattern="/^[a-zA-Z ]+$/" required=""
                                           >
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="username">To: </label>
                                    <input type="text" name="to_down" id="to_down" class="form-control"
                                           data-parsley-trigger="change"
                                           pattern="/^[a-zA-Z ]+$/" required=""
                                           >
                                </div>
								
								<div class="form-group col-md-4 mb-0">
                                    <label for="scstart"> Departure Date:</label>
                                    <div class='input-group datepicker' data-format="L">
                                        <input type='text' class="form-control" name="departure_date_down"
                                               id="departure_date_down" required="" onkeydown="return false"/>
                                      <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
                                </div>
								<!-- <div class="form-group col-md-4">
                                    <label for="scstart">Departure: </label>
                                    <input type='text' name="departure_date_down" id="departure_date_down" class="form-control date_pick" onkeydown="return false"/>
                                </div> -->
                          
							   </div>
							    <div class="row">
								<div class="form-group col-md-4 mb-0">
                                    <label for="scstart"> Arrival Date:</label>
                                  <div class='input-group datepicker' data-format="L">
                                        <input type='text' class="form-control" name="return_date_down"
                                               id="return_date_down" required="" onkeydown="return false"/>
                                       <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>  
                                    </div>
                                </div>
                               <!-- <div class="form-group col-md-4 ">
                                    <label for="scstart">Return: </label>
                                    <input type='text' name="return_date_down" id="return_date_down" class="form-control date_pick" onkeydown="return false"/>

                                </div> -->
								<div class="form-group col-md-4 mb-0">
                                    <label for="username">Airport: </label>
                                    <input type="text" name="airport_down" id="airport_down" class="form-control"
                                         required="">
                                </div>
							    <div class="form-group col-md-4 mb-0">
                                    <label for="username">Flight: </label>
                                    <input type="text" name="flight_down" id="flight_down" class="form-control"
                                         required="">
                                </div>
								
                            </div>
                            <div class="row">
							
							
                            </div>
							
							<div class="row">
							       <div class="form-group col-md-4 mb-0">
                                    <label for="username">Flight Class: </label>
                                    <input type="text" name="flightclass_down" id="flightclass_down" class="form-control"
                                         required="">
                                </div>    
                            </div>
                        </form>
                    </div>


           
                    <div class="tab-pane" id="tab3">
                        <p class="well">Please check and make sure the details given are correct!</p>
                        <!--                        <form name="step7" role="form" novalidate>
                                                    <div class="checkbox">
                                                        <label class="checkbox checkbox-custom-alt">
                                                            <input type="checkbox" name="newsletter" id="newsletter" checked="">
                                                            <i></i> Receive notifications </label>
                                                    </div>
                                                </form>-->
                    </div>
                    <ul class="pager wizard">
                        <li class="previous">
                            <button class="btn btn-default">Previous</button>
                        </li>
                        <li class="next">
                            <button id="next_btn" class="btn btn-default">Next</button>
                        </li>
                        <li class="next finish" style="display:none;">
                            <button id="finish_btn" class="btn btn-success">Finish</button>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <span class="text-success mt-0 mb-20" id="SucM"></span>
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
<!-- The basic File Upload plugin -->
<!--/ vendor javascripts -->
<!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
<script src="assets/js/main.js"></script>


<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script>
                                                       $('body').on('click', '.date_pick', function () {
                                                           $(this).datepicker({
                                                               changeMonth: true,
                                                               changeYear: true,
                                                               dateFormat: "yy/mm/dd"
                                                           }).focus();
                                                           $(this).removeClass('datepicker');
                                                       });
</script>

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

  
	
	
	
	 $('#finish_btn').click(function () {
		 
		 var fdata=$('#step1,#step2').serialize();
		 var travel_eligibility     = $('#eligibility').val();
		 if(travel_eligibility==="up and down"){
			 fdata=fdata+"&"+$('#step3').serialize();
		 }
		// alert(fdata);
		 
		  $.ajax({
             url: "employee_travel_ticket_details_action.php",
            type: "POST",
		  data: fdata,                 
		  success: function (data) {
			   //  alert(data);   
				 $('#Succ').html("Data Updated Successfully");
              window.location = "accounts_employee_travel_booked.php";
			   
             }
			 });
  });
</script>
<script>
  $('#eligibility').change(function ()
    {
        var eligibility = $(this).val();
        if (eligibility == "up and down")
        {
            $('#step2').show('slow');
            $('#step3').show('slow');
        }
        
        if (eligibility == "up")
        {
            $('#step2').show('slow');
            $('#step3').hide('slow');
        }
		if (eligibility == "down")
        {
            $('#step2').show('slow');
            $('#step3').hide('slow');
        }
    });
</script>


<script>
 $('#departure_date').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true,onSelect: function(date) {
 $("#return_date").datepicker('option', 'minDate', date);} });
$('#return_date').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true});

  // $('#return_date').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true,onSelect: function(date) {
  // $("#departure_date_down").datepicker('option', 'minDate', date);} });
 // $('#departure_date_down').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true});

 $('#departure_date_down').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true,onSelect: function(date) {
 $("#return_date_down").datepicker('option', 'minDate', date);} });
$('#return_date_down').datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true});



</script>
</body>
</html>

