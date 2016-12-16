<?php

date_default_timezone_set('Asia/Qatar');
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
include './connection.php';
$objPHPExcel = new PHPExcel();
$payer_eid = $bank_code_com = $company_iban_no = $company_id = "";
if (isset($_POST["cid"])) {
    $company_id = $_POST["cid"];
    $select_comp_bank_data = $db->selectQuery("SELECT sm_company_bank_details.company_account_no,sm_bank_details.bank_code,sm_company_bank_details.company_iban_no FROM sm_company_bank_details INNER JOIN sm_bank_details ON sm_company_bank_details.bank_id=sm_bank_details.bank_id LEFT JOIN sm_company ON sm_company.company_id=sm_company_bank_details.bank_id WHERE sm_company.company_id='$company_id'");
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
$lastMonth1 = date('Y-m-d', strtotime('first day of last month'));
$check_last_month = date('m', strtotime('first day of last month'));
$check_last_year = date('Y', strtotime('first day of last month'));
$lastMonth = date('m', strtotime(date($lastMonth1) . " -1 month"));
$checkYear = date('Y', strtotime(date($lastMonth1) . " -1 month"));
if (count($resFet)) {
    $qatar_id = $visa_id = $employee_account_no = "";
    $total_working_days = $net_salary = $basic_salary = $extra_hours = 0;
    $rowCount = 4;
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $qatar_id = $visa_id = $employee_account_no = "";
        $employee_name = $resFet[$rC]['employee_name'];
        $emp_id = $resFet[$rC]['employee_id'];
        $deduct_amount = $extra_hours = $total_extra_working_income = 0;
        $deduction_amount = $basic_salary = $total_working_days = $net_salary = 0;
        $emp_id = $resFet[$rC]['employee_id'];
        $employee_name = $resFet[$rC]['employee_name'];
        $select_sif_extra_fields = $db->selectQuery("SELECT `normal_overtime`,`employee_visa`,`employee_qid`,`holiday_overtime`,`extra_income`,`extra_hours` FROM `sm_employee_working_hours_total` WHERE `employee_id`='$emp_id' AND `month`='$lastMonth' AND `year`='$checkYear'");
        if (count($select_sif_extra_fields)) {
            $qatar_id = $select_sif_extra_fields[0]['employee_qid'];
            $visa_id = $select_sif_extra_fields[0]['employee_visa'];
            $extra_hours = $select_sif_extra_fields[0]['extra_hours'];
            $total_extra_working_income = $select_sif_extra_fields[0]['extra_income'];
        }
        $thisMo_sif_extra_fields = $db->selectQuery("SELECT `total_working_days` FROM `sm_employee_working_hours_total` WHERE `employee_id`='$emp_id' AND `month`='$check_last_month' AND `year`='$check_last_year'");
        if (count($thisMo_sif_extra_fields)) {
            $total_working_days = $thisMo_sif_extra_fields[0]['total_working_days'];
            $basic_salary = $thisMo_sif_extra_fields[0]['employee_salary'];
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
        $select_basics = $db->selectQuery("SELECT * FROM `sm_sif_basic` WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$check_last_month' AND YEAR(sif_date)='$check_last_year'");
        if (count($select_basics)) {
            $payment_type = $select_basics[0]['sif_payment_type'];
            $notes_comments = $select_basics[0]['sif_notes_comments'];
        }
        $select_bank_data = $db->selectQuery("SELECT sm_employee_bank_details.employee_account_no,sm_bank_details.bank_code FROM sm_employee_bank_details INNER JOIN sm_bank_details ON sm_employee_bank_details.bank_id=sm_bank_details.bank_id WHERE sm_employee_bank_details.employee_id='$emp_id'");
        if (count($select_bank_data)) {
            $employee_account_no = $select_bank_data[0]['employee_account_no'];
            $bank_code = $select_bank_data[0]['bank_code'];
        } else {
            $employee_account_no = "";
            $bank_code = "";
        }
        $sal_freq = M;
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $fc = $rC + 1);
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $qatar_id);
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $visa_id);
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $employee_name);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $bank_code);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $employee_account_no);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $sal_freq);
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_working_days);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $net_salary);
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $basic_salary);
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $extra_hours);
        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, round($total_extra_working_income));
        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $display_deduction);
        $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $payment_type);
        $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $notes_comments);
        $rowCount = $rowCount + 1;
        $values_payroll = array();
        $values_payroll['payroll_status'] = "Paid";
        $values_payroll['salary'] = $net_salary;
        $values_payroll['payroll_date'] = date('Y-m-d');
        $update_salary = $db->secure_update("sm_payroll", $values_payroll, " WHERE employee_id='$emp_id'");
    }
    $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle("A3:O3")->getFont()->setBold(true);
}
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('SIF_' . $payer_eid . "_" . $bank_code_com . "_" . date("Ymd") . "_" . date("hi") . '.xlsx');
echo 'SIF_' . $payer_eid . "_" . $bank_code_com . "_" . date("Ymd") . "_" . date("hi") . '.xlsx';
