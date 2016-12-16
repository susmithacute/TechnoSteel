<?php
include './connection.php';
if (isset($_POST['emp_id']) && isset($_POST['payment_type'])) {
    $emp_id = $_POST['emp_id'];
    $payment_type = str_replace("<br>", "", $_POST['payment_type']);
    $thisMonth = date('m');
    $value = array();
    $value['sif_payment_type'] = $payment_type;
    $update_sif = $db->secure_update("sm_sif_basic", $value, "WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$thisMonth'");
}
if (isset($_POST['emp_id']) && isset($_POST['notes_comments'])) {
    $emp_id = $_POST['emp_id'];
    $notes_comments = str_replace("<br>", "", $_POST['notes_comments']);
    $thisMonth = date('m');
    $value = array();
    $value['sif_notes_comments'] = $notes_comments;
    $update_sif = $db->secure_update("sm_sif_basic", $value, "WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$thisMonth'");
}
if (isset($_POST['emp_id']) && isset($_POST['popup'])) {
    $eid = $_POST['emp_id'];
    $thisMonth = date('m');
    $deduction_list = $db->selectQuery("SELECT  `deduction_category_id`, `deduction_category` FROM `sm_deduction_category` ORDER BY deduction_category_id DESC ");
    if (count($deduction_list)) {
        $amount = 0;
        ?>  <div class="row"><?php
        for ($cou = 0; $cou < count($deduction_list); $cou++) {
            $cat_id = $deduction_list[$cou]['deduction_category_id'];
			
			if($cat_id=='1')
			{ 
				
            $select_dedc = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE `employee_id`='$eid' AND MONTH(deduction_date)='$thisMonth' AND `deduction_category_id`='$cat_id'");
            if (count($amount)) {
                $amount = $select_dedc[0]['deduction_amount'];
            } else {
                $amount = 0;
            }
            ?>

                <div class="col-md-6">
                    <label class="form-label"><?php echo $deduction_list[$cou]['deduction_category']; ?></label>
                    <input type="text" class="form-control" name="deduction_category[<?php echo $cou; ?>][deduction_amount]" readonly value="<?php echo $amount; ?>"  />
                    <input type="hidden" class="form-control" name="deduction_category[<?php echo $cou; ?>][deduction_category_id]" value="<?php echo $deduction_list[$cou]['deduction_category_id']; ?>" id="deduction_category_id" />
                </div>
                <?php
			  }
			 else if($cat_id=='2')
			{ 
				
            $select_dedc = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE `employee_id`='$eid' AND MONTH(deduction_date)='$thisMonth' AND `deduction_category_id`='$cat_id'");
            if (count($amount)) {
                $amount = $select_dedc[0]['deduction_amount'];
            } else {
                $amount = 0;
            }
            ?>

                <div class="col-md-6">
                    <label class="form-label"><?php echo $deduction_list[$cou]['deduction_category']; ?></label>
                    <input type="text" class="form-control" name="deduction_category[<?php echo $cou; ?>][deduction_amount]" readonly value="<?php echo $amount; ?>"  />
                    <input type="hidden" class="form-control" name="deduction_category[<?php echo $cou; ?>][deduction_category_id]" value="<?php echo $deduction_list[$cou]['deduction_category_id']; ?>" id="deduction_category_id" />
                </div>
                <?php
			  }
			  else
			  {
				 $select_dedc = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE `employee_id`='$eid' AND MONTH(deduction_date)='$thisMonth' AND `deduction_category_id`='$cat_id'");
            if (count($amount)) {
                $amount = $select_dedc[0]['deduction_amount'];
            } else {
                $amount = 0;
            }
            ?>

                <div class="col-md-6">
                    <label class="form-label"><?php echo $deduction_list[$cou]['deduction_category']; ?></label>
                    <input type="text" class="form-control" name="deduction_category[<?php echo $cou; ?>][deduction_amount]" value="<?php echo $amount; ?>"  />
                    <input type="hidden" class="form-control" name="deduction_category[<?php echo $cou; ?>][deduction_category_id]" value="<?php echo $deduction_list[$cou]['deduction_category_id']; ?>" id="deduction_category_id" />
                </div> 
               <?php				
			  }
            }
            ?>  </div>  <?php
        }
    }