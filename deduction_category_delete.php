<?php



session_start();

include('connection.php');

if (isset($_REQUEST['pass_val'])) {

    $delete_seesion = $_REQUEST['pass_val'];
    $sql = $db->executeQuery("DELETE FROM sm_deduction_category WHERE `deduction_category_id`='$delete_seesion'");
   
}
?>