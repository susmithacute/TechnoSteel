<?php

include('connection.php');
if (isset($_POST['category_name'])) {
	$bank_fee = $_POST['bank_fee'];
	$sponsor_fee = $_POST['sponsor_fee'];
	$company_fee = $_POST['company_fee'];
    $type_name = $_POST['type_name'];
	$category_name = $_POST['category_name'];
    $result = array();
    $check_id = $db->selectQuery("select * from sm_visa_fee where visa_fee_category='$category_name' and visa_fee_type='$type_name' and visa_fee_status='1'");
    if (count($check_id)) {
        $result = array("Status" => "Visa fee already added..", "data_val" => "0");
        echo json_encode($result);
    } else {

	if($bank_fee=="")
	{
		$bank_fee1='0';
	}
	else
		{
		$bank_fee1=$bank_fee;
	   }
	   
	   if($sponsor_fee=="")
	{
		$sponsor_fee1='0';
	}
	else
		{
		$sponsor_fee1=$sponsor_fee;
	   }
	   if($company_fee=="")
	{
		$company_fee1='0';
	}
	else
		{
		$company_fee1=$company_fee;
	   }
	
        //$manufacturer_name = $_REQUEST['manufacturer_name'];
        $values["visa_fee_type"] = $type_name;
		$values["visa_fee_category"] = $category_name;
		$values["visa_fee_company"] = $company_fee1;
		$values["visa_fee_bank"] = $bank_fee1;
		$values["visa_fee_sponsor"] = $sponsor_fee1;
		$values["visa_fee_total"] = $company_fee1+$sponsor_fee1+$bank_fee1;
        //$values["sponsor_status"] = '1';

        $insert = $db->secure_insert("sm_visa_fee", $values);
        $result = array("Status" => "Successful", "data_val" => "1");
        echo json_encode($result);
    }
}