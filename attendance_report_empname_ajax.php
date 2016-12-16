 <?php
include("connection.php");
if(isset($_POST['emp_id'])){
   $emp_id=$_POST['emp_id'];
  
    $employee_name=$db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,' ',sm_employee.employee_middlename,' ',sm_employee.employee_lastname)as fullname,employee_id,employee_company FROM `sm_employee` WHERE  `employee_id`='$emp_id'");
    if(count($employee_name)){ ?>
		
                                     <select class="form-control mb-10" name="employee_name" id="attnd_employee_name">
									
									<?php for($ds=0; $ds < count($employee_name); $ds++){ ?>
									<option value="<?php echo $employee_name[$ds]['employee_id'];?>"><?php echo $employee_name[$ds]['fullname'];?></option>
									<?php } ?>
									</select>

       <?php } 
       } 
     ?> 
       
        
				 


    

