<?php

include("./connection.php");

$visa_id = $_POST['visa_id'];
$visa_renew_type = $_POST['renew_type'];
$visa_renew_date = $_POST['renew_date'];
$visa_renew_fee = $_POST['renew_fee'];
$visa_renew_exdate1 = $_POST['renew_exdate'];
$v1 = substr($visa_renew_exdate1, 0, 2);
$v2 = substr($visa_renew_exdate1, 2, 4);
$v3 = substr($visa_renew_exdate1, 4, 8);
echo "###########";
echo $visa_renew_exdate = $v1 . "/" . $v2 . "/" . $v3;
echo "###########";
$values["visa_id"] = $visa_id;
$values["visa_renewal_type"] = $visa_renew_type;
$values["visa_renewal_amount"] = $visa_renew_fee;
if ($visa_renew_date == "") {
    $renew_date = "";
} else {
    $explode_dor = explode('-', $visa_renew_date);
    $renew_date = $explode_dor[2] . "-" . $explode_dor[1] . "-" . $explode_dor[0];
}
$values["visa_renewal_inserted_date"] = $renew_date;

if ($visa_renew_exdate == "") {
    $visa_ex = "";
} else {
    $explode_do = explode('/', $visa_renew_exdate);
    $ex_date = $explode_do[2] . "-" . $explode_do[1] . "-" . $explode_do[0];
    $add_days = 30;
    $visa_ex = date('Y-m-d', strtotime($ex_date) + (24 * 3600 * $add_days));
    $values2["visa_renewal_date1"] = $visa_ex;
}
echo $visa_ex;
$insert = $db->secure_update("sm_visa_renew", $values, " WHERE `renew_id`='$visa_id'");
$insert2 = $db->secure_update("sm_visa", $values2, " WHERE `visa_id`='$visa_id'");
//echo "Partner Added Successfully!!!";visa_type_days
//echo "<script>location.href=companylist.php;</script>";
if (count($insert)) {

    //echo "<script>location.href='visa_list.php'</script>";
    $result = array("Status" => "Added Successfully..", "data_val" => "1");
    echo json_encode($result);
} else {

    $result = array("Status" => "Error in addition", "data_val" => "0");
    echo json_encode($result);
}
