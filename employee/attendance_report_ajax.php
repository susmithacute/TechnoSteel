 <?php
include('../connection.php');
if(isset($_POST['designation'])){
   $designation=$_POST['designation'];
  $des_names = $db->selectQuery("SELECT `designation_name` FROM `sm_designation` WHERE `designation_id` = '$designation'");
   if (count($des_names) > 0)
		{
			$des_name = $des_names[0]['designation_name']; 
			
		}
    $employee_name=$db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,' ',sm_employee.employee_middlename,' ',sm_employee.employee_lastname)as fullname,employee_id,employee_company FROM `sm_employee` WHERE  `employee_designation`='$des_name'");
    if(count($employee_name)){ ?>
		
                                     <select class="form-control mb-10" name="employee_name" id="attnd_employee_name">
									 <option value="" selected="">Select</option>
									<?php for($ds=0; $ds < count($employee_name); $ds++){ ?>
									<option value="<?php echo $employee_name[$ds]['employee_id'];?>"><?php echo $employee_name[$ds]['fullname'];?></option>
									<?php } ?>
									</select>

       <?php } else { ?>

                                     <select class="form-control mb-10" name="employee_name" id="attnd_employee_name">
									 <option value="" selected="">No employees present</option>
									 </select>
      <?php } 
      }  ?> 
       
        
				 


    

