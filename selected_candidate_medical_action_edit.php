<?php
include('connection.php');
session_start();
if (isset($_REQUEST['numf'])) {
    $numf = $_REQUEST['numf'];
}

if(isset($_REQUEST['candidate_id']))
{
		$candidate_id	= $_REQUEST['candidate_id'];
		//$medical_result	= $_REQUEST['medical_result'];
		
		$selectMedicalStatus = $db->selectQuery("select `medical_status_id` from `sm_candidate_medical_status` where `candidate_id`='$candidate_id'");
		$medicalStatusId = $selectMedicalStatus[0]['medical_status_id'];
		$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_medical_certificates` WHERE `candidate_id`='$candidate_id' AND `medical_status_id` = '$medicalStatusId'");
		if(!empty($medicalStatusId))
		{
			//echo "dgfdg"; die;
			$selectCandCode = $db->selectQuery("select `candidate_code` from `sm_candidate` where `candidate_id`='$candidate_id'");
			$candidate_code = $selectCandCode[0]['candidate_code'];
			$values = array();
			$values['candidate_id'] = $candidate_id;
			//$values['medical_status'] = $medical_result;
			 // $values['candidate_code'] = $candidate_code;
			//$medicalStatusId = $db->secure_insert("sm_candidate_medical_status", $values);
		
			if($candidate_id){
				   
				// $file = $_FILES['file-0'];
				// $filename = $file['name'];
				$extensions = array("png", "jpg", "pdf", "doc", "docx");
				$data_ready = 1;
				$sesVal = array();
				$folder_name = "candidate_uploads/";

				if ($data_ready == 1) {
			for ($i = 0; $i < $numf; $i++) {
			$file_new_name = "";
			$filename = "";
			$file = $_FILES['file-' . $i];
			$filename_org = $file['name'] . ", ";
			$filename = str_replace(' ', '', $file['name']);
			if ($filename != "") {
				$uniqid = uniqid();
				$filename = $uniqid . $filename;
				
				$folder_name = "candidate_uploads/$candidate_code/";
				  $folder_name .="medical_certificates/";
				  if(!file_exists($folder_name))
				  {
					  mkdir($folder_name,0777,true);
				  }
				   $file_new_name = "";
				   $file_new_name = $folder_name . $filename;
					 move_uploaded_file($file['tmp_name'], $folder_name."/" . $filename);
					
								 }
			


				 // $selectCandCode = $db->selectQuery("select `candidate_code` from `sm_candidate` where `candidate_id`='$candidate_id'");
			// $candidate_code = $selectCandCode[0]['candidate_code'];
			
				
				
				$values1 = array();
				$values1['candidate_id'] = $candidate_id;
				$values1['medical_status_id'] = $medicalStatusId;
				$values1["medical_certificates"] = $file_new_name;
			
				// $values1['candidate_code'] = $candidate_code;
				$insert = $db->secure_insert("sm_candidate_medical_certificates", $values1);
			echo "Medical Documents Update Successfully";
					}
					
				}
			
			
							
			   }
			   //echo "Medical Status Update Successfully";
		} else { echo "Failed to Update"; }
}	//Medical certificates upload
?>