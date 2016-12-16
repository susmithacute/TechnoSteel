<?php
$success_msg="";
$page = "company";
$tab = "company_setting";
$sub = "designation";
$sub1 = "designation_list";
include('file_parts/header.php');
?>

                <?php

                

                $res = $db->selectQuery("select * from sm_designation where designation_id='" . $_GET['designation_id'] . "' ");


                if (count($res)) {

                    $designation_id = $res[0]['designation_id'];

                    $designation_name = $res[0]['designation_name'];

				}

                    ?>
					
					
					
					<?php

if (isset($_POST['submit'])) {
	
	$designation_name= $_POST['designation_name'];
	
    $values1['designation_name'] = $designation_name;
	$query1 = $db->secure_update('sm_designation', $values1, "  WHERE designation_id = '" . $_GET['designation_id'] . "'");
	if (count($query1)) {

        $success_msg = "Values Updated!";
		
		 echo "<script>location.href='designation_list.php'</script>";

		}

		else

		{

		$success_msg = "Error in updation";

		}


}?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">

            <h2>Edit Designation<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="#">Settings </a>
                    </li>
					<li>
                        <a href="#">Designation List</a>
                    </li>
                    <li>
                        <a href="#">Edit Designation</a>
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Edit Designation </a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Designation Name: </label>
                                    <input type="text" name="designation_name" id="cr" value="<?php echo $designation_name;?> "class="form-control" required>
                                </div>

                          </div>
						   <div class="col-md-6">
                                    <p style="color:red;" id = "com_status"></p>
                                </div>
						  
						   <ul class="pager wizard" style="margin-right:650px;">
                    <!--<li class="previous"><button class="btn btn-default">Previous</button></li>
                    <li class="next"><button class="btn btn-default" id="next_btn">Next</button></li>-->
                    <li class="next finish" style="display:none;">
                        <button class="btn btn-success" name="submit" id="submit_btn" type="submit">Add</button>
                    </li>
                </ul>
            </form> 
           </div>							

               
                <div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-2">
				<h4  class="text-success mt-0 mb-20" id="partner_succes"><?php echo $success_msg; ?></h4>
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

<script>
$(document).ready(function () {
    $("#form1").submit(function () {
        $(".btn btn-success").attr("disabled", true);
        return true;
    });
});
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

$('#cr').on('blur', function (e) {
        var des = jQuery('#cr').val();
        $('#com_status').html('Please wait...');
        $.ajax({
            url: 'designation_check.php',
            type: 'POST',
            dataType: 'json',
            data: {des: des},
            success: function (data) {
                $('#com_status').html(data.Status);
                var ch2 = data.data_val;
                if (ch2 == 0) {
                    $('#cr').val('');
                }
                if (ch2 == 1) {

                }

            }
        });
    });
	</script>
<!--/ Page Specific Scripts -->


</body>
</html>
