<?php
include("connection.php");
if(isset($_POST['edit_id'])){
	
	$edit_id=$_POST['edit_id']; 
	//echo $edit_id;
	$select_data1 = $db->selectQuery("SELECT `medical_status` FROM sm_medical_visa_status WHERE `candidate_id`='$edit_id'");
		 if(count($select_data1>0)){
			$medical_status= $select_data1[0]['medical_status'];
			
		}
		
	$select_data = $db->selectQuery("SELECT `documents_data`,`documents_start_date`,`documents_end_date` FROM sm_candidate_documents WHERE `documents_title`='QatarID' AND `candidate_id`='$edit_id'");
	 if(count($select_data)>0){
		 
         $qatar_id= $select_data[0]['documents_data'];
		 
         $qatar_id_issued_date1= explode("-",$select_data[0]['documents_start_date']);
		 $qatar_id_issued_date = $qatar_id_issued_date1[2]."-".$qatar_id_issued_date1[1]."-".$qatar_id_issued_date1[0];
		 $qatar_id_expiry_date1= explode("-",$select_data[0]['documents_end_date']);
		 $qatar_id_expiry_date = $qatar_id_expiry_date1[2]."-".$qatar_id_expiry_date1[1]."-".$qatar_id_expiry_date1[0];
				 $result=array("qatar_id"=> $qatar_id,"qatar_id_issued_date"=>$qatar_id_issued_date,"qatar_id_expiry_date"=>$qatar_id_expiry_date,"medical_status"=>$medical_status);
				 echo json_encode($result);

	//}
}
}
?>



