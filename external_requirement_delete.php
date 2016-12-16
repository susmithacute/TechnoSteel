
<?php

include('connection.php');

    $delete_seesion = $_POST['pass_val'];
    $values=array();
    $values['hiring_requirment_active']="0";
    $db->secure_update("sm_external_requirment",$values,"WHERE `hiring_requirment_id`='$delete_seesion'");
?>