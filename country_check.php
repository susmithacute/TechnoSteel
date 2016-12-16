<?php

include('connection.php');
if (isset($_POST['country'])) {
	$value_array = array();
$country = $_POST['country'];
$result = array();
foreach ($country as $key => $value_array) {
	$country_name=$value_array['country_name'];
	$check_id =$db->selectQuery("select * from sm_recruit_country where country_name='$country_name' AND country_status='1'");
	if(count($check_id)>0)		
	{			
array_push($result,"0");	
				}		else{ 
$db->secure_insert("sm_recruit_country", $value_array);
		array_push($result, "1");
		unset($value_array);	
		}        } 
        echo json_encode($result);
    }
?>