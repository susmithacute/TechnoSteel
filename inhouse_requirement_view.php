<?php
$page = "employee";
$tab = "work_plan";
$sub = "inhouse_requirements";
$sub1="inhouse_list";
include('file_parts/header.php');
$uid = $_GET['uid'];
$resuid = $db->selectQuery("SELECT sm_inhouse_requirement.title,sm_inhouse_requirement.project_manager,sm_inhouse_requirement.contact,sm_work_site.work_site,sm_work_site.site_location FROM sm_inhouse_requirement INNER JOIN sm_work_site ON sm_inhouse_requirement.work_site_id=sm_work_site.id WHERE sm_inhouse_requirement.id='$uid'");
if (count($resuid)) {

    $title = $resuid[0]['title'];
    $work_site_id = $resuid[0]['work_site'];
    $work_location = $resuid[0]['site_location'];
    $project_manager = $resuid[0]['project_manager'];
    $contact = $resuid[0]['contact'];
    
}

	

?>

<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-profile">

        <div class="pageheader">

            <h2>Inhouse Requirement<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">

                    <li>

                        <a href="#"><i class="fa fa-home"></i> Sponsor Master</a>

                    </li>

                    <li>

                        <a href="#"> Inhouse Requirement</a>

                    </li>

                    <li>

                        <a href="#">Inhouse Requirement profile</a>

                    </li>

                    
                </ul>



            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">


            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-4">

                    <!-- tile -->
                    

                    <section class="tile tile-simple">
                    </section>
                </div>

                <div class="col-md-8">

                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile body -->
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                   
                                    <li role="presentation"><a href="inhouse_requirement_view.php?uid=<?php echo $uid; ?>">Inhouse Requirement</a></li>
                                    <li role="presentation"><a href="inhouse_requirement_edit.php?uid=<?php echo $uid; ?>">Edit</a></li>
                                </ul>
                                <div style="padding: 12px">
                                    
                                        <div class="wrap-reset">

                                           

                                               <!-- <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>About</strong> Requirements </h4>
                                                    </div>
													</div>-->

                                                <div class="row">
												<div class="form-group col-sm-6">

                                                        <label for="first-name">Title</label>

                                                        <input type="text" class="form-control" id="first-name" readonly name="company_email" value="<?php echo $title; ?>">

                                                    </div>
                                                    <div class="form-group col-sm-6">

                                                        <label for="first-name">Work site</label>

                                                        <input type="text" class="form-control" id="first-name" readonly name="company_email" value="<?php echo $work_site_id; ?>">

                                                    </div>
													</div>
													
													<div class="row">
                                                    <div class="form-group col-sm-6">

                                                        <label for="first-name">Work location</label>

                                                        <input type="text" class="form-control" id="first-name" readonly name="company_email" value="<?php echo $work_location; ?>">

                                                    </div>
                                                    <div class="form-group col-sm-6">

                                                        <label for="first-name">Project Manager</label>

                                                        <input type="text" class="form-control" id="first-name" readonly name="company_email" value="<?php echo $project_manager; ?>">

                                                    </div>
													</div>
													
													<div class="row">
													 <div class="form-group col-sm-6">

                                                        <label for="first-name">Contact</label>

                                                        <input type="text" class="form-control" id="first-name" readonly name="company_email" value="<?php echo $contact; ?>">

                                                    </div>
													</div>                                                
                                                
                                                <?php
                                                $requirement = $db->selectQuery("SELECT sm_designation.designation_name,sm_requirements.category,sm_requirements.no_of_employees,sm_requirements.date_assign_from,sm_requirements.date_assign_to FROM sm_designation INNER JOIN sm_requirements ON sm_designation.designation_id=sm_requirements.job_position WHERE sm_requirements.id='$uid'");
                                                if (count($requirement)>0) {
													//echo "gggggggggggggggggggggggggggggggggggggggggg";
                                                    for ($qi = 0; $qi < count($requirement); $qi++) {
														//if(!empty($requirement[$qi]['job_position']) && !empty($requirement[$qi]['category'])){
                                                        ?>
														
														<div class='form-group col-md-12 legend'>
                                                    <h4><strong> Requirement </strong> <?php echo $qi+1; ?> </h4>
                                                </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label for="city">Job Position</label>
                                                                <input type="text" class="form-control" readonly name="company" id="company" value="<?php echo $requirement[$qi]['designation_name']; ?>">
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="city">Category</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $requirement[$qi]['category']; ?>">
                                                            </div>
                                                        </div>
														
														<div class="row">
                                                                <?php
                                                                $date_assign_from = new DateTime($requirement[$qi]['date_assign_from']);
																$date_assign_to = new DateTime($requirement[$qi]['date_assign_to']);
																?>
																<div class="form-group col-sm-6">
                                                                <label for="city">From</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $date_assign_from->format("d/m/Y"); ?>">
																</div>
																
																<div class="form-group col-sm-6">
                                                                <label for="city">To</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $date_assign_to->format("d/m/Y"); ?>">
																</div>
                                                       </div>
													   
													   <div class="row">
														<div class="form-group col-md-6">
                                    <label for="username">No of employees required: </label>
                                    <input type="text" name="no_of_employees"  class="form-control" readonly value="<?php echo $requirement[$qi]['no_of_employees']; ?>" data-parsley-trigger="change"
                                                       data-parsley-type="digits" required/>
                                </div>
								</div>
                                                        
                                                            <?php
														//	}
														}
                                                    }
                                                    ?>
                                                
                                                

                                        </div>

                                   
                                </div>
                                
                            </div>
                            <!-- /tile body -->

                    </section>
                    <!-- /tile -->




                </div>
                <!-- /col -->











            </div>
            <!-- /row -->



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
<script type="text/javascript" src="assets/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<script type="text/javascript" src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/jRespond/jRespond.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/screenfull/screenfull.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>
<!--/ vendor javascripts -->




<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script type="text/javascript" src="assets/js/main.js"></script>
<!--/ custom javascripts -->






<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->






</body>


</html>