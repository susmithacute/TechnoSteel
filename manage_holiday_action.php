<?php
include('connection.php');

		$date = explode("-",$_POST['add_holiday']);
		$add_holiday = $date[2].'-'.$date[1].'-'.$date[0];
		
	     
		$selectholiday=$db->selectquery("SELECT `holiday` FROM holidays WHERE `holiday`='$add_holiday'");
		if($selectholiday)
		{echo "Holiday Exists";}
			else{
		$values["holiday"] = $add_holiday;
		
		$update = $db->secure_insert("holidays", $values);
		if($update){
					echo "Added Successfully";
				}
			} 
				?>