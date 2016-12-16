<?php
$success_msg = "";
$page = "accounts";
$tab = "accounts_employee_travel";
$sub = "accounts_employee_other_travel";
$sub1 = "accounts_employee_other_travel_booked";
include('file_parts/header.php');
	//$employee_id=$_GET["employee_id"];
?>

<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-profile">

        <div class="pageheader">

            <h2>Profile </h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> Sponsor Master</a>
                    </li>
                    <li>
                        <a href="#">Employee</a>
                    </li>
                    <li>
                        <a href="partner_list.php">Employee Travel</a>
                    </li>
                    <li>
                        <a href="#">Profile </a>
                    </li>
                </ul>

            </div>

        </div>
        <div class="pagecontent">
            <div class="row">
                <?php
				$employee_id=$_REQUEST['employee_id'];
                $resPartner = $db->selectQuery("select * from sm_employee_travel where employee_id='$employee_id' ");
                if (count($resPartner)) {
                   // $employee_name = $resPartner[0]['id'];
                   $employee_code        = $resPartner[0]['employee_employment_id'];
                   $travel_place         = $resPartner[0]['travel_place'];
                   $travel_purpose       = $resPartner[0]['travel_purpose'];
                   $travel_duration      = $resPartner[0]['travel_duration'];
                   $travel_cost          = $resPartner[0]['travel_cost'];
                   $travel_details       = $resPartner[0]['travel_details'];
                   $travel_eligibility   = $resPartner[0]['travel_eligibility'];
				   
				   
                   $travel_from          = $resPartner[0]['travel_from'];
                   $travel_to            = $resPartner[0]['travel_to'];
                 //  $departure_date       = $resPartner[0]['travel_departure_date'];
				   //$return_date          = $resPartner[0]['travel_return_date'];
				   
				   		   
				   $travel_from_db = explode("-", $resPartner[0]['travel_departure_date']);
				   $departure_date = $travel_from_db[2]."/".$travel_from_db[1]."/".$travel_from_db[0];
                   
				    $travel_to_db = explode("-", $resPartner[0]['travel_return_date']);
				    $return_date = $travel_to_db[2]."/".$travel_to_db[1]."/".$travel_to_db[0];
                   $travel_airport       = $resPartner[0]['travel_airport'];
                   $travel_flight        = $resPartner[0]['travel_flight'];
				   $travel_flight_class  = $resPartner[0]['travel_flight_class'];
				   
				   
				    $travel_from_down 		      = $resPartner[0]['travel_from_down'];
				       $travel_to_down 		          = $resPartner[0]['travel_to_down'];
				     //  $travel_departure_date_down 	  = $resPartner[0]['travel_departure_date_down'];
				      // $travel_return_date_down 	  = $resPartner[0]['travel_return_date_down'];
					   
					$travel_departure_date2      = explode("-", $resPartner[0]['travel_departure_date_down']);
				   $travel_departure_date_down= $travel_departure_date2[2]."/".$travel_departure_date2[1]."/".$travel_departure_date2[0];
				   $travel_return_date2      = explode("-", $resPartner[0]['travel_return_date_down']);
				   $travel_return_date_down = $travel_return_date2[2]."/".$travel_return_date2[1]."/".$travel_return_date2[0];

				       $travel_airport_down 	      = $resPartner[0]['travel_airport_down'];
				       $travel_flight_down 	          = $resPartner[0]['travel_flight_down'];
				       $travel_flight_class_down 	  = $resPartner[0]['travel_flight_class_down'];
                   // $par = $resPartner[0]['par'];
                   // $company = $resPartner[0]['company'];
				   
				   
				   
					$select = $db->selectQuery("select CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name from `sm_employee` WHERE `employee_id`='$employee_id'");
			                            
                                        if (count($select)) {
											$employee_firstname = $select[0]['full_name'];
										}
										
										
$dpImg = "";
$resLogo = $db->selectQuery("SELECT * FROM `sm_employee_files` WHERE `file_title`='Profile_Picture' AND `file_status`='1' AND `employee_id`='$employee_id'");
if (count($resLogo) && file_exists($resLogo[0]['file_name'])) {
    $dpImg = $resLogo[0]['file_name'];
} else {
    $dpImg = "assets/images/profile-default.png";
}
                    ?>

 <div class="col-md-4">



                        <!-- tile -->

                        <section class="tile tile-simple">



                            <!-- tile widget -->

                            <div class="tile-widget p-30 text-center">
                                    <div class="thumb thumb-xl">

                                        <img class="img-circle" src="<?php echo $dpImg; ?>" alt="">

                                    </div>
                                <h4 class="mb-0"><?php echo $employee_firstname; ?></h4>

                       
                            </div>

                            <div class="tile-body text-center bg-blue p-0">


                            </div>
  </section>

                        <!-- /tile -->
                    </div>

               
                    <div class="col-md-8">

                        <!-- tile -->
                        <section class="tile tile-simple">

                            <!-- tile body -->
                            <div class="tile-body p-0">

                                <div role="tabpanel">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tabs-dark" role="tablist">
                                        <li role="presentation" ><a style="color:#16a085;" href="accounts_employee_other_travel_booked_profile.php?employee_id=<?php echo $_GET['employee_id']?>" >Profile</a></li>
										<li role="presentation"><a href="accounts_employee_other_travel_booked_edit.php?employee_id=<?php echo $_GET['employee_id']?>">Edit</a></li>
										<!--<li role="presentation"><a href="#settingsTab" aria-controls="settingsTab" role="tab" data-toggle="tab">Downloads</a></li>-->
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">


                                        <div role="tabpanel" class="tab-pane active" id="settingsTab">

                                            <div class="wrap-reset">

                                                <form name="form4" role="form" id="form4"  method="post" enctype="multipart/form-data">

                                                    <div class="row">
                                                        <div class="form-group col-md-12 legend">
                                                            <h4><strong>Employee</strong> Profile</h4>
                                                            <!--<p><a href="partner_edit.php?id=<?php //echo $_GET['id']?>">  <span style="padding: 0px 0px 0px 386px;    font-size: 18px;color: #428bca">Edit Profile</span></a>-->                                                                                                                                                </p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
													
													<div class="form-group col-md-4">
                                    <label for="phone">Employee Designation</label>
                                        <?php
                                        $emp_designation = $db->selectQuery("select `employee_designation` FROM `sm_employee` WHERE `employee_id`='$employee_id'");
			                             if (count($emp_designation)) {
											 $emp_desig = $emp_designation[0]['employee_designation'];
										
			                               }?>
									<input type="text" class="form-control" id="first-name" name="parid" value="<?php echo @$emp_desig; ?>" disabled>
                                                
                                   
                                </div>
														
			                    <div class="form-group col-md-4">
                                    <label for="phone">Employee Name</label>
                                        <?php
                                        $select = $db->selectQuery("select CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name from `sm_employee` WHERE `employee_id`='$employee_id'");
			                            // if (count($select)) {
										
			                               // }
									

                                        if (count($select)) {
											
                                            for ($rt = 0; $rt < count($select); $rt++) {
												 $employee_firstname = $select[0]['full_name'];
                                                ?>
												<input type="text" class="form-control" id="first-name" name="parid" value="<?php echo $employee_firstname; ?>" disabled>
                                                
                                                <?php
                                            }
                                        }
                                        ?>
                                   
                                </div>
                                                        <div class="form-group col-sm-4">

                                                            <label for="first-name">Employee Code</label>

															<input type="text" class="form-control" id="first-name" name="parid" value="<?php echo $employee_code; ?>" disabled>
                                                               
                                                            </select>

                                                        </div>
                                                    </div>

                                                   <div class="row">
							 
                               
								<div class="form-group col-md-4">
                                    <label for="companyname">Place of visit: </label>
                                    <input type="text" name="place_of_visit" id="place_of_visit" class="form-control" value="<?php echo $travel_place; ?>" disabled >
                                </div>
								
								<div class="form-group col-md-4">
                                    <label for="companyname">Purpose of visit: </label>
                                    <input type="text" name="purpose_of_visit" id="purpose_of_visit" class="form-control" value="<?php echo $travel_purpose; ?>" disabled  >
                                </div>
								
								<div class="form-group col-md-4">
                                    <label for="companyname">Duration in days: </label>
                                    <input type="text" name="duration" id="duration" class="form-control" value="<?php echo $travel_duration; ?>" disabled >
                                </div>
                               
                               
                            </div>
							 <div class="row">
                             
                               <div class="form-group col-md-4">
                                    <label for="companyname">Cost: </label>
                                    <input type="text" name="cost" id="cost" class="form-control" value="<?php echo $travel_cost; ?>" disabled
                                           >
                                </div>
								
								<div class="form-group col-md-4">
                                    <label for="companyname">Travel details: </label>
                                    <input type="text" name="travel_details" id="travel_details" class="form-control" value="<?php echo $travel_details; ?>" disabled
                                           >
                                </div>
								
								<div class="form-group col-md-4">
                                    <label for="companyname">Ticket: </label>
                                    
										   <input type="text" name="ticket" id="ticket" class="form-control" value="<?php echo $travel_eligibility; ?>" disabled
                                           >
										   <!--<select class="form-control" name="ticket" id="ticket" value="<?php echo $travel_eligibility; ?>">
                                        <option selected="" value=""> Select </option>
                                        <option <?php //if($travel_eligibility == "One way"){ echo "selected"; }?> value="One way">One way</option>
                                        <option <?php// if($travel_eligibility == "Two way"){ echo "selected"; }?> value="Two way">Two way</option>
                                       
                                    </select>  -->
                                </div>
								</div>
									 <div id="up">
                                                    <div class="row">

                                                        <div class="form-group col-sm-6">
                                                            <label for="address1">From</label>
                                                            <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $travel_from; ?>" disabled>
                                                        </div>

                                                        <div class="form-group col-sm-6">
                                                            <label for="address2">To</label>
                                                            <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $travel_to; ?>" disabled>
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                        <div class="form-group col-sm-6">

                                                            <label for="first-name">Departure date</label>


                                                           <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $departure_date; ?>" disabled>

                                                        </div>

                                                        <div class="form-group col-sm-6">
                                                            <label for="address2">Arrival date:</label>
                                                            <input type="text" class="form-control" id="address2" name="email" value="<?php echo $return_date; ?>" disabled>
                                                        </div>

                                                    </div>
													
													
													<div class="row">

                                                        <div class="form-group col-sm-6">

                                                            <label for="first-name">Airport</label>


                                                           <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $travel_airport; ?>" disabled>

                                                        </div>

                                                        <div class="form-group col-sm-6">
                                                            <label for="address2">Flight:</label>
                                                            <input type="text" class="form-control" id="address2" name="email" value="<?php echo $travel_flight; ?>" disabled>
                                                        </div>

                                                    </div>
                                              
													
                                                    <div class="row">

                                                        <div class="form-group col-sm-6">
                                                            <label for="address1">Flight Class:</label>
                                                            <input type="text" class="form-control" id="address1" name="phone" value="<?php echo $travel_flight_class; ?>" data-parsley-trigger="change"                                                       data-parsley-type="digits" disabled>
                                                        </div>
                                                      
													  
													        </div>
													  
                                                    </div>
													
					<div id="down">
				<?php if(!empty($travel_from_down)){ ?>
										<h4 class="custom-font"><strong>Ticket Details Return</strong></h4>
                            
                                   <div class="row">
                            
								 <div class="form-group col-sm-6">
                                                            <label for="address1">From:</label>
                                                            <input type="text" class="form-control" id="from_down" name="from_down" value="<?php echo $travel_from_down; ?>" disabled>
                                                        </div>
                                                       <div class="form-group col-sm-6">
                                                            <label for="address1">To:</label>
                                                            <input type="text" class="form-control" id="to_down" name="to_down" value="<?php echo $travel_to_down; ?>"  disabled>
                                                        </div>
														</div>

								  <div class="row">
								<div class="form-group col-md-6 mb-0">
                                    <label for="scstart"> Departure Date:</label>
                                    <div class='input-group datepicker' data-format="L">
                                        <input type='text' class="form-control" name="departure_date_down"
                                               id="departure_date_down" required="" onkeydown="return false"   value="<?php echo $travel_departure_date_down; ?>"  disabled>
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
                                </div>
							
                          <div class="form-group col-md-6 mb-0">
                                    <label for="scstart"> Arrival Date:</label>
                                    <div class='input-group datepicker' data-format="L">
                                        <input type='text' class="form-control" name="return_date_down"
                                               id="return_date_down" required="" onkeydown="return false"  value="<?php echo $travel_return_date_down; ?>" disabled>
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
                                </div>
							   </div>
					
								 <div class="row">
								<div class="form-group col-md-6 mb-0">
                                    <label for="username">Airport: </label>
                                    <input type="text" name="airport_down" id="airport_down" class="form-control"
                                         required="" value="<?php echo $travel_airport_down; ?>" disabled>
                                </div>
							    <div class="form-group col-md-6 mb-0">
                                    <label for="username">Flight: </label>
                                    <input type="text" name="flight_down" id="flight_down" class="form-control"
                                         required="" value="<?php echo $travel_flight_down; ?>" disabled>
                                </div>
								
                            </div>
                           
							
							
                          
							
							<div class="row">
							       <div class="form-group col-md-6 mb-0">
                                    <label for="username">Flight Class: </label>
                                    <input type="text" name="flightclass_down" id="flightclass_down" class="form-control"
                                         required="" value="<?php echo $travel_flight_class_down; ?>" disabled>
                                </div>    
                            </div><?php } ?>
							  </div>
																			 
                        </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </section>
                    </div>
                <?php } ?>




            </div>
            <!-- /row -->

        </div>
        <!-- /page content -->

    </div>

</section>
<!--/ CONTENT -->

</div>
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

<script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

<script src="assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>
<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!--/ vendor javascripts -->




<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="assets/js/main.js"></script>
<script>
$(window).load(function () {
	<?php if($travel_eligibility == "One way"){?>
	$('#down').hide('slow');
	<?php } ?>

                           });
</script>
<script>
  $('#ticket').change(function ()
    {
        var eligibility = $(this).val();
		
        if (eligibility == "Two way")
        {alert(eligibility);
            $('#up').show();
            $('#down').show();
        } else {
			$('#up').show('slow');
			$('#down').hide('slow');
		}
		
    });
</script>
</body>
</html>
