<?php

include('connection.php');
if (isset($_POST['deduction_category']) && isset($_POST['edit_id'])) {
	
    $deduction_category = $_POST['deduction_category'];
	$edit_id = $_POST['edit_id'];
    $result = array();
    $check_id = $db->selectQuery("select * from sm_deduction_category where deduction_category='$deduction_category' and deduction_category_id!='$edit_id'");
    if (count($check_id)) {
        $result = array("Status" => "Deduction Category Exists..", "data_val" => "0");
        echo json_encode($result);
    } else {
        $result = array("Status" => "", "data_val" => "1");
        echo json_encode($result);
    }
}
?>