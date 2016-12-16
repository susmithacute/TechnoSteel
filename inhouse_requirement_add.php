<?php

$page = "employee";
$tab = "work_plan";
$sub = "inhouse_requirements";
$sub1="inhouse_add";

include("./file_parts/header.php");



?>

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

<section id="content">

    <div class="page page-forms-wizard">

       <div class="pageheader">

            <h2> Inhouse <span>Requirement</span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Requirement</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Inhouse Requirement</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Inhouse Requirement Add</a>
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

                    <li><a href="#tab1" data-toggle="tab">Basic <span

                                class="badge badge-default pull-right wizard-step">1</span></a></li>


                    <li><a href="#tab2" data-toggle="tab">Requirements<span

                                class="badge badge-default pull-right wizard-step">2</span></a></li>



                    



                </ul>

                <div class="tab-content">

                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="step1" role="form">
						<div class="row">
						
						<div class="form-group col-md-12">
                                    <label for="phone">Title: </label>
                                   <input type="text" name="title" id="title" class="form-control" required="" >
                                </div>
								</div>

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="phone">Work site: </label>
                                    <select class="form-control" required="" name="work_site_id" id="work_site_id" ><span id="exist_status" class="validate_span"></span>
                                        <option selected="" value=""> Select</option>
                                        <?php
                                        $manuf = $db->selectQuery("SELECT `work_site`,`id`,`site_location` FROM `sm_work_site`");
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

                                <div class="form-group col-md-6">
                                    <label for="phone">Work location: </label>
                                    <input type="text" name="work_location" id="work_location" class="form-control"  >
                                </div>

                            </div>

                            <div class="row">
								<div class="form-group col-md-6">
                                    <label for="username">Project Manager: </label>
                                    <input type="text" name="project_manager" id="project_manager" class="form-control">
                                </div>

								
								<div class="form-group col-md-6">
                                    <label for="username">Contact: </label>
                                    <input type="text" name="contact" id="contact" class="form-control" data-parsley-trigger="change"
                                                       data-parsley-type="digits">
                                </div>
                            </div>
							</div>
                           </form>
                          
                               <div class="tab-pane" id="tab2">

                        <form name="step2" id="step2" role="form" novalidate>
						
						 
                            <h4 class="custom-font"><strong>Requirement 1</strong></h4>
							<div class="row">
							
                                <input type="hidden" id="requirement_incrr" value="1">

                                <div class="form-group col-md-6">

                                    <label for="interview_job_position">Job Position: </label>

                                    <select class="form-control interview_job_position1"

                                            name="requirement[1][job_position]"

                                           >

                                        <option selected="" value=""> Select</option>

                                        <?php

                                        $select_job = $db->secure_select("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE `designation_status`='1'");

                                        if (count($select_job) > 0) {

                                            for ($ji = 0; $ji < count($select_job); $ji++) {

                                                ?>

                                                <option

                                                    value="<?php echo $select_job[$ji]['designation_id']; ?>"><?php echo $select_job[$ji]['designation_name']; ?></option>

                                                    <?php

                                                }

                                            }

                                            ?>

                                    </select>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="interview_category">Category: </label>

                                    <input type="text" name="requirement[1][category]"  class="form-control">

                                </div>

								

								<input type="hidden" name="req_value1" value="1" class="req_value1"/>

								

                                <div class="form-group col-md-12">

                                    <div class="skill_set">



                                    </div>

                                </div>

                           
                            
                    <div class="form-group col-md-6">
                        <label for="username">Date Assign From:</label>
                        <input type="text" name="requirement[1][date_assign_from]" id="date_assign_from" class="form-control" onkeydown="return false" />
					</div>
					
                
				
				
                    <div class="form-group col-md-6">
                        <label for="username">Date Assign To:</label>
                        <input type="text" name="requirement[1][date_assign_to]" id="date_assign_to"  class="form-control" onkeydown="return false"/>
					</div>
               
					
                                
					
								<div class="form-group col-md-6">
                                    <label for="username">No of employees required: </label>
                                    <input type="text" name="requirement[1][no_of_employees]"  class="form-control" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" data-parsley-trigger="change"
                                                       data-parsley-type="digits"  />
													   <span id="error" style="color: Red; display: none">Only digits are allowed</span>
                                </div>
								
								<input type="hidden" name="req_value1" value="1" class="req_value1"/>
								
                       </div>

                    

                    

                   

                           

                           

                            <h4 class="custom-font"><strong>Requirement 2</strong></h4>

                            <div class="row">

                                <input type="hidden" id="requirement_incr" value="2">

                                <div class="form-group col-md-6">

                                    <label for="interview_job_position">Job Position: </label>

                                    <select class="form-control interview_job_position2"

                                            name="requirement[2][job_position]"

                                            >

                                        <option selected="" value=""> Select</option>

                                        <?php

                                        $select_job = $db->secure_select("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE `designation_status`='1'");

                                        if (count($select_job) > 0) {

                                            for ($ji = 0; $ji < count($select_job); $ji++) {

                                                ?>

                                                <option

                                                    value="<?php echo $select_job[$ji]['designation_id']; ?>"><?php echo $select_job[$ji]['designation_name']; ?></option>

                                                    <?php

                                                }

                                            }

                                            ?>

                                    </select>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="interview_category">Category: </label>

                                    <input type="text" name="requirement[2][category]"  class="form-control">

                                </div>
							</div>
							
							<div class="row">
								
                <div class="form-group col-md-6">
                        <label for="username">Date Assign From:</label>
                        <input type="text" name="requirement[2][date_assign_from]" id="date_from" class="form-control" onkeydown="return false" />
					</div>
					
                
				
				
                    <div class="form-group col-md-6">
                        <label for="username">Date Assign To:</label>
                        <input type="text" name="requirement[2][date_assign_to]" id="date_to"  class="form-control" onkeydown="return false" />
                    </div>
					
               </div>
					
						 <div class="row">
								<div class="form-group col-md-6">
                                    <label for="username">No of employees required: </label>
                                    <input type="text" name="requirement[2][no_of_employees]"  class="form-control" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" data-parsley-trigger="change"
                                                       data-parsley-type="digits"  />
													   <span id="error" style="color: Red; display: none">Only digits are allowed</span>
                                </div>
								<input type="hidden" name="req_value2" value="2" class="req_value2"/>
								</div>
								
								

								

								
								
                         
								

                                

                         


                            <div class="requirement_div"></div>

                            <input type="hidden" id="requirement_val_incr" value="3"/>

							

							

                            <div class="row">

                                <div class="col-md-3">

                                    <button class="btn btn-success" id="requirement_add" type="button">Add New <i

                                            class="fa fa-plus"></i></button>

                                </div>

                            </div>

                        </form>

                    </div>

                    


                    


                    <ul class="pager wizard">



                        <li class="previous">



                            <button class="btn btn-default">Previous</button>



                        </li>





                        <li class="next">



                            <button class="btn btn-default">Next</button>



                        </li>



                        <li class="next finish" style="display:none;">



                            <button class="btn btn-success" type="button" id="finish_btn">Finish</button>



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



<!--/ vendor javascripts -->



<!-- ============================================



        ============== Custom JavaScripts ===============



        ============================================= -->



<script src="assets/js/main.js"></script>





<!--/ custom javascripts -->

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<!--<script>
                                                       $('body').on('click', '.date_pick', function () {
                                                           $(this).datepicker({
                                                               changeMonth: true,
                                                               changeYear: true,
                                                               dateFormat: "dd/mm/yy"
                                                           }).focus();
                                                           $(this).removeClass('datepicker');
                                                       });
</script>-->



<!-- ===============================================



        ============== Page Specific Scripts ===============



        ================================================ -->





<script type="text/javascript">





</script>

<script>
$('#date_assign_from').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true,onSelect: function(date) {
		$("#date_assign_to").datepicker('option', 'minDate', date);} });
$('#date_assign_to').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
</script>

<script>
$('#date_from').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true,onSelect: function(date) {
		$("#date_to").datepicker('option', 'minDate', date);} });
$('#date_to').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
</script>

<script>

    $('body').on('click', '.date_pick', function () {
var dt=$('.date_pick').val();                                                        
														$(this).datepicker( { 
             //minDate: '0', 
            beforeShow : function()
            {
                jQuery( this ).datepicker('option','minDate', jQuery('.date_pickf').val() );
            } , 
            altFormat: "dd-mm-yy", 
            dateFormat: 'dd-mm-yy'

        }).focus();
                                                          $(this).removeClass('datepicker');
                                                      });
													  $('body').on('click', '.date_pickf', function () {
														  
                                                          $(this).datepicker( { 
            maxDate: '0', 
            beforeShow : function()
            {
                jQuery( this ).datepicker('option','maxDate', jQuery('.date_pick').val() );
            },
            altFormat: "dd-mm-yy", 
            dateFormat: 'dd-mm-yy'

        }).focus();
                                                          $(this).removeClass('datepicker');
                                                      });
			
		
		

    $(window).load(function () {

        $('#rootwizard').bootstrapWizard({

            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;

                var $current = index + 1;

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

        $('#work_site_id').change(function () {

            var work_site_id = $(this).val();

            $.ajax({

                url: "inhouse_requirement_add_ajax.php",

                type: "POST",

                data: {work_site_id: work_site_id},

                success: function (data) {

                    $('#work_location').val(data);

                }

            });

        });
		

		

		 

		



        $('#finish_btn').click(function () {
			
		var fdata = $('#step1,#step2').serialize();
		 
		
		 
		  $.ajax({
             url: "inhouse_requirement_add_action.php",
            type: "POST",
             
			data:fdata,	
			success: function (data) {
				//alert(data);
			  window.location = "inhouse_requirement_list.php";
			   
             }
			 });
		
  });
  


        $('#requirement_add').click(function () {

            var requirement_add = "requirement_add";

            requirement_val_incr = $('#requirement_incr').val();

            added_val = + requirement_val_incr + 1;
			//alert(requirement_val_incr);
			


            $('.requirement_div').append ('<h4 class="custom-font">'

                    + '<strong> Requirement '  + added_val +  '</strong> </h4>'

                    + ' <div class="row">'

                    + '    <div class="form-group col-md-6">'
                    + '    <label for="interview_job_position">Job Position: </label>'
                    + '  <select class="form-control interview_job_position_more' + added_val + '" name="requirement[' + added_val + '][job_position]">'
                    + ' <option selected="" value=""> Select</option>'
<?php
$select_job = $db->secure_select("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE `designation_status`='1'");
if (count($select_job) > 0) {
                    for ($ji = 0; $ji < count($select_job); $ji++) {
                         ?>
                    +'  <option value="<?php echo $select_job[$ji]['designation_id']; ?>"><?php echo $select_job[$ji]['designation_name']; ?></option>'

                                                    <?php
                                                }
                                            }
                                            ?>
                    + '</select>'
                    + ' </div>'

                    + '<div class="form-group col-md-6">'
					+ ' <label for="interview_category">Category: </label>'
                + '<input type="text"  name="requirement[' + added_val + '][category]"  class="form-control"> '
                    + '</div>'

                    + '  </div>'
                      
					  
					  
					   + ' <div class="row">'

                   + '<div class="form-group col-md-6">'
                + '<label for="username">Date assign from: </label>'
				+ '<input type="text" name="requirement[' + added_val + '][date_assign_from]"  class="form-control date_pickf" onkeydown="return false" />'
                + '</div>'
				
                + '<div class="form-group col-md-6 ">'
                + '<label for="username">Date assign to: </label>'
				+ '<input type="text" name="requirement[' + added_val + '][date_assign_to]" class="form-control date_pick to_date" onkeydown="return false"/>'
                + '</div>'
                + '</div>'
				
				+     ' <div class="row">'
				+     '<div class="form-group col-md-6">'
                +     '<label for="username">No of employees required: </label>'
                +     '<input type="text" name="requirement[' + added_val + '][no_of_employees]"       class="form-control" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" data-parsley-trigger="change" data-parsley-type="digits" >'
				+ '<span id="error" style="color: Red; display: none">Only digits are allowed</span>'
                +     '</div>'
	            +	  '</div>'
				+     '</br>'
				);
			 $('#requirement_incr').val(added_val);
			 
              });
			  
			  
			  

</script>

<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
           // document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
</script>


<script>
function Redirect() {

        window.location = "inhouse_requirement_list.php";

    }
</script>

</body>

</html>