<?php
include("connection.php");
//print_r($_POST); die;
if(isset($_REQUEST['work_site_id'])) 
{
	
		$title                   =   $_REQUEST['title'];
		$work_site_id            =   $_REQUEST['work_site_id'];
		$work_location           =   $_REQUEST['work_location'];
		$project_manager               =   $_REQUEST['project_manager'];
		$contact                 =   $_REQUEST['contact'];
		
		
		

		
		
		        $values["title"] 	           = $title;
				$values["work_site_id"] 	   = $work_site_id;
				$values["work_location"]       = $work_location;
				$values["project_manager"] 	   = $project_manager;
		        $values["contact"] 	           = $contact;
				
				  

				$insert = $db->secure_insert("sm_inhouse_requirement", $values );
				if(!empty($insert)){
					echo "<script>location.href='inhouse_requirement_list.php'</script>";
				} else { 
				echo "Failed"; 
				}
					       
    
        
}

if (isset($_POST['requirement'])) {
    $value_array = array();
    $requirement = $_POST["requirement"]; 
    foreach ($requirement as $key => $value_array) {
        if (!empty($value_array['date_assign_from'])) {
            $date_assign_from = explode("-", $value_array['date_assign_from']);
            $date_assign_from1 = $date_assign_from[2] . "-" . $date_assign_from[1] . "-" . $date_assign_from[0];
        } else {
            $date_assign_from1 = "";
        }
        $value_array['date_assign_from'] = $date_assign_from1;
        if (!empty($value_array['date_assign_to'])) {
            $date_assign_to = explode("-", $value_array['date_assign_to']);
            $date_assign_to1 = $date_assign_to[2] . "-" . $date_assign_to[1] . "-" . $date_assign_to[0];
        } else {
            $date_assign_to1 = "";
        }
        $value_array['date_assign_to'] = $date_assign_to1;
        $requirement_vals = array_merge($value_array, array("id" => $insert));
        $requirement_id = $db->secure_insert("sm_requirements", $requirement_vals);
        unset($value_array);
    }
}
?>