<?php
include('connection.php');

	    $candidate_id 			= $_POST['candidate_id'];
		$valu= $_POST['applied_visa_date'];
		$originalDate  = explode("/",$valu);
		$visa_date   = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
				
                $values['visa_status']="Applied";
					$values["applied_visa_date"] = $visa_date;
				$values["visa_type"]		= $_POST['visa_type'];
			    $values["visa_category"] = $_POST['visa_category'];
                $update = $db->secure_update("sm_candidate_visa_process", $values, "WHERE `candidate_id`='$candidate_id'");
				if($update){
					
					echo "added successfully";
				

				} 
    