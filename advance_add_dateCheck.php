<?php
include('connection.php');
if (isset($_POST['req_date'])) {
	
    $originalDate = explode("/",$_POST['req_date']);
    $req_date = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
	$dd=new DateTime($req_date);
	$da=$dd->format('m');
	
	$emp_id = $_POST['emp_name'];
	
	$result = array();
    $check_id = $db->selectQuery("select * from sm_salary_advance where  month(advance_requested_date)='$da' AND employee_id='$emp_id'");
    if (count($check_id)) {		
        $result = array("Status" => "Amount Already Allowed for this month..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}
?>
   
    
