<?php
include('connection.php');
if (isset($_REQUEST['update_id'])) {
    $update_seesion = $_REQUEST['update_id'];
    $values=array();
    $values['advance_status']="Approved";
    $db->secure_update("sm_salary_advance",$values, "WHERE `advance_id`='$update_seesion'");
    unset($values);
}