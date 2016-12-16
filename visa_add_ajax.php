<?php

include("./connection.php");
$visa_applicant_name = $_POST['visa_applicant'];
$visa_category = $_POST['visa_category'];
$visa_type = $_POST['visa_type'];
$visa_client_name = $_POST['visa_client'];
$visa_passport_no = $_POST['visa_passport'];
$visa_contact_no = $_POST['visa_contact'];
$visa_email = $_POST['visa_email'];
$dor = $_POST['visa_received_date'];
$visa_advance_amount = $_POST['visa_advance'];
$visa_balance_fee = $_POST['visa_balance'];
$visa_total_fee = $_POST['total_fee'];
$visa_country = $_POST['visa_country'];
$visa_status = $_POST['visa_status'];
$visa_address = $_POST['visa_address'];
$company_fee = $_POST['company_fee'];
$sponsor_fee = $_POST['sponsor_fee'];
$bank_fee = $_POST['bank_fee'];

$check_id = $db->selectQuery("select `visa_id` from sm_visa  ORDER BY visa_id DESC LIMIT 1");
if (count($check_id) > 0) {
    //$manufacturer_name = $_REQUEST['manufacturer_name'];
    $id = $check_id[0]["visa_id"];
    $id1 = $id + 1;
    $text = "REF-";
    $number = $generate_auto_id = str_pad($id1, 3, '0', STR_PAD_LEFT);
    $refnumber = $text . $number;
} else {
    $number = $generate_auto_id = str_pad(1, 3, '0', STR_PAD_LEFT);
    $text = "REF-";
    $refnumber = $text . $number;
}
$visa_ref_no = $refnumber;
$type_days = $db->selectQuery("SELECT  `visa_type_days` FROM `sm_visa_type` where `visa_type_status`='1' and visa_type_name ='$visa_type'");
if (count($type_days)) {

    for ($cou = 0; $cou < count($type_days); $cou++) {


        $visa_day = $type_days[$cou]['visa_type_days'];
    }
}

$values["visa_applicant_name"] = $visa_applicant_name;
$values["visa_category"] = $visa_category;
$values["visa_ref_no"] = $visa_ref_no;
$values["visa_type"] = $visa_type;
$values["visa_type_days"] = $visa_day;
$values["visa_client_name"] = $visa_client_name;
$values["visa_passport_no"] = $visa_passport_no;
$values["visa_contact_no"] = $visa_contact_no;
$values["visa_email"] = $visa_email;

if ($dor == "") {
    $application_date = "";
} else {
    $explode_dor = explode('/', $dor);
    $application_date = $explode_dor[2] . "-" . $explode_dor[1] . "-" . $explode_dor[0];
}
$values["visa_application_date"] = $application_date;
$values["visa_advance_amount"] = $visa_advance_amount;
$values["visa_country"] = $visa_country;
$values["visa_status"] = $visa_status;
$values["visa_address"] = $visa_address;
$values["visa_bank_fee"] = $bank_fee;
$values["visa_sponsor_fee"] = $sponsor_fee;
$values["visa_company_fee"] = $company_fee;
$values["visa_total_amount"] = $visa_total_fee;
$insert = $db->secure_insert("sm_visa", $values);

$values2["visa_renewal_type"] = $visa_category;
$values2['visa_id'] = $insert;
$values2["visa_ref_no"] = $visa_ref_no;
$values2["visa_bank_fee"] = $bank_fee;
$values2["visa_sponsor_fee"] = $sponsor_fee;
$values2["visa_company_fee"] = $company_fee;
$values2["visa_total_fee"] = $visa_total_fee;
$values2["visa_balance_fee"] = $visa_balance_fee;
$values2["visa_advance_fee"] = $visa_advance_amount;
$insert2 = $db->secure_insert("sm_visa_renew", $values2);
if (count($insert)) {
    $result = array("Status" => "Added Successfully..", "data_val" => "1");
    echo json_encode($result);
} else {
    $result = array("Status" => "Error in addition", "data_val" => "0");
    echo json_encode($result);
}

