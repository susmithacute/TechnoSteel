<?php
include("connection.php");
if(isset($_POST['employee_id'])){
   $employee_id=$_POST['employee_id'];
   
   
   $employee_code = $db->selectQuery("SELECT `employee_employment_id` FROM `sm_employee` WHERE `employee_id` = '$employee_id'");
   if (count($employee_code) > 0){
			echo $emp_code = $employee_code[0]['employee_employment_id']; 
		} else echo "Code Not Available"; 
	} else { echo "Employee Name Is Not Found";}
           ?>
        
    

