<?php

//include ("./file_parts/header.php");
//include("connection.php");
$visa_name = "";
$today = date('Y-m-d');

//$yesterday = date('Y-m-d', strtotime("-1 days"));

$daylen = 60 * 60 * 24;

$cur_date = date("d-m-Y");
//$notif_day_before=15;
$select_day = $db->selectQuery("SELECT `validity_period`,`notify_period` FROM  `sm_visa_validity` WHERE  `notification_name` =  'RP Visa Medical Nofication'");
if(count($select_day)){
    $notif_day_before=$select_day[0]['notify_period'];
	$validity_day=$select_day[0]['validity_period'];
//echo "$validity_day";
	//echo "$notif_day_before";die;
}
$cmpMail="";
$canId="";

$empz = $db->selectQuery("SELECT * FROM `sm_candidate_visa_process` WHERE `visa_status`='approved'");
//echo "<pre>";print_r($empz);
if (count($empz) > 0) {

    $values = array();

    for ($em = 0; $em < count($empz); $em++) {

        $canId = $empz[$em]['candidate_id'];

        $visatypeId = $empz[$em]['visa_type'];

        $visa_expiry = $empz[$em]['visa_expiry'];

        //$emp_name = $empz[$em]['employee_firstname'] . " " . $empz[$em]['employee_middlename'] . " " . $empz[$em]['employee_lastname'];
		//echo "$visatypeId";die;
 //echo "$visa_expiry";die;
        $visaName = $db->selectQuery("SELECT `visa_type_name` FROM `sm_visa_type` WHERE `visa_type_id`='$visatypeId'");
		//echo "<pre>";print_r($visaName);die;

        if (count($visaName) > 0) {
			 for ($cm = 0; $cm < count($visaName); $cm++) {

            $visa_name = $visaName[$cm]['visa_type_name'];
		
            //echo "$visa_name";die;
			
			
			$entry_date = $db->selectQuery("SELECT `entry_date` FROM `sm_travelling_details` WHERE `candidate_id`='$canId'");
			
			 if (count($entry_date) > 0) {
			 for ($cd = 0; $cd < count($entry_date); $cd++) {

            $entrydate = $entry_date[$cd]['entry_date'];
			
         //echo "$entrydate";

        $doc_n = $db->selectQuery("SELECT candidate_firstname FROM `sm_candidate` WHERE `candidate_id`='$canId'");
		 
		 //echo "<pre>";print_r($doc_n);
		 // echo "$visa_name";
		  
		   // echo "$doc_n";
			 //echo "$canId";die;

        if (count($doc_n) > 0) {

             $values = array();

             for ($d = 0; $d < count($doc_n); $d++) {
                $values = array();
				$can_name = $doc_n[$d]['candidate_firstname'];
				//echo "$canId";die;
                /*$doc_title = $doc_n[$d]['document_title'];
                $doc_id = $doc_n[$d]['document_id'];
                $doc_start_date = $doc_n[$d]['document_start_date'];
                $doc_end_date = $doc_n[$d]['document_end_date'];*/
				
                //echo $entrydate;
                  //$val = '15';
				  $last_date = date('Y-m-d', strtotime($entrydate.' +'.$validity_day. 'day'));
                 $medical_date = date('Y-m-d', strtotime($entrydate.' +'.$notif_day_before. 'day'));
                    //echo $medical_date;
                $explode_end_date = explode("-", $last_date);
                $ins_month_date=new DateTime($last_date);
                $ins_month=$ins_month_date->format("M");
                $ins_date = $explode_end_date[2] . "-" . $ins_month . "-" . $explode_end_date[0];
				//echo "$last_date";
				//echo "$today";die;
				//date_sub($visa_expiry,date_interval_create_from_date_string("45 days"));
				//echo date_format($date,"Y-m-d");die;
				
                if ($medical_date==$today) {
					 $values['notification_start_date'] = date("Y-m-d");
                   
                    //$values['notification_start_date'] = date("Y-m-d");
					 $values['last_date'] = $last_date;
					 $values['entry_date'] =$entrydate;
                    $values['visa_name'] = $visa_name;
                    //$values['visa_end_date'] = $insert_doc_date->format("Y-m-d");
                    $values['cand_id'] = $canId;
					//echo "cccc<pre>";print_r($values);die;
					$check_exist = $db->selectQuery("SELECT * FROM `sm_notification_medicalvisa` WHERE `cand_id` = '$canId' AND `visa_name` = '$visa_name'");
                if (count($check_exist) > 0) {
                    for ($fc = 0; $fc < count($check_exist); $fc++) {
                        $check_name = $check_exist[$fc]['visa_name'];
                        $check_id = $check_exist[$fc]['cand_id'];
                        
                            $values_up['notification_data'] = $can_name . "'s Last Date of Medical is " .$ins_date;
                            //print_r($values_up); die;
							$db->secure_update("sm_notification_medicalvisa", $values_up, "WHERE `cand_id`='$check_id'");
                        
                    }
                } else {
                    $values['notification_data'] = $can_name . "'s Last Date of Medical is" .$ins_date;
					//print_r($values); die;
                    try {
                        $in = $db->secure_insert("sm_notification_medicalvisa", $values);
                        if (empty($in)) {
                            throw new Exception("error");
                        }
                    } catch (Exception $e) {
                        echo "#";
                    }
					 
				}
					
                    }
                    
                }
            }
			 }
			 }
        }
		
    
	}
	
	
}
}

?>