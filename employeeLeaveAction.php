<?php
include('connection.php');

if(isset($_POST['employee_id'])) 
{
		
		$id                     = $_POST['employee_id'];
		$leave_type_id          = $_POST['leave_type_id'];
		$reason                   = $_POST['reason'];
		$leave_from             = $_POST['leave_from'];
		$leaveFromArray 		= explode('-',$leave_from);
		$leaveFromYMD 			= $leaveFromArray[2].'-'.$leaveFromArray[1].'-'.$leaveFromArray[0];
		$leave_to               = $_POST['leave_to'];
		$leaveToArray 			= explode('-',$leave_to);
		$leaveToYMD 			= $leaveToArray[2].'-'.$leaveToArray[1].'-'.$leaveToArray[0];
		$d=$leaveToYMD;
		$s=$leaveFromYMD;
		
		
		
				
				$values["employee_id"] 		= $id;
				$values["reason"] 	        = $reason;
				$values["leave_type_id"] 	= $leave_type_id;
				$values["leave_from"] 		= $leaveFromYMD;
				$values["leave_to"] 		= $leaveToYMD;
				//echo $id; 
				$sql2=$db->selectQuery("SELECT `employee_id`,`leave_from`,`leave_to` FROM  sm_employee_leave WHERE `employee_id`='$id' AND  (`leave_to`='$s' OR `leave_from`='$s')  AND `status`='active'");
				
				//echo $sql2;die;
				//echo "<pre>";print_r($sql2); die;
			if(empty($sql2) )
			{
					$sql3=$db->selectQuery("SELECT `employee_id`,`leave_from`,`leave_to` FROM  sm_employee_leave WHERE `employee_id`='$id' AND `leave_from`<='$d'  AND `status`='active'");
					
					
					//echo "<pre>";print_r($sql3); die;
					if(empty($sql3) )
				        {
					 
							$insert = $db->secure_insert("sm_employee_leave", $values);
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
						$sql4=$db->selectQuery("SELECT `employee_id`,`leave_from`,`leave_to` FROM  sm_employee_leave WHERE `employee_id`='$id' AND `leave_to`>='$s' AND `leave_from`<='$d'  AND `status`='active'");
								//echo "<pre>";print_r($sql4); die;
							if(empty($sql4))
								{
									
					 
											$insert = $db->secure_insert("sm_employee_leave", $values);
										if(count($insert)>0){
					 echo "1";
													//echo " <script>location.href='processvisa_candidate_list.php'</script>";
													} else {  echo "0"; }
								}
							else
								{			 
							echo "0";	
							}
						}
							
			}
		
				 
			 else
                 {
					
					  //echo "Helloo   Leave Already Exist";
				 
					  echo "0";
						}
				}



