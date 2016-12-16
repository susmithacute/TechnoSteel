<?php

include('connection.php');
//echo "haii";
session_start();
if (isset($_REQUEST['numf'])) {
    $numf = $_REQUEST['numf'];
		
}
$employee_id = $_REQUEST['pass_val'];
$selectemployee_id = $db->selectQuery("SELECT `employee_id`,`employee_employment_id` from sm_employee where `employee_id`='$employee_id'");
$employee_id = $selectemployee_id[0]['employee_id'];
$employee_code = $selectemployee_id[0]['employee_employment_id'];
//$employee_company=$selectcandidate_id[0]['employee_company'];
//$values['candidate_id'] = $candidate_id;
//$values['candidate_code'] = $candidate_code;
//$values['medical_status'] = $medical_status;
$extensions = array("png", "jpg", "pdf", "doc", "docx");
$data_ready = 1;
$sesVal = array();


	
$folder_name = "emp_uploads/$employee_code/";
$folder_name .="medical certificates/";




if (!file_exists($folder_name)) {
        mkdir($folder_name, 0777, true);
    }
if ($data_ready == 1) {
    for ($i = 0; $i < $numf; $i++) {
        $file_new_name = "";
        $filename = "";
        $file = $_FILES['file-' . $i];
        $filename_org = $file['name'] . ", ";
        $filename = str_replace(' ', '', $file['name']);
        if ($filename != "") {
            $uniqid = uniqid();
            $filename = $filename;
            $file_new_name= $folder_name . $filename;
			//$file_new_name = $folder_name;
            move_uploaded_file($file['tmp_name'], $file_new_name);
			$value["medical_certificates"] = $file_new_name;
			
				$insert = $db->secure_update("sm_employee_leave", $value, "WHERE `employee_id`='$employee_id' AND `leave_type_id`='2'");
				
				if (count($insert)) {

					echo "<script>location.href='emp_leavelist.php'</script>";
				}
				else{
					$success_msg = "Error in insertion";
				}
			}
			
			}
		}
	
		
		

?>