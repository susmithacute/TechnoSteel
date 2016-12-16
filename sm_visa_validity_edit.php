<?php
$success_msg="";
$page = "recruitment";
$tab = "recruit_settings";
$sub = "notification_settings";
$sub1 = "visa_validity_list";
//$sub = "visa_validity_edit";



include('file_parts/header.php');
if(isset($_REQUEST["edit_id"]))
{
	$edit_id=$_REQUEST["edit_id"];
	//echo $edit_id;
	
	
	$sql2=$db->selectQuery("SELECT  sm_visa_validity.notification_name,sm_visa_validity.validity_period, sm_visa_validity.notify_period FROM  sm_visa_validity WHERE id='".$edit_id."'");
	//echo $sql2;
	
	if(count($sql2) > 0 )
	{
		
		$notification_name=$sql2[0]["notification_name"];
		//$validity_period=$sql2[0]["validity_period"];
		$notify_period=$sql2[0]["notify_period"];
		}
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
$notification = $_REQUEST['notification'];
//$validity_period=$_REQUEST['validity_period'];
$notify_period=$_REQUEST['notify_period'];
$values["notification_name"] = $notification;
//$values["validity_period"]=$validity_period;
$values["notify_period"]=$notify_period;


$check=$db->selectQuery("SELECT `notification_name` FROM  sm_visa_validity WHERE notification_name='".$notification."' AND id!='".$edit_id."'");
if (count($check)) {
	  echo  $success_msg = "Exist"; 
//echo "<script>location.href='sm_visa_validity_add.php'</script>";
		}
  else
  {

$insert = $db->secure_update("sm_visa_validity", $values,"WHERE id='$edit_id'");


if (count($insert)) {

	  echo  $success_msg = "success";

 echo "<script>location.href='sm_visa_validity_list.php'</script>";
		}

		else

		{

		$success_msg = "Error in insertion";

 }
 
}
}

?>





<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">

            <h2> Notification Settings <span>edit</span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
					 <li>
                        <a>HR</a>
                    </li> 
                    <li>
                        <a href="javascript:void(0)">Recruitment</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Settings</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Notification</a>
                    </li>
					<li>
                        <a href="javascript:void(0)">Notification List</a>
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
                    <li><a href="#tab1" data-toggle="tab">Notification Settings</a></li>
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">
								<div class="form-group col-md-6">
                                    <label for="notification">Name Of Notification: </label>
                                     <select class="form-control" name="notification" id="notification" required="">
                                        <option selected="" value=""> Select</option>
                                        <?php
                                        $name = $db->selectQuery("SELECT `notification_name` FROM `sm_visa_validity` WHERE `status`='active'");
                                        if (count($name) > 0) {
                                            for ($ei = 0; $ei < count($name); $ei++) {
                                                ?>
                                                <option value="<?php echo $name[$ei]['notification_name']; ?>"<?php if($name[$ei]['notification_name']==@$notification_name){ echo "selected";}?>><?php echo $name[$ei]['notification_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
									 </div>
                                </div>
								<!--<div class="row">
								<div class="form-group col-md-6">
                                    <label for="validity_period">Validity Period: </label>
                                     <input type="text" name="validity_period" value="<?php echo $validity_period; ?>"  id="validity_period" class="form-control" required>
									 </div>
                                </div>-->
								<div class="row">
								<div class="form-group col-md-6">
                                    <label for="notify_period">Notify Period: </label>
                                     <input type="text" name="notify_period" value="<?php echo $notify_period; ?>"  id="notify_period" class="form-control" required>
                                </div>
								 </div>
								
								<div class="row">
						<ul class="pager wizard" style="margin-right:67%;">
							<li class="next finish" style="display:none;">
							 <button class="btn btn-success" name="submit" id="submit_btn" type="submit">Add</button>
								<!--	<input type="submit" name="submit" value="add"> -->
							</li>
						
				
						 

                            </form>
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

	
	
	
<!--/ Page Specific Scripts -->
</body>
</html>
