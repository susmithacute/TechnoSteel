<?php
include("connection.php");
if(isset($_REQUEST['emp_name'])){
     $emp_id=$_POST['emp_name'];
	 
	  $employ_emp_id = $db->selectQuery("SELECT `employee_employment_id` FROM `sm_employee` WHERE `employee_id` = '$emp_id'");
	 
       if(count($employ_emp_id)){
		   
      		 echo $employ_emp_id[0]['employee_employment_id'];
    }
}

   ?>      
    

