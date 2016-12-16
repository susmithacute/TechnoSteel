<?php
include('connection.php');
if (isset($_POST['sele_can']))
	{
		 $candidate_id = $_POST['sele_can'];
		
		$selectvisaprocess=$db->selectQuery("SELECT `visa_process_id` FROM sm_candidate_visa_process WHERE `candidate_id` = '$candidate_id'");
		if($selectvisaprocess)
		{
			$visaprocessid = $selectvisaprocess[0]['visa_process_id'];
			// if(!empty($visaprocessid)){
			// $value = $db->executeQuery("DELETE FROM `sm_candidate_visa_process` WHERE `visa_process_id` = '$visaprocessid'");
			
			$visa_status = "Applied";
			//$visa_no = "";notified_status
			 if(!empty($visa_status))
			 {
				   $db->executeQuery("UPDATE `sm_candidate_visa_process` SET `visa_status`='$visa_status',`visa_no`='',`visa_no`='',`visa_issued`='',`visa_expiry`='',`reason`='' WHERE `visa_process_id`='$visaprocessid'");
			 }
			// if(!empty($value)){
				// // $values = $db->executeQuery("DELETE FROM `sm_candidate_medical_certificates` WHERE `medical_status_id` = '$medicalStatusId'");
				// if(!empty($values)){
					// echo "Data Deleted Successfully";
				// } else { echo "Unable to delete Medical visa Certificates! Please try Again";}
			// } else { echo "Unable to delete Medical visa Status! Please try Again"; }
			//} 
		}
    }
	
	
	
	