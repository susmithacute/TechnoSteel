<?php
include('connection.php');

	    $candidate_id 			= $_POST['candidate_id'];
		echo $candidate_id;
	$values["visa_no"]			= $_POST['visa_no'];
	$valu	     = $_POST['visa_issued'];
	//echo $values["visa_no"];
			$value1			= $_POST['visa_expiry'];
			
			$originalDate  = explode("/",$valu);
			
		 $visa_date   = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
		 //echo $visa_date;
		 //echo $visa_date;
		  //echo $value1;
			 $original  = explode("/",$value1);
			 $visa  = $original[2]."-".$original[1]."-".$original[0];
			
				
                $values["visa_issued"]= $visa_date;
			$values["visa_expiry"]= $visa;
			echo $visa;
			echo $visa_date;
			//$empArray["data"][]=$values;
			//$values=array();
                $update = $db->secure_update("sm_candidate_visa_process", $values, "WHERE `candidate_id`='$candidate_id'");
				if($update){
					
					echo "added successfully";
				

				} 
    

