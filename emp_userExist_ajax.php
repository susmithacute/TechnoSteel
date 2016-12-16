<?php
include('connection.php');
if (isset($_POST['emp_name'])) {
    $emp_id = $_POST['emp_name'];
	$result = array();
    $check_id = $db->selectQuery("select * from sm_employee_login where employee_id='$emp_id'");
    if (count($check_id)) {
        $result = array("Status" => "Already Exixting User..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}
?>
   
    
