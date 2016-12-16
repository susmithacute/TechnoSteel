<?php
include("connection.php");

 if (isset($_REQUEST['title']))
	 //print_r($_REQUEST);

 // if($_SERVER['REQUEST_METHOD']=='POST')
  {
 $title=$_REQUEST['title']; 
  $type=$_REQUEST['type'];
  $requirement=$_REQUEST['requirements'];
  $titles=$_REQUEST['titles'];

  $work_site_id = $_REQUEST['work_site_id'];
  //$designation_id=$_REQUEST['designation_id'];
  $employee_id=$_REQUEST['employee_id'];

  
  $date_assign_from=explode("-",$_REQUEST['date_assign_from']);
  $date_assign_from1=$date_assign_from[2]."-".$date_assign_from[1]."-".$date_assign_from[0];
   
  
  $date_assign_to=explode("-",$_REQUEST['date_assign_to']);
  $date_assign_to1=$date_assign_to[2]."-".$date_assign_to[1]."-".$date_assign_to[0];
  
if($type == 'Inhouse'){
	$designation_id=$_REQUEST['job_position'];//inhouse
  $values["job_position_id"]=$designation_id;
  $values["requirement"]=$titles;
   $employees=$_REQUEST['employees_inhouse'];
   $values["no_of_employees"]=$employees;
   //$values["process_status"]      = "processed";	
	} else {
	$employees=$_REQUEST['employees'];
	  $designations=$_REQUEST['designations'];
	  $values["job_position_id"]=$designations;
	  $values["requirement"]=$requirement;	
		$values["no_of_employees"]=$employees;
	}



  $values["title"]=$title;
  $values["type"]=$type;
  //$values["requirement"]=$requirement;
  //$values["no_of_employees"]=$employees;
  $values["work_site_id"] = $work_site_id;
  $values["issued_date_from"] = $date_assign_from1;
  $values["issued_date_to"] = $date_assign_to1;
 
  $insert = $db->secure_insert("sm_employee_work_assign", $values);


  $value['employee_work_assign_id'] = $insert;
  $employee = array();
  if(!empty($employee_id)){
	  foreach($employee_id as $employee)
	  {
	  $value['employee_id'] = $employee;
	  $insert = $db->secure_insert("sm_work_assign_employee_id", $value);
	  }
  }


  if (!empty($insert))
 {

	  $values=array();
   $values['process_status']="processed";
   $db->secure_update("sm_requirements",$values, "WHERE `job_position`='$designation_id' AND `id` = '$titles'");
  echo  $success_msg = "success";
  echo "<script>location.href='emp_title_list.php'</script>";
  } else {

  $success_msg = "Error in insertion";
  }
  } 
  
  
if(isset($_POST['des'])){
	
    $des=$_POST['des'];
    $re_work_site_id=$db->selectQuery("SELECT * FROM `sm_external_requirment` WHERE designation='$des'");
	
    if(count($re_work_site_id)){
		//echo "hi";
      $date_from = $re_work_site_id[0]['hiring_requirment_date_from'];
		$datefrom 		= explode('-',$date_from);
		$from  			= $datefrom[2].'-'.$datefrom[1].'-'.$datefrom[0];
		$date_to               = $re_work_site_id[0]['hiring_requirment_date_to'];
		$dateto 			= explode('-',$date_to);
		$to		= $dateto[2].'-'.$dateto[1].'-'.$dateto[0];
		//$client= $select_data[0]['client'];
		//$designation= $re_work_site_id[0]['designation'];
		$resources= $re_work_site_id[0]['employees'];
		$result=array("from"=> $from,"to"=>$to,"resources"=>$resources);
		echo json_encode($result);
				 
	 
    }
}
  