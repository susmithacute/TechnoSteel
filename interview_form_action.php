<?php

session_start();
include("connection.php");
//print_r($_SESSION); die;
//echo "<pre>";print_r($_SESSION); die;
$Passport_Documents = $Experience_Certificates = $Resume = $Candidate_Picture = $Candidate_Contract = '';
if (isset($_SESSION['Passport_Documents'])) {
    $Passport_Documents = implode(",", $_SESSION['Passport_Documents']);
}
if (isset($_SESSION['Experience_Certificates'])) {
    $Experience_Certificates = implode(",", $_SESSION["Experience_Certificates"]);
}
if (isset($_SESSION['Resume'])) {
    $Resume = implode(",", $_SESSION["Resume"]);
}
if (isset($_SESSION['ID_Card'])) {
    $ID_Card = implode(",", $_SESSION["ID_Card"]);
}
if (isset($_SESSION['Driving_License'])) {
    $Driving_License = implode(",", $_SESSION["Driving_License"]);
}
if (isset($_SESSION['Candidate_Picture'])) {
    $Candidate_Picture = ($_SESSION["Candidate_Picture"]);
}
if (isset($_SESSION['Candidate_Contract'])) {
    $Candidate_Contract = ($_SESSION["Candidate_Contract"]);
}
$candidate_id = $_POST['candidate_id'];
$candidate_nationality = $_POST['candidate_nationality'];
$candidate_city = $_POST['candidate_city'];
$candidate_code = $_POST['candidate_code'];
//$candidate_dob1 = new DateTime($_POST['candidate_dob']);
//$candidate_dob = $candidate_dob1->format('Y-m-d');
$candidate_dob1 = explode("/", $_POST['candidate_dob']);
$candidate_dob = @$candidate_dob1[2] . "-" . @$candidate_dob1[1] . "-" . @$candidate_dob1[0];
$candidate_email = $_POST['candidate_email'];
$candidate_firstname = $_POST['candidate_firstname'];
$candidate_gender = $_POST['candidate_gender'];
$candidate_lastname = $_POST['candidate_lastname'];
$candidate_marital_status = $_POST['candidate_marital_status'];
$candidate_middlename = $_POST['candidate_middlename'];
$candidate_doorno = $_POST['candidate_doorno'];
$candidate_phone = $_POST['candidate_phone'];
$candidate_state = $_POST['candidate_state'];
$candidate_zipcode = $_POST['candidate_zipcode'];
$interview_result = $_POST['interview_result'];
$values = array();
$values['candidate_nationality'] = $candidate_nationality;
$values['candidate_city'] = $candidate_city;
$values['candidate_code'] = $candidate_code;
$values['candidate_dob'] = $candidate_dob;
$values['candidate_email'] = $candidate_email;
$values['candidate_firstname'] = $candidate_firstname;
$values['candidate_gender'] = $candidate_gender;
$values['candidate_lastname'] = $candidate_lastname;
$values['candidate_marital_status'] = $candidate_marital_status;
$values['candidate_middlename'] = $candidate_middlename;
$values['candidate_doorno'] = $candidate_doorno;
$values['candidate_phone'] = $candidate_phone;
$values['candidate_state'] = $candidate_state;
$values['candidate_zipcode'] = $candidate_zipcode;
$values['candidate_interview_status'] = $interview_result;
if ($interview_result == "Selected") {
    $selected_salary = $_POST['selected_salary'];
    $selected_values = array();
    $selected_values['salary'] = $selected_salary;
    $selected_values['candidate_id'] = $candidate_id;
	$db->executeQuery("DELETE FROM `sm_selected_candidates` WHERE `candidate_id` ='$candidate_id'");
    $insrt_sel = $db->secure_insert("sm_selected_candidates", $selected_values);
}
if ($interview_result == "Retest") {
    $retest_date = $_POST['retest_date'];
    $retest_values = array();
    $retest_values['retest_date'] = $retest_date;
    $retest_values['candidate_id'] = $candidate_id;
	$db->executeQuery("DELETE FROM `sm_retest_candidates` WHERE `candidate_id` ='$candidate_id'");
    $insrt_ret = $db->secure_insert("sm_retest_candidates", $retest_values);
}
if ($interview_result == "Rejected") {
    $rejection_reason = $_POST['rejection_reason'];
    $rejection_values['rejection_reason'] = $rejection_reason;
    $rejection_values['candidate_id'] = $candidate_id;
	$db->executeQuery("DELETE FROM `sm_rejected_candidates` WHERE `candidate_id` ='$candidate_id'");
    $insrt_rej = $db->secure_insert("sm_rejected_candidates", $rejection_values);
}
if ($interview_result == "onhold") {
    $holding_reason = $_POST['holding_reason'];
    $holding_values['holding_reason'] = $holding_reason;
    $holding_values['candidate_id'] = $candidate_id;
	$db->executeQuery("DELETE FROM `sm_holding_candidates` WHERE `candidate_id` ='$candidate_id'");
    $insrt_rej = $db->secure_insert("sm_holding_candidates", $holding_values);
}
$candidate_update = $db->secure_update("sm_candidate", $values, "WHERE `candidate_id`='$candidate_id'");
//echo "<pre>";print_r($_POST["emp_docs"]); die;
	
	$display_name = ""; 
	$select_name = $db->selectQuery("SELECT `candidate_added_by` FROM `sm_candidate` WHERE `candidate_id`='$candidate_id'");
	if(!empty($select_name))
	{
		$display_name = $select_name[0]['candidate_added_by'];
	}
	if(isset($_POST["emp_docs"])){
	$emp_docs = array_values($_POST["emp_docs"]);
	//echo "<pre>";print_r($emp_docs); die;
        foreach ($emp_docs as $key => $value_array) {
			
            if ($value_array["document_title"] == "Candidate_Picture") {
                
                if (!empty($Candidate_Picture)) 
				{
					if($display_name == 'agent')
					{
						$Candidate_Pictures = '../'.$Candidate_Picture;
					} else {
						$Candidate_Pictures = $Candidate_Picture;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Candidate_Picture'");
                    $data_value_array["file_name"] = "Candidate_Picture";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Candidate_Pictures;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Candidate_Picture']);
					unset($data_value_array);
                } 
            } elseif ($value_array["document_title"] == "Resume") {
					
				if ($Resume) 
				{
					if($display_name == 'agent')
					{
						$Resumes = '../'.$Resume;
					} else {
						$Resumes = $Resume;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Resume'");
                    $data_value_array["file_name"] = "Resume";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Resumes;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Resume']);
					unset($data_value_array);
				}
            } elseif ($value_array["document_title"] == "Experience_Certificates") {
                
				if ($Experience_Certificates)
				{
					if($display_name == 'agent')
					{
						$Experience_Certificatess = '../'.$Experience_Certificates;
					} else {
						$Experience_Certificatess = $Experience_Certificates;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Experience_Certificates'");
                    $data_value_array["file_name"] = "Experience_Certificates";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Experience_Certificatess;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Experience_Certificates']);
					unset($data_value_array);
				}
            } elseif ($value_array["document_title"] == "Passport_Documents") {
                
				if ($Passport_Documents) 
				{
					if($display_name == 'agent')
					{
						$Passport_Documentss = '../'.$Passport_Documents;
					} else {
						$Passport_Documentss = $Passport_Documents;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Passport_Documents'");
                    $data_value_array["file_name"] = "Passport_Documents";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Passport_Documentss;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Passport_Documents']);
					unset($data_value_array);
				}
            }  elseif ($value_array["document_title"] == "ID_Card") {
                
				if (@$ID_Card) 
				{
					if($display_name == 'agent')
					{
						$ID_Cards = '../'.$ID_Card;
					} else {
						$ID_Cards = $ID_Card;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'ID_Card'");
                    $data_value_array["file_name"] = "ID_Card";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $ID_Cards;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['ID_Card']);
					unset($data_value_array);
				}
            }  elseif ($value_array["document_title"] == "Driving_License") {
                
				if (@$Driving_License) 
				{
					if($display_name == 'agent')
					{
						$Driving_Licenses = '../'.$Driving_License;
					} else {
						$Driving_Licenses = $Driving_License;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Driving_License'");
                    $data_value_array["file_name"] = "Driving_License";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Driving_Licenses;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Driving_License']);
					unset($data_value_array);
				}
            }
			elseif ($value_array["document_title"] == "Candidate_Contract") {
                
				if (@$Candidate_Contract) 
				{
					if($display_name == 'agent')
					{
						$Signed_Contract1 = '../'.$Candidate_Contract;
					} else {
						$Signed_Contract1 = $Candidate_Contract;
					}
					
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Candidate_Contract'");
                    $data_value_array["file_name"] = "Candidate_Contract";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Signed_Contract1;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Candidate_Contract']);
					unset($data_value_array);
				}
            }
			else {
                continue;
            }
        }
		}
		


if (isset($_POST['qualification'])) {
    $value_array = array();
    $qualification = $_POST["qualification"];
	$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_qualifications` WHERE `candidate_id`='$candidate_id'");
    foreach ($qualification as $key => $value_array) {
        $qualification_vals = array_merge($value_array, array("candidate_id" => $candidate_id));
       
		$experience_id = $db->secure_insert("sm_candidate_qualifications", $qualification_vals);
        unset($value_array);
    }
}

if (isset($_POST['application'])) {
    $value_array1 = array();
    $skill_implode = "";
    $application = $_POST["application"];
    if (isset($_POST['skill'])) {
        $skill = $_POST['skill'];
        $skill_implode = implode(",", $skill);
    }
    foreach ($application as $key => $value_array1) {
        $application_vals = array_merge($value_array1, array("candidate_id" => $candidate_id, "application_skills" => $skill_implode));
      
        $application_id = $db->secure_update("sm_candidate_application", $application_vals, "WHERE `candidate_id` = '$candidate_id'");
        unset($value_array1);
    }
}
if ($_POST['job_postion_value'] == 'Welder') {
	$testvalue['job_position']= $_POST['job_postion_value'];
	$testvalue['candidate_id']= $candidate_id;
	$testvalue['test_root']= $_POST["test_root"];
	$testvalue['fillup_capping']= $_POST["fillup_capping"];
	
}
if ($_POST['job_postion_value'] == 'Fabricator') {
	$testvalue['job_position']= $_POST['job_postion_value'];
	$testvalue['candidate_id']= $candidate_id;
	
	$testvalue['cutting']= $_POST["cutting"];
	$testvalue['grinding']= $_POST["grinding"];
	$testvalue['tack_weld']= $_POST["tack_weld"];
	$testvalue['drawing']= $_POST["drawing"];
	
}
if ($_POST['job_postion_value']!= 'Fabricator' && $_POST['job_postion_value']!= 'Welder') {
	$testvalue['job_position']= $_POST['job_postion_value'];
	$testvalue['candidate_id']= $candidate_id;
	$testvalue['test_root']= $_POST["test_root"];
	$testvalue['skill']= $_POST["skills"];
	$testvalue['mark_percentage']= $_POST["mark_percentage"];
}

	$db->executeQuery("DELETE FROM `sm_interview_test_details` WHERE `candidate_id` ='$candidate_id'");
	$insrt_other = $db->secure_insert("sm_interview_test_details", $testvalue);

if (isset($_POST['experience'])) {
    $value_arrays = array();
    $experiences = $_POST["experience"];
	$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_experience` WHERE `candidate_id`='$candidate_id'");
    foreach ($experiences as $key => $value_arrays) {
        if (!empty($value_arrays['experience_from'])) {
            $from_date1 = explode("/", $value_arrays['experience_from']);
            $from_date = $from_date1[2] . "-" . $from_date1[1] . "-" . $from_date1[0];
        } else {
            $from_date = "";
        }
        $value_arrays['experience_from'] = $from_date;
        if (!empty($value_arrays['experience_to'])) {
            $to_date1 = explode("/", $value_arrays['experience_to']);
            $to_date = $to_date1[2] . "-" . $to_date1[1] . "-" . $to_date1[0];
        } else {
            $to_date = "";
        }
        $value_arrays['experience_to'] = $to_date;
        $experience_vals = array_merge($value_arrays, array("candidate_id" => $candidate_id));
        
		$experience_id = $db->secure_insert("sm_candidate_experience", $experience_vals);
	
        unset($value_arrays);
    }
	
} 
if (isset($_POST['documents'])) {
    $document_array = array();
    $documents = $_POST['documents'];
	
    foreach ($documents as $key => $document_array) {
        $document_vals = array_merge($document_array, array("candidate_id" => $candidate_id));
        
        
        if ($document_array["documents_title"] == "Passport") { 
            $document_id = $db->secure_update("sm_candidate_documents", $document_vals, "WHERE `candidate_id` = '$candidate_id' AND `documents_title` = 'Passport'");
            if (empty($Passport_Documents)) {
                continue;
            }
			
        } elseif ($document_array["documents_title"] == "Driving Licence") { 
			
            $document_id = $db->secure_update("sm_candidate_documents", $document_vals, "WHERE `candidate_id` = '$candidate_id' AND `documents_title` = 'Driving Licence'");
            if (empty($Passport_Documents)) {
                continue;
            }
        } elseif ($document_array["documents_title"] == "ID Card") { 
            $document_id = $db->secure_update("sm_candidate_documents", $document_vals, "WHERE `candidate_id` = '$candidate_id' AND `documents_title` = 'ID Card'");
        } else {
            continue;
        }
		
     
        unset($document_array);
    }
} 
echo '<script>location.href="interview_form.php?can_id=' . $candidate_id . '"</script>';
