<?php

include('connection.php');
if (isset($_REQUEST['pass_val'])) {
    $delete_seesion = $_REQUEST['pass_val'];
//echo $delete_seesion;
    $values=array();
    $values['status']="delete";
    $db->secure_update("sm_employee_performance",$values,"WHERE `id`='$delete_seesion'");
	echo "Deleted";
}
?>