<?php
include("connection.php");
if(isset($_REQUEST['advance']))
{
    $advance=$_REQUEST['advance'];
	$total_fee=$_REQUEST['total_fee'];
    $balance=$total_fee-$advance;
	 
	$result = array("balance" => $balance);
	echo json_encode($result);
	}
	?>