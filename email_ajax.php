<?php
include("connection.php");
if(isset($_POST['update_id'])){
	//print_r($_POST);
	$id=$_POST['update_id'];
		//$candidate_id=$_POST['candidate_id'];
$agent_code1 = $db->selectQuery("SELECT `agent_code` FROM sm_candidate WHERE `candidate_id`='$id'");

			 $agent_co = $agent_code1[0]['agent_code'];
            if (!empty($agent_co)&&($agent_co!="other")) {
			
							$select = $db->selectQuery("SELECT `agent_email` FROM sm_recruitment_agents WHERE `agent_area_id`='$agent_co'");
							             
								if(count($select)>0){
									//echo "nooo";
								
										$email= $select[0]['agent_email'];
											
												 //$data=array("agent_email2"=>$email);
												 //echo json_encode($data);
											
								 }       
			                     
			}
            else
			{ 
				
			//echo"yeeeee";
				$mail = $db->selectQuery("SELECT `candidate_email` FROM sm_candidate WHERE `candidate_id`='$id'");
				
				$email= $mail[0]['candidate_email'];
					
							// $data1=array("agent_email2"=> $email);
							 //echo json_encode($data1);
							
		   }


	$visaDetails = $db->selectQuery("SELECT CONCAT( sm_candidate.candidate_firstname,  ' ', sm_candidate.candidate_middlename,  ' ',
		sm_candidate.candidate_lastname ) AS candidate_name, sm_candidate_visa_process.candidate_id,sm_candidate_visa_process.visa_type,
		sm_candidate_visa_process.visa_no,sm_candidate_visa_process.visa_issued,sm_candidate_visa_process.visa_expiry,sm_candidate.candidate_email
		FROM sm_candidate
		LEFT JOIN sm_candidate_visa_process ON  sm_candidate.candidate_id=sm_candidate_visa_process.candidate_id
		WHERE  `visa_status`='Approved' AND sm_candidate_visa_process.candidate_id='$id'");
		if (!empty($visaDetails)) {
			//$s1=$visaDetails[0]['visa_issued'];
					$s1=explode("-",$visaDetails[0]['visa_issued']);
			$date1=$s1[2]."-".$s1[1]."-".$s1[0];
			
								$s2=explode("-",$visaDetails[0]['visa_expiry']);
			$date2=$s2[2]."-".$s2[1]."-".$s2[0];
			
			$content= "Hai		".$visaDetails[0]['candidate_name'].'
			This is your confirmation mail for joining Technosteel.
			
			Visa Number:'.$visaDetails[0]['visa_no']."
			Visa Issued Date :".$date1."
			Visa Expiry Date :".$date2.'
			
			If you will not present within 90 days from issued date,this opportunity will be rejected.'.
			' If you wish to come here, please send the following details.'.'
			 Flight No:
			Date of Travel:
			Departure Time:
			Arrival Time'.'
			                                                  Thank You';
											
			
		
			 $data=array("content_mail"=> $content,"agent_email2" =>$email);
							 echo json_encode($data);
							
				
			
		}
	
}