<?php
include("connection.php");
if(isset($_REQUEST['work_site_id'])){
    $work_site_id=$_REQUEST['work_site_id'];
    $re_work_site_id=$db->selectQuery("SELECT * FROM `sm_work_site` WHERE id='$work_site_id'");
    if(count($re_work_site_id)){
       
       
            echo $re_work_site_id[0]['site_location'];
           
        
    }
}








	 
	 
	 
	 
	 
	 
	 




