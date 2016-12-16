<?php

include('connection.php');

if (isset($_REQUEST['pass_val'])) {

    $delete_seesion = $_REQUEST['pass_val'];
	$sql = $db->executeQuery("update sm_visa set visa_active='0' where visa_id ='$delete_seesion'");

}