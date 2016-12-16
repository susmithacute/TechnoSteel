<?php

include('connection.php');
if (isset($_REQUEST['pass_val'])) {
    $delete_seesion = $_REQUEST['pass_val'];
    //$values=array();
    //$values['employee_status']="0";
    $delete=$db->executeQuery("DELETE  FROM holidays WHERE `id`='$delete_seesion'");
	if($delete){echo "delete success";}
}