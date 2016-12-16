<?php
include("connection.php");
if(isset($_POST['designation'])){
	$date_assign_from1=explode("-",$_POST['date_assign_from']);
	$date_assign_from=$date_assign_from1[2]."-".$date_assign_from1[1]."-".$date_assign_from1[0];
	$date_assign_to1=explode("-",$_POST['date_assign_to']);
	$date_assign_to=$date_assign_to1[2]."-".$date_assign_to1[1]."-".$date_assign_to1[0];
   $designation=$_POST['designation'];
   
   
   $des_names = $db->selectQuery("SELECT `designation_name` FROM `sm_designation` WHERE `designation_id` = '$designation'");
   
	if (count($des_names) > 0)
		{
			echo $des_name = $des_names[0]['designation_name']; 
		}
		$employee_assign=$db->selectQuery("SELECT sm_employee_work_assign.issued_date_from,  sm_employee_work_assign.issued_date_to,sm_employee_work_assign.id ,sm_work_assign_employee_id.employee_work_assign_id,sm_work_assign_employee_id.employee_id,CONCAT(sm_employee.employee_firstname,sm_employee.employee_middlename,sm_employee.employee_lastname)as fullname,sm_employee.employee_id FROM sm_employee INNER JOIN sm_employee_work_assign
		INNER JOIN sm_work_assign_employee_id ON sm_work_assign_employee_id.employee_work_assign_id=sm_employee_work_assign.id AND sm_work_assign_employee_id.employee_id=sm_employee.employee_id WHERE sm_employee_work_assign.issued_date_to='$date_assign_to' AND  sm_employee_work_assign.issued_date_from='$date_assign_from' AND sm_employee.employee_designation='$des_name'");
		// for($ds=0; $ds < count($employee_assign); $ds++){
			// //$employee_name = array();
		// $employee_name[]=$employee_assign[$ds]['fullname'];
		// }
		$employee_id = array();
		//echo "<pre>";print_r($employee_assign);
		for($emp_assig = 0; $emp_assig<count($employee_assign); $emp_assig++)
		{$employee_id[]=$employee_assign[$emp_assig]['employee_id'];}
	//echo "haii";print_r($employee_id);
	$employee_name=$db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,sm_employee.employee_middlename,sm_employee.employee_lastname)as fullname,sm_employee.employee_id FROM sm_employee WHERE sm_employee.employee_designation='$des_name'");
    if(count($employee_name)){?>
		
                                    <select class="form-control" name="employee_id" id="employee_id" required="" multiple>
									<?php for($ds=0; $ds < count($employee_name); $ds++){ 
									$job_pos_empid = $employee_name[$ds]['employee_id'];
									if(!in_array($job_pos_empid,$employee_id)){ ?>
									<option value="<?php echo $employee_name[$ds]['employee_id'];?>"><?php echo $employee_name[$ds]['fullname'];?></option>
									<?php } ?>
									<?php } ?>
									</select>

	<?php }  
}	?>
        
    

