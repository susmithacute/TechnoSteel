<?php



session_start();

include('connection.php');

if (isset($_REQUEST['pass_val'])) {

    $delete_seesion = $_REQUEST['pass_val'];

    //$sql = "update sm_vehicle_manufacturer set manufacturer_status='0' where manufacturer_id ='$delete_seesion'";
	
    //mysql_query($sql);
	
	$sql = $db->executeQuery("update sm_job_category set job_category_status='0' where job_category_id ='$delete_seesion'");

}