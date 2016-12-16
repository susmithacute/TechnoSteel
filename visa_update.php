<?php



session_start();

include('connection.php');

if (isset($_REQUEST['pass_val'])) {
    $visa_status = $_REQUEST['visa_val'];
    $delete_seesion = $_REQUEST['pass_val'];
	$sql = $db->executeQuery("update sm_visa set visa_status='$visa_status' where visa_id ='$delete_seesion'");

}