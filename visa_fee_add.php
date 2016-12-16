<?php
$success_msg="";
$page = "visa";
$tab = "visa_settings";
$sub = "visa_fee_settings";
$sub1 = "visa_fee_add";

include('file_parts/header.php');

?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<style>
    .validate_span {
        color: #ff7b76 !important;
        font-size: 12px;
        line-height: 0.9em;
        list-style-category: none;
    }
</style>
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">
            <h2>Add Visa Fee<span></span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Visa </a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Visa Fee</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Visa Fee</a>
                    </li>
                    
                </ul>

            </div>

        </div>
        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
               <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Add Visa Fee </a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">
						<div class="row">
									<div class="form-group col-md-6">
                                    <label for="phone">Visa Type: </label>
                                    <select class="form-control mb-10" name="type_name" id="type_name" required="">
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
								</div>
						<div class="row">
						
									<div class="form-group col-md-6">
                                    <label for="phone">Visa Category: </label>

									 <select class="form-control mb-10" name="category_name" id="category_name"
                                            required="">
                                        <option value="">Select</option>
                                    </select>
                                </div>
								</div>
								

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Bank Fee: </label>
                                    <input fee="text" name="bank_fee" id="bank_fee" class="form-control" required>
                                   

                                </div>
                          </div>
						  <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Company Fee: </label>
                                    <input fee="text" name="company_fee" id="company_fee" class="form-control" required>
                                    

                                </div>
                          </div>
						  <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Sponsor Fee: </label>
                                    <input fee="text" name="sponsor_fee" id="sponsor_fee" class="form-control" required>
                                    <span id="exist_status" class="validate_span"></span>

                                </div>
                          </div>
						   <div class="col-md-6">
                                    <p style="color:red;" id =""></p>
                            </div>
						  
						   <ul class="pager wizard" style="margin-right:650px;">
                    <li class="finish" style="display:none;">
                        <button class="btn btn-success" name="submit" id="submit_btn" type="button">Add</button>
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
    <!-- /page content -->

</div>

</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->

<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->



<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->


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
$('#type_name').change(function () {
        var type = $(this).val();
        $.ajax({
            url: "type_category.php",
            type: "POST",
            data: {type: type},
            success: function (data) {
                $('#category_name').html(data);
            }
        });
    });
$('#submit_btn').click(function(){
    $('#exist_status').html('');
	var error_check=1;
    var category_name = jQuery('#category_name').val();
	var type_name = jQuery('#type_name').val();
	var bank_fee = jQuery('#bank_fee').val();
	var company_fee = jQuery('#company_fee').val();
	var sponsor_fee = jQuery('#sponsor_fee').val();
    if(company_fee==""){
		error_check=0;
		//$('#exist_status').html("Company fee is required.");
      
    }
	if(bank_fee==""){
		error_check=0;
		//$('#exist_status').html("Bank fee is required.");
      
    }
	if(sponsor_fee==""){
		error_check=0;
		//$('#exist_status').html("Please fill all required fields..");
      
    }
    if(error_check==1) {
        $.ajax({
            url: 'visa_fee_check.php',
            type: 'POST',
            dataType: 'json',
            data: {category_name: category_name,type_name:type_name,bank_fee:bank_fee,company_fee:company_fee,sponsor_fee:sponsor_fee},
            success: function (data) {
                $('#exist_status').html(data.Status);
                var ch2 = data.data_val;
                if (ch2 == 0) {
                    $('#fee_name').val('');
					$('#type_name').val('');
					$('#bank_fee').val('');
					$('#company_fee').val('');
					$('#sponsor_fee').val('');
                }
                if (ch2 == 1) {
                    location.href='visa_fee_list.php'
                }

            }
        });
    }
});
	</script>
	


<!--/ Page Specific Scripts -->

<script>
   /* $(document).ready(function () {
        var fdata = "";

        $('#next_btn').click(function () {
            fdata = $('#form1').serialize();
        });
        $('#submit_btn').click(function () {
            var formData = new FormData();
            jQuery.each(jQuery('#file')[0].files, function (i, file) {
                formData.append('file-' + i, file);
            });
            $.ajax({
                url: "ins_partner.php?" + fdata,
                category: "POST",
                cache: false,
                contentcategory: false,
                processData: false,
                data: formData,
                success: function (data) {
                    //alert(data);
                    // alert("Partner Add Successfully");
                    $("#partner_succes").html(data);

                }
            });
        });
    });
    /**/
</script>
</body>
</html>
