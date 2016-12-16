<?php

include './connection.php';
require ('class-excel-xml.inc.php');
$docs = "";
$selected_feilds = "";
if (isset($_POST["emp"])) {
    $myarray = $list = $docs = $mydocs = $myheaderarraycount = array();
    $myheaderarray = array("Slno.");
    $select_feilds = " employee_id,";
    $emp_fields = $_POST["emp"];
    foreach ($emp_fields as $emp_row) {
        //echo $emp_row;
        array_push($myheaderarray, $emp_row);
        array_push($myheaderarraycount, $emp_row);
        if ($emp_row == 'Name') {
            $emp_row = "CONCAT(employee_firstname,' ',employee_middlename,' ',employee_lastname) as Name";
        }
        $select_feilds.=$emp_row . ",";
    }

    if (isset($_POST['doc'])) {
        $docs = $_POST['doc'];
        foreach ($docs as $doc_ti) {
            array_push($myheaderarray, $doc_ti);
            array_push($myheaderarray, "Expiry");
        }
    }
    array_push($list, $myheaderarray);
    $selected_feilds = substr($select_feilds, 0, -1);
    $select_emp_table = $db->selectQuery("SELECT " . $selected_feilds . " FROM sm_employee WHERE `employee_status`=1");
    if (count($select_emp_table)) {
        $sl_no = 1;
        $count_array = count($myheaderarraycount);
        for ($i = 0; $i < count($select_emp_table); $i++) {
            $emp_id = $select_emp_table[$i]['employee_id'];
            array_push($myarray, $sl_no);
            for ($j = 1; $j <= $count_array; $j++) {
                $this_val = $myheaderarray[$j];
                $insert_value = $select_emp_table[$i][$this_val];
                if ($this_val == 'employee_company') {
                    $select_company = $db->selectQuery("SELECT `company_name` FROM `sm_company` WHERE `company_id`='$insert_value'");
                    if (count($select_company)) {
                        $insert_value = $select_company[0]['company_name'];
                    }
                }

                array_push($myarray, $insert_value);
            }

            foreach ($docs as $dd) {
                $select_doc_data = $db->selectQuery("SELECT `document_data`,`document_end_date` FROM `sm_employee_documents` WHERE `document_title`='$dd' AND `status`=1 AND `employee_id`='$emp_id'");
                if (count($select_doc_data)) {
                    array_push($myarray, $select_doc_data[0]['document_data']);
                    array_push($myarray, $select_doc_data[0]['document_end_date']);
                }
            }


            array_push($list, $myarray);
            $myarray = array();
            $mydocs = array();
            $sl_no++;
        }
    } $fp = fopen('employee_list.xls', 'w');

    foreach ($list as $fields) {
        fputcsv($fp, $fields, "\t", '"');
    }
    echo "employee_list.xls";
}