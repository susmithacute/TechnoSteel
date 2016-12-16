<?php
include('../connection.php');
if(isset($_POST['emp_name'])){
   $emp_id=$_POST['emp_name'];
 
    $employee_id=$db->selectQuery("SELECT * FROM sm_employee WHERE `employee_id`='$emp_id'");
    if(count($employee_id)){ ?>
		
                                     <select class="form-control mb-10" name="emp_id" id="emp_id">
									
									<?php for($ds=0; $ds < count($employee_id); $ds++){ ?>
									<option value="<?php echo $employee_id[$ds]['employee_id'];?>" selected=""><?php echo $employee_id[$ds]['employee_id'];?></option>
									<?php } ?>
									</select>

       <?php } 
      }  ?> 
       
        
			
								
	 


    