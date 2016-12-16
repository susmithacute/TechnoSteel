<?php
include("connection.php");

 if (isset($_REQUEST['title']))

 // if($_SERVER['REQUEST_METHOD']=='POST')
  {
 $title=$_REQUEST['title']; 
  $type=$_REQUEST['type'];
  $requirement=$_REQUEST['requirement'];
  $employees=$_REQUEST['employees'];
  $work_site_id = $_REQUEST['work_site_id'];
  $designation_id=$_REQUEST['designation_id'];
  $employee_id=$_REQUEST['employee_id'];

  if(!empty($_REQUEST['date_assign_from'])){
  $date_assign_from=explode("-",$_REQUEST['date_assign_from']);
  $date_assign_from1=$date_assign_from[2]."-".$date_assign_from[1]."-".$date_assign_from[0];
  } else { $date_assign_from1 = "";}
  if(!empty($_REQUEST['date_assign_to'])){
  $date_assign_to=explode("-",$_REQUEST['date_assign_to']);
  $date_assign_to1=$date_assign_to[2]."-".$date_assign_to[1]."-".$date_assign_to[0];
  } else { $date_assign_to1 ="";}


  $values["title"]=$title;
  $values["type"]=$type;
  $values["requirement"]=$requirement;
  $values["no_of_employees"]=$employees;
  $values["job_position_id"]=$designation_id;
  $values["work_site_id"] = $work_site_id;
  $values["issued_date_from"] = $date_assign_from1;
  $values["issued_date_to"] = $date_assign_to1;
  if ($requirement !="" || $employees !="")
  {
  $insert = $db->secure_insert("sm_employee_work_assign", $values);
  }
  else{
	  $title=$_REQUEST['title'];
  $type=$_REQUEST['type'];
  $requirement=$_REQUEST['requirement'];
  $employees=$_REQUEST['employees'];
  $work_site_id = $_REQUEST['work_site_id'];
  $designation_id=$_REQUEST['designation_id'];
  $employee_id=$_REQUEST['employee_id'];

   if(!empty($_REQUEST['date_assign_from'])){
  $date_assign_from=explode("-",$_REQUEST['date_assign_from']);
  $date_assign_from1=$date_assign_from[2]."-".$date_assign_from[1]."-".$date_assign_from[0];
   }
   if(!empty($_REQUEST['date_assign_to'])){
  $date_assign_to=explode("-",$_REQUEST['date_assign_to']);
  $date_assign_to1=$date_assign_to[2]."-".$date_assign_to[1]."-".$date_assign_to[0];
   }


  $valu["title"]=$title;
  $valu["type"]=$type;
  $values["requirement"]=$requirement;
  $values["no_of_employees"]=$employees;
  $valu["job_position_id"]=$designation_id;
  $valu["work_site_id"] = $work_site_id;
  $valu["issued_date_from"] = $date_assign_from1;
  $valu["issued_date_to"] = $date_assign_to1;
 

  $insert = $db->secure_insert("sm_employee_work_assign", $valu);
	  
  }


  $value['employee_work_assign_id'] = $insert;
  $employee = array();
  foreach($employee_id as $employee)
  {
  $value['employee_id'] = $employee;
  $insert = $db->secure_insert("sm_work_assign_employee_id", $value);
  }


  if (!empty($insert))
  {
  echo  $success_msg = "success";
  //echo "<script>location.href='emp_title_list.php'</script>";
  } else {

  $success_msg = "Error in insertion";
  }
  } 
  
  
if(isset($_POST['requirement'])){
    $requirement=$_POST['requirement'];
    $re_work_site_id=$db->selectQuery("SELECT * FROM `sm_external_requirment` WHERE hiring_requirment_id='$requirement'");
	
    if(count($re_work_site_id)){
      $date_from = $re_work_site_id[0]['hiring_requirment_date_from'];
		$datefrom 		= explode('-',$date_from);
		$from  			= $datefrom[2].'-'.$datefrom[1].'-'.$datefrom[0];
		$date_to               = $re_work_site_id[0]['hiring_requirment_date_to'];
		$dateto 			= explode('-',$date_to);
		$to		= $dateto[2].'-'.$dateto[1].'-'.$dateto[0];
		//$client= $select_data[0]['client'];
		$designation= $re_work_site_id[0]['designation'];
		$resources= $re_work_site_id[0]['hiring_requirment_nof_person'];
				 $result=array("designation"=> $designation,"from"=> $from,"to"=>$to,"resources"=>$resources);
				 echo json_encode($result);
				 
				 
           
        
    }
}