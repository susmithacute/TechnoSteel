<?php

include('connection.php');
if (isset($_POST['pass_val']))
	{
		$employee_id = $_POST['pass_val'];
		
		$medicalVisaStatus=$db->selectQuery("SELECT `medical_visa_status_id` FROM sm_medical_visa_status WHERE `employee_id` = '$employee_id'");
		if($medicalVisaStatus)
		{
			$medicalVisaStatusId = $medicalVisaStatus[0]['medical_visa_status_id'];
			if(!empty($medicalVisaStatusId)){
			$value = $db->executeQuery("DELETE FROM `sm_medical_visa_status` WHERE `medical_visa_status_id` = '$medicalVisaStatusId'");
			if(!empty($value)){
				$values = $db->executeQuery("DELETE FROM `sm_medical_visa_certificates` WHERE `medical_visa_status_id` = '$medicalVisaStatusId'");
				if(!empty($values)){
					echo "Data Deleted Successfully";
				} else { echo "Unable to delete Medical visa Certificates! Please try Again";}
			} else { echo "Unable to delete Medical visa Status! Please try Again"; }
			} 
		}
	}