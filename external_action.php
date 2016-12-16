<?php
include('connection.php');

if(isset($_POST['hiri_emp']))	
{
		$id                     = $_POST['hire_id'];
	    $hiri_emp                     = $_POST['hiri_emp'];
		$resources                 = $_POST['resources'];
		$req_date_from            = $_POST['req_date_from'];
		$leaveFromArray 		= explode('-',$req_date_from);
		$leaveFromYMD 			= $leaveFromArray[2].'-'.$leaveFromArray[1].'-'.$leaveFromArray[0];
		$req_date_to               = $_POST['req_date_to'];
		$leaveToArray 			= explode('-',$req_date_to);
		$leaveToYMD 			= $leaveToArray[2].'-'.$leaveToArray[1].'-'.$leaveToArray[0];
		$wage                     = $_POST['wage'];
		$employees                     = $_POST['employees'];
				$values["hiring_employees"] = $hiri_emp;
				$values["hiring_requirment_id"] = $id;
				//$values["client"] 	        = $client;
				$values["hiring_requirment_date_from"] = $leaveFromYMD;
				$values["hiring_requirment_date_to"]   = $leaveToYMD;
				$values["hiring_requirment_nof_person"] = $resources;
				$values["wage"] 	= $wage;
				$values["employees"] 		= $employees;
				$values["status"] 		= "Hiring";
				//$values["leave_to"] 		= $leaveToYMD;
				//echo $id; 
				
				
				$insert = $db->secure_update("sm_external_requirment", $values, "WHERE `hiring_requirment_id`= $id");
							if($insert){
					                echo "1";
									//echo " <script>location.href='processvisa_candidate_list.php'</script>";
									} 
									else 
									{  
								   echo "0"; 
								   }
}
     else{
		 
		$id                        = $_POST['hire_id'];
		$resources                 = $_POST['resources'];
		$req_date_from             = $_POST['req_date_from'];
		$leaveFromArray 		   = explode('-',$req_date_from);
		$leaveFromYMD 			   = $leaveFromArray[2].'-'.$leaveFromArray[1].'-'.$leaveFromArray[0];
		$req_date_to               = $_POST['req_date_to'];
		$leaveToArray 			   = explode('-',$req_date_to);
		$leaveToYMD 			   = $leaveToArray[2].'-'.$leaveToArray[1].'-'.$leaveToArray[0];
		$wage                      = $_POST['wage'];
		$employees                 = $_POST['employees'];
		
				$values["hiring_requirment_id"] = $id;
				//$values["client"] 	        = $client;
				$values["hiring_requirment_date_from"] = $leaveFromYMD;
				$values["hiring_requirment_date_to"]   = $leaveToYMD;
				$values["hiring_requirment_nof_person"] = $resources;
				$values["wage"] 	= $wage;
				$values["employees"] 		= $employees;
				$values["status"] 		= "completed";
				//$values["leave_to"] 		= $leaveToYMD;
				//echo $id; 
				
				
				$insert = $db->secure_update("sm_external_requirment", $values, "WHERE `hiring_requirment_id`= $id");
							if($insert){
					                echo "1";
									//echo " <script>location.href='external_requirement_list.php'</script>";
									} 
									else 
									{  
								   echo "0"; 
								   }
		
	 }