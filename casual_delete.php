
<?php

include('connection.php');

    $delete_seesion = $_POST['pass_val'];
    $values=array();
    $values['status']="delete";
    $db->secure_update("sm_employee_leave",$values,"WHERE `leave_id`='$delete_seesion'");
?>