<?php
include('connection.php');
if (isset($_POST['req_amount'])) {
    $req_amount = $_POST['req_amount'];
	$emp_id = $_POST['emp_name'];
	$result = array();
    $emp_salary = $db->selectQuery("select employee_salary from sm_employee WHERE employee_id='$emp_id'");
    if (count($emp_salary)) {
		$employee_salary = $emp_salary[0]['employee_salary'];
		if($req_amount>$employee_salary){
			
        $result = array("Status" => "Requested amount exeeds current salary.", "data_val" => "0");
        echo json_encode($result);   }
     else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
 }
}
?>