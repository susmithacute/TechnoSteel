<?php
include("connection.php");
if(isset($_REQUEST['bank_id'])){
     $bank_id=$_POST['bank_id'];
	 $select_bank_id = $db->selectQuery("select bank_code from  sm_bank_details where bank_id='$bank_id'");
       if(count($select_bank_id)){
		   
      		 echo $select_bank_id[0]['bank_code']; 
    }
}

   ?>      
    

