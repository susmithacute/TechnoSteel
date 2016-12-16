<?php

include('connection.php');

$req_date = date("Y/m/d");
$dd = new DateTime($req_date);
$da = $dd->format('m');
if (isset($_POST['deduction_category'])) {
    $deduction_category = $_POST['deduction_category'];
    $employee_id = $_POST['employ_id'];
    foreach ($deduction_category as $key => $value_array) {
        print_r($value_array);
        echo "<br>";
        $values = array();
        $values["employee_id"] = $employee_id;
        $values["deduction_date"] = date("Y/m/d");
        $values["deduction_amount"] = $value_array['deduction_amount'];
        $categ_id = $values["deduction_category_id"] = $value_array['deduction_category_id'];
        if ($categ_id != 1) {
            $check_exist = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE employee_id='$employee_id' AND month(deduction_date)='$da' AND deduction_category_id='$categ_id'");
            if (count($check_exist)) {
                $update = $db->secure_update("sm_salary_deduction", $values, "WHERE employee_id='$employee_id' AND deduction_category_id='$categ_id'");
            } else {
                $insert = $db->secure_insert("sm_salary_deduction", $values);
            }
        }
    }
    $sum_total = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE employee_id='$employee_id' AND month(deduction_date)='$da'");
    if (count($sum_total)) {
        $total_amount = 0;
        for ($de = 0; $de < count($sum_total); $de++) {
            $sum_amount = $sum_total[$de]['deduction_amount'];
            $total_amount = $total_amount + $sum_amount;
        }
        $basic_sal = $db->selectQuery("SELECT employee_salary FROM `sm_employee` WHERE employee_id='$employee_id'");
        $basic_salary = $basic_sal[0]['employee_salary'];
        $basic_ded_rate = $basic_salary / 4;
        $sum_value = array();
        $sum_value["employee_id"] = $employee_id;
        $current_date = date("Y/m/d");
        $next_month = date('m', strtotime('+1 month'));
        $sum_value["deduction_date"] = "2016-" . $next_month . "-03";

        if ($total_amount > $basic_ded_rate) {
            $amount = $total_amount - round($basic_ded_rate);
            $sum_value["deduction_amount"] = $amount;
        } else {
            $sum_value["deduction_amount"] = 0;
        }
        $sum_value["deduction_category_id"] = '1';
        $check_next_month = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE employee_id='$employee_id' AND month(deduction_date)='$next_month' AND deduction_category_id='1'");
        if (count($check_next_month)) {
            $sum_update = $db->secure_update("sm_salary_deduction", $sum_value, "WHERE employee_id='$employee_id' AND deduction_category_id='1' AND month(deduction_date)='$next_month'");
        } else {
            $sum_insert = $db->secure_insert("sm_salary_deduction", $sum_value);
        }
    }
}