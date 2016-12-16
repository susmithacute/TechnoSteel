<?php
include('connection.php');
if (isset($_POST['company_account_no'])) {
    $company_account_no = $_POST['company_account_no'];
	
	$result = array();
    $check_id = $db->selectQuery("select company_account_no from sm_company_bank_details WHERE company_account_no='$company_account_no'");
    if (count($check_id)) {
        $result = array("Status" => "Account No Exists..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}
?>