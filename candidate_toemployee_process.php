<?php

session_start();
include("./connection.php");
if(isset($_POST['candi_id'])) 
{
	$resCandi = $db->selectQuery("SELECT * FROM `sm_candidate` WHERE `candidate_id`='$can_id'");
	if (count($resCandi)) {

		$candidate_code = $resCandi[0]['candidate_code'];
		$agent_code = $resCandi[0]['agent_code'];
		$candidate_added_by = $resCandi[0]['candidate_added_by'];
		$candidate_firstname = $resCandi[0]['candidate_firstname'];
		$candidate_middlename = $resCandi[0]['candidate_middlename'];
		$candidate_lastname = $resCandi[0]['candidate_lastname'];
		$candidate_gender = $resCandi[0]['candidate_gender'];
		$candidate_marital_status = $resCandi[0]['candidate_marital_status'];
		$candidate_dob = $resCandi[0]['candidate_dob'];
		$candidate_doorno = $resCandi[0]['candidate_doorno'];
		$candidate_nationality = $resCandi[0]['candidate_nationality'];
		$candidate_state = $resCandi[0]['candidate_state'];
		$candidate_city = $resCandi[0]['candidate_city'];
		$candidate_zipcode = $resCandi[0]['candidate_zipcode'];
		$candidate_email = $resCandi[0]['candidate_email'];
		$candidate_phone = $resCandi[0]['candidate_phone'];
		$candidate_status = $resCandi[0]['candidate_status'];
		$candidate_interview_status = $resCandi[0]['candidate_interview_status'];

		$candidate_dob1 = explode("-", $candidate_dob);
		$candidate_dob = $candidate_dob1[2] . "/" . $candidate_dob1[1] . "/" . $candidate_dob1[0];
	}

}

/*
$sponsor_id = $_SESSION['id'];
$Passport = $Visa = $Qatar = $Health = $Insurance = $Resume = '';
if (isset($_SESSION['Passport'])) {
    $Passport1 = $_SESSION['Passport'];
    $Passport = implode(",", $Passport1);
}
if (isset($_SESSION['Visa'])) {
    $Visa1 = $_SESSION["Visa"];
    $Visa = implode(",", $Visa1);
}
if (isset($_SESSION['Qatar'])) {
    $Qatar = implode(",", $_SESSION["Qatar"]);
}
if (isset($_SESSION['Health'])) {
    $Health1 = $_SESSION["Health"];
    $Health = implode(",", $Health1);
}
if (isset($_SESSION['Insurance'])) {
    $Insurance1 = $_SESSION["Insurance"];
    $Insurance = implode(",", $Insurance1);
}
if (isset($_SESSION['Resume'])) {
    $Resume = implode(",", $_SESSION["Resume"]);
}
if (isset($_POST['depend_num'])) {
    $depend_num = $_POST['depend_num'];
}
if (isset($_SESSION['Profile_Picture'])) {
    $Profile_Picture = implode(",", $_SESSION['Profile_Picture']);
} */


/*
$visa_end = "";
$visa_num = "";
$visa_start = "";
$pass_end = "";
$pass_num = "";
$pass_start = "";
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address21 = $_POST['address21'];
$address22 = $_POST['address22'];
$city = $_POST['city'];
$city2 = $_POST['city2'];
$company = $_POST['company'];
$dnumber = $_POST['dnumber'];
$dnumber2 = $_POST['dnumber2'];
$dob = $_POST['dob'];
$doj1 = $_POST['doj'];
$em_contact = $_POST['em_contact'];
$email = $_POST['email'];
$employee_com_id = $_POST['employee_com_id'];
$employee_designation = $_POST['employee_designation'];
$employee_salary = $_POST['employee_salary'];
$employee_fee = $_POST['employee_fee'];
$first_name = $_POST['first_name'];
$gender = $_POST['gender'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$nationality = $_POST['nationality'];
$phone = $_POST['phone'];
$remarks = $_POST['remarks'];
$state = $_POST['state'];
$state2 = $_POST['state2'];
$visa_type = $_POST['visa_type'];
$zip = $_POST['zip'];
$zip2 = $_POST['zip2'];
$values = array();
$values['employee_firstname'] = $first_name;
$values['employee_middlename'] = $middle_name;
$values['employee_lastname'] = $last_name;
$values['employee_employment_id'] = $employee_com_id;
$values['employee_company'] = $company;
$values['employee_visatype'] = $visa_type;
$values['employee_fee'] = $employee_fee;
$values['employee_salary'] = $employee_salary;
$values['employee_designation'] = $employee_designation;
$values['employee_nationality'] = $nationality;
$values['employee_gender'] = $gender;
$values['employee_dob'] = $dob;
$values['employee_remarks'] = $remarks;
$values['employee_peraddress1'] = $address1;
$values['employee_peraddress2'] = $address2;
$values['employee_perdoor'] = $dnumber;
$values['employee_percity'] = $city;
$values['employee_perstate'] = $state;
$values['employee_perzip'] = $zip;
$values['employee_resiaddress1'] = $address21;
$values['employee_resiaddress2'] = $address22;
$values['employee_residoor'] = $dnumber2;
$values['employee_resicity'] = $city2;
$values['employee_resistate'] = $state2;
$values['employee_zip'] = $zip2;
$values['employee_email'] = $email;
$values['employee_phone'] = $phone;
$values['employee_emcontact'] = $em_contact;
$values['employee_receive_newsletter'] = "yes";
$explode_doj = explode('/', $doj1);

$values['employee_joining_date'] = $explode_doj[2] . "-" . $explode_doj[1] . "-" . $explode_doj[0];
$values['sponsor_id'] = $sponsor_id;
$employee_id = $db->secure_insert("sm_employee", $values);
if (!empty($employee_id)) {
    echo "Employee added successfully";
}
if (!empty($Profile_Picture)) {
    $clogoArray = array();
    $clogoArray['employee_id'] = $employee_id;
    $clogoArray['file_name'] = $Profile_Picture;
    $clogoArray['file_title'] = 'Profile_Picture';
    $dp = $db->secure_insert("sm_employee_files", $clogoArray);
    unset($_SESSION['Profile_Picture']);
}
if (!empty($Resume)) {
    $resumeArray = array();
    $resumeArray['employee_id'] = $employee_id;
    $resumeArray['file_name'] = $Resume;
    $resumeArray['file_title'] = 'Resume';
    $resumeArray["file_class"] = 'Resume';
    $dp = $db->secure_insert("sm_employee_files", $resumeArray);
    unset($_SESSION['Resume']);
}
if (isset($_POST["depen"])) {
    $depen = $_POST["depen"];
    $counter = count($depen);
    foreach ($depen as $dkey => $keyval) {
        $dep_new = array_merge($keyval, array("employee_id" => $employee_id));
        $insert_depend = $db->secure_insert("sm_dependant", $dep_new);
        $values1 = array();
    }
}
if (isset($_POST["emp_docs"])) {
    $emp_docs = array_values($_POST["emp_docs"]);
    foreach ($emp_docs as $key => $value_array) {
        $value_array["document_title"] = preg_replace('/\bNo\b/', '', $value_array["document_title"]);
        $className = "";
        $s_date = $value_array['document_start_date'];
        $explode_s_date = explode("/", $s_date);
        $value_array['document_start_date'] = $explode_s_date[2] . "-" . $explode_s_date[1] . "-" . $explode_s_date[0];
        $e_date = $value_array['document_end_date'];
        $explode_e_date = explode("/", $e_date);
        $value_array['document_end_date'] = $explode_e_date[2] . "-" . $explode_e_date[1] . "-" . $explode_e_date[0];
        $employee_documents = array_merge($value_array, array("employee_id" => $employee_id));
        $document_id = $db->secure_insert("sm_employee_documents", $employee_documents);
        $data_value_array = array();
        if ($value_array["document_title"] == "Qatar ID") {
            if (empty($Qatar)) {
                continue;
            }
            $data_value_array["file_name"] = $Qatar;
            $className = "Qatar";
            unset($_SESSION['Qatar']);
        } elseif ($value_array["document_title"] == "Health Card ") {
            if (empty($Health)) {
                continue;
            }
            $data_value_array["file_name"] = $Health;
            $className = "Health";
            unset($_SESSION['Health']);
        } elseif ($value_array["document_title"] == "Insurance ") {
            if (empty($Insurance)) {
                continue;
            }
            $data_value_array["file_name"] = $Insurance;
            $className = "Insurance";
            unset($_SESSION['Insurance']);
        } elseif ($value_array["document_title"] == "Passport ") {
            if (empty($Passport)) {
                continue;
            }
            $data_value_array["file_name"] = $Passport;
            $className = "Passport";
            unset($_SESSION['Passport']);
        } elseif ($value_array["document_title"] == "Visa ") {
            if (empty($Visa)) {
                continue;
            }
            $data_value_array["file_name"] = $Visa;
            $className = "Visa";
            unset($_SESSION['Visa']);
        } else {
            continue;
        }

        $data_value_array["employee_id"] = $employee_id;
        $data_value_array["document_id"] = $document_id;
        $data_value_array["file_class"] = $className;
        $insert_file = $db->secure_insert("sm_employee_files", $data_value_array);
        unset($data_value_array);
    }
}
unset($_SESSION['Qatar']);
unset($_SESSION['Health']);
unset($_SESSION['Insurance']);
unset($_SESSION['Passport']);
unset($_SESSION['Visa']);
unset($_SESSION['Resume']);
unset($_SESSION['Profile_Picture']);
*/