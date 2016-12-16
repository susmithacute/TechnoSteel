<?php

include '../connection.php';
include './time_zone.php';
$city = $country = "";
$punch_in_ip = $_SERVER['REMOTE_ADDR'];
if (isset($_POST['set_punch_in']) || isset($_POST['set_punch_out'])) {
    $geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $punch_in_ip));
    if (is_numeric($geoplugin['geoplugin_latitude']) && is_numeric($geoplugin['geoplugin_longitude'])) {
        $lat = $geoplugin['geoplugin_latitude'];
        $long = $geoplugin['geoplugin_longitude'];
        $city = $geoplugin['geoplugin_city'];
        $country = $geoplugin['geoplugin_countryName'];
        $country_code = $geoplugin['geoplugin_countryCode'];
        $zone = get_nearest_timezone($lat, $long, $country_code);
        date_default_timezone_set($zone);
    }
}
$today_date = date('Y-m-d');
$punch_in_dateTime = date('Y-m-d H:i:s');
if (isset($_POST['report_text']) && isset($_POST['emp_id'])) {
    $report_text = $_POST['report_text'];
    $emp_id = $_POST['emp_id'];
    $values = array();
    $values['report_date'] = $today_date;
    $values['report_text'] = $report_text;
    $values['employee_id'] = $emp_id;
    $check_exist = $db->selectQuery("SELECT * FROM `sm_employee_work_report` WHERE `employee_id`='$emp_id' AND `report_date`='$today_date'");
    if (count($check_exist)) {
        $update = $db->secure_update("sm_employee_work_report", $values, "WHERE `employee_id`='$emp_id' AND `report_date`='$today_date'");
        if (!empty($insert)) {
            echo "Report Updated";
        }
    } else {
        $insert = $db->secure_insert("sm_employee_work_report", $values);
        if (!empty($insert)) {
            echo "Report Submitted";
        }
    }
}
//date_default_timezone_set('Asia/Kolkata');
if (isset($_POST['set_punch_in']) && isset($_POST['emp_id'])) {

    $emp = $_POST['emp_id'];
    $values = array();
    $values['attendance_date'] = $today_date;
    $values['attendance_punch_in_time'] = $punch_in_dateTime;
    $values['attendance_punch_in_format'] = date("A");
    $values['attendance_punch_in_location'] = $city . "," . $country;
    $values['attendance_punch_in_ip'] = $punch_in_ip;
    $values['employee_id'] = $emp;
    $ck = $db->selectQuery("SELECT * FROM `sm_employee_attendance` WHERE `employee_id`='$emp' AND `attendance_date`='$today_date'");
    if (count($ck) <= 0) {
        $insert_punch_in = $db->secure_insert("sm_employee_attendance", $values);
    }
}
if (isset($_POST['set_punch_out']) && isset($_POST['emp_id'])) {
    $emp = $_POST['emp_id'];
    $values = array();
    $values['attendance_punch_out_time'] = $punch_in_dateTime;
    $values['attendance_punch_out_format'] = date("A");
    $values['attendance_punch_out_location'] = $city . "," . $country;
    $values['attendance_punch_out_ip'] = $punch_in_ip;
    $ck = $db->selectQuery("SELECT `attendance_punch_out_time` FROM `sm_employee_attendance` WHERE `employee_id`='$emp' AND `attendance_date`='$today_date'");
    if (count($ck) > 0) {
        $out = $ck[0]['attendance_punch_out_time'];
        if ($out == "") {
            $insert_punch_in = $db->secure_update("sm_employee_attendance", $values, "WHERE `employee_id`='$emp' AND `attendance_date`='$today_date'");
        }
    }
}
if (isset($_POST['check']) && isset($_POST['emp_id'])) {
    $empId = $_POST['emp_id'];
    $select_report = $db->selectQuery("SELECT * FROM `sm_employee_work_report` WHERE `employee_id`='$empId' AND `report_date`='$today_date'");
    if (count($select_report) > 0) {
        echo "1";
    } else {
        echo "0";
    }
}
