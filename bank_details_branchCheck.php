<?php
include('connection.php');
if (isset($_POST['bank_branch'])) {
    $bank_branch = $_POST['bank_branch'];
	$bank_name = $_POST['bank_name'];
	$result = array();
    $check_id = $db->selectQuery("select bank_branch from sm_bank_details WHERE bank_branch='$bank_branch' AND bank_name='$bank_name'");
    if (count($check_id)) {
        $result = array("Status" => "Branch Exists..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}
?>