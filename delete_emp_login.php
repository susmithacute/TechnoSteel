<?php
include('connection.php');
if (isset($_REQUEST['pass_val'])) {
    $delete_seesion = $_REQUEST['pass_val'];
    $db->executeQuery("DELETE FROM sm_employee_login WHERE `id`='$delete_seesion'");
}
?>