<?php

session_start();
include('../connection.php');
//echo "<pre>";print_r($_SESSION); die;
//echo "<pre>";print_r($_POST["emp_docs"]); die;
$candidate_id = $_REQUEST['candidate_id'];
$Passport_Documents = $Experience_Certificates = $Resume = $Candidate_Picture = $ID_Card = $Driving_License = '' ;
if (isset($_SESSION['Passport_Documents'])) {
    $Passport_Documents = implode(",", $_SESSION['Passport_Documents']);
} else { 
	$Passport_Documents="";  
}
if (isset($_SESSION['Experience_Certificates'])) {
    $Experience_Certificates = implode(",", $_SESSION["Experience_Certificates"]);
} else { 
	$Experience_Certificates="";  
}
if (isset($_SESSION['Resume'])) {
    $Resume = implode(",", $_SESSION["Resume"]);
}else { 
	$Resume="";  
}
if (isset($_SESSION['Candidate_Picture'])) {
    $Candidate_Picture = implode(",", $_SESSION["Candidate_Picture"]);
}else { 
	$Candidate_Picture="";  
}
if (isset($_SESSION['ID_Card'])) {
    $ID_Card = implode(",", $_SESSION["ID_Card"]);
}else { 
	$ID_Card="";  
}
if (isset($_SESSION['Driving_License'])) {
    $Driving_License = implode(",", $_SESSION["Driving_License"]);
}else { 
	$Driving_License="";  
}
//echo "<pre>";print_r($_POST["emp_docs"]); die;
if (isset($_REQUEST['candidate_id'])) {
    //$employee_id = $_REQUEST['employee_id'];
    if (isset($_POST["emp_docs"])) 
	{
        $emp_docs = array_values($_POST["emp_docs"]);
        foreach ($emp_docs as $key => $value_array) {
			
            if ($value_array["document_title"] == "Candidate_Picture") {
                
                if ($Candidate_Picture) 
				{
					//echo "hai"; die;
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Candidate_Picture'");
                    $data_value_array["file_name"] = "Candidate_Picture";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Candidate_Picture;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Candidate_Picture']);
					unset($data_value_array);
                } 
            } elseif ($value_array["document_title"] == "Resume") {
					
				if ($Resume) 
				{
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Resume'");
                    $data_value_array["file_name"] = "Resume";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Resume;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Resume']);
					unset($data_value_array);
				}
            } elseif ($value_array["document_title"] == "Experience_Certificates") {
                
				if ($Experience_Certificates)
				{
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Experience_Certificates'");
                    $data_value_array["file_name"] = "Experience_Certificates";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Experience_Certificates;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Experience_Certificates']);
					unset($data_value_array);
				}
            } elseif ($value_array["document_title"] == "Passport_Documents") {
                
				if ($Passport_Documents) 
				{
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Passport_Documents'");
                    $data_value_array["file_name"] = "Passport_Documents";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Passport_Documents;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Passport_Documents']);
					unset($data_value_array);
				}
            }  elseif ($value_array["document_title"] == "ID_Card") {
                
				if ($ID_Card) 
				{
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'ID_Card'");
                    $data_value_array["file_name"] = "ID_Card";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $ID_Card;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['ID_Card']);
					unset($data_value_array);
				}
            }  elseif ($value_array["document_title"] == "Driving_License") {
                
				if ($Driving_License) 
				{
					$deletes_exp = $db->executeQuery("DELETE FROM `sm_candidate_files` WHERE `candidate_id`='$candidate_id' AND `file_name` = 'Driving_License'");
                    $data_value_array["file_name"] = "Driving_License";
                    $data_value_array["candidate_id"] = $candidate_id;
                    $data_value_array['file_path'] = $Driving_License;
					$logo = $db->secure_insert("sm_candidate_files", $data_value_array);
					unset($_SESSION['Driving_License']);
					unset($data_value_array);
				}
            }else {
                continue;
            }
        }
    }
    if (count($emp_docs)) {
        $success_msg = "Values Updated!";
    } else {
        $success_msg = "Error in updation";
    }
}