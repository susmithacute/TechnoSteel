<?php
$page = "visa";
$tab = "process_visa";
$sub = "visa_add";
include("./file_parts/header.php")
?>
<!--/ CONTROLS Content -->
<style>
    .addt_text:focus{
        outline: none;
    }
    .addt_text {
        background-color:transparent;
        border: 0px solid;
        height:30px;
        width:260px;
    }
    .file_status{
        color:#428bca;
    }
</style>
<!-- ====================================================
          ================= CONTENT ===============================
          ===================================================== -->
<section id="content">
    <div class="page page-forms-wizard">
        <div class="pageheader">
            <h2>Visa processing <span>Add New Visa</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="#"><i class="fa fa-home"></i> SME</a> </li>
                    <li> <a href="#">Visa processing</a> </li>
                    <li> <a href="#">Add Visa</a> </li>
                </ul>
            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Basic <span class="badge badge-default pull-right wizard-step">1</span></a></li>
					<li><a href="#tab2" data-toggle="tab">Finish <span class="badge badge-default pull-right wizard-step">2</span></a></li>
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <form name="step1" role="form" id="form">
                          
                            <div class="row">
							
								
                               <div class="form-group col-md-4">
                                    <label for="phone">Visa Type: </label>
                                    <select class="form-control mb-10" name="visa_type" id="visa_type" required="">
                                        <option  value="">Select</option>
                                        <?php
                                        $select = $db->selectQuery("select * from sm_visa_type where visa_type_status='1'");
                                        if (count($select)) {
                                            for ($rt = 0; $rt < count($select); $rt++) {
                                                ?>
                                                <option value="<?php echo $select[$rt]['visa_type_name']; ?>"> <?php echo $select[$rt]['visa_type_name']; ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								 <div class="form-group col-md-4">
                                    <label for="phone">Category: </label>
                                   <select class="form-control mb-10" name="visa_category" id="visa_category">
                                        <option  value="">Select</option>
                                        
                                    </select>
                                </div>
								  <div class="form-group col-md-4">
                                    <label for="dnumber">Applicant Name: </label>
                                    <input type="text" name="visa_applicant" id="visa_applicant"  class="form-control" />
                                </div>
								
								</div>
								 <div class="row">
								
								
								
								 <div class="form-group col-md-4">
                                    <label for="phone">Passport No: </label>
									 <input type="text" name="visa_passport" id="visa_passport" class="form-control" />
                                
                                    
                                </div> 
								<div class="form-group col-md-4">
                                    <label for="phone">Client Name: </label>
                                    <select class="form-control mb-10" name="visa_client"   id="visa_client">
                                        <option  value="">Select</option>
                                        <?php
                                        $select = $db->selectQuery("select * from sm_visa_client where visa_client_status='1'");
                                        if (count($select)) {
                                            for ($rt = 0; $rt < count($select); $rt++) {
                                                ?>
                                                <option value="<?php echo $select[$rt]['visa_client_name']; ?>"> <?php echo $select[$rt]['visa_client_name']; ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								 <div class="form-group col-md-4">
                                    <label for="dnumber">Contact no: </label>
                                    <input type="text" name="visa_contact" id="visa_contact" class="form-control" />
                                </div>
								 </div>
								 <h1 class="text-success mt-0 mb-20" id="agent_status"></h4>
								 <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="zip">Received Date: </label>
                                    <div class='input-group datepicker' data-format="L">
                                        <input type='text' name="visa_received_date" id="visa_received_date" class="form-control"/>
                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">Advance amount: </label>
                                    <input type="text"  name="visa_amount" id="visa_amount" class="form-control"  />
                                </div>
								<div class="form-group col-md-4">
                                    <label for="phone">Status: </label>
                                   <select class="form-control mb-10" name="visa_status" id="visa_status">
                                        <option  value="Applied">Applied</option>
										<option  value="Not Applied">Not Applied</option>
                                    </select>
                                </div>
								 
								</div>
								<div class="row">
                                
                                
                                <div class="form-group col-md-4">
                                    <label for="username">Email: </label>
                                    <input type="text"  name="visa_email" id="visa_email" class="form-control"  />
                                </div>
								<div class="form-group col-md-4">
								<label for="username">Country: </label>
								<select class="form-control mb-10" name="visa_country"   id="visa_country">
                                       <option  value="">Select</option>
                                        <?php
                                        $select = $db->selectQuery("select * from country");
                                        if (count($select)) {
                                            for ($rt = 0; $rt < count($select); $rt++) {
                                                ?>
                                                <option value="<?php echo $select[$rt]['name']; ?>"> <?php echo $select[$rt]['name']; ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
									</div>
									<div class="form-group col-md-4">
                                    <label for="username">Address: </label>
                                    <textarea name="visa_address" id="visa_address" class="form-control"></textarea>
                               
                                </div>
								
								</div>
								 
								
								 
                            
                        </form>
                    </div>
                   <div class="tab-pane" id="tab2">
                        <p class="well">Please check and make sure the details given are correct!</p>
                        <form name="step2" role="form" novalidate>
                           
                        </form>
                    </div>
                    
                   
                    <ul class="pager wizard">
                       
                         <li class="previous">
                            <button class="btn btn-default">Previous</button>
                        </li>
                        <li class="next">
                            <button id="next_btn" class="btn btn-default">Next</button>
                        </li>
                        <li class="next finish" style="display:none;">
                            <button name="submit" id="submit_btn" type="button" class="btn btn-success">Finish</button>
                        </li>
                    </ul>
                    <div class="row">

                        <div class="col-md-9"></div>

                        <h4 class="text-success mt-0 mb-20" id="exist_status"></h4>
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
                                                // $('.date_pic').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});

                                                $('body').on('click', '.datepicker_recurring_start', function () {
                                                    $(this).datepicker({
                                                        changeMonth: true,
                                                        changeYear: true,
                                                        dateFormat: "dd/mm/yy"
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
$('#visa_type').change(function () {
        var type = $(this).val();
        $.ajax({
            url: "type_category.php",
            type: "POST",
            data: {type: type},
            success: function (data) {
                $('#visa_category').html(data);
            }
        });
    });
</script>
<script>
    
        $('#submit_btn').click(function () {
             fdata = $('#form').serialize();
            $.ajax({
                url: "visa_add_ajax.php",
                type: "POST",
				dataType: 'json',
                data: fdata,
                success: function (data) 
				{
                    $("#exist_status").html(data.Status);
					//var ch2 = data.data_val;
                    //if (ch2 == 1) {
                    location.href='visa_list.php'
                }

                
            });
        });
   
    /**/
</script>
</body>
</html>

