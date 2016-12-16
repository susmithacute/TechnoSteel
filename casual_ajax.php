<?php
include("connection.php");
if(isset($_POST['edit_id'])){
	$edit_id=$_POST['edit_id'];
	$select_data = $db->selectQuery("SELECT `reason`,`leave_from`,`leave_to`,`leave_id`,`leave_type_id` FROM sm_employee_leave WHERE `leave_id`='$edit_id'");
	//$select_reason=$db->selectQuery("SELECT `leave_` FROM sm_candidate_visa_process WHERE `candidate_id`='$reason_id'");
	if(count($select_data)>0){
	//echo $select_data[0]['leave_from'];
	// for ($rC = 0; $rC < count($select_data); $rC++) {
       // $values['leave_id'] = $select_data[$rC]['leave_id'];
        //$values['full_name'] = htmlspecialchars_decode($resFet[$rC]['full_name']);
		  $leaveFromYMD          = $select_data[0]['leave_from'];
		$leaveFromArray 		= explode('-',$leaveFromYMD);
		$leave_from  			= $leaveFromArray[2].'-'.$leaveFromArray[1].'-'.$leaveFromArray[0];
		 $leaveToYMD               = $select_data[0]['leave_to'];
		$leaveToArray 			= explode('-',$leaveToYMD);
		$leave_to		= $leaveToArray[2].'-'.$leaveToArray[1].'-'.$leaveToArray[0];
		
		
		$reason= $select_data[0]['reason'];
       //$leave_from= $select_data[0]['leave_from'];
       //$leave_to= $select_data[0]['leave_to'];
		$leave_type_id= $select_data[0]['leave_type_id'];
				 $result=array("reason"=> $reason,"leave_from"=> $leave_from,"leave_to"=>$leave_to,"leave_type_id"=>$leave_type_id);
				 echo json_encode($result);
}
}
?>



