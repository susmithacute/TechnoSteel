<?php
include('connection.php');
$reason ="";
	   $candidate_id 			= $_POST['candidate_id'];
		$visa_no 				= $_POST['visa_no'];
		//$visa_issued 			= $_POST['visa_issued'];
//$visa_expiry 			= $_POST['visa_expiry'];
		$reason 				= $_POST['reason'];
		$visa_status 			= $_POST['visa_status'];
       $originalDate                 = explode("/",$_POST['visa_issued']);
           $visa_issued   = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
		    $original                 = explode("/",$_POST['visa_expiry']);
           $visa_expiry   = $original[2]."-".$original[1]."-".$original[0];
		   
		   
		  
			 if($visa_status == "Approved")
			{ 
		 $select = $db->selectQuery("SELECT `visa_no` FROM sm_candidate_visa_process ");
		
		   $visa = $select[0]['visa_no'];
		  // echo  "****".$visa;
		   if($visa == $visa_no ){
			   
		    echo "0";
		   
	}
	
		   else if($visa != $visa_no ) {
				//echo "app"; die;
                $values["visa_no"] = $visa_no;
				$values["visa_issued"]=$visa_issued;
				$values["visa_expiry"]=$visa_expiry;

				//$values["reason"]=$reason;
				$values["visa_status"]=$visa_status;
                $update = $db->secure_update("sm_candidate_visa_process", $values, "WHERE `candidate_id`='$candidate_id'");
				if($update){
					echo "1";
				}
		   }

			} 
				else if($visa_status == "Rejected")
		{
		
			$values1["reason"] = $reason;
			$values1["visa_status"]=$visa_status;
			$update1 = $db->secure_update("sm_candidate_visa_process", $values1, "WHERE `candidate_id`='$candidate_id'");
			echo "success";
		}
		   

