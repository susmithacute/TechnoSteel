<?php

date_default_timezone_set('Asia/Qatar');
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
include './connection.php';
$objPHPExcel = new PHPExcel();
$payer_eid = $bank_code_com = $company_iban_no = $company_id = "";
if (isset($_POST["cid"])) {
    $company_id = $_POST["cid"];
    $select_comp_bank_data = $db->selectQuery("SELECT sm_company_bank_details.company_account_no,sm_bank_details.bank_code,sm_company_bank_details.company_iban_no FROM sm_company_bank_details INNER JOIN sm_bank_details ON sm_company_bank_details.bank_id=sm_company_bank_details.bank_id LEFT JOIN sm_company ON sm_company.company_id=sm_company_bank_details.bank_id WHERE sm_company.company_id='$company_id'");
    if (count($select_comp_bank_data)) {
        $company_account_no = $select_comp_bank_data[0]['company_account_no'];
        $bank_code_com = $select_comp_bank_data[0]['bank_code'];
        $company_iban_no = $select_comp_bank_data[0]['company_iban_no'];
    }
    $select_cr = $db->selectQuery("SELECT `doc_data` FROM `sm_company_docs` WHERE `doc_title`='Commercial Registration' AND `company_id`='$company_id' AND `doc_status`='1' ");
    if (count($select_cr)) {
        $company_cr = $select_cr[0]['doc_data'];
        $payer_eid = str_pad($company_cr, 8, "0", STR_PAD_LEFT);
    }
    $resFet = $db->selectQuery("SELECT CONCAT(employee_firstname,' ',employee_middlename,' ',employee_lastname) as employee_name, employee_salary,employee_id FROM sm_employee "
            . " WHERE employee_status='1' AND employee_company='$company_id'");
}
$salary = $records = "";
if (isset($_POST['salary']) && isset($_POST['records'])) {
    $salary = $_POST['salary'];
    $records = $_POST['records'];
}
// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Employer EID');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'File Creation Date');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'File Creation Time');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Payer EID');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Payer QID');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Payer Bank Short Name');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Payer IBAN');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Salary Year and Month');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Total Salaries');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Total Records');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', $payer_eid);
$objPHPExcel->getActiveSheet()->SetCellValue('B2', date("Ymd"));
$objPHPExcel->getActiveSheet()->SetCellValue('C2', date("hi"));
$objPHPExcel->getActiveSheet()->SetCellValue('D2', $payer_eid);
$objPHPExcel->getActiveSheet()->SetCellValue('E2', '');
$objPHPExcel->getActiveSheet()->SetCellValue('F2', $bank_code_com);
$objPHPExcel->getActiveSheet()->SetCellValue('G2', $company_iban_no);
$objPHPExcel->getActiveSheet()->SetCellValue('H2', date("Ym"));
$objPHPExcel->getActiveSheet()->SetCellValue('I2', $salary);
$objPHPExcel->getActiveSheet()->SetCellValue('J2', $records);
$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Record Sequence');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Employee QID');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Employee Visa ID');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Employee Name');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Employee Bank Short Name');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Employee Account');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Salary Frequency');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Number Of Working Days');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Net Salary');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Basic Salary');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Extra Hours');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Extra Income');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', 'Deductions');
$objPHPExcel->getActiveSheet()->SetCellValue('N3', 'Payment Type');
$objPHPExcel->getActiveSheet()->SetCellValue('O3', 'Notes/Comments');
$cl = $employee_name = $bank_code = "";
$thisMonth = date("m");
$thisYear = date("Y");
if (count($resFet)) {
    $qatar_id = $visa_id = $employee_account_no = "";
    $total_working_days = $net_salary = $basic_salary = $extra_hours = 0;
    $rowCount = 4;
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $employee_name = $resFet[$rC]['employee_name'];
        $emp_id = $resFet[$rC]['employee_id'];
        $qatar = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `document_title`='Qatar ID' AND `status`='1' AND `employee_id`='$emp_id'");
        if (count($qatar)) {
            $qatar_id = $qatar[0]['document_data'];
        }
        $emp_salary = $resFet[$rC]['employee_salary'];
        $basic_salary = preg_replace("/[^0-9]/", "", $emp_salary);
        if ($basic_salary == "") {
            $basic_salary = 0;
        }
        $total_extra_working_income = $net_salary = $extra_hours = $extra_income = $normal_over_time = $holiday_over_time = $total_holiday_over_time = $total_normal_over_time = $total_normal_income = $holiday_extra = $total_holiday_income = 0;
        $times = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `employee_id`='$emp_id' AND MONTH(date)='$thisMonth'");
        if (count($times) > 0) {
            for ($t = 0; $t < count($times); $t++) {
                $normal_over_time = $times[$t]['normal_over_time'];
                $holiday_over_time = $times[$t]['holiday_over_time'];
                $total_normal_over_time = $total_normal_over_time + $normal_over_time;
                $total_holiday_over_time = $total_holiday_over_time + $holiday_over_time;
                $extra_hours = $extra_hours + $normal_over_time + $holiday_over_time;
                if ($extra_hours > 85) {
                    $extra_hours = 85;
                }
            }
        }
        if ($basic_salary != 0) {
            $per_day = $basic_salary / 30;
            $per_hour = $per_day / 8;
            $normal_extra = $per_hour * (1.25 / 100);
            $total_normal_income = ($per_hour + $normal_extra) * $total_normal_over_time;
            $holiday_extra = $per_hour * (1.5 / 100);
            $total_holiday_income = ($per_hour + $holiday_extra) * $total_holiday_over_time;
            $total_extra_working_income = $total_normal_income + $total_holiday_income;
        }
        $deduction_amount = $display_deduction = $deduct_this_month_amount = 0;
        $deductions = $db->selectQuery("SELECT `deduction_amount` FROM `sm_salary_deduction` WHERE `employee_id`='$emp_id' AND MONTH(deduction_date)='$thisMonth'");
        if (count($deductions)) {
            for ($dct = 0; $dct < count($deductions); $dct++) {
                $deduct_amount = $deductions[$dct]['deduction_amount'];
                $deduction_amount = $deduction_amount + $deduct_amount;
            }
        }
        if ($deduct_amount == 0) {
            $display_deduction = "0";
        } else {

            $this_month_deduct_percntage = $basic_salary / 4;
            if ($deduction_amount >= $this_month_deduct_percntage) {
                $deduct_this_month_amount = $this_month_deduct_percntage;
            } else {
                $deduct_this_month_amount = $deduction_amount;
            }
            $display_deduction = round($deduct_this_month_amount);
        } $this_month_deduct_percntage = $basic_salary / 4;
        if ($deduction_amount >= $this_month_deduct_percntage) {
            $net_salary = round(($basic_salary + round($total_extra_working_income)) - $this_month_deduct_percntage);
        } else {
            $net_salary = round(($basic_salary + round($total_extra_working_income)) - $deduct_this_month_amount);
        }
        $month_start_date = $thisYear . "-" . $thisMonth . "-01";
        $month_end_date1 = strtotime('last day of this month', time());
        $month_end_date = date("Y-m-d", $month_end_date1);
        $total_working_days = 0;
        $working_days = 0;
        $leave_days = 0;

        for ($dt = $month_start_date; $dt <= $month_end_date; $dt++) {
            $check_date = strtotime($dt);
            $emp_leave = $db->selectQuery("SELECT * FROM `sm_employee_leave` WHERE `employee_id`='$emp_id'");
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
        $select_basics = $db->selectQuery("SELECT * FROM `sm_sif_basic` WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$thisMonth'");
        if (count($select_basics)) {
            $payment_type = $select_basics[0]['sif_payment_type'];
            $notes_comments = $select_basics[0]['sif_notes_comments'];
        }
        $select_visa = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `employee_id`='$emp_id' AND `document_title`='Visa'");
        if (count($select_visa)) {
            $visa_id = $select_visa[0]['document_data'];
        }
        $select_bank_data = $db->selectQuery("SELECT sm_employee_bank_details.employee_account_no,sm_bank_details.bank_code FROM sm_employee_bank_details INNER JOIN sm_bank_details ON sm_employee_bank_details.bank_id=sm_employee_bank_details.bank_id LEFT JOIN sm_employee ON sm_employee.employee_id=sm_employee_bank_details.bank_id WHERE sm_employee.employee_id='$emp_id'");
        if (count($select_bank_data)) {
            $employee_account_no = $select_bank_data[0]['employee_account_no'];
            $bank_code = $select_bank_data[0]['bank_code'];
        }
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $fc = $rC + 1);
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $qatar_id);
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $visa_id);
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $employee_name);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $bank_code);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $employee_account_no);
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_working_days);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $net_salary);
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $basic_salary);
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $extra_hours);
        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, round($total_extra_working_income));
        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $display_deduction);
        $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $payment_type);
        $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $notes_comments);
        $rowCount = $rowCount + 1;
        //$objPHPExcel->getActiveSheet()->setTitle('SIF_' . $payer_eid . "_" . $bank_code_com . "_" . date("Ymd") . "_" . date("hi"));
    }
}
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$folder_name = "SIF/";
$folder_name .=date("Y") . "/" . date("F") . "/";
if (!file_exists($folder_name)) {
    mkdir($folder_name, 0777, true);
} else {
    array_map('unlink', glob("$folder_name/*.*"));
}
$file_name = 'SIF_' . $payer_eid . "_" . $bank_code_com . "_" . date("Ymd") . "_" . date("hi") . '.xlsx';
//$objWriter->save($folder_name . '/' . $file_name);
$objWriter->save($file_name);
// Save Excel 2007 file
//$values = array();
//$values['sif_name'] = $file_name;
//$values['sif_created_date'] = day("Y-m-d");
//$select_sif = $db->selectQuery("SELECT * FROM `sm_sif_list` WHERE MONTH(sif_created_date)='$thisMonth' AND YEAR(sif_created_date)='$thisYear'");
//if (count($select_sif)) {
//    $update = $db->secure_update("sm_sif_list", $values, "WHERE MONTH(sif_created_date)='$thisMonth' AND YEAR(sif_created_date)='$thisYear'");
//}
echo $file_name;
