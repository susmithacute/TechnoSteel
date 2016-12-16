<?php

//include ("./file_parts/header.php");
$visa_name = "";
$today = date('Y-m-d');

//$yesterday = date('Y-m-d', strtotime("-1 days"));

$daylen = 60 * 60 * 24;

$cur_date = date("d-m-Y");
$notif_day_before=182;
$select_day=$db->selectQuery("SELECT `notify_period` FROM `sm_visa_validity` WHERE `notification_name`='Living Visa Expiry'");
if(count($select_day)){
    $notif_day_before=$select_day[0]['notify_period'];
	//echo "$notif_day_before";
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
                $insert_doc_date = new DateTime($visa_expiry);
                $find_noti = (strtotime($visa_expiry) - strtotime($cur_date)) / $daylen;
                $num_days = round($find_noti);
                $explode_end_date = explode("-", $visa_expiry);
                $ins_month_date=new DateTime($visa_expiry);
                $ins_month=$ins_month_date->format("M");
                $ins_date = $explode_end_date[2] . "-" . $ins_month . "-" . $explode_end_date[0];
				//echo "$num_days";die;
				//date_sub($visa_expiry,date_interval_create_from_date_string("45 days"));
				//echo date_format($date,"Y-m-d");die;
				
                if ($num_days < $notif_day_before && $num_days >= 0) {
					 $values['notification_start_date'] = date("Y-m-d");
                
                    //$values['notification_start_date'] = date("Y-m-d");
                    $values['visa_name'] = $visa_name;
                    $values['visa_end_date'] = $insert_doc_date->format("Y-m-d");
                    $values['cand_id'] = $canId;
					//echo "<pre>";print_r($values);die;
					$check_exist = $db->selectQuery("SELECT * FROM `sm_notification_livingvisa` WHERE `cand_id` = '$canId' AND `visa_name` = '$visa_name'");
                if (count($check_exist) > 0) {
                    for ($fc = 0; $fc < count($check_exist); $fc++) {
                        $check_name = $check_exist[$fc]['visa_name'];
                        $check_id = $check_exist[$fc]['cand_id'];
                        
                            $values_up['notification_data'] = $check_name . " " . "VISA for" . " " . $can_name . " expires on " . " " . $ins_date;
                            $db->secure_update("sm_notification_livingvisa", $values_up, "WHERE `cand_id`='$check_id'");
                        
                    }
                } else {
                    $values['notification_data'] = $visa_name . " " . "Visa for" . " " . $can_name . " will expire on " . $ins_date;

                    try {
                        $in = $db->secure_insert("sm_notification_livingvisa", $values);
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

?>