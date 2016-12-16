<?php
include("connection.php");
if(isset($_POST['update_id'])){
	//print_r($_POST);
	$id=$_POST['update_id'];
	$select_data = $db->selectQuery("SELECT sm_external_demands.client, sm_external_requirment.designation,sm_external_requirment.hiring_requirment_date_from,sm_external_requirment.hiring_requirment_date_to ,sm_external_requirment.hiring_requirment_nof_person FROM sm_external_requirment LEFT JOIN sm_external_demands ON sm_external_requirment.hiring_requirment_id=sm_external_demands.id WHERE sm_external_requirment.hiring_requirment_id='$id'");
	//print_r($select_data);  die;
	if(count($select_data)>0){
	
		 $date_from = $select_data[0]['hiring_requirment_date_from'];
		$datefrom 		= explode('-',$date_from);
		$from  			= $datefrom[2].'-'.$datefrom[1].'-'.$datefrom[0];
		$date_to               = $select_data[0]['hiring_requirment_date_to'];
		$dateto 			= explode('-',$date_to);
		$to		= $dateto[2].'-'.$dateto[1].'-'.$dateto[0];
		//$client= $select_data[0]['client'];
		$designation= $select_data[0]['designation'];
		$resources= $select_data[0]['hiring_requirment_nof_person'];
				 $data=array("designation"=> $designation,"from"=> $from,"to"=>$to,"resources"=>$resources);
				 echo json_encode($data);
}
}
?>



