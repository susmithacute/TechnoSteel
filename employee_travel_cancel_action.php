<?php
session_start();
include('connection.php');

if (isset($_REQUEST['employee_id'])) {
    $employee_id=$_POST['employee_id'];
	$travel_status = "canceled";
    $db->executeQuery("UPDATE `sm_employee_travel` SET `travel_status`='$travel_status' WHERE `employee_id`='$employee_id'");
}