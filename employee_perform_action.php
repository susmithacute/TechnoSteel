<?php
include('connection.php');


if(isset($_POST['employee_perform'])&&($_POST['date'])) 
{

		$employee_perform   = $_POST['employee_perform'];
		$perform_date              = $_POST['date']; 
		$employee_id        = $_POST['employee_id'];
		
 
	
	 $ex_date1= explode("-",$perform_date);
			
			$comp2=$ex_date1[2].'-'.$ex_date1[1];
		
			$check = $db->selectQuery("SELECT `employee_id`,`date` FROM sm_employee_performance WHERE `employee_id`='$employee_id' AND `status`='active' AND `date`='$comp2'");
			
			
if(!empty($check)){																														
				   $date = $check[0]['date'];
			
					//$ex_date = explode("-",$date);
					$ex_date = explode("-",$date);
					
					$comp=$ex_date[0].'-'.$ex_date[1];
				
			if($comp2==$comp)
					 {
						echo "0";
						
					 }
					  
				
			else if($comp2!=$comp)
				{
						 $values["rating1"] = $employee_perform;
						$values["date"] = $comp2;
						$values["employee_id"] = $employee_id;
					
		
				$update1 = $db->secure_insert("sm_employee_performance", $values);
				if($update1){
					
				echo"1";

						} 
				}
                 }
 
 if(empty($check)){
	                       $valu["rating1"] = $employee_perform;
							$valu["date"] = $comp2;
							$valu["employee_id"] = $employee_id;
				
	
				$update = $db->secure_insert("sm_employee_performance", $valu);
				if($update){
					
				echo"2";

						
				}
				       }
				
}

