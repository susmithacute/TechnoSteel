<?php

include('connection.php');
if (isset($_POST['category']))
	{
    $value_array = array(); 
	$category = $_POST["category"];
	$result=array();
	foreach ($category as $key => $value_array) {
		$job_position=$value_array['job_position'];
		$job_category_name=$value_array['job_category_name'];
		$check_id =$db->selectQuery("select * from sm_job_category where job_category_name='$job_category_name' and job_position='$job_position' and job_category_status='1'");	
		if(count($check_id)>0)	
		{   
		array_push($result,"0");
		}	
		else 	
		{      
		$db->secure_insert("sm_job_category", $value_array);	
		array_push($result, "1");  
		unset($value_array);		
		}			
		}		
		echo json_encode($result);    
		}
		?>		
