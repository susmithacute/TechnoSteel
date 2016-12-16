<?php
include('connection.php');
if (isset($_POST['username'])) {
    $username = $_POST['username'];
	$result = array();
    $check_id = $db->selectQuery("select employee_username from sm_employee_login where employee_username='$username'");
    if (count($check_id)) {
        $result = array("Status" => "Username Exists..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}
?>