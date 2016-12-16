<?php
$success_msg="";
$page = "recruitment";$tab = "recruit_settings";$sub = "recruit_category";
$sub1 = "recruit_category_add";
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
        list-style-type: none;
    }
</style>
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">
            <h2>Add Category<span></span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Settings </a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Recruitment</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Category</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Add Category </a>
                    </li>
                </ul>

            </div>

        </div>
        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
               <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Add New Category</a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">
						            <div class="row">
									<div class="form-group col-md-5">
                                    <label for="phone">Job position: </label>
                                    <select class="form-control mb-10" name="category[0][job_position]" id="job_position" required="">
                                        <option  value="">Select</option>
                                        <?php
                                        $select = $db->selectQuery("select * from sm_job_positions WHERE job_status='1'");
                                        if (count($select)) {
                                            for ($rt = 0; $rt < count($select); $rt++) {
                                                ?>
                                                <option value="<?php echo $select[$rt]['job_name']; ?>"> <?php echo $select[$rt]['job_name']; ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								
                                <div class="form-group col-md-5">
                                    <label for="username">Category Name: </label>
                                    <input type="text" name="category[0][job_category_name]" id="job_category_name" class="form-control" required>
                                    <span id="exist_status_0" class="validate_span"></span>

                                </div>
                          </div>
						  <div class="experience_div"></div>
                            <input type="hidden" value="1" id="category_increment">
						   <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-success" type="button" id="category_add_btn" >Add Category
                                        <i class="fa fa-plus"></i></button>
                                </div>
								 <div class="col-md-8"></div>
								  <div class="col-md-1">
                            <ul class="pager wizard" style="margin-right:650px;">
                                <li class="next finish" style="display:none;">
                                    <button class="btn btn-success" name="submit" id="submit_btn" type="button">Add</button>
                                </li>
                            </ul>
							</div>
                        </form>
                    </div>
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
<!--<script>
$(document).ready(function () {
    $("#form1").submit(function () {
        $(".btn .btn-success").attr("disabled", true);
        return true;
    });
});
</script>-->
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
    $('#submit_btn').click(function () {
        $('#exist_status_0').html('');
		
		var error_check=1;
		 var job_position = jQuery('#job_position').val();
         var job_category_name = jQuery('#job_category_name').val();
        
        if (job_category_name == "") {
			error_check=0;
            
        }
		if(error_check==1) {
            $.ajax({
                url: 'category_check.php',
                type: 'POST',
                dataType: 'json',
                 data: $('form').serialize(),
                success: function (data) {
					 $('#exist_status').html(data.Status);
                 var counts=data.length;
					for(i=0;i<counts;i++){
						if(data[i]=="0"){
							$('#exist_status_'+i).html("Already Exist");
						}
						else{
							$('#exist_status_'+i).html("");
							 location.href='category_list.php';
						}
					}
                    var ch2 = data.data_val;
                    if (ch2 == 0) {
						
                        $('#job_position').val('');
                        $('#job_category_name').val('');
                    }
                    if (ch2 == 1) {
                       
                    }

                }
            });
        }
    });
</script>
<!--/ Page Specific Scripts -->

<script>
	 $('#category_add_btn').click(function () {
		
        var category_add = "category_add";
        category_increment = $('#category_increment').val();
        added_exp = +category_increment + 1;
        $('.experience_div').append(
                '<div class="row">'
                + '<div class="form-group col-md-5">'
				+ ' <label for="phone">Job Position: </label>'
                + '<select class="form-control mb-10" name="category[' + category_increment + '][job_position]" id="job_position" required="" >'
                + '<option selected="" value=""> Select</option>'
<?php
$select = $db->selectQuery("select * from sm_job_positions WHERE job_status='1'");
if (count($select)) {
    for ($rt = 0; $rt < count($select); $rt++) {
        ?>
                +'  <option value="<?php echo $select[$rt]["job_name"]; ?>"><?php echo $select[$rt]["job_name"]; ?></option>'
        <?php
    }
}
?>
        + '</select>'
                + '</div>'
                + '<div class="form-group col-md-5">'
                + '<label for="username">Category Name: </label>'
                + '<input type="text"  name="category[' + category_increment + '][job_category_name]"  class="form-control"  id="job_category_name"  required=""> '
				 + ' <span id="exist_status_' + category_increment + '" class="validate_span"></span>'
			    + '</div>'
				 + '</div>'
				
				  );
                $('#category_increment').val(added_exp);
    });
	</script>
</body>
</html>
