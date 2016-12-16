<?php
include("connection.php");
if(isset($_POST['edit_id'])){
	$edit_id=$_POST['edit_id'];
	
	$select_visa=$db->selectQuery("SELECT * FROM sm_candidate_visa_process WHERE `candidate_id`='$edit_id'");
	if(count($select_visa)>0){
	
	$visa_no= $select_visa[0]['applied_visa_date'];
	 $visa_type= $select_visa[0]['visa_type'];
	 $visa_category= $select_visa[0]['visa_category'];
	 
	 $originalDate  = explode("-",$visa_no);
       $visa_date   = $originalDate[2]."/".$originalDate[1]."/".$originalDate[0];
	//echo $visa_no;
	
	$result=array("applied_visa_date"=>$visa_date,"visa_type"=>$visa_type,"visa_category"=>$visa_category);
	echo json_encode($result);
	}
}
?>



