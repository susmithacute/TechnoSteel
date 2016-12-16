<?php

include('connection.php');

    $delete_seesion = $_POST['pass_val'];
	//echo $delete_seesion;
    $values=array();
    $value=array();
	$values['travelling_status']="travelling";
	$value['medical_status']="Pending";
	$val['candidate_toemployee']="No";
    $db->secure_update("sm_travelling_details",$values,"WHERE `candidate_id`='$delete_seesion'");
	$db->secure_update("sm_medical_visa_status",$value,"WHERE `candidate_id`='$delete_seesion'");
	$db->secure_update("sm_candidate",$val,"WHERE `candidate_id`='$delete_seesion'");
	$db->executeQuery("DELETE  FROM sm_candidate_documents WHERE `documents_title`='QatarID' AND `candidate_id`='$delete_seesion'");
	$db->executeQuery("DELETE  FROM sm_candidate_files WHERE `file_name`='medical certificates' AND `candidate_id`='$delete_seesion'");
	$db->executeQuery("DELETE  FROM sm_medical_visa_certificates WHERE  `candidate_id`='$delete_seesion'");
	$db->executeQuery("DELETE  FROM sm_employee WHERE `candidate_id`='$delete_seesion'");
	?>