<?php

include('connection.php');
if (isset($_REQUEST['pass_val'])) {
    $delete_seesion = $_REQUEST['pass_val'];
    $values=array();
    $values['status']="delete";
	$insert = $db->secure_update("sm_requirements", $values,"WHERE `requirement_id`= '$delete_seesion'");
    //$db->executeQuery("DELETE FROM `sm_employee_requirement` WHERE `id`='$delete_seesion'");
	
}