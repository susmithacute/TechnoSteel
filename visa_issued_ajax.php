<?php

include("connection.php");
if (isset($_POST['visa_id'])) {
    $visa_id = $_POST['visa_id'];
    $dispatch_date = explode("-", $_POST['dispatch_date']);
    $values = array();
    $entry_date = $values['visa_entry_date'] = $dispatch_date[2] . "-" . $dispatch_date[1] . "-" . $dispatch_date[0];
    $add_days = 30;
    $visa_renew = date('Y-m-d', strtotime($entry_date) + (24 * 3600 * $add_days));
    $values["visa_status"] = "Entered";
    $values["visa_renewal_date"] = $visa_renew;
    $update_values = $db->secure_update("sm_visa", $values, " WHERE `visa_id`='$visa_id'");
    $values2["visa_renewal_date1"] = $visa_renew;
    $update_values = $db->secure_update("sm_visa_renew", $values2, " WHERE `visa_id`='$visa_id'");
}