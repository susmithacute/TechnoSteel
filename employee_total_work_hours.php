
<?php
//include("connection.php");
$year = date("Y");
	$selectemployee=$db->selectquery("SELECT `employee_id` FROM sm_employee WHERE `employee_status`='1'");
	    if (count($selectemployee)) {
			for ($emp = 0; $emp < count($selectemployee); $emp++)
			{
				$employee_id = $selectemployee[$emp]['employee_id'];
				 $val = "";
				for($i=1; $i<=12; $i++){
				if(strlen($i)==1){ $i = '0'.$i; }
				$selectemploye_id=$db->selectquery("SELECT `id` FROM sm_employee_working_hours_total WHERE `employee_id`='$employee_id' AND `year` = '$year' AND `month` = '$i'");
				if(count($selectemploye_id)>0)
				{ $val = 0; }
				else{
				
				$values["normal_working_hours"] = 8;
				$values["employee_id"] = $employee_id;
				$values["year"] = $year;
				$values["month"] = $i;
				
				
				$update = $db->secure_insert("sm_employee_working_hours_total", $values);
				if($update){
							$val = 1;
						}
					}
				}
			}
		}
		
		//echo $val;
?>