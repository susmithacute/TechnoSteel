<?php
include("connection.php");
if(isset($_REQUEST['vis_type']))
{
    $visa_type=$_REQUEST['vis_type'];
	$visa_category=$_REQUEST['vis_category'];
	$visa_advance=$_REQUEST['vis_advance'];
   
     $resFet = $db->selectQuery("SELECT * FROM `sm_visa_fee` WHERE `visa_fee_category`='$visa_category' AND `visa_fee_type`='$visa_type' AND visa_fee_status='1'");

												if (count($resFet)) {

												for ($rC = 0; $rC < count($resFet); $rC++) {
       
												$visa_fee_bank = $resFet[$rC]['visa_fee_bank'];
												$visa_fee_sponsor = $resFet[$rC]['visa_fee_sponsor'];
												$visa_fee_company = $resFet[$rC]['visa_fee_company'];
												}
                                                $visa_fee_total=$visa_fee_bank+$visa_fee_sponsor+$visa_fee_company;
												$visa_balance_amount=$visa_fee_total-$visa_advance;
												} 
												$result = array("bankfee" => $visa_fee_bank,"sponsorfee"=>$visa_fee_sponsor,"companyfee"=>$visa_fee_company,"totalfee"=>$visa_fee_total, "balancefee" => $visa_balance_amount);
												echo json_encode($result);
												}
												?>