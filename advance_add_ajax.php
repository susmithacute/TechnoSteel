<?php
include("connection.php");
if(isset($_REQUEST['manufacturer'])){ 
$manufacturer=$_REQUEST['manufacturer'];
   $res_manufacturer=$db->selectQuery("SELECT * FROM `sm_employee` WHERE employee_id='$manufacturer'");    
   if(count($res_manufacturer)){                        
       echo $res_manufacturer[0]['employee_salary'];                      
 	   }
	     }
?>		 