<?php

include('connection.php');
if (isset($_POST['employee_id'])) {
$employee_id=$_POST['employee_id'];
    $db->executeQuery("DELETE  FROM `sm_employee_travel` WHERE `employee_id`='$employee_id'");
	
}