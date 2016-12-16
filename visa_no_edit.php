<?php
include("connection.php");
if(isset($_POST['edit_id'])){
	$edit_id=$_POST['edit_id'];
	//echo  $edit_id;
	$select_visa=$db->selectQuery("SELECT * FROM sm_candidate_visa_process WHERE `candidate_id`='$edit_id'");
	if(count($select_visa)>0){
	$visa_no= $select_visa[0]['visa_no'];
	$visa_issued= $select_visa[0]['visa_issued'];
	$visa_expiry= $select_visa[0]['visa_expiry'];
	//echo $visa_no;
	 $originalDate  = explode("-",$visa_issued);
       $visa_date   = $originalDate[2]."/".$originalDate[1]."/".$originalDate[0];
	   
	   
	    $original  = explode("-",$visa_expiry);
       $visa   = $original[2]."/".$original[1]."/".$original[0];
	
	$result=array("visa_no"=>$visa_no,"visa_issued"=>$visa_date,"visa_expiry"=>$visa);
	echo json_encode($result);
	}
}
?>



