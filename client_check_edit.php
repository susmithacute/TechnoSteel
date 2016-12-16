<?php

include('connection.php');
if (isset($_POST['client_name']) && isset($_POST['edit_id'])) {
	
    $client_name = $_POST['client_name'];
	$edit_id = $_POST['edit_id'];
    $result = array();
    $check_id = $db->selectQuery("select * from sm_recruit_client where visa_client_name='$client_name' and client_id!='$edit_id' and visa_client_status='1'");
    if (count($check_id)) {
        $result = array("Status" => "Client Name Exists..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}