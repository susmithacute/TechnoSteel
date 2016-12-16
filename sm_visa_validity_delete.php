
<?php

include('connection.php');

    $delete_seesion = $_POST['pass_val'];
    $values=array();
    $values['status']="delete";
    $db->secure_update("sm_visa_validity",$values,"WHERE `id`='$delete_seesion'");
?>