<?php
include("connection.php");

/*if(isset($_POST['category'])){
	//echo ($_POST['category']);
    $category=$_POST['category'];
    $re_work_site_id=$db->selectQuery("SELECT * FROM `sm_requirements` WHERE requirement_id='$category'");
	
    if(count($re_work_site_id)){
		//echo "<pre>";print_r($re_work_site_id);
      $date_from = $re_work_site_id[0]['date_assign_from'];
		$datefrom 		= explode('-',$date_from);
		$from  			= $datefrom[2].'-'.$datefrom[1].'-'.$datefrom[0];
		$date_to               = $re_work_site_id[0]['date_assign_to'];
		$dateto 			= explode('-',$date_to);
		$to		= $dateto[2].'-'.$dateto[1].'-'.$dateto[0];
		//$client= $select_data[0]['client'];
		$designation= $re_work_site_id[0]['job_position'];
		$resources= $re_work_site_id[0]['no_of_employees'];
		$inhouse_requirement_id = $re_work_site_id[0]['id'];
		
		$work_site_id=$db->selectQuery("SELECT `work_site_id` FROM `sm_inhouse_requirement` WHERE id='$inhouse_requirement_id'");
		if(!empty($work_site_id)){
			$site_id = $work_site_id[0]['work_site_id'];
		} else { $site_id ="";}
		
				 $result=array("designation"=> $designation,"from"=> $from,"to"=>$to,"resources"=>$resources,"site_id" => $site_id);
				 echo json_encode($result);
				 
				 
           
        
    }
}*/


if(isset($_POST['job_position'])){
	//echo ($_POST['category']);
    $job_position=$_POST['job_position'];
	$title_id=$_POST['title_id'];
    $re_work_site_id=$db->selectQuery("SELECT * FROM `sm_requirements` WHERE `id`='$title_id' AND `job_position`='$job_position'");
	
    if(count($re_work_site_id)){
		//echo "<pre>";print_r($re_work_site_id);
      $date_from = $re_work_site_id[0]['date_assign_from'];
		$datefrom 		= explode('-',$date_from);
		$from  			= $datefrom[2].'-'.$datefrom[1].'-'.$datefrom[0];
		$date_to               = $re_work_site_id[0]['date_assign_to'];
		$dateto 			= explode('-',$date_to);
		$to		= $dateto[2].'-'.$dateto[1].'-'.$dateto[0];
		//$client= $select_data[0]['client'];
		$category= $re_work_site_id[0]['category'];
		$resources= $re_work_site_id[0]['no_of_employees'];
		$inhouse_requirement_id = $re_work_site_id[0]['id'];
		
		$work_site_id=$db->selectQuery("SELECT `work_site_id` FROM `sm_inhouse_requirement` WHERE id='$title_id'");
		if(!empty($work_site_id)){
			$site_id = $work_site_id[0]['work_site_id'];
		} else { $site_id ="";}
		
				 $result=array("category"=> $category,"from"=> $from,"to"=>$to,"resources"=>$resources,"site_id" => $site_id);
				 echo json_encode($result);
				 
				 
           
        
    }
}
?>