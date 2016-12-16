<?php
$success_msg="";
$page = "company";
$tab = "company_setting";
$sub = "company_bank";
$sub1 = "company_bank_list";
include('file_parts/header.php');


if(isset($_REQUEST["bank_id"]))
    {          
            $bank_id=$_REQUEST["bank_id"];
			$sql2 = $db->selectQuery("SELECT * FROM sm_bank_details WHERE bank_id='$bank_id'");
			if(count($sql2) > 0 ){
				$bank_name=$sql2[0]["bank_name"];
		        $bank_code=$sql2[0]["bank_code"];
		        $bank_branch=$sql2[0]["bank_branch"];
		        $bank_country=$sql2[0]["bank_country"];
		   	
			}
    }		
if($_SERVER['REQUEST_METHOD']=='POST')
	{	
			
             $bank_name              = $_POST['bank_name'];
		     $bank_code              = $_POST['bank_code'];
		     $bank_branch            = $_POST['bank_branch'];
		     $bank_country           = $_POST['bank_country'];
		    
		     $values["bank_name"]    = $bank_name;
		     $values["bank_code"]    = $bank_code;				 
	         $values["bank_branch"]  = $bank_branch;
			 $values["bank_country"] = $bank_country;
			
			$update = $db->secure_update("sm_bank_details",$values, "WHERE bank_id='$bank_id'");
				if($update){
					echo "sucess";
					
				} 
		        echo " <script>location.href='bank_details_list.php'</script>";
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

            <h2>Edit Bank Details<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="#">Settings </a>
                    </li>
					<li>
                        <a href="#">Bank</a>
                    </li>
                    <li>
                        <a href="#">Edit Bank Details</a>
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Edit Bank Details </a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="bank_name">Bank Name: </label>
                                    <input type="text" name="bank_name" id="bank_name" value="<?php echo @$bank_name;?>" class="form-control" required>
                                    <span id="com_status" class="validate_span"></span>

                                </div>

                         
                                <div class="form-group col-md-6">
                                    <label for="bank_name">Bank Code: </label>
                                    <input type="text" name="bank_code" id="bank_code" value="<?php echo @$bank_code;?>" class="form-control" required>
                                    <span id="com_status" class="validate_span"></span>

                                </div>

                          </div>
						  <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="bank_name">Branch: </label>
                                    <input type="text" name="bank_branch" id="bank_branch" value="<?php echo @$bank_branch;?>" class="form-control" required>
                                    <span id="com_status" class="validate_span"></span>

                                </div>

                         
                                <div class="form-group col-md-6">

                                    <label for="bank_country">Country: </label>

                                    <select name="bank_country" id="bank_country" class="form-control">
                                        <option value="">Select Country</option>
                                        <?php
                                        $select_country = $db->selectQuery("SELECT `nicename` FROM `country`");
                                        if (count($select_country)) {
                                            for ($k = 0; $k < count($select_country); $k++) {
                                                ?>
                                                <option value="<?php echo $select_country[$k]['nicename']; ?>"<?php if($select_country[$k]['nicename']==@$bank_country){ echo "selected";}?>><?php echo $select_country[$k]['nicename']; ?></option>
                                                                                                                   <?php
                                                                                                               }
                                                                                                           }
                                                                                                           ?>
                                    </select>
                                </div>

                          </div>
						   <div class="col-md-6">
                                    <p style="color:red;" id = ""></p>
                                </div>
						  
					

				
				<ul class="pager wizard">
							<li class="next finish" style="display:none;">
							 <button class="btn btn-success" name="submit" id="submit_btn" type="submit">Update</button>
								<!--	<input type="submit" name="submit" value="add"> -->
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

	

<!--/ Page Specific Scripts -->


</body>
</html>
