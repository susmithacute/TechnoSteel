<?php

include('connection.php');
if (isset($_POST['client_name'])) {
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $result = array();
    $check_id = $db->selectQuery("select * from sm_visa_client where visa_client_name='$client_name' and visa_client_status='1'");
    if (count($check_id)) {
        $result = array("Status" => "Client Name Exists..", "data_val" => "0");
        echo json_encode($result);
    } else {

        //$manufacturer_name = $_REQUEST['manufacturer_name'];
        $values["visa_client_name"] = $client_name;
        $values["visa_client_email"] = $client_email;

        //$values["client_status"] = '1';

        $insert = $db->secure_insert("sm_visa_client", $values);
        $result = array("Status" => "Successful", "data_val" => "1");
        echo json_encode($result);
    }
}