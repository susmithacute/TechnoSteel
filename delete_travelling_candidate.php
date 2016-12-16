<?php

include('connection.php');
//if (isset($_REQUEST['pass_val'])) {
    $delete_seesion = $_POST['pass_val'];
	//echo $delete_seesion;
    //$values=array();
    //$values['employee_status']="0";
	//executeQuery("DELETE FROM `sm_medical_visa_certificates` WHERE `candidate_id`='$edit_id'");
    $delete=$db->executeQuery("DELETE FROM `sm_travelling_details` WHERE `candidate_id`='$delete_seesion'");
//}