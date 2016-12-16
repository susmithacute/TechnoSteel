<?php

include('connection.php');
$thisMonth = date("m");
$thisYear = date("Y");
$lastMonth1 = date('Y-m-d', strtotime('first day of last month'));
$check_last_month = date('m', strtotime('first day of last month'));
$check_last_year = date('Y', strtotime('first day of last month'));
$lastMonth = date('m', strtotime(date($lastMonth1) . " -1 month"));
$checkYear = date('Y', strtotime(date($lastMonth1) . " -1 month"));
if (isset($_POST['normal_work_hour']) && isset($_POST['emp_id']) && isset($_POST['date_val'])) {
    $normal_work_hour = $_POST['normal_work_hour'];
    $emp_id = $_POST['emp_id'];
    $date_val = $_POST['date_val'];
    $normal_values = array();
    $normal_values['date'] = $date_val;
    $normal_values['normal_work_hours'] = $normal_work_hour;
    $normal_values['employee_id'] = $emp_id;
    $check_normal = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$date_val' AND `employee_id`='$emp_id'");
    if (count($check_normal) > 0) {
		$normal_values['total_work_hours'] = $check_normal[0]['normal_over_time'] + $normal_work_hour;
        $up_normal = $db->secure_update("sm_time_sheet", $normal_values, " WHERE `employee_id`='$emp_id' AND `date`='$date_val'");
    }
    if (count($check_normal) <= 0) {
        $in_normal = $db->secure_insert("sm_time_sheet", $normal_values);
    }
}

if (isset($_POST['normal_over_time']) && isset($_POST['emp_id']) && isset($_POST['date_val'])) {
    $normal_over_time = $_POST['normal_over_time'];
    $emp_id = $_POST['emp_id'];
    $date_val = $_POST['date_val'];
    $normal_values = array();
    $normal_values['date'] = $date_val;
    $normal_values['normal_over_time'] = $normal_over_time;
    $normal_values['employee_id'] = $emp_id;
    $check_normal = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$date_val' AND `employee_id`='$emp_id'");
    if (count($check_normal) > 0) {
		$normal_values['total_work_hours'] = $check_normal[0]['normal_work_hours'] + $normal_over_time;
        $up_normal = $db->secure_update("sm_time_sheet", $normal_values, " WHERE `employee_id`='$emp_id' AND `date`='$date_val'");
    }
    if (count($check_normal) <= 0) {
        $in_normal = $db->secure_insert("sm_time_sheet", $normal_values);
    }
}
if (isset($_POST['holiday_over_time']) && isset($_POST['emp_id']) && isset($_POST['date_val'])) {
    $holiday_over_time = $_POST['holiday_over_time'];
    $emp_id = $_POST['emp_id'];
    $date_val = $_POST['date_val'];
    $normal_values = array();
    $normal_values['date'] = $date_val;
    $normal_values['holiday_over_time'] = $holiday_over_time;
    $normal_values['total_work_hours']=$holiday_over_time;
    $normal_values['employee_id'] = $emp_id;
    $check_normal = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$date_val' AND `employee_id`='$emp_id'");
    if (count($check_normal) > 0) {
        $up_normal = $db->secure_update("sm_time_sheet", $normal_values, " WHERE `employee_id`='$emp_id' AND `date`='$date_val'");
    }
    if (count($check_normal) <= 0) {
        $in_normal = $db->secure_insert("sm_time_sheet", $normal_values);
    }
}

if (isset($_POST['total_work_hours']) && isset($_POST['emp_id']) && isset($_POST['date_val'])) {
    $emp_id = $_POST['emp_id'];
    $date_val = $_POST['date_val'];
    $total_work_hours = $_POST['total_work_hours'];
    $normal_values = array();
    $normal_values['date'] = $date_val;
    $normal_values['total_work_hours'] = $total_work_hours;
    $normal_values['employee_id'] = $emp_id;
    $check_total = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$date_val' AND `employee_id`='$emp_id'");
    if (count($check_total) > 0) {
        $up_total = $db->secure_update("sm_time_sheet", $normal_values, " WHERE `employee_id`='$emp_id' AND `date`='$date_val'");
    }
    if (count($check_total) <= 0) {
        $in_total = $db->secure_insert("sm_time_sheet", $normal_values);
    }
}

if (isset($_POST['month']) && isset($_POST['year']) && isset($_POST['emp_id']) && isset($_POST['normal_wh']) && isset($_POST['grand_total'])) {
    $emp_id = $_POST['emp_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $emp_id = $_POST['emp_id'];
    $normal_wh = $_POST['normal_wh'];
    $grand_total = $_POST['grand_total'];
    $normal_values = array();
    $normal_values['month'] = $month;
    $normal_values['year'] = $year;
    $normal_values['normal_work_hours'] = $normal_wh;
    $normal_values['employee_id'] = $emp_id;
    $normal_values['grand_total'] = $grand_total;
    $check_total = $db->selectQuery("SELECT * FROM `sm_employee_working_hours_total` WHERE `month`='$month' AND `employee_id`='$emp_id' AND `year`='$year'");
    if (count($check_total) > 0) {
        $up_total = $db->secure_update("sm_employee_working_hours_total", $normal_values, " WHERE `employee_id`='$emp_id' AND `month`='$month' AND `year`='$year'");
    }
    if (count($check_total) <= 0) {
        $in_total = $db->secure_insert("sm_employee_working_hours_total", $normal_values);
    }
}

if (isset($_POST['month']) && isset($_POST['year']) && isset($_POST['emp_id']) && isset($_POST['normal_ot']) && isset($_POST['grand_total'])) {
    $emp_id = $_POST['emp_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $emp_id = $_POST['emp_id'];
    $normal_ot = $_POST['normal_ot'];
    $grand_total = $_POST['grand_total'];
    $normal_values = array();
    $normal_values['month'] = $month;
    $normal_values['year'] = $year;
    $normal_values['normal_overtime'] = $normal_ot;
    $normal_values['employee_id'] = $emp_id;
    $normal_values['grand_total'] = $grand_total;
    $check_total = $db->selectQuery("SELECT * FROM `sm_employee_working_hours_total` WHERE `month`='$month' AND `employee_id`='$emp_id' AND `year`='$year'");
    if (count($check_total) > 0) {
        $up_total = $db->secure_update("sm_employee_working_hours_total", $normal_values, " WHERE `employee_id`='$emp_id' AND `month`='$month' AND `year`='$year'");
    }
    if (count($check_total) <= 0) {
        $in_total = $db->secure_insert("sm_employee_working_hours_total", $normal_values);
    }
}

if (isset($_POST['month']) && isset($_POST['year']) && isset($_POST['emp_id']) && isset($_POST['holiday_ot']) && isset($_POST['grand_total'])) {
    $emp_id = $_POST['emp_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $emp_id = $_POST['emp_id'];
    $holiday_ot = $_POST['holiday_ot'];
    $grand_total = $_POST['grand_total'];
    $normal_values = array();
    $normal_values['month'] = $month;
    $normal_values['year'] = $year;
    $normal_values['holiday_overtime'] = $holiday_ot;
    $normal_values['employee_id'] = $emp_id;
    $normal_values['grand_total'] = $grand_total;
    $check_total = $db->selectQuery("SELECT * FROM `sm_employee_working_hours_total` WHERE `month`='$month' AND `employee_id`='$emp_id' AND `year`='$year'");
    if (count($check_total) > 0) {
        $up_total = $db->secure_update("sm_employee_working_hours_total", $normal_values, " WHERE `employee_id`='$emp_id' AND `month`='$month' AND `year`='$year'");
    }
    if (count($check_total) <= 0) {
        $in_total = $db->secure_insert("sm_employee_working_hours_total", $normal_values);
    }
}
///Multiple Add normal overtime
if (isset($_POST['normal_overtimeMul']) && isset($_POST['emp_idMul']) && isset($_POST['year']) && isset($_POST['month'])) {
    $normal_over_time = $_POST['normal_overtimeMul'];
    $emp_id = $_POST['emp_idMul'];
    $year = $_POST['year'];
    $month = $_POST['month'];

    //Find Leave Date of Employee
    $leaves = array();
    $selectleaves = $db->selectQuery("SELECT `leave_from`,`leave_to` FROM sm_employee_leave WHERE  employee_id ='$emp_id' AND status ='active'");
    for ($Sl = 0; $Sl < count($selectleaves); $Sl++) {
        $date1 = $selectleaves[$Sl]['leave_to'];
        $end_date = date('Y-m-d', strtotime($date1 . "+1 days"));


        $begin = new DateTime($selectleaves[$Sl]['leave_from']);
        $end = new DateTime($end_date);


        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

        foreach ($daterange as $date) {
            $leaves[] = $date->format("Y-m-d");
        }
    }

    //Get Month
    function getMonth($year, $month) {

        // this calculates the last day of the given month
        $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $date = new DateTime();
        $res = Array();

        // iterates through days
        for ($day = 01; $day <= $last; $day++) {


            $date->setDate($year, $month, $day);
            $date->format('Y-m-d');
            //print_r($date);
            //$res[$day]=$date->format("l");
            $res[$day] = $day;
        }
        return $res;
    }

    $res = getMonth($year, $month);

    $yearMonth = $year . '-' . $month;

    $total = 0;
    foreach ($res as $dates) {
        //if(strlen($date)==1)
        $s = strlen($dates);
        if ($s == 1) {
            $str = "0";
            $new_dates = $str . $dates;
        } else {
            $new_dates = $dates;
        }
        $new_date = $yearMonth . '-' . $new_dates;

        $normal_values = array();
        $normal_values['date'] = $new_date;
        $normal_values['normal_over_time'] = $normal_over_time;
        $normal_values['employee_id'] = $emp_id;

        $selectholiday = $db->selectQuery("SELECT `holiday` FROM holidays WHERE `holiday`='$new_date '");
        if (empty($selectholiday)) {
            if (!in_array($new_date, $leaves)) {
                $check_normal = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$new_date' AND `employee_id`='$emp_id'");
                if (count($check_normal) > 0) {
                    $normal_values['total_work_hours'] = $check_normal[0]['normal_work_hours'] + $normal_over_time;
                    $up_normal = $db->secure_update("sm_time_sheet", $normal_values, " WHERE `employee_id`='$emp_id' AND `date`='$new_date'");
                }
                if (count($check_normal) <= 0) {
                    $in_normal = $db->secure_insert("sm_time_sheet", $normal_values);
                }
                $total+= $normal_over_time;
            }
        }
    }
    //print_r($total); die;
    //Normal Work Hours Total
    $normal_values1['normal_overtime'] = $total;
    $normal_values1['employee_id'] = $emp_id;
    $normal_values1['year'] = $year;
    $normal_values1['month'] = $month;
    $check_total = $db->selectQuery("SELECT * FROM `sm_employee_working_hours_total` WHERE `month`='$month' AND `employee_id`='$emp_id' AND `year`='$year'");
    $grand_total = $check_total[0]['normal_work_hours'] + $check_total[0]['holiday_overtime'] + $total;
    $normal_values1['grand_total'] = $grand_total;

    if (count($check_total) > 0) {
        $up_total = $db->secure_update("sm_employee_working_hours_total", $normal_values1, " WHERE `employee_id`='$emp_id' AND `month`='$month' AND `year`='$year'");
    }
    if (count($check_total) <= 0) {
        $in_total = $db->secure_insert("sm_employee_working_hours_total", $normal_values1);
    }
}
//SIF
if (isset($_POST['month']) && isset($_POST['year']) && isset($_POST['emp_id'])) {
    //die;
    $employee_id = $_POST['emp_id'];
    $y = $_POST['year'];
    $m = $_POST['month'];
    $basic_salary = 0;
    $get_employee_salary = $db->selectQuery("SELECT `employee_salary`,CONCAT(employee_firstname,' ',employee_middlename,' ',employee_lastname) AS full_name FROM `sm_employee` WHERE `employee_id`='$employee_id' AND `employee_status`='1'");

    if (count($get_employee_salary)) {
        $full_name = $get_employee_salary[0]['full_name'];
        $total_normal_over_time = $total_holiday_over_time = $total_holiday_income = $total_extra_working_income = 0;
        $normal_extra = 0;
        $emp_salary = $get_employee_salary[0]['employee_salary'];
        $basic_salary = preg_replace("/[^0-9]/", "", $emp_salary);
        if ($basic_salary == "") {
            $basic_salary = $holiday_extra = 0;
        }
        $get_extra_data = $db->selectQuery("SELECT `normal_work_hours`,`normal_overtime`,`holiday_overtime` FROM `sm_employee_working_hours_total` WHERE `employee_id`='$employee_id' AND `year`='$y' AND `month`='$m'");
        if (count($get_extra_data)) {
            $total_normal_over_time = $get_extra_data[0]['normal_overtime'];
            $total_holiday_over_time = $get_extra_data[0]['holiday_overtime'];
        } else {
            $total_normal_over_time = 0;
            $total_holiday_over_time = 0;
        }
        if ($basic_salary > 0) {
            $per_day = $basic_salary / 30;
            $per_hour = $per_day / 8;
            $normal_extra = $per_hour * (1.25 / 100);
            $total_normal_income = ($per_hour + $normal_extra) * $total_normal_over_time;
            $holiday_extra = $per_hour * (1.5 / 100);
            $total_holiday_income = ($per_hour + $holiday_extra) * $total_holiday_over_time;
            $total_extra_working_income = $total_normal_income + $total_holiday_income;
            $total_extra_working_income;
        }

        $visa_id = $qatar_id = "";
        $qatar = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `document_title`='Qatar ID' AND `status`='1' AND `employee_id`='$employee_id'");
        if (count($qatar)) {
            $qatar_id = $qatar[0]['document_data'];
        }
        $select_visa = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `employee_id`='$employee_id' AND `document_title`='Visa'");
        if (count($select_visa)) {
            $visa_id = $select_visa[0]['document_data'];
        }
        //total working days
        $month_start_date = $checkYear . "-" . $lastMonth . "-01";
        $month_end_date = date('Y-m-d', strtotime('last day of previous month'));
        $total_working_days = 0;
        $working_days = 0;
        $leave_days = 0;
        for ($dt = $month_start_date; $dt <= $month_end_date; $dt++) {
            $check_date = strtotime($dt);
            $emp_leave = $db->selectQuery("SELECT leave_from,leave_to FROM `sm_employee_leave` WHERE `employee_id`='$employee_id'");
            if (count($emp_leave)) {
                for ($lv = 0; $lv < count($emp_leave); $lv++) {
                    $leave_from = strtotime($emp_leave[$lv]['leave_from']);
                    $leave_to = strtotime($emp_leave[$lv]['leave_to']);
                    if (($check_date >= $leave_from) && ($check_date <= $leave_to)) {
                        $leave_days = $leave_days + 1;
                    } else {
                        $leave_days = $leave_days + 0;
                    }
                }
            } else {
                $leave_days = $leave_days + 0;
            }
            $working_days = $working_days + 1;
        }
        if ($leave_days >= $working_days) {
            $total_working_days = 0;
        } else {
            $total_working_days = $working_days - $leave_days;
        }
        $check_extra = $db->selectQuery("SELECT `id` FROM `sm_employee_working_hours_total` WHERE `employee_id`='$employee_id' AND `year`='$y' AND `month`='$m'");
        $value_array = array();
        $value_array['employee_qid'] = $qatar_id;
        $value_array['employee_visa'] = $visa_id;
        $value_array['employee_name'] = $full_name;
        $value_array['employee_salary'] = $emp_salary;
        $value_array['extra_income'] = $total_extra_working_income;
        $value_array['extra_hours'] = $total_normal_over_time + $total_holiday_over_time;
        $value_array['total_working_days'] = $total_working_days;
        if (count($check_extra)) {
            $update = $db->secure_update("sm_employee_working_hours_total", $value_array, " WHERE `employee_id`='$employee_id' AND `year`='$y' AND `month`='$m'");
        }
    }
}


//ADD Normal Working Hours B/W Two dates
if(isset($_POST['date_from']) && isset($_POST['date_to']) && isset($_POST['emp_id']) && isset($_POST['yearNormal']) && isset($_POST['monthNormal']) && isset($_POST['range_normal_work_hour'])){
$normal_work_hours = $_POST['range_normal_work_hour'];
$date_froms = $_POST['date_from'];
$date_tos = $_POST['date_to'];
$emp_id = $_POST['emp_id'];
$year = $_POST['yearNormal'];
$month = $_POST['monthNormal'];


//Find Leave Date of Employee
$leaves = array();
$selectleaves = $db->selectQuery("SELECT `leave_from`,`leave_to` FROM sm_employee_leave WHERE  employee_id ='$emp_id' AND status ='active'");
for ($Sl = 0; $Sl < count($selectleaves); $Sl++) {
	$date1 = $selectleaves[$Sl]['leave_to'];
	$end_date = date('Y-m-d', strtotime($date1 . "+1 days"));


	$begin = new DateTime($selectleaves[$Sl]['leave_from']);
	$end = new DateTime($end_date);


	$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

	foreach ($daterange as $date) {
		//echo "hai".$date->format("Y-m-d") . "<br>";
		$leaves[] = $date->format("Y-m-d");
	}
}

//From date and to date format change
$date_from_array =  explode('-',$date_froms);
$date_from = $date_from_array[2]."-".$date_from_array[1]."-".$date_from_array[0];
$date_to_array =  explode('-',$date_tos);
$date_to_ar = $date_to_array[2]."-".$date_to_array[1]."-".$date_to_array[0];
$date_to = date('Y-m-d', strtotime($date_to_ar  . "+1 days"));
 

$begins = new DateTime($date_from);
$ends = new DateTime($date_to);

$dateranges = new DatePeriod($begins, new DateInterval('P1D'), $ends);

$total = 0;
foreach($dateranges as $datesrang){
   $date = $datesrang->format("Y-m-d");


$normal_values['date'] = $date;
$normal_values['normal_work_hours'] = $normal_work_hours;
$normal_values['employee_id'] = $emp_id;


//Holiday & Leave Check
$selectholiday = $db->selectQuery("SELECT `holiday` FROM holidays WHERE `holiday`='$date'");
if (empty($selectholiday)) {
            if (!in_array($date, $leaves)) {
                $check_normal = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$date' AND `employee_id`='$emp_id'");
				//echo "SELECT * FROM `sm_time_sheet` WHERE `date`='$date' AND `employee_id`='$emp_id'";
				//print_r($check_normal);
                if (count($check_normal) > 0) { 
                    //$normal_values['total_work_hours'] = $normal_work_hours + $check_normal[0]['normal_over_time'];
                    $up_normal = $db->secure_update("sm_time_sheet", $normal_values, " WHERE `employee_id`='$emp_id' AND `date`='$date'");
                }
                if (count($check_normal) <= 0) { 
                    $in_normal = $db->secure_insert("sm_time_sheet", $normal_values);
                }
                $total+= $normal_work_hours;
            }
        }
}

/************ GET TOTAL HOURS **************/
	$normal_work_hours_total = 0;
	$normal_overtime_total = 0;
	$holiday_over_time = 0;
	$grand_total = 0;
    //Get Month
    function getMonth($year, $month) {

        // this calculates the last day of the given month
        $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $date = new DateTime();
        $res = Array();

        // iterates through days
        for ($day = 01; $day <= $last; $day++) {


            $date->setDate($year, $month, $day);
            $date->format('Y-m-d');
            //print_r($date);
            //$res[$day]=$date->format("l");
            $res[$day] = $day;
        }
        return $res;
    }

    $res = getMonth($year, $month);

    $yearMonth = $year . '-' . $month;

    $total = 0;
    foreach ($res as $dates) {
        $s = strlen($dates);
        if ($s == 1) {
            $str = "0";
            $new_dates = $str . $dates;
        } else {
            $new_dates = $dates;
        }
        $new_date = $yearMonth . '-' . $new_dates;
		$check_normal_total_wrk_hour = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$new_date' AND `employee_id`='$emp_id'");
		if(!empty($check_normal_total_wrk_hour)){
		//print_r($check_normal_total_wrk_hour); die;
		$normal_work_hours_total+=$check_normal_total_wrk_hour[0]['normal_work_hours'];
		$normal_overtime_total+=$check_normal_total_wrk_hour[0]['normal_over_time'];
		$holiday_over_time = $check_normal_total_wrk_hour[0]['holiday_over_time'];
		}
		if (count($check_normal_total_wrk_hour) > 0) { 
			$normal_val['total_work_hours'] = $check_normal_total_wrk_hour[0]['normal_work_hours'] + $check_normal_total_wrk_hour[0]['normal_over_time']+$check_normal_total_wrk_hour[0]['holiday_over_time'];
			$up_normal = $db->secure_update("sm_time_sheet", $normal_val, " WHERE `employee_id`='$emp_id' AND `date`='$new_date'");
		}
		
	}
	$grand_total = $normal_work_hours_total+$normal_overtime_total+$holiday_over_time;
		
//Insert Total Working Hours
$normal_values1['normal_work_hours'] = $normal_work_hours_total;
$normal_values1['employee_id'] = $emp_id;
$normal_values1['year'] = $year;
$normal_values1['month'] = $month;
$check_total = $db->selectQuery("SELECT * FROM `sm_employee_working_hours_total` WHERE `month`='$month' AND `employee_id`='$emp_id' AND `year`='$year'");
//$grand_total = $check_total[0]['normal_work_hours'] + $check_total[0]['holiday_overtime'] + $total;
$normal_values1['grand_total'] = $grand_total;
if (count($check_total) > 0) {
	$up_total = $db->secure_update("sm_employee_working_hours_total", $normal_values1, " WHERE `employee_id`='$emp_id' AND `month`='$month' AND `year`='$year'");
}
if (count($check_total) <= 0) {
	$in_total = $db->secure_insert("sm_employee_working_hours_total", $normal_values1);
}

}
?>