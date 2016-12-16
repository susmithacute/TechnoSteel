<?php
include('connection.php');
 if (isset($_REQUEST['hire_id'])) {
    $hire_id = $_REQUEST['hire_id'];
	
	$invoice_status=$_REQUEST['invoice_status'];
	$val['req_id'] = $hire_id;
	
	$val['invoice_status'] = $invoice_status;
	 $check_invoice = $db->selectQuery("SELECT * FROM sm_external_invoice WHERE `req_id` = '$hire_id'");
	 
	 if(!empty($check_invoice))
	 {
		$update = $db->secure_update("sm_external_invoice",$val,"WHERE `req_id` = '$hire_id'");
		if (count($update)) {
				echo "update success";
				}
				else{
					$success_msg = "Error in insertion";
				}
	 }
	 else{
	$insert = $db->secure_insert("sm_external_invoice", $val);
				if (count($insert)) {
				echo "success";
				}
				else{
					$success_msg = "Error in insertion";
				}
	}
}
?>