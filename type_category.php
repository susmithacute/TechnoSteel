<?php
include("connection.php");
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    $res_category = $db->selectQuery("SELECT * FROM `sm_visa_category` WHERE `visa_category_type`='$type' and visa_category_status='1'");
    if (count($res_category)) {
        ?>
        <option  value="">Select</option>
        <?php
        for ($mod = 0; $mod < count($res_category); $mod++) {
            ?>
            <option value="<?php echo $res_category[$mod]['visa_category'] ?>"><?php echo $res_category[$mod]['visa_category']; ?></option>
            <?php
        }
    }
}

if (isset($_POST['v_type']) && isset($_POST['v_category'])) {
    $v_type = $_POST['v_type'];
    $v_category = $_POST['v_category'];
    $select_amount1 = $db->selectQuery("SELECT `visa_fee_total` FROM `sm_visa_fee` WHERE `visa_fee_category`='$v_category' AND `visa_fee_type`='$v_type'");
    if (count($select_amount1) > 0) {
        echo $total_amount1 = $select_amount1[0]['visa_fee_total'];
    }
}
