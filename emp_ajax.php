<?php
include("connection.php");
if(isset($_REQUEST['requirements'])){
    $requirements=$_REQUEST['requirements'];
    $requirement=$db->selectQuery("SELECT sm_external_requirment.designation,sm_external_demands.requirement,sm_designation.designation_name,sm_designation.designation_id FROM sm_external_requirment INNER JOIN sm_external_demands INNER JOIN sm_designation ON sm_external_requirment.id=sm_external_demands.id AND sm_external_requirment.designation=sm_designation.designation_id WHERE sm_external_demands.id='$requirements'");
   
		//print_r($requirement); die;?>
		
                                        <option selected="" value=""> Select</option>
										<?php
										 if(count($requirement)){
                                            for ($ei = 0; $ei < count($requirement); $ei++) {
                                                ?>
                                                <option value="<?php echo $requirement[$ei]['designation_id']; ?>"><?php echo $requirement[$ei]['designation_name']; ?></option>
                                                <?php
                                            }
										 } else { ?>
										 <option selected="" value=""> Data Not Available</option>
										<?php	} ?>
                                    
		
       <?php 
       
           // echo $requirement[0]['designation_name'];
           
        
    }
	
	if(isset($_POST['titles'])){
		$title= $_POST['titles'];
		//echo "haii"; die;
		
		  $job_position=$db->selectQuery("SELECT sm_requirements.	job_position,sm_designation.designation_name,sm_designation.designation_id FROM sm_inhouse_requirement INNER JOIN sm_requirements INNER JOIN sm_designation ON sm_requirements.	job_position=sm_designation.designation_id AND sm_inhouse_requirement.id=sm_requirements.id WHERE sm_inhouse_requirement.id='$title'");
   
		//print_r($requirement); die;?>
		
                                        <option selected="" value=""> Select</option>
										<?php
										 if(count($job_position)){
                                            for ($ei = 0; $ei < count($job_position); $ei++) {
                                                ?>
                                                <option value="<?php echo $job_position[$ei]['designation_id']; ?>"><?php echo $job_position[$ei]['designation_name']; ?></option>
                                                <?php
                                            }
										 } else { ?>
										 <option selected="" value=""> Data Not Available</option>
										<?php	} ?>
		
<?php	}
	?>
