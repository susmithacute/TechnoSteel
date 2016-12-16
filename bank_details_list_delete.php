<?php
include('connection.php');

if (isset($_REQUEST['pass_val'])) {

    $delete_seesion = $_REQUEST['pass_val'];
$db->executeQuery("DELETE FROM `sm_bank_details` WHERE `bank_id` ='$delete_seesion'");

}
?>