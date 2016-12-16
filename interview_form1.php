<?php
$page = "recruitment";
$tab = "interview_process";
$sub = "interview";
$sub1 = "interview_form";

$head = "";

$head1 = "";

//$sub1 = "";

$tab1 = "";

$inter_id = "";

include("file_parts/header.php");

$candidate_code = "";

$candidate_id = "";

$dpImg = $can_id = "";

unset($_SESSION['candidate_code']);
unset($_SESSION['cand_id']);

$candidate_firstname = $candidate_middlename = $candidate_lastname = $candidate_doorno = $candidate_city = "";

$candidate_state = $candidate_zipcode = $candidate_nationality = $candidate_marital_status = $candidate_gender = "";

$candidate_dob = $candidate_email = $candidate_phone = "";

if (isset($_REQUEST['can_id'])) {

    $candidate_id = $_REQUEST['can_id'];

    $select_info = $db->selectQuery("SELECT * FROM `sm_candidate` WHERE `candidate_id`='$candidate_id'");
	//echo "<pre>";print_r($select_info); 

    if (count($select_info)) {

        $candidate_code = $select_info[0]['candidate_code'];

        $agent_code = $select_info[0]['agent_code'];

        $candidate_added_by = $select_info[0]['candidate_added_by'];

        $candidate_firstname = $select_info[0]['candidate_firstname'];

        $candidate_middlename = $select_info[0]['candidate_middlename'];

        $candidate_lastname = $select_info[0]['candidate_lastname'];

        $candidate_gender = $select_info[0]['candidate_gender'];

        $candidate_marital_status = $select_info[0]['candidate_marital_status'];

        $candidate_dob = $select_info[0]['candidate_dob'];

        $candidate_doorno = $select_info[0]['candidate_doorno'];

        $candidate_nationality = $select_info[0]['candidate_nationality'];

        $candidate_state = $select_info[0]['candidate_state'];

        $candidate_city = $select_info[0]['candidate_city'];

        $candidate_zipcode = $select_info[0]['candidate_zipcode'];

        $candidate_email = $select_info[0]['candidate_email'];

        $candidate_phone = $select_info[0]['candidate_phone'];

        $candidate_status = $select_info[0]['candidate_status'];

        $candidate_interview_status = $select_info[0]['candidate_interview_status'];



        $candidate_dob1 = explode("-", $candidate_dob);

        $candidate_dob = $candidate_dob1[2] . "/" . $candidate_dob1[1] . "/" . $candidate_dob1[0];

        $dpImg = $image_check = "";

        $resLogo = $db->selectQuery("SELECT * FROM `sm_candidate_files` WHERE `file_name`='Candidate_Picture' AND `file_status`='1' AND `candidate_id`='$candidate_id'");

        /*if (count($resLogo)) {

            $dpImg = $resLogo[0]['file_path'];

            //$image_check = 1;

        } else {

            $dpImg = "assets/images/profile-default.png";

            //$image_check = 0;

        }*/
		
			$display_name = ""; 
			$select_name = $db->selectQuery("SELECT `candidate_added_by` FROM `sm_candidate` WHERE `candidate_id`='".$_REQUEST['can_id']."'");
			if(!empty($select_name))
			{
				$display_name = $select_name[0]['candidate_added_by'];
			}
		if (count($resLogo)){	
			if($display_name == 'agent')
			{
				$dpImgs = str_replace("../","",$resLogo[0]['file_path']);
			} else {
				$dpImgs = $resLogo[0]['file_path'];
			}
		if (file_exists($dpImgs)) {
			$dpImg = $dpImgs;
		} else {
			$dpImg = "assets/images/profile-default.png";
		}
		} else {
			$dpImg = "assets/images/profile-default.png";
		}


        $_SESSION['candidate_code'] = $candidate_code;
		$_SESSION['cand_id'] = $candidate_id;

    }
	
	$applis = $db->selectQuery("SELECT * FROM `sm_candidate_application` WHERE `candidate_id`='$candidate_id'"); 
	//echo "<pre>";print_r($applis); die;

}

?>

<!-- ====================================================

================= CONTENT ===============================

===================================================== -->

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

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<section id="content">



    <div class="page page-profile">



        <div class="pageheader">



            <h2>Interview Form </h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li><a href="#"><i class="fa fa-home"></i> SME</a></li>

                    <li><a href="#">Recruitment</a></li>

                    <li><a href="#">Schedule Interview</a></li>

                    <li><a href="#">Interview Form</a></li>

                </ul>



            </div>



        </div>



        <!-- page content -->

        <div class="pagecontent">





            <!-- row -->

            <div class="row">



                <form class="form-horizontal" name="" method="post" action="interview_form_action.php"

                      enctype="multipart/form-data" role="form" data-parsley-validate>

                    <div class="col-md-9">

                        <section class="tile">



                            <!-- tile body -->

                            <div class="tile-body p-0">



                                <div role="tabpanel">



                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs tabs-dark" role="tablist">

                                        <li role="presentation"><a style="color:#16a085;" href="javascript:void(0)">Interview Form</a></li>
										<?php if (isset($_REQUEST['can_id'])) { ?>
										<li role="presentation"><a style="color:#16a085;" href="candidate_gallery.php?can_id=<?php echo $_REQUEST['can_id']; ?> ">Documents</a></li>
										<?php } ?>
                                    </ul>

                                    <!-- Tab panes -->

                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active" id="settingsTab">

                                            <div class="tile-body">

                                                <div class="row">

                                                    <div class="col-md-3 col-md-offset-8">

                                                         <a href="candidate_add.php?Form" class="btn btn-success" type="button" id="contact_ad_btn">Add New candidate <i

                                                                class="fa fa-plus"></i></a>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-4">

                                                        <label for="selected_interview">Select Interview: </label>

                                                        <select class="form-control" name="selected_interview"

                                                                id="selected_interview">

                                                            <option selected="" value=""> Select</option>

                                                            <?php

                                                            $select_interview = $db->selectQuery("SELECT `interview_id`,`interview_name` FROM `sm_interview` WHERE `interview_status`='Active' AND `interview_name` !='' ");
                                                            if (count($select_interview)) {

                                                                for ($intr = 0; $intr < count($select_interview); $intr++) {

                                                                    ?>

                                                                    <option value="<?php echo $select_interview[$intr]['interview_id']; ?>" <?php if ($select_interview[$intr]['interview_id'] == @$applis[0]['interview_id']) { echo "selected=''"; } ?>
                                                                           ><?php echo $select_interview[$intr]['interview_name']; ?></option>

                                                                    <?php

                                                                }

                                                            }

                                                            ?>

                                                        </select>

                                                    </div>
													
													<?php 
													
													$job_postions = $db->selectQuery("SELECT `application_job_position` FROM `sm_candidate_application` WHERE `candidate_id`='$candidate_id'"); ?>

                                                    <div class="col-md-4">

                                                        <label for="select_job">Job Position: </label>

                                                        <select class="form-control" name="select_job"

                                                                id="select_job">

                                                            <option selected="" value=""> Select</option>
														<?php if(count($job_postions)){ ?>
														<option selected="" value="<?php echo $job_postions[0]['application_job_position']; ?>"><?php echo $job_postions[0]['application_job_position']; ?></option>
														<?php } ?>


                                                        </select>

                                                    </div>
													
													<?php $select_candid = $db->selectQuery("SELECT CONCAT(sm_candidate.candidate_firstname,' ',sm_candidate.candidate_middlename,' ',sm_candidate.candidate_lastname) as candidate_name,sm_candidate.candidate_id,sm_candidate_application.application_job_position FROM `sm_candidate` INNER JOIN sm_candidate_application ON sm_candidate.candidate_id=sm_candidate_application.candidate_id WHERE sm_candidate.candidate_id='$candidate_id'"); ?>

                                                    <div class="col-md-4">

                                                        <label for="select_candidate">Candidate: </label>

                                                        <select class="form-control" name="select_candidate"

                                                                id="select_candidate">

                                                            <option selected="" value=""> Select</option>

                                                            <?php if(count($select_candid)){ ?>
														<option selected="" value="<?php echo $select_candid[0]['candidate_name']; ?>"><?php echo $select_candid[0]['candidate_name']; ?></option>
														<?php } ?>

                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Candidate</strong> Details</h4>

                                                    </div>

                                                </div>

                                                <input type="hidden" name="candidate_id" value="<?php echo $candidate_id; ?>">

                                                <div class="row">

                                                    <div class=" col-sm-4">

                                                        <label for="first-name">First Name</label>

                                                        <input type="text" class="form-control" name="candidate_firstname" id="f_name"  value="<?php echo $candidate_firstname; ?>">

                                                    </div>

                                                    <div class=" col-sm-4">

                                                        <label for="last-name">Middle Name</label>

                                                        <input type="text" class="form-control" name="candidate_middlename" id="m_name" value="<?php echo $candidate_middlename; ?>">

                                                    </div>

                                                    <div class=" col-sm-4">

                                                        <label for="last-name">Last Name</label>

                                                        <input type="text" class="form-control" name="candidate_lastname" id="l_name"  value="<?php echo $candidate_lastname; ?>">

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Candidate ID</label>

                                                        <input type="text" name="candidate_code"  class="form-control" id="eid" value="<?php echo $candidate_code; ?>">

                                                    </div>

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Marital Status</label>

                                                        <select class="form-control mb-10" name="candidate_marital_status">

                                                            <option selected="" value=""> Select</option>

                                                            <option value="Married" <?php

                                                            if ($candidate_marital_status == "Married") {

                                                                echo 'selected=""';

                                                            }

                                                            ?> >Married</option>

                                                            <option value="Not Married" <?php

                                                            if ($candidate_marital_status == "Not Married") {

                                                                echo 'selected=""';

                                                            }

                                                            ?>>Single</option>

                                                            <option value="Divorced" <?php

                                                            if ($candidate_marital_status == "Divorced") {

                                                                echo 'selected=""';

                                                            }

                                                            ?>>Divorced</option>

                                                        </select>                                                     </div>

                                                </div>

                                                <div class="row">

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Gender</label>

                                                        <select class="form-control" name="candidate_gender">

                                                            <option selected="" value=""> Select</option>

                                                            <option value="Male" <?php

                                                            if ($candidate_gender == "Male") {

                                                                echo "selected=''";

                                                            }

                                                            ?>>Male</option>
															<option value="Female" <?php

                                                            if ($candidate_gender == "Female") {

                                                                echo "selected=''";

                                                            }

                                                            ?>>Female</option>

                                                        </select>

                                                    </div>

                                                    <div class=" col-md-6 ">

                                                        <label for="scstart">Date of Birth: </label>

                                                        <div class='input-group datepicker' data-format="L">

                                                            <input type='text' name="candidate_dob" class="form-control" value="<?php echo $candidate_dob; ?>" onkeydown="return false"/>

                                                            <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Nationality</label>

                                                        <select class="form-control mb-10" name="candidate_nationality">

                                                            <option value="">Select</option>

                                                            <?php

                                                            $select = $db->selectQuery("select * from country ");

                                                            if (count($select)) {

                                                                for ($rt = 0; $rt < count($select); $rt++) {

                                                                    ?>

                                                                    <option

                                                                        value="<?php echo $select[$rt]['name']; ?>" <?php

                                                                        if ($select[$rt]['name'] == $candidate_nationality) {

                                                                            echo 'selected=""';

                                                                        }

                                                                        ?>> <?php echo $select[$rt]['name']; ?> </option>

                                                                        <?php

                                                                    }

                                                                }

                                                                ?>

                                                        </select>

                                                    </div>

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Address</label>

                                                        <input type="text" name="candidate_doorno" class="form-control" id="Nationality" value="<?php echo $candidate_doorno; ?>">

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">City</label>

                                                        <input type="text" name="candidate_city" class="form-control" id="eid" value="<?php echo $candidate_city; ?>">

                                                    </div>

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Region/State</label>

                                                        <input type="text" name="candidate_state" class="form-control" id="Nationality" value="<?php echo $candidate_state; ?>">

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Zip code</label>

                                                        <input type="text" name="candidate_zipcode" class="form-control" id="eid" value="<?php echo $candidate_zipcode; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                                    </div>

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">E-mail</label>

                                                        <input type="text" name="candidate_email" class="form-control" id="Nationality" value="<?php echo $candidate_email; ?>" onblur="validateEmail(this);">
														<span id="emailval" style="color:#FF0000"></span>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class=" col-sm-6">

                                                        <label for="Nationality">Phone</label>

                                                        <input type="text" name="candidate_phone" class="form-control" id="eid" value="<?php echo $candidate_phone; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                                    </div>

                                                </div>


                                                <div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Applied</strong> For</h4>

                                                    </div>

                                                </div>
												
                                                <?php

                                                if (isset($_REQUEST['can_id'])) {

                                                    $appli = $db->selectQuery("SELECT * FROM `sm_candidate_application` WHERE `candidate_id`='$candidate_id'");

                                                    if (count($appli)) {

                                                        //for ($qi = 0; $qi < count($appli); $qi++) {

                                                            ?>
															
                                                            <div class="row">

																<div class=" col-sm-6">

                                                                    <label for="city">Job Position:</label>

                                                                    <input type="text" class="form-control" id="company" value="<?php echo $appli[0]['application_job_position'];

                                                                                    ?>" data-parsley-id="7313" readonly >

                                                                </div>
																
																<div class=" col-sm-6">

                                                                    <label for="city">Category:</label>

                                                                    <input type="text" class="form-control" id="company" value="<?php echo $appli[0]['application_job_category']; ?>" data-parsley-id="7313" readonly >

                                                                </div>

                                                                <div class=" col-md-12">

                                                                   <!--<div class="skill_set">

                                                                    </div>--->
																	
			<div class="skill_set">
				 <?php if (!empty($appli[0]['application_job_category']) && !empty($appli[0]['application_job_position'])) { 
						
						$select_skill = $db->selectQuery("SELECT `skill_name` FROM `sm_job_skill` WHERE `skill_category`='".$appli[0]['application_job_category']."' AND `skill_job`='".$appli[0]['application_job_position']."'");
						if (count($select_skill) > 0) { 
						for ($ski = 0; $ski < count($select_skill); $ski++) {  ?>
							
						<?php /*name="requirements_skills[<?php echo $ski ?>]" */ ?>
						<?php $skils = explode(',',$appli[0]['application_skills']);?>
						<!--<div class="skill_setss">-->
							<label class="checkbox checkbox-custom-alt">
								<input type="checkbox" name="skill[<?php echo $ski ?>]" value="<?php echo $select_skill[$ski]['skill_name']; ?>" 
								<?php if(in_array($select_skill[$ski]['skill_name'],$skils)) { ?> checked="checked" <?php } ?> disabled /><i></i> 
							<?php echo $select_skill[$ski]['skill_name']; ?></label>
						<!--</div>-->
					<?php } } }  ?>
			</div>


                                                                </div>

                                                            </div>

                                                            <?php

                                                       // }

                                                    }

                                                } else {

                                                    ?>

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <label for="interview_job_position">Job Position: </label>

                                                            <select class="form-control" name="interview_job_position"

                                                                    id="interview_job_position">

                                                                <option selected="" value=""> Select</option>

                                                                <?php

                                                                $select_job = $db->secure_select("SELECT `job_name` FROM `sm_job_positions` WHERE `job_status`='1'");

                                                                if (count($select_job) > 0) {

                                                                    for ($ji = 0; $ji < count($select_job); $ji++) {

                                                                        ?>

                                                                        <option

                                                                            value="<?php echo $select_job[$ji]['job_name']; ?>"><?php echo $select_job[$ji]['job_name']; ?></option>

                                                                            <?php

                                                                        }

                                                                    }

                                                                    ?>

                                                            </select>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <label for="interview_category">Category: </label>

                                                            <select class="form-control" name="interview_category"

                                                                    id="interview_category">

                                                                <option selected="" value=""> Select</option>

                                                            </select>

                                                        </div>

                                                        <div class="col-md-12 skill_set">



                                                        </div>

                                                    </div>

                                                <?php }

                                                ?>
												
												<?php if (isset($_REQUEST['can_id'])) {

                                                    $test_details = $db->selectQuery("SELECT * FROM `sm_interview_test_details` WHERE `candidate_id`='$candidate_id'");
												} ?>
												
												<div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Test</strong> Details</h4>

                                                    </div>

                                                </div>
												<input type="hidden" name="job_postion_value"  value="<?php echo $appli[0]['application_job_position']; ?>">
												
												<?php if(@$appli[0]['application_job_position'] == 'Welder'){ ?>
                                                <div id="welders">
												
												<input type="hidden" name="welder" value="welder"/>
                                                 
												<?php /* <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Skills:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="skills"

                                                                  value = "<?php echo @$test_details[0]['skill']; ?>" id="skills" readonly>                                                        </div>

                                                        

                                                    </div> */ ?>

                                                    <div class="row">
                                                      
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Test Roots:</label>

                                                        <div class="col-sm-4">

                                                            <?php /*<select class="form-control" name="test_root"

                                                                    id="test_root">

                                                                <option value=""> Select</option>

                                                                <option value="Passed" <?php if(@$test_details[0]['test_root'] == 'Passed'){ echo "selected";}?>> Passed </option>

                                                                <option  value="Failed" <?php if(@$test_details[0]['test_root'] == 'Failed'){ echo "selected";}?>> Failed </option>

                                                            </select> */ ?>
															
															<input type="text" class="form-control" name="test_root"

                                                                  value = "<?php echo @$test_details[0]['test_root']; ?>" id="test_root" >

                                                        </div>

                                                    </div>
													<?php /* <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Marks/Percentage:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="mark_percentage"

                                                                   id="mark_percentage" value = "<?php echo @$test_details[0]['mark_percentage']; ?>" readonly>                                                        </div>

                                                        

                                                    </div> */ ?>
                                                   

                                                

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Fill Up and Capping:</label>

                                                        <div class="col-sm-4">

                                                            <select class="form-control" name="fillup_capping"

                                                                    id="fillup_capping">

                                                                <option value=""> Select</option>

                                                                <option value="Passed" <?php if(@$test_details[0]['fillup_capping'] == 'Passed'){ echo "selected";}?>> Passed </option>

                                                                <option  value="Failed" <?php if(@$test_details[0]['fillup_capping'] == 'Failed'){ echo "selected";}?>> Failed </option>

                                                            </select> 
															
															<?php /* <input type="text" class="form-control" name="fillup_capping"

                                                                   id="fillup_capping" value = "<?php echo @$test_details[0]['test_root']; ?>" >
*/ ?>
                                                        </div>



                                                    </div>

                                                </div>
												
												<?php } else if(@$appli[0]['application_job_position'] == 'Fabricator'){ ?>
												
                                                <div id="fabricators">
													<input type="hidden" name="fabricator" value="fabricator"/>
													
											
													<?php /* <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Skill:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="skills"

                                                                   id="skills" value = "<?php echo @$test_details[0]['skill']; ?>" readonly>                                                        </div>

                                                        

                                                    </div>

                                                  <div class="row">
                                                      
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Test Root:</label>

                                                        <div class="col-sm-4">

                                                           <?php /* <select class="form-control" name="test_root"

                                                                    id="test_root">

                                                                <option value=""> Select</option>

                                                                <option value="Passed" <?php if(@$test_details[0]['test_root'] == 'Passed'){ echo "selected";}?>> Passed </option>

                                                                <option  value="Failed" <?php if(@$test_details[0]['test_root'] == 'Failed'){ echo "selected";}?>> Failed </option>

                                                            </select> */ ?>
															
															<?php /* <input type="text" class="form-control" name="test_root"

                                                                   id="test_root" value = "<?php echo @$test_details[0]['test_root']; ?>" readonly>

                                                        </div>

                                                    </div>
													
													<div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Marks/Percentage:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="mark_percentage"

                                                                   id="mark_percentage" value = "<?php echo @$test_details[0]['mark_percentage']; ?>" readonly >                                                        </div>

                                                        

                                                    </div> */ ?>
                                                   

                                               
												
                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Cutting:</label>

                                                        <div class="col-sm-2">

                                                            <input type="number" min = "0" max= "100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" class="form-control" name="cutting"

                                                                   id="cutting" value = "<?php echo @$test_details[0]['cutting']; ?>"  >                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Grinding:</label>

                                                        <div class="col-sm-2">

                                                            <input type="number" class="form-control" name="grinding" min = "0" max= "100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}"

                                                                   id="grinding" value = "<?php echo @$test_details[0]['grinding']; ?>"  >                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Tack weld:</label>

                                                        <div class="col-sm-2">

                                                            <input type="number" class="form-control" name="tack_weld"

                                                                   id="tack_weld" min = "0" max= "100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" value = "<?php echo @$test_details[0]['tack_weld']; ?>"  >                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Drawing:</label>

                                                        <div class="col-sm-2">

                                                            <input type="number" class="form-control" name="drawing"

                                                                   id="drawing" value = "<?php echo @$test_details[0]['drawing']; ?>" min = "0" max= "100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" >                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>



                                                </div>
												<?php //} else if(@$appli[0]['application_job_position'] == 'Other'){ ?>
												<?php } else { ?>
												
												<div id="others" >
												<input type="hidden" name= "other" value="other" />
												<div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Skill:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="skills"

                                                                   id="skills" value = "<?php echo @$test_details[0]['skill']; ?>"  >                                                        </div>

                                                        

                                                    </div>

                                                    <div class="row">
                                                      
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Test Root:</label>

                                                        <div class="col-sm-4">

                                                           <select class="form-control" name="test_root"

                                                                    id="test_root">

                                                                <option value=""> Select</option>

                                                                <option  value="Passed" <?php if(@$test_details[0]['test_root'] == 'Passed'){ echo "selected";}?>> Passed </option>

                                                                <option  value="Failed" <?php if(@$test_details[0]['test_root'] == 'Failed'){ echo "selected";}?>> Failed </option>

                                                            </select> 
															
															<?php /* <input type="text" class="form-control" name="test_root"

                                                                   id="test_root" value = "<?php echo @$test_details[0]['test_root']; ?>" > */ ?>

                                                        </div>

                                                    </div>
													<div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Marks/Percentage:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="mark_percentage"

                                                                   id="mark_percentage" value = "<?php echo @$test_details[0]['mark_percentage']; ?>"  >                                                        </div>

                                                        

                                                    </div>
                                                   

                                                </div>
												<?php }  ?>
												
												
												
												
												
												
											<?php /*	
                                                <div id="welder" style="display: none">
												
												<input type="hidden" name="welder" value="welder"/>
                                                   <!-- <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Test Root:</label>

                                                        <div class="col-sm-4">

                                                            <select class="form-control" name="test_root" id="test_root">

                                                                <option value=""> Select</option>

                                                                <option selected="" value="Passed"> Passed </option>

                                                                <option  value="Failed"> Failed </option>

                                                            </select>

                                                        </div>

                                                    </div>--->

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Fill Up and Capping:</label>

                                                        <div class="col-sm-4">

                                                            <select class="form-control" name="fillup_capping"

                                                                    id="fillup_capping">

                                                                <option value=""> Select</option>

                                                                <option selected="" value="Passed"> Passed </option>

                                                                <option  value="Failed"> Failed </option>

                                                            </select>

                                                        </div>



                                                    </div>

                                                </div>
												
												<div id="other" style="display: none">
												<div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Skill:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="skills"

                                                                   id="skills">                                                        </div>

                                                        

                                                    </div>

                                                    <div class="row">
                                                      
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Test Root:</label>

                                                        <div class="col-sm-4">

                                                            <select class="form-control" name="test_root"

                                                                    id="test_root">

                                                                <option value=""> Select</option>

                                                                <option selected="" value="Passed"> Passed </option>

                                                                <option  value="Failed"> Failed </option>

                                                            </select>

                                                        </div>

                                                    </div>
													<div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Marks/Percentage:</label>

                                                        <div class="col-sm-4">

                                                            <input type="text" class="form-control" name="mark_percentage"

                                                                   id="mark_percentage">                                                        </div>

                                                        

                                                    </div>
                                                   

                                                </div>

                                                <div id="fabricator"  style="display: none">
													<input type="hidden" name="fabricator" value="fabricator"/>
                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Cutting:</label>

                                                        <div class="col-sm-2">

                                                            <input type="text" class="form-control" name="cutting"

                                                                   id="cutting">                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Grinding:</label>

                                                        <div class="col-sm-2">

                                                            <input type="text" class="form-control" name="grinding"

                                                                   id="grinding">                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Tack weld:</label>

                                                        <div class="col-sm-2">

                                                            <input type="text" class="form-control" name="tack_weld"

                                                                   id="tack_weld">                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Drawing:</label>

                                                        <div class="col-sm-2">

                                                            <input type="text" class="form-control" name="drawing"

                                                                   id="drawing">                                                        </div>

                                                        <div class="col-sm-4">

                                                            <label>%</label>

                                                        </div>

                                                    </div>



                                                </div> */ ?>
												
												
												
									
									<?php /*<div class="row"> <div class="col-sm-6">
                                                            <textarea class="form-control"  name="remark" id="remark" ><?php if(@$test_details[0]['remark']!=""){ echo $test_details[0]['remark']; } else { echo "Remarks.."; } ?></textarea>                                                        </div>
									</div> */  ?>
									
									<div class="row">

                                                        <label class="col-sm-2 control-label" for="inputEmail3">Remark:</label>

                                                        <div class="col-sm-4">

                                                            <textarea class="form-control"  name="remark" id="remark" ><?php if(@$test_details[0]['remark']!=""){ echo $test_details[0]['remark']; } else { echo "Remarks.."; } ?></textarea>
                                                        

                                    </div>
									</div>
												
												
												<div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Qualification</strong> Details</h4>

                                                    </div>

                                                </div>

                                                <?php

                                                if (isset($_REQUEST['can_id'])) {

                                                    $qualif = $db->selectQuery("SELECT * FROM `sm_candidate_qualifications` WHERE `candidate_id`='$candidate_id'");

                                                    if (count($qualif)) {

                                                        for ($ql = 0; $ql < count($qualif); $ql++) {

                                                            ?>

                                                            <div class="row">

                                                                <div class=" col-sm-6">

                                                                    <label for="city">Qualification <?php echo $nq = $ql + 1; ?></label>

                                                                    <select class="form-control" name="qualification[<?php echo $ql; ?>][qualification_name]">
																		<option selected="" value=""> Select</option>
																		<?php
																		$selectQual = $db->selectQuery("SELECT * FROM `sm_recruit_qualification` WHERE `qualification_status`='1'");
																		if (count($selectQual)) {
																			for ($qi = 0; $qi < count($selectQual); $qi++) {
																				?>
																				<option
																					value="<?php echo $selectQual[$qi]['qualification_name']; ?>" <?php
																					if ($selectQual[$qi]['qualification_name'] == $qualif[$ql]['qualification_name']) {
																						echo 'selected=""';
																					}
																					?>><?php echo $selectQual[$qi]['qualification_name']; ?></option>
																					<?php
																				}
																			}
																			?>
																	</select>
                                                                </div>

                                                                <div class=" col-sm-6">

                                                                    <label for="city">Status</label>

                                                                    <select class="form-control mb-10" name="qualification[<?php echo $ql; ?>][qualification_status]">

                                                                        <option selected="" value=""> Select</option>

                                                                        <option value="Passed" <?php

                                                                        if ($qualif[$ql]['qualification_status'] == "Passed") {

                                                                            echo "selected=''";

                                                                        }

                                                                        ?>>Passed</option>
																		
																		<option value="Failed" <?php

                                                                        if ($qualif[$ql]['qualification_status'] == "Failed") {

                                                                            echo "selected=''";

                                                                        }

                                                                        ?>>Failed</option>



                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <?php

                                                        }

                                                    } ?>
													
													<?php 

                                                } else {

                                                    ?>

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <label for="interview_qualification">Qualification: </label>

                                                            <select class="form-control" name="qualification[0][qualification_name]"

                                                                    id="interview_qualification">

                                                                <option selected="" value=""> Select</option>

                                                                 <?php
																$selectQual = $db->selectQuery("SELECT * FROM `sm_recruit_qualification` WHERE `qualification_status`='1'");
																if (count($selectQual)) {
																	for ($qi = 0; $qi < count($selectQual); $qi++) {
																		?>
																		<option
																			value="<?php echo $selectQual[$qi]['qualification_name']; ?>"><?php echo $selectQual[$qi]['qualification_name']; ?></option>
																			<?php
																		}
																	}
																	?>

                                                            </select>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <label for="interview_qualification_status">Status: </label>

                                                            <select class="form-control"

                                                                    name="qualification[0][qualification_status]"

                                                                    id="interview_qualification_status">

                                                                <option selected="" value=""> Select</option>

                                                                <option  value="Passed"> Passed</option>

                                                                <option  value="Failed"> Failed</option>

                                                            </select>

                                                        </div>

                                                    </div>

                                                    <?php

                                                }

                                                ?>
												</br>
												<div class="qualification_div"></div>
													
												<input type="hidden" value="<?php if(!empty($qualif)) { echo count($qualif); } else { echo "1"; } ?>" id="qualification_increment"/>
												<div class="row">
													<div class="col-md-3">
														<button class="btn btn-success" type="button" id="qualification_add_btn">Other Qualifications <i class="fa fa-plus"></i></button>
													</div>
												</div>

                                                <div class="row">&nbsp;</div>
												
												
												

                                                <div class="row">

                                                    <div class=" form-group col-md-12 legend">

                                                        <h4><strong>Experience</strong> Details</h4>

                                                    </div>

                                                </div>

                                                <?php

                                                if (isset($_REQUEST['can_id'])) {

                                                    $experience = $db->selectQuery("SELECT * FROM `sm_candidate_experience` WHERE `candidate_id`='$candidate_id'");

                                                    if (count($experience)) {

                                                        for ($qi = 0; $qi < count($experience); $qi++) {

                                                            ?>

                                                            <div class="row">

                                                                <div class=" col-sm-6">

                                                                    <label for="city">Company</label>

                                                                    <input type="text" class="form-control"  name="experience[<?php echo $qi; ?>][experience_company]" id="company" value="<?php echo $experience[$qi]['experience_company']; ?>">

                                                                </div>

                                                                <div class=" col-sm-6">

                                                                    <label for="city">Designation</label>
<?php /*
                                                                     <input type="text" class="form-control"  name="experience[<?php echo $qi; ?>][experience_designation]"  value="<?php echo $experience[$qi]['experience_designation']; ?>">
																	*/ ?>
																	<select class="form-control mb-10" name="experience[<?php echo $qi; ?>][experience_designation]">
                                        <option selected="" value=""> Select</option>
                                        <?php
                                        $select_exp = $db->selectQuery("SELECT * FROM `sm_job_positions`");
                                        if (count($select_exp)) {
                                            for ($ei = 0; $ei < count($select_exp); $ei++) {
                                                ?>
                                                <option value="<?php echo $select_exp[$ei]['job_name']; ?>" <?php if($select_exp[$ei]['job_name'] == $experience[$qi]['experience_designation']) { echo "selected"; }?>><?php echo $select_exp[$ei]['job_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <option value="Other"> Other</option>

                                    </select>
															
                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <?php

                                                                $datetime1 = new DateTime($experience[$qi]['experience_from']);
																$datetime2 = new DateTime($experience[$qi]['experience_to']);

                                                                ?>

                                                                <div class=" col-md-6 ">

                                                                    <label for="scstart">From: </label>

                                                                    <div class='input-group datepicker' data-format="L">

                                                                        <input type='text' value="<?php echo $datetime1->format("d/m/Y"); ?>" name="experience[<?php echo $qi; ?>][experience_from]" class="form-control" onkeydown="return false"/>

                                                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                                    </div>

                                                                </div>

                                                                <div class=" col-md-6 ">

                                                                    <label for="scstart">To: </label>

                                                                    <div class='input-group datepicker' data-format="L">

                                                                        <input type='text' value="<?php echo $datetime2->format("d/m/Y"); ?>" name="experience[<?php echo $qi; ?>][experience_to]"  class="form-control" onkeydown="return false"/>

                                                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                                    </div>

                                                                </div>

                                                            </div>
															
															<div class="row">
															<div class="col-md-6"></br>
                                                            <label for="address1">Total Experience</label>
															<?php
                                                                $interval = $datetime1->diff($datetime2);
                                                                $exper = $interval->format('%y years %m months and %d days')
                                                                ?>
																
                                                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $exper; ?>" readonly="">

															</div>
															</div>



                                                            <?php

                                                        }

                                                    }

                                                    ?>

 <?php /*                                                    <div class="row">
													
<?php 
if(@$datetime1!="" && @$datetime2!=""){
$date1 = $datetime1->format("Y-m-d");
$date2 = $datetime2->format("Y-m-d");
$diff = abs(strtotime($date2) - strtotime($date1));
 
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));



?>

                                                        <div class="col-md-6">

                                                            <label for="address1">Total:</label>

                                                            <input type="text" class="form-control" id="company_name"

                                                                   name="company_name"

                                                                   value="<?php printf("%d years, %d months, %d days\n", $years, $months, $days); ?>"

                                                                   readonly="">

                                                        </div>
<?php } ?>

                                                    </div> */ ?>

                                                    <?php

                                                } else {

                                                    ?>



                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <label for="fax">Company: </label>

                                                            <input type="text" name="experience[0][experience_company]" class="form-control">

                                                        </div>

                                                        <div class=" col-md-6">

                                                            <label for="phone">Designation: </label>

                                                            <select class="form-control mb-10" name="experience[0][experience_designation]">

                                                                <option selected="" value=""> Select</option>

                                                                <?php

                                                                $select_exp = $db->selectQuery("SELECT * FROM `sm_job_positions`");

                                                                if (count($select_exp)) {

                                                                    for ($ei = 0; $ei < count($select_exp); $ei++) {

                                                                        ?>

                                                                        <option value="<?php echo $select_exp[$ei]['job_name']; ?>"><?php echo $select_exp[$ei]['job_name']; ?></option>

                                                                        <?php

                                                                    }

                                                                }

                                                                ?>

                                                                <option value="Other"> Other</option>



                                                            </select>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <label for="scstart">From: </label>

                                                            <input type='text' name="experience[0][experience_from]"

                                                                   class="form-control date_pick"/>

                                                        </div>

                                                        <div class="col-md-6 ">

                                                            <label for="scstart">To: </label>

                                                            <input type='text' name="experience[0][experience_to]"

                                                                   class="form-control date_pick"/>



                                                        </div>

                                                    </div>

                                                   <!--- <div class="experience_div"></div>

                                                    <input type="hidden" value="1" id="experience_increment">

                                                    <div class="row">

                                                        <div class="col-md-3">

                                                            <button class="btn btn-success" type="button" id="experience_add_btn">Add Experience

                                                                <i class="fa fa-plus"></i></button>

                                                        </div>

                                                    </div> -->

                                                    <?php

                                                }

                                                ?>
												
										<div class="experience_div"></div>
										<input type="hidden" value="<?php if (isset($_REQUEST['can_id'])) { echo count($experience); } else { echo "1"; }?>" id="experience_increment">
										</br>
										<div class="row">
											<div class="col-md-3">
												<button class="btn btn-success" type="button" id="experience_add_btn">Add Experience
													<i class="fa fa-plus"></i></button>
											</div>
										</div>
										

                                                <div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Documents</strong></h4>

                                                    </div>

                                                </div>

                                                <?php

                                                if (isset($_REQUEST['can_id'])) {

                                                    $docum = $db->selectQuery("SELECT * FROM `sm_candidate_documents` WHERE `candidate_id`='$candidate_id'");
													
													//echo "<pre>";print_r($docum); 

                                                    if (count($docum)) {

                                                        for ($doc = 0; $doc < count($docum); $doc++) {

                                                            ?>

                                                            <div class="row">

                                                                <div class=" col-sm-4">

                                                                    <label for="city"><?php echo $docum[$doc]['documents_title'];?></label>

                                                                    <input type="hidden" name="documents[<?php echo $doc; ?>][documents_title]" value="<?php echo $docum[$doc]['documents_title']; ?>">

                                                                    <input type="text" class="form-control"  name="documents[<?php echo $doc; ?>][documents_data]" id="company" value="<?php echo $docum[$doc]['documents_data']; ?>">

                                                                </div>

																<?php  if($docum[$doc]['documents_title']!='ID Card') { ?>

                                                                <div class=" col-md-4 ">

                                                                    <label for="scstart">Commencing Date: </label>

                                                                    <div class='input-group datepicker' data-format="L">

                                                                        <input type='text' value="<?php echo $docum[$doc]['documents_start_date']; ?>" name="documents[<?php echo $doc; ?>][documents_start_date]" class="form-control"/>

                                                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                                    </div>

                                                                </div> 

                                                                <div class=" col-md-4 ">

                                                                    <label for="scstart">Renewal Date: </label>

                                                                    <div class='input-group datepicker' data-format="L">

                                                                        <input type='text' value="<?php echo $docum[$doc]['documents_end_date']; ?>" name="documents[<?php echo $doc; ?>][documents_end_date]" class="form-control"/>

                                                                        <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                                    </div>

                                                                </div>
																<?php } ?>

                                                            </div>

                                                            <?php

                                                        }

                                                    } 

                                                } else {

                                                    ?>

                                                    <div class="row">

                                                        <div class="col-md-4 mb-0">

                                                            <label>Passport No</label>

                                                            <input type="hidden" name="emp_docs[5][document_title]" readonly=""

                                                                   value="Passport" class="form-control addt_text"

                                                                   style="background-color: #fff; color: black; cursor: default;">

                                                            <input type="text" name="documents[0][documents_data]" id="qatar_id"

                                                                   class="form-control" placeholder=""/>

                                                        </div>

                                                        <div class="col-md-4 mb-0">

                                                            <label for="scstart">Issue Date: </label>

                                                            <div class='input-group datepicker' data-format="L">

                                                                <input type='text' name="documents[0][documents_start_date]"

                                                                       class="form-control"/>

                                                                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4 mb-0">

                                                            <label for="scstart">Renewal Date: </label>

                                                            <div class='input-group datepicker' data-format="L">

                                                                <input type='text' name="documents[0][documents_end_date]" class="form-control"/>

                                                                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-4 mb-0">

                                                            <label>Driving License ID</label>

                                                            <input type="hidden" name="documents[1][documents_title]" readonly=""

                                                                   value="Driving Licence" class="form-control addt_text"

                                                                   style="background-color: #fff; color: black; cursor: default;">

                                                            <input type="text" name="documents[1][documents_data]" id="qatar_id"

                                                                   class="form-control" placeholder=""/>

                                                        </div>

                                                        <div class="col-md-4 mb-0">

                                                            <label for="scstart">Start Date: </label>

                                                            <div class='input-group datepicker' data-format="L">

                                                                <input type='text' name="documents[1][documents_start_date]"

                                                                       class="form-control"/>

                                                                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4 mb-0">

                                                            <label for="scstart">End Date: </label>

                                                            <div class='input-group datepicker' data-format="L">

                                                                <input type='text' name="documents[1][documents_end_date]" class="form-control"/>

                                                                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-4 mb-0">

                                                            <label>ID Card No</label>

                                                            <input type="hidden" name="documents[2][documents_title]" readonly=""

                                                                   value="ID Card" class="form-control addt_text"

                                                                   style="background-color: #fff; color: black; cursor: default;">

                                                            <input type="text" name="documents[2][documents_data]" id="qatar_id"

                                                                   class="form-control" placeholder=""/>

                                                        </div>

                                                    </div>

                                                    <?php

                                                } 

                                                ?>
												
												

                                                <div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Uploads</strong></h4>

                                                    </div>

                                                </div>

                                                <?php

                                                if (isset($_REQUEST['can_id'])) {

                                                    $select_pass = $db->selectQuery("SELECT `file_name` FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name`='Passport_Documents' AND `file_status` = 1");

                                                    if (count($select_pass)) {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Passport</label>

                                                            <span class="btn btn-primary fileinput-button">Uploaded &nbsp;<span class="">

                                                                </span>

                                                            </span>

                                                            <p></p>

                                                        </div>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Passport</label>

                                                            <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                                <span class="">Add File</span>

                                                                <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                                <input type="hidden" value="Passport_Documents"  class="dfile">

                                                            </span>

                                                            <span class="file_status" name="File name here"></span>

                                                            <p></p>

                                                        </div>
														
													<div class="row">
														<div class="form-group col-sm-4">
															<input type="hidden" name="emp_docs[0][document_title]"
																   value="Passport_Documents" readonly=""
																   class="form-control addt_text"
																   style="background-color: #fff; cursor: default;">
															<input type="hidden" name="emp_docs[0][document_data]" value=""
																   id="cr" class="form-control">
														</div>
													</div>

                                                        <?php

                                                    }

                                                    ?>

                                                    <?php

                                                    $select_exp = $db->selectQuery("SELECT `file_name` FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name`='Experience_Certificates' AND `file_status` = 1");

                                                    if (count($select_exp)) {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Experience </label>

                                                            <span class="btn btn-primary fileinput-button">Uploaded &nbsp;<span class="">

                                                                </span>

                                                            </span>

                                                            <p></p>

                                                        </div>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Experience Documents</label>

                                                            <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                                <span class="">Add File</span>

                                                                <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                                <input type="hidden" value="Experience_Certificates" class="dfile">

                                                            </span>

                                                            <span class="file_status" name="File name here"></span>

                                                            <p></p>

                                                        </div>
														
														<div class="row">
														<div class="form-group col-sm-4">
															<input type="hidden" name="emp_docs[1][document_title]"
																   value="Experience_Certificates" readonly=""
																   class="form-control addt_text"
																   style="background-color: #fff; cursor: default;">
															<input type="hidden" name="emp_docs[1][document_data]" value=""
																   id="cr" class="form-control">
														</div>
													</div>

                                                        <?php

                                                    }

                                                    ?>

                                                    <?php

                                                    $select_exp = $db->selectQuery("SELECT `file_name` FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name`='Resume' AND `file_status` = 1");

                                                    if (count($select_exp)) {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Resume</label>

                                                            <span class="btn btn-primary fileinput-button">Uploaded &nbsp;<span class="">

                                                                </span>

                                                            </span>

                                                            <p></p>

                                                        </div>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Resume</label>

                                                            <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                                <span class="">Add File</span>

                                                                <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                                <input type="hidden" value="Resume"  class="dfile">

                                                            </span>

                                                            <span class="file_status" name="File name here"></span>

                                                            <p></p>

                                                        </div>
														
														<div class="row">
														<div class="form-group col-sm-4">
															<input type="hidden" name="emp_docs[2][document_title]"
																   value="Resume" readonly=""
																   class="form-control addt_text"
																   style="background-color: #fff; cursor: default;">
															<input type="hidden" name="emp_docs[2][document_data]" value=""
																   id="cr" class="form-control">
														</div>
														</div>

                                                        <?php

                                                    }

                                                    ?>

                                                    <?php

                                                    $select_exp = $db->selectQuery("SELECT `file_name` FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name`='ID_Card' AND `file_status` = 1");

                                                    if (count($select_exp)) {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">ID Card</label>

                                                            <span class="btn btn-primary fileinput-button">Uploaded &nbsp;<span class="">

                                                                </span>

                                                            </span>

                                                            <p></p>

                                                        </div>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">ID Card</label>

                                                            <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                                <span class="">Add File</span>

                                                                <input type="file" name="files" class="" id="id_card" onchange="upload_files(this)"  multiple>

                                                                <input type="hidden" value="ID_Card"  class="dfile">

                                                            </span>

                                                            <span class="file_status" name="File name here"></span>

                                                            <p></p>

                                                        </div>
														
														<div class="row">
														<div class="form-group col-sm-4">
															<input type="hidden" name="emp_docs[3][document_title]"
																   value="ID_Card" readonly=""
																   class="form-control addt_text"
																   style="background-color: #fff; cursor: default;">
															<input type="hidden" name="emp_docs[3][document_data]" value=""
																   id="cr" class="form-control">
														</div>
														</div>

                                                        <?php

                                                    }

                                                    ?>

                                                    <?php

                                                    $select_exp = $db->selectQuery("SELECT `file_name` FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name`='Driving_License' AND `file_status` = 1");

                                                    if (count($select_exp)) {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Driving License</label>

                                                            <span class="btn btn-primary fileinput-button">Uploaded &nbsp;<span class="">

                                                                </span>

                                                            </span>

                                                            <p></p>

                                                        </div>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <div class="sam">

                                                            <label class="col-md-4 control-label">Driving License</label>

                                                            <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                                <span class="">Add File</span>

                                                                <input type="file" name="files" class="" id="id_card" onchange="upload_files(this)"  multiple>

                                                                <input type="hidden" value="Driving_License"  class="dfile">

                                                            </span>

                                                            <span class="file_status" name="File name here"></span>

                                                            <p></p>

                                                        </div>
														
														<div class="row">
														<div class="form-group col-sm-4">
															<input type="hidden" name="emp_docs[4][document_title]"
																   value="Driving_License" readonly=""
																   class="form-control addt_text"
																   style="background-color: #fff; cursor: default;">
															<input type="hidden" name="emp_docs[4][document_data]" value=""
																   id="cr" class="form-control">
														</div>
														</div>

                                                        <?php

                                                    }

                                                } else {

                                                    ?>

                                                    <div class="sam">

                                                        <label class="col-md-4 control-label">Passport</label>

                                                        <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Add File</span>

                                                            <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                            <input type="hidden" value="Passport_Documents"  class="dfile">

                                                        </span>

                                                        <span class="file_status" name="File name here"></span>

                                                        <p></p>

                                                    </div>

                                                    <div class="sam">

                                                        <label class="col-md-4 control-label">Experience Documents</label>

                                                        <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Add File</span>

                                                            <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                            <input type="hidden" value="Experience_Certificates"  class="dfile">

                                                        </span>

                                                        <span class="file_status" name="File name here"></span>

                                                        <p></p>

                                                    </div>



                                                    <div class="sam">

                                                        <label class="col-md-4 control-label">Resume</label>

                                                        <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Add File</span>

                                                            <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                            <input type="hidden" value="Resume"  class="dfile">

                                                        </span>

                                                        <span class="file_status" name="File name here"></span>

                                                        <p></p>

                                                    </div>



                                                    <div class="sam">

                                                        <label class="col-md-4 control-label">ID Card</label>

                                                        <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Add File</span>

                                                            <input type="file" name="files" class="" id="id_card" onchange="upload_files(this)"  multiple>

                                                            <input type="hidden" value="ID_Card"  class="dfile">

                                                        </span>

                                                        <span class="file_status" name="File name here"></span>

                                                        <p></p>

                                                    </div>



                                                    <div class="sam">

                                                        <label class="col-md-4 control-label">Driving License</label>

                                                        <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Add File</span>

                                                            <input type="file" name="files" class="" id="id_card" onchange="upload_files(this)"  multiple>

                                                            <input type="hidden" value="Driving_License"  class="dfile">

                                                        </span>

                                                        <span class="file_status" name="File name here"></span>

                                                        <p></p>

                                                    </div>

                                                    <?php

                                                }

                                                ?>



                                                <div class="row">

                                                    <div class="form-group col-md-12 legend">

                                                        <h4><strong>Interview</strong>Status</h4>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <label class="col-sm-3 control-label" for="inputEmail3">Interview Status:</label>

                                                    <div class="col-sm-6">

                                                        <select class="form-control" name="interview_result"

                                                                id="interview_result">

                                                            <option selected="" value=""> Select </option>

                                                            <option value="Selected" <?php if(@$candidate_interview_status == 'Selected'){ echo "selected";}?>> Selected </option>

                                                            <option  value="Retest" <?php if(@$candidate_interview_status == 'Retest'){ echo "selected";}?> > Retest </option>

                                                            <option  value="Rejected" <?php if(@$candidate_interview_status == 'Rejected'){ echo "selected";}?>> Rejected </option>
															
															<option  value="onhold" <?php if(@$candidate_interview_status == 'onhold'){ echo "selected";}?> > On Hold </option>

                                                        </select>

                                                    </div>

                                                </div>

                                                <p></p>
												
												<?php if(!empty($_REQUEST['can_id'])){
												$select_cc = $db->selectQuery("SELECT `file_name` FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name`='Candidate_Contract'");
												
												
												if (isset($_REQUEST['can_id']) && $candidate_interview_status== 'Selected' && count($select_cc)) { ?>
												<div class="selected_result">
														<div class="row">
                                                        <label class="col-sm-3 control-label" for="inputEmail3">Signed Contract:</label>
														
																<div class="col-sm-6">
																 <span class="btn btn-primary fileinput-button">Uploaded &nbsp;<span class="">
                                                                </span>
                                                            </span>
															</div>
														</div>
														
														<?php $cand_salary = $db->selectQuery("SELECT `salary` FROM `sm_selected_candidates` WHERE `candidate_id`='$candidate_id'"); ?>
														
														<div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Salary in QAR:</label>

                                                        <div class="col-sm-6">

                                                            <input type="text" class="form-control" name="selected_salary" id="selected_salary" value="<?php echo @$cand_salary[0]['salary']; ?>">

                                                        </div>

                                                    </div>
													
												</div>
																
												<?php } else { ?>

                                                <div class="selected_result" style="display: none">

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Upload Signed Contract:</label>

                                                        <div class="col-sm-6">

                                                            <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                                <span class="">Add File</span>

                                                                <input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                                <input type="hidden" value="Candidate_Contract"  class="dfile">

                                                            </span>

                                                            <span class="file_status" name="File name here"></span>



                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Salary in QAR:</label>

                                                        <div class="col-sm-6">

                                                            <input type="text" class="form-control" name="selected_salary" id="selected_salary">

                                                        </div>

                                                    </div>

                                                    <div>
                                                    </div>
                                                </div>
												<?php } ?>
												
												
												<?php $cand_rej = $db->selectQuery("SELECT `rejection_reason` FROM `sm_rejected_candidates` WHERE `candidate_id`='$candidate_id'"); ?>
														
												
												<?php if (isset($_REQUEST['can_id']) && $candidate_interview_status== 'Rejected' && !empty($cand_rej)) { ?>

                                                <div class="rejected_result" >

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Reason for rejection:</label>

                                                        <div class="col-sm-6">

                                                            <input type="text" class="form-control" name="rejection_reason" id="rejection_reason" value="<?php echo $cand_rej[0]['rejection_reason']; ?>">

                                                        </div>

                                                    </div>

                                                </div>
												<?php } else { ?>
												
												<div class="rejected_result" style="display: none">

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Reason for rejection:</label>

                                                        <div class="col-sm-6">

                                                            <input type="text" class="form-control" name="rejection_reason" id="rejection_reason">

                                                        </div>

                                                    </div>

                                                </div>
													
												<?php } ?>
												
												<?php $cand_reset = $db->selectQuery("SELECT `retest_date` FROM `sm_retest_candidates` WHERE `candidate_id`='$candidate_id'"); ?>
												
												
												<?php if (isset($_REQUEST['can_id']) && $candidate_interview_status== 'Retest' && !empty($cand_reset)) { ?>


                                                <div class="retest_result" >

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Retest Date:</label>

                                                        <div class=" col-md-6 ">

                                                            <div class='input-group datepicker' data-format="L">

                                                                <input type='text' name="retest_date" class="form-control" value="<?php echo $cand_reset[0]['retest_date'];?>" />

                                                                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
												<?php } else { ?>
												
												<div class="retest_result" style="display: none">

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Retest Date:</label>

                                                        <div class=" col-md-6 ">

                                                            <div class='input-group datepicker' data-format="L">

                                                                <input type='text' name="retest_date" class="form-control" />

                                                                <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
													
												<?php } ?>
												
												<?php $cand_hold = $db->selectQuery("SELECT `holding_reason` FROM `sm_holding_candidates` WHERE `candidate_id`='$candidate_id'"); ?>
														
												
												<?php //echo "dff";echo "<pre>";print_r($cand_hold); 
												if (isset($_REQUEST['can_id']) && $candidate_interview_status== 'onhold' && !empty($cand_hold)) { ?>

												
												

												<div class="holding_result" >

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Reason for Holding:</label>

                                                        <div class="col-sm-6">

                                                            <input type="text" class="form-control" name="holding_reason" id="holding_reason" value="<?php echo $cand_hold[0]['holding_reason']; ?>" >

                                                        </div>

                                                    </div>

                                                </div>
												<?php } else { ?>
												
												<div class="holding_result" style="display: none">

                                                    <div class="row">

                                                        <label class="col-sm-3 control-label" for="inputEmail3">Reason for Holding:</label>

                                                        <div class="col-sm-6">

                                                            <input type="text" class="form-control" name="holding_reason" id="holding_reason">

                                                        </div>

                                                    </div>

                                                </div>
												
												<?php } ?>
												
												<?php } ?>



                                                <div class="row">&nbsp;</div>

                                                <div class="row">&nbsp;</div>



                                                <input type="submit" name="submit" class="btn btn-rounded btn-success btn-sm" value="Update"  >

                                            </div>



                                        </div>



                                    </div>

                                    <!-- /tile body -->



                                    </section>

                                    <!-- /tile -->



                                </div>

                                </form>

                                <!-- /col -->

                                <div class="col-md-3">



                                    <!-- tile -->

                                    <section class="tile tile-simple">



                                        <!-- tile widget -->

                                        <div class="tile-widget p-30 text-center">

                                            <?php

                                            if (!isset($_REQUEST['can_id'])) {

                                                ?>

                                                <div class="thumb thumb-xl">

                                                    <img  id="emdp"  src="<?php echo $dpImg; ?>" alt="">

                                                </div>

                                               <div class="sam">

                                                    

                                                    <span > 

<?php if(!empty($dpImg)){?>                                                      
<div class="thumb thumb-xl"><img  src="<?php echo $dpImg; ?>" alt="">
</div><?php } ?>
<a href="" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3" class="btn btn-success fileinput-button">Candidate Photos <i class="glyphicon glyphicon-plus"></i></a>
                                                    </span>

                                                 

                                                </div>

                                                

                                                 <!---<div class="sam">

                                                    <label class="col-sm-3 control-label"></label>

                                                    <a href="take_picture/preview.php?can_id=<?php echo $candidate_id; ?>">  <span class="btn btn-primary"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Candidate Photo</span>

                                                            <a href="take_picture/preview.php?can_id=<?php //echo $candidate_id;?>                                                                                                                     ?>"></a>-->

                                                            <!--<input type="hidden" value="Profile_Picture" name="profpic" class="dfile">

                                                        </span></a>

                                                    <span class="file_status" name="File name here"></span>

                                                    <p  ></p>



                                                </div>--->

                                                <div class="sam">

                                                </div>

                                                <?php

                                            }

                                            if (isset($_REQUEST['can_id']) && !isset($_SESSION['Candidate_Picture'])) {

                                                ?>
												<?php 
												if (file_exists($dpImg)) { ?>

                                                <div class="thumb thumb-xl">

                                                    <img  id="emdp" src="<?php echo $dpImg; ?>" alt="">

                                                </div>
												<?php } ?>

                                                <!--<div class="sam">

                                                    <label class="col-sm-3 control-label"></label>

                                                    <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i>

                                                        <span class="">Upload</span>

                                                        <input type="file" name="files" class="" id="profile_pic" onchange="upload_files_without_doc(this)"  multiple>

                                                        <input type="hidden" value="Profile_Picture" name="profpic" class="dfile">

                                                    </span>

                                                    <span class="file_status" name="File name here"></span>

                                                    <p  ></p>



                                                </div>--->

                                               <!-- or-->

                                                <div class="sam">

                                                    <label class="col-sm-3 control-label"></label>

                                                   
                                                           <!-- <span class="">Candidate Photoxx</span>-->

                                                            <!--<a href="take_picture/preview.php?can_id=<?php //echo $candidate_id;                                                                                                                      ?>"></a>-->
															
															<a href="" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3" class="btn btn-success fileinput-button">Candidate Photos <i class="glyphicon glyphicon-plus"></i></a>

                                                            <input type="hidden" value="Profile_Picture" name="profpic" class="dfile">

                                                        </span></a>

                                                    <span class="file_status" name="File name here"></span>

                                                    <p  ></p>



                                                </div>

                                                <div class="sam">

                                                </div>

                                                <?php

                                            }

                                            ?>
<?php// echo $dpImg; ?>
                                            <?php

                                            if (isset($_SESSION['Candidate_Picture']) && isset($_REQUEST['can_id'])) {

                                               // if (file_exists($dpImg) class="img-circle") { ?>

                                                <div class="thumb thumb-xl">

                                                    <img id="emdp" src="<?php echo $dpImg; ?>" alt="">

                                                </div>
												<?php// } ?>

                                                <div class="sam">

                                                    <label class="col-sm-3 control-label"></label>

                                                    <!--<a href="take_picture/preview.php?can_id=<?php echo $candidate_id; ?>">  <span class="btn btn-primary"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Captures</span>

                                                            <input type="hidden" value="Profile_Picture" name="profpic" class="dfile">

                                                        </span></a>-->
														
														<a href="" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3" class="btn btn-success fileinput-button">Candidate Photos <i class="glyphicon glyphicon-plus"></i></a>

                                                    <span class="file_status" name="File name here"></span>

                                                    <p></p>

                                                </div>

                                                <?php

                                            }

                                            ?>

                                        </div>

                                    </section>



                                    <!-- /tile -->





                                    <!-- tile -->



                                    <!-- /tile -->





                                </div>



                            </div>

                            <!-- /row -->



                    </div>

                    <!-- /page content -->



            </div>



            </section>

            <!--/ CONTENT -->



        </div>

        <!--/ Application Content -->



    </div>

<div class="modal splash fade" id="splash1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Please choose an action</h3>
            </div>
            <div class="modal-body">
                
                                             <div class="sam">



                                                   <a id="camera">  <span class="btn btn-primary"> <i class="glyphicon glyphicon-plus"></i>

                                                            <span class="">Capture</span>

                                                            <!--<a href="take_picture/preview.php?can_id=<?php //echo $candidate_id;                                                                                                                      ?>"></a>-->

                                                            <input type="hidden"  value="Profile_Picture" name="profpic" class="dfile">

                                                        </span></a>
														

                                                    <label class="col-sm-3 control-label" ></label>

                                                  

                                                 <span>
                                                        <!--<input type="file" name="files" class="" id="profile_pic" onchange="upload_files(this)"  multiple>

                                                        <input type="hidden" value="Profile_Picture" name="profpic" class="dfile">-->
														
														<!--<input type=button value="Capture & Upload" onClick="take_snapshot()" class="btn btn-success fileinput-button" style="font-weight:bold;">-->

                                                    </span>

                                                    <span class="file_status" name="File name here"></span>

                                                    <button class="btn btn-danger delete" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancel</button>
													


                                                </div>
												 <div class="row" id="camcontent" style="display:none;">
            <div class="col-md-3" rel="advertisements"></div>
			
			

            <div class="col-md-6">
                <div class="list-group">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-primary" href="interview_form.php">Back to Interview Form </a>
                    </div>
                </div>
                <div id="my_camera"></div>
				
				<?php /*<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
				<input type="text" name="myname" id="myname">
				<input type="submit" name="send" id="send">
				</form> */?>
			
				<script type="text/javascript" src="take_picture/webcam.js"></script>
				<script language="JavaScript">
					document.write( webcam.get_html(320, 240) );
				</script>
                <form>
                    <!--<div id="pre_take_buttons">
                        <input type=button value="Take Snapshot" class="btn btn-primary" onClick="preview_snapshot()" 
						id="image_file_input">
                    </div>
                    <div id="post_take_buttons" style="display:none">
                        <input type=button value="&lt; Take Another" class="btn btn-danger" onClick="cancel_preview()">
                        <input type=button value="Save Photo &gt;"  onClick="save_photo()" class="btn btn-success" style="font-weight:bold;">
                    </div>-->
					
					<input type=button value="Configure..." onClick="webcam.configure()" class="btn btn-primary">
					&nbsp;&nbsp;
					<input type=button value="Capture & Upload" onClick="take_snapshot()" class="btn btn-success" style="font-weight:bold;">
                </form>
                <!--<div id="results" class="well">Your captured image will appear here...</div>--->
				<div id="upload_results" style="background-color:#eee;"></div>
            </div>
            <!-- <div class="col-md-3" rel="advertisements"></div>-->
        </div>
              
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
    </div>
</div>



    <style>

        .validate_span {

            color: #ff7b76 !important;

            font-size: 12px;

            line-height: 0.9em;

            list-style-type: none;

        }

    </style>

    <!-- ============================================

    ============== Vendor JavaScripts ===============

    ============================================= -->
	
    <!---<script src="assets/jquery.min.js"></script>-->

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

    <script src="assets/js/vendor/parsley/parsley.min.js"></script>
	<script src=""></script>

        <!-- First, include the Webcam.js JavaScript Library -->
        <!--<script type="text/javascript" src="take_picture/webcam.min.js"></script>
        <script type="text/javascript" src="take_picture/script.js"></script>-->

    <!--/ vendor javascripts -->

    <!-- ============================================

    ============== Custom JavaScripts ===============

    ============================================= -->

    <script src="assets/js/main.js"></script>

    <!--/ custom javascripts -->

    <!-- ===============================================

    ============== Page Specific Scripts ===============

    ================================================ -->

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script>
                                                       $('body').on('click', '.date_pick', function () {
                                                           $(this).datepicker({
                                                               changeMonth: true,
                                                               changeYear: true,
                                                               dateFormat: "dd/mm/yy"
                                                           }).focus();
                                                           $(this).removeClass('datepicker');
                                                       });
</script>

    <script>
 $(document).ready(function(){
      $("#camera").click(function(){
          $("#camcontent").show();
      });
   });
   

                                                        $('#selected_interview').change(function () {

                                                            var selected_interview = $(this).val();

                                                            $.ajax({

                                                                url: "interview_form_process.php",

                                                                type: "POST",

                                                                data: {selected_interview: selected_interview},

                                                                success: function (data) {

                                                                    $('#select_job').html(data);

                                                                }

                                                            });

                                                        });

                                                        $('#select_job').change(function () {

                                                            var select_job = $(this).val();
															
															var select_intrw = $('#selected_interview').val();

                                                            $.ajax({

                                                                url: "interview_form_process.php",

                                                                type: "POST",

                                                                data: {select_job: select_job,select_intrw: select_intrw},

                                                                success: function (data) {

                                                                    $('#select_candidate').html(data);

                                                                }

                                                            });

                                                        });

                                                        $('#select_candidate').change(function () {

                                                            var select_candidate = $(this).val();

                                                            location.href = "interview_form.php?can_id=" + select_candidate;



                                                        });

                                                        $('#job_position').change(function () {
															
															

                                                            var this_val = $(this).val();

                                                            if (this_val == "Fabricator") {

                                                                $('#fabricator').show();

                                                                $('#welder').hide();
																
																$('#welders').hide();
																$('#fabricators').hide();
																$('#others').hide();

                                                            } else if (this_val == "Welder") {

                                                                $('#welder').show();

                                                                $('#fabricator').hide();
																
																$('#welders').hide();
																$('#fabricators').hide();
																$('#others').hide();

                                                            }else if (this_val != "Welder" && this_val !="Fabricator"){

                                                                $('#welder').hide();
																
																$('#fabricator').hide();
																
																$('#other').show();
																
																$('#welders').hide();
																$('#fabricators').hide();
																$('#others').hide();

                                                            }

                                                            $.ajax({

                                                                url: "interview_form_process.php",

                                                                type: "POST",

                                                                data: {intr_job: this_val},

                                                                success: function (data) {

                                                                    $('#interview_category').html();

                                                                }

                                                            });
															
															$('#job_postion_value').val(this_val);

                                                        });



                                                        $('#interview_category').change(function () {

                                                            var job_cat = $(this).val();

                                                            var job_psn = $('#interview_job_position').val();

                                                            $.ajax({

                                                                url: "interview_form_process.php",

                                                                type: "POST",

                                                                data: {job_cat: job_cat, job_psn: job_psn},

                                                                success: function (data) {

                                                                    $('.skill_set').html(data);

                                                                }

                                                            });

                                                        });

                                                        $('#interview_result').change(function () {

                                                            var selected_val = $(this).val();

                                                            if (selected_val == "Selected") {

                                                                $('.rejected_result').hide();

                                                                $('.retest_result').hide();
																
																$('.holding_result').hide();

                                                                $('.selected_result').show();

                                                            } else if (selected_val == "Rejected") {

                                                                $('.selected_result').hide();

                                                                $('.retest_result').hide();
																
																$('.holding_result').hide();

                                                                $('.rejected_result').show();



                                                            } else if (selected_val == "Retest") {

                                                                $('.selected_result').hide();

                                                                $('.rejected_result').hide();
																
																$('.holding_result').hide();

                                                                $('.retest_result').show();

                                                            } else if (selected_val == "onhold") {

                                                                $('.selected_result').hide();

                                                                $('.rejected_result').hide();

                                                                $('.retest_result').hide();
																
																$('.holding_result').show();

                                                            }

                                                        });

                                                      <?php /*  $('#experience_add_btn').click(function () {

                                                            var experience_add = "experience_add";

                                                            experience_increment = $('#experience_increment').val();

                                                            added_exp = +experience_increment + 1;

                                                            $('.experience_div').append(

                                                                    '<div class="row">'

                                                                    + '<div class="form-group col-md-4">'

                                                                    + '<label for="fax">Company: </label>'

                                                                    + '<input type="text"  name="experience[' + experience_increment + '][experience_company]"  class="form-control" > '

                                                                    + '</div>'

                                                                    + '<div class="form-group col-md-4">'

                                                                    + '<label for="phone">Designation: </label>'

                                                                    + '<select class="form-control mb-10" name="experience[' + experience_increment + '][experience_designation]"  >'

                                                                    + '<option selected="" value=""> Select</option>'

                                                                    + '<option value="Married">Sample</option>'

                                                                    + '<option value="Not Married">Sample</option>'

                                                                    + '</select>'

                                                                    + '</div>'

                                                                    + '</div>'

                                                                    + '<div class="row">'

                                                                    + '<div class="form-group col-md-4">'

                                                                    + '<label for="scstart">From: </label>'

                                                                    + '<input type="text" name="experience[' + experience_increment + '][experience_from]" class="form-control date_pick"/>'

                                                                    + '</div>'

                                                                    + '<div class="form-group col-md-4 ">'

                                                                    + '<label for="scstart">To: </label>'

                                                                    + '<input type="text" name="experience[' + experience_increment + '][experience_to]" class="form-control date_pick"/>'

                                                                    + '</div>'

                                                                    + '</div>'

                                                                    );

                                                            $('#experience_increment').val(added_exp);

                                                        }); */ ?>



                                                        function upload_files(element) {

                                                            $(element).parent('span').siblings('.file_status_img').html("<img src='assets/images/buffering.gif' width='30' height='30' />");

                                                            var section = $(element).siblings('.dfile').val();

                                                            var cp_id = "<?php echo $candidate_id ?>";

                                                            var numf = 0;

                                                            var file_ok = 0;

                                                            var formData = new FormData();

                                                            $.each($(element)[0].files, function (i, file) {

                                                                var fileSize = this.size;

                                                                var sizeLimit = 2000000;

                                                                if (fileSize > sizeLimit) {

                                                                    file_ok = 0;

                                                                    $(element).parent('span').siblings('.file_status_img').hide();

                                                                    $(element).parent('span').siblings('.file_status_warn').css("color", "red");

                                                                    $(element).parent('span').siblings('.file_status_warn').html("File size must be less than 2MB");

                                                                } else {

                                                                    file_ok = 1;

                                                                    formData.append('file-' + i, file);

                                                                    numf = numf + 1;

                                                                    $(this).closest('input').val();

                                                                }

                                                            });

                                                            if (file_ok == 1) {

                                                                $.ajax({

                                                                    url: "candidate_fileup.php?numf=" + numf + '&cp_id=' + cp_id + '&section=' + section,

                                                                    type: "POST",

                                                                    cache: false,

                                                                    contentType: false,

                                                                    processData: false,

                                                                    data: formData,

                                                                    success: function (data) {

                                                                        $(element).parent('span').siblings('.file_status_img').hide();

                                                                        $(element).parent('span').siblings('.file_status_warn').hide();

                                                                        $(element).parent('span').siblings('.file_status').css("color", "#428bca");

                                                                        $(element).parent('span').siblings('.file_status').append(data);

                                                                    }

                                                                });

                                                            }

                                                        }
		$('.job_position').change(function () {
        var job_position = $(this).val();
        $.ajax({
            url: "candidate_process.php",
            type: "POST",
            data: {job_position: job_position},
            success: function (data) {
                $('#job_category').html(data);
            }
        });
    });
														
		//$('#job_category').change(function () {
		$('#job_category').change(function () {	
        var job_cat = $(this).val();
        var job_psn = $('.job_position').val();
        $.ajax({
            url: "candidate_process.php",
            type: "POST",
            data: {job_cat: job_cat, job_psn: job_psn},
            success: function (data) {
                $('.skill_set').html(data);
            }
        });
    });

    </script>

</script>

<!---<script language="JavaScript">
		document.write( webcam.get_html(320, 240) );
</script>-->

<script language="JavaScript">
//jQuery(document).ready(function() {
	
    webcam.set_api_url( 'webcam_uploading.php');
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
		webcam.set_hook( 'onComplete', 'my_completion_handler' );

		
		
		function take_snapshot_prew(){
			// take snapshot and upload to server
			//alert("take_snapshot_prew");
			// freeze camera so user can preview pic
            webcam.freeze();
			//document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			//webcam.snap();
		}
		
		function take_snapshot(){
			// take snapshot and upload to server
			//alert("take_snapshot");
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
		}
		

		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				// show JPEG image in page
				//document.getElementById('upload_results').innerHTML ='<h1>Upload Successful!</h1>';
				// reset camera for another shot
				//webcam.reset();
				window.location = "interview_form.php?can_id=<?php echo $candidate_id; ?>";
			}
			else {alert("PHP Error: " + msg);
		}
		
		}
		
//});

	</script>
	
<script type="text/javascript">
function validate(){
    x=document.myForm
    input=x.myInput.value
    if (input.length>5){
        alert("The field cannot contain more than 5 characters!")
        return false
    }else {
        return true
    }
}
$('#qualification_add_btn').click(function () {
        var qualification_add = "qualification_add";
        qualification_val_incr = $('#qualification_increment').val();
        added_qual = +qualification_val_incr + 1;
        $.ajax({
            url: "interviewform_qualification_increment.php",
            type: "POST",
            data: {qualification_add: qualification_add, qual_val: qualification_val_incr},
            success: function (data) {
                $('.qualification_div').append(data);
                $('#qualification_increment').val(added_qual);
            }
        });
    });
		$('#experience_add_btn').click(function () {
        var experience_add = "experience_add";
        experience_increment = $('#experience_increment').val();
        added_exp = +experience_increment + 1;
        $('.experience_div').append(
                '<div class="row">'
                + '<div class="col-md-6">'
                + '<label for="fax">Company: </label>'
                + '<input type="text"  name="experience[' + experience_increment + '][experience_company]"  class="form-control" > '
                + '</div>'
                + '<div class="col-md-6">'
                + '<label for="phone">Designation: </label>'
                + '<select class="form-control mb-10" name="experience[' + experience_increment + '][experience_designation]"  >'
                + '<option selected="" value=""> Select</option>'
<?php
$select_exp = $db->selectQuery("SELECT * FROM `sm_job_positions`");
if (count($select_exp)) {
    for ($ei = 0; $ei < count($select_exp); $ei++) {
        ?>
                +'  <option value="<?php echo $select_exp[$ei]["job_name"]; ?>"><?php echo $select_exp[$ei]["job_name"]; ?></option>'
        <?php
    }
}
?>
        + '</select>'
                + '</div>'
                + '</div>'
                + '<div class="row">'
                + '<div class="col-md-6">'
                + '<label for="scstart">From: </label>'
               // + '<input type="text" name="experience[' + experience_increment + '][experience_from]" class="form-control date_pick"/>'
				+ '<div class="input-group datepicker" data-format="L">'
                //+ '<input type="text" name="experience[' + experience_increment + '][experience_to]" class="form-control date_pick"/>'
				+ '<input type="text" name="experience[' + experience_increment + '][experience_from]" class="form-control date_pick" onkeydown="return false" />'
				+ '<span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>'
				+ '</div>'
                + '</div>'
                + '<div class="col-md-6 ">'
                + '<label for="scstart">To: </label>'
				+ '<div class="input-group datepicker" data-format="L">'
                //+ '<input type="text" name="experience[' + experience_increment + '][experience_to]" class="form-control date_pick"/>'
				+ '<input type="text" name="experience[' + experience_increment + '][experience_to]" class="form-control date_pick" onkeydown="return false" />'
				+ '<span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>'
				+ '</div>'
                + '</div>'
				+ '</div>'
				+ '</br>'
                );
                $('#experience_increment').val(added_exp);
    });
	
		function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            //alert('Invalid Email Address');
			$('#emailval').html('Invalid Email Address').fadeOut(3000);
            return false;
        }

        return true;

}

</script>
</body>

</html>



