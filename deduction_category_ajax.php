<?php

include('connection.php');
if (isset($_POST['ded_category'])) {
    $fdata = $_POST['ded_category'];
    foreach ($fdata as $ded_category) {
        $values = array();
        if ($ded_category != "") {
            $check = $db->selectQuery("SELECT * FROM `sm_deduction_category` WHERE `deduction_category`='$ded_category'");
            if (count($check) > 0) {
                continue;
            } else {
                $values["deduction_category"] = $ded_category;
                $insert = $db->secure_insert("sm_deduction_category", $values);
            }
        }
    }
}
if (isset($_POST['ded'])) {
    $category = $_POST['ded'];
    if ($category != "") {
        $check_name = $db->selectQuery("SELECT * FROM `sm_deduction_category` WHERE `deduction_category`='$category'");
        if (count($check_name) > 0) {
            echo "0";
        } else {
            echo "1";
        }
    }
}